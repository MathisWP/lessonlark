<?php
/**
 * Form field definitions shared by the form renderer, the submission handler, and the admin screen.
 *
 * @package lessonlark-booking
 */

defined( 'ABSPATH' ) || exit;

/**
 * Grade levels offered in the "Student's grade" dropdown.
 *
 * @return string[]
 */
function lessonlark_booking_grades() {
	return apply_filters(
		'lessonlark_booking_grades',
		array(
			__( 'Elementary (K–5)', 'lessonlark-booking' ),
			__( 'Middle school (6–8)', 'lessonlark-booking' ),
			__( 'High school (9–12)', 'lessonlark-booking' ),
			__( 'College', 'lessonlark-booking' ),
			__( 'Adult learner', 'lessonlark-booking' ),
		)
	);
}

/**
 * Session format options.
 *
 * @return string[]
 */
function lessonlark_booking_formats() {
	return apply_filters(
		'lessonlark_booking_formats',
		array(
			__( 'Online', 'lessonlark-booking' ),
			__( 'In person', 'lessonlark-booking' ),
			__( 'Either', 'lessonlark-booking' ),
		)
	);
}

/**
 * Split the block's comma-separated subject list into clean labels.
 *
 * @param string $list Comma-separated subjects.
 * @return string[]
 */
function lessonlark_booking_parse_subjects( $list ) {
	return array_values( array_filter( array_map( 'trim', explode( ',', (string) $list ) ) ) );
}

/**
 * Default block settings, also used if a submitted form's settings can't be found.
 *
 * @return array
 */
function lessonlark_booking_default_config() {
	return array(
		'recipient' => '',
		'success'   => __( 'Thanks! Your request is in. You’ll hear back within one business day.', 'lessonlark-booking' ),
		'confirm'   => true,
		'subjects'  => __( 'Math, Science, Reading & Writing, Test Prep, Languages, Study Skills', 'lessonlark-booking' ),
	);
}

/**
 * Store a form's settings server-side and return a short key for the hidden field.
 * Keeps the recipient address out of the page source.
 *
 * @param array $config Form settings.
 * @return string Key.
 */
function lessonlark_booking_config_key( $config ) {
	$key = substr( md5( wp_json_encode( $config ) ), 0, 12 );
	// Editor previews re-render on every keystroke; only store settings from real page views.
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return $key;
	}
	$configs = get_option( 'lessonlark_booking_forms', array() );
	if ( ! isset( $configs[ $key ] ) ) {
		$configs[ $key ] = $config;
		$configs         = array_slice( $configs, -25, null, true ); // Old settings from past edits age out.
		update_option( 'lessonlark_booking_forms', $configs, false );
	}
	return $key;
}

/**
 * Count booking forms rendered on this request, so the first gets a stable anchor.
 *
 * @return int 1 for the first form, 2 for the second...
 */
function lessonlark_booking_next_instance() {
	static $count = 0;
	return ++$count;
}

/**
 * Look up a form's settings by key.
 *
 * @param string $key Key from lessonlark_booking_config_key().
 * @return array
 */
function lessonlark_booking_get_config( $key ) {
	$configs = get_option( 'lessonlark_booking_forms', array() );
	return isset( $configs[ $key ] ) ? $configs[ $key ] : lessonlark_booking_default_config();
}

/**
 * Meta keys stored on each booking, mapped to their admin labels.
 *
 * @return array<string, string>
 */
function lessonlark_booking_meta_labels() {
	return array(
		'_llb_parent_name' => __( 'Name', 'lessonlark-booking' ),
		'_llb_email'       => __( 'Email', 'lessonlark-booking' ),
		'_llb_phone'       => __( 'Phone', 'lessonlark-booking' ),
		'_llb_grade'       => __( 'Student’s grade', 'lessonlark-booking' ),
		'_llb_subjects'    => __( 'Subjects', 'lessonlark-booking' ),
		'_llb_format'      => __( 'Format', 'lessonlark-booking' ),
		'_llb_times'       => __( 'Preferred times', 'lessonlark-booking' ),
		'_llb_message'     => __( 'Message', 'lessonlark-booking' ),
		'_llb_page'        => __( 'Submitted from', 'lessonlark-booking' ),
	);
}
