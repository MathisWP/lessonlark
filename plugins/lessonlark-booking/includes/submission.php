<?php
/**
 * Form submission handling.
 *
 * The form posts to admin-post.php so it works without JavaScript; view.js
 * upgrades it to a fetch() request and gets JSON back from the same handler.
 *
 * No nonce: this is a public, logged-out form, where a nonce adds no CSRF
 * protection but does break submissions from pages served by a page cache.
 * Spam is handled by a honeypot, a signed minimum-fill-time token, and a
 * per-IP rate limit instead.
 *
 * @package lessonlark-booking
 */

defined( 'ABSPATH' ) || exit;

const LESSONLARK_BOOKING_MIN_SECONDS = 3;
const LESSONLARK_BOOKING_RATE_LIMIT  = 5;  // Submissions per IP...
const LESSONLARK_BOOKING_RATE_WINDOW = 600; // ...per this many seconds.

add_action( 'admin_post_nopriv_lessonlark_booking_submit', 'lessonlark_booking_handle_submission' );
add_action( 'admin_post_lessonlark_booking_submit', 'lessonlark_booking_handle_submission' );

/**
 * Sign a value so it can round-trip through a hidden field untampered.
 *
 * @param string $value Value to sign.
 * @return string "value.signature"
 */
function lessonlark_booking_sign( $value ) {
	return $value . '.' . wp_hash( $value, 'nonce' );
}

/**
 * Verify a signed value.
 *
 * @param string $signed "value.signature".
 * @return string|false The value, or false if the signature is wrong.
 */
function lessonlark_booking_verify( $signed ) {
	$pos = strrpos( (string) $signed, '.' );
	if ( false === $pos ) {
		return false;
	}
	$value = substr( $signed, 0, $pos );
	return hash_equals( wp_hash( $value, 'nonce' ), substr( $signed, $pos + 1 ) ) ? $value : false;
}

/**
 * Handle a booking submission.
 */
function lessonlark_booking_handle_submission() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- public form; see file header.
	$is_ajax = ! empty( $_POST['llb_ajax'] );
	$return  = isset( $_POST['llb_return'] ) ? esc_url_raw( wp_unslash( $_POST['llb_return'] ) ) : home_url( '/' );
	$return  = wp_validate_redirect( $return, home_url( '/' ) );

	$config = lessonlark_booking_get_config( isset( $_POST['llb_form'] ) ? sanitize_key( wp_unslash( $_POST['llb_form'] ) ) : '' );

	// Honeypot: real people never see this field. Pretend success so bots move on.
	if ( ! empty( $_POST['llb_website'] ) ) {
		lessonlark_booking_respond( $is_ajax, $return, true, $config['success'] ?? '' );
	}

	// Filled in faster than a human could?
	$started = (int) lessonlark_booking_verify( isset( $_POST['llb_token'] ) ? wp_unslash( $_POST['llb_token'] ) : '' );
	if ( ! $started ) {
		lessonlark_booking_respond( $is_ajax, $return, false, __( 'This form has expired. Please reload the page and try again.', 'lessonlark-booking' ) );
	}
	if ( ( time() - $started ) < LESSONLARK_BOOKING_MIN_SECONDS ) {
		lessonlark_booking_respond( $is_ajax, $return, false, __( 'That was quick! Please wait a moment and submit again.', 'lessonlark-booking' ) );
	}

	// Rate limit per IP (hashed, never stored raw).
	$ip_key = 'llb_rate_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	$hits   = (int) get_transient( $ip_key );
	if ( $hits >= LESSONLARK_BOOKING_RATE_LIMIT ) {
		lessonlark_booking_respond( $is_ajax, $return, false, __( 'Too many requests. Please try again in a few minutes, or get in touch directly.', 'lessonlark-booking' ) );
	}
	set_transient( $ip_key, $hits + 1, LESSONLARK_BOOKING_RATE_WINDOW );

	// Collect and validate.
	$allowed_subjects = lessonlark_booking_parse_subjects( $config['subjects'] ?? '' );
	$raw_subjects     = isset( $_POST['llb_subjects'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['llb_subjects'] ) ) : array();

	$data = array(
		'_llb_parent_name' => isset( $_POST['llb_parent_name'] ) ? sanitize_text_field( wp_unslash( $_POST['llb_parent_name'] ) ) : '',
		'_llb_email'       => isset( $_POST['llb_email'] ) ? sanitize_email( wp_unslash( $_POST['llb_email'] ) ) : '',
		'_llb_phone'       => isset( $_POST['llb_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['llb_phone'] ) ) : '',
		'_llb_grade'       => isset( $_POST['llb_grade'] ) ? sanitize_text_field( wp_unslash( $_POST['llb_grade'] ) ) : '',
		'_llb_subjects'    => implode( ', ', array_intersect( $raw_subjects, $allowed_subjects ) ),
		'_llb_format'      => isset( $_POST['llb_format'] ) ? sanitize_text_field( wp_unslash( $_POST['llb_format'] ) ) : '',
		'_llb_times'       => isset( $_POST['llb_times'] ) ? sanitize_text_field( wp_unslash( $_POST['llb_times'] ) ) : '',
		'_llb_message'     => isset( $_POST['llb_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['llb_message'] ) ) : '',
		'_llb_page'        => $return,
	);
	// phpcs:enable

	if ( ! in_array( $data['_llb_grade'], lessonlark_booking_grades(), true ) ) {
		$data['_llb_grade'] = '';
	}
	if ( ! in_array( $data['_llb_format'], lessonlark_booking_formats(), true ) ) {
		$data['_llb_format'] = '';
	}

	$errors = array();
	if ( '' === $data['_llb_parent_name'] ) {
		$errors['llb_parent_name'] = __( 'Please enter your name.', 'lessonlark-booking' );
	}
	if ( ! is_email( $data['_llb_email'] ) ) {
		$errors['llb_email'] = __( 'Please enter a valid email address.', 'lessonlark-booking' );
	}
	$data['_llb_parent_name'] = mb_substr( $data['_llb_parent_name'], 0, 120 );
	$data['_llb_message']     = mb_substr( $data['_llb_message'], 0, 5000 );

	if ( $errors ) {
		lessonlark_booking_respond( $is_ajax, $return, false, __( 'Please fix the highlighted fields.', 'lessonlark-booking' ), $errors );
	}

	// Save a copy first, so a failed email never loses a lead.
	$title   = $data['_llb_parent_name'] . ( $data['_llb_subjects'] ? ' · ' . $data['_llb_subjects'] : '' );
	$post_id = wp_insert_post(
		array(
			'post_type'   => 'lessonlark_booking',
			'post_status' => 'private',
			'post_title'  => $title,
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		lessonlark_booking_respond( $is_ajax, $return, false, __( 'Something went wrong. Please try again, or get in touch directly.', 'lessonlark-booking' ) );
	}
	foreach ( $data as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	lessonlark_booking_send_notification( $post_id, $data, $config );

	if ( ! empty( $config['confirm'] ) ) {
		lessonlark_booking_send_confirmation( $data );
	}

	/**
	 * Fires after a booking request is saved and emailed.
	 *
	 * @param int   $post_id Booking post ID.
	 * @param array $data    Sanitized submission, keyed by meta key.
	 */
	do_action( 'lessonlark_booking_submitted', $post_id, $data );

	lessonlark_booking_respond( $is_ajax, $return, true, $config['success'] ?? '' );
}

/**
 * Email the site owner.
 *
 * @param int   $post_id Booking ID.
 * @param array $data    Submission.
 * @param array $config  Block config.
 * @return bool Whether wp_mail() reported success.
 */
function lessonlark_booking_send_notification( $post_id, $data, $config ) {
	$to = ! empty( $config['recipient'] ) && is_email( $config['recipient'] ) ? $config['recipient'] : get_option( 'admin_email' );

	$lines = array();
	foreach ( lessonlark_booking_meta_labels() as $key => $label ) {
		if ( '' !== $data[ $key ] ) {
			$lines[] = $label . ': ' . $data[ $key ];
		}
	}
	$lines[] = '';
	/* translators: %s: Admin URL. */
	$lines[] = sprintf( __( 'View in WordPress: %s', 'lessonlark-booking' ), admin_url( 'post.php?post=' . $post_id . '&action=edit' ) );

	/* translators: 1: Parent name. 2: Site name. */
	$subject = sprintf( __( 'New booking request from %1$s (%2$s)', 'lessonlark-booking' ), $data['_llb_parent_name'], wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$headers = array( 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>' ), '', $data['_llb_parent_name'] ) . ' <' . $data['_llb_email'] . '>' );

	return wp_mail( $to, $subject, implode( "\n", $lines ), $headers );
}

/**
 * Send the visitor a short confirmation. Deliberately contains none of their
 * free-text input, so the form can't be used to relay spam to third parties.
 *
 * @param array $data Submission.
 */
function lessonlark_booking_send_confirmation( $data ) {
	$site = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	/* translators: %s: Site name. */
	$subject = sprintf( __( 'Your tutoring request with %s', 'lessonlark-booking' ), $site );
	$body    = implode(
		"\n\n",
		array(
			__( 'Hi there,', 'lessonlark-booking' ),
			__( 'Thanks for reaching out! Your tutoring request has been received, and you’ll hear back within one business day to set up a free consultation.', 'lessonlark-booking' ),
			/* translators: %s: Site name. */
			sprintf( __( '— %s', 'lessonlark-booking' ), $site ),
		)
	);
	wp_mail( $data['_llb_email'], $subject, $body );
}

/**
 * Finish the request: JSON for fetch(), redirect for plain form posts.
 *
 * @param bool   $is_ajax Whether the request came from view.js.
 * @param string $return  Page to send the visitor back to.
 * @param bool   $success Outcome.
 * @param string $message Message to show.
 * @param array  $errors  Field errors keyed by input name.
 */
function lessonlark_booking_respond( $is_ajax, $return, $success, $message, $errors = array() ) {
	if ( $is_ajax ) {
		$payload = array(
			'message' => $message,
			'errors'  => $errors,
		);
		$success ? wp_send_json_success( $payload ) : wp_send_json_error( $payload, 400 );
	}
	$url = add_query_arg( 'lessonlark_booking', $success ? 'sent' : 'error', $return );
	wp_safe_redirect( $url . '#lessonlark-booking' );
	exit;
}
