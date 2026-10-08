<?php
/**
 * Contact details: set phone, email, and hours once under Appearance → Contact
 * details, and every place the theme shows them (footer, booking section,
 * call and email buttons) updates, text and links together.
 *
 * Blocks connect to these values with the Block Bindings API, source
 * "lessonlark/contact". When a value isn't set, blocks keep the sample text
 * saved in their markup.
 *
 * @package lessonlark
 */

defined( 'ABSPATH' ) || exit;

/**
 * Saved contact details.
 *
 * @return array{phone:string,email:string,hours:string}
 */
function lessonlark_contact_details() {
	$saved = get_theme_mod( 'lessonlark_contact', array() );
	return array(
		'phone' => isset( $saved['phone'] ) ? (string) $saved['phone'] : '',
		'email' => isset( $saved['email'] ) ? (string) $saved['email'] : '',
		'hours' => isset( $saved['hours'] ) ? (string) $saved['hours'] : '',
	);
}

/**
 * Value for one binding key, or null to keep the block's own sample content.
 *
 * Until any detail is saved, every block keeps its sample text. Once something
 * is saved, only real details show: an empty field comes back as '' (hidden)
 * rather than falling back to the sample, so real and sample info never mix.
 *
 * Keys: phone, email, hours, phone_url, email_url, call_label,
 * email_phone (two links on separate lines), talk (phone · email, then hours).
 *
 * @param string $key Binding key.
 * @return string|null
 */
function lessonlark_contact_value( $key ) {
	$c   = lessonlark_contact_details();
	$any = '' !== $c['phone'] || '' !== $c['email'] || '' !== $c['hours'];

	$phone_url = '' !== $c['phone'] ? 'tel:' . preg_replace( '/[^0-9+]/', '', $c['phone'] ) : '';
	$email_url = '' !== $c['email'] ? 'mailto:' . $c['email'] : '';

	$phone_link = $phone_url ? sprintf( '<a href="%1$s">%2$s</a>', esc_url( $phone_url, array( 'tel' ) ), esc_html( $c['phone'] ) ) : '';
	$email_link = $email_url ? sprintf( '<a href="%1$s">%2$s</a>', esc_url( $email_url, array( 'mailto' ) ), esc_html( $c['email'] ) ) : '';

	switch ( $key ) {
		case 'phone':
		case 'email':
		case 'hours':
			if ( '' !== $c[ $key ] ) {
				return esc_html( $c[ $key ] );
			}
			return $any ? '' : null;
		case 'phone_url':
			return $phone_url ? $phone_url : null;
		case 'email_url':
			return $email_url ? $email_url : null;
		case 'call_label':
			/* translators: %s: Phone number. */
			return '' !== $c['phone'] ? esc_html( sprintf( __( 'Call %s', 'lessonlark' ), $c['phone'] ) ) : null;
		case 'email_phone':
			$parts = array_filter( array( $email_link, $phone_link ) );
			if ( $parts ) {
				return implode( '<br>', $parts );
			}
			return $any ? '' : null;
		case 'talk':
			$line  = implode( ' · ', array_filter( array( $phone_link, $email_link ) ) );
			$hours = '' !== $c['hours'] ? esc_html( $c['hours'] ) : '';
			$html  = implode( '<br>', array_filter( array( $line, $hours ) ) );
			if ( '' !== $html ) {
				return $html;
			}
			return $any ? '' : null;
	}
	return null;
}

/**
 * Register the binding source.
 */
function lessonlark_register_contact_source() {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}
	register_block_bindings_source(
		'lessonlark/contact',
		array(
			'label'              => __( 'Contact details', 'lessonlark' ),
			'get_value_callback' => static function ( $source_args ) {
				return isset( $source_args['key'] ) ? lessonlark_contact_value( $source_args['key'] ) : null;
			},
		)
	);
}
add_action( 'init', 'lessonlark_register_contact_source' );

/**
 * Show the saved values in the block editor too, so connected blocks preview correctly.
 */
function lessonlark_contact_editor_script() {
	$keys   = array( 'phone', 'email', 'hours', 'phone_url', 'email_url', 'call_label', 'email_phone', 'talk' );
	$values = array();
	foreach ( $keys as $key ) {
		$values[ $key ] = lessonlark_contact_value( $key );
	}
	wp_enqueue_script( 'lessonlark-contact-bindings', get_template_directory_uri() . '/assets/js/contact-bindings.js', array( 'wp-blocks', 'wp-i18n' ), wp_get_theme()->get( 'Version' ), true );
	wp_add_inline_script(
		'lessonlark-contact-bindings',
		'window.lessonlarkContact = ' . wp_json_encode(
			array(
				'values'      => $values,
				'label'       => __( 'Contact details', 'lessonlark' ),
				'settingsUrl' => admin_url( 'themes.php?page=lessonlark-contact' ),
			)
		) . ';',
		'before'
	);
}
add_action( 'enqueue_block_editor_assets', 'lessonlark_contact_editor_script' );

/**
 * Appearance → Contact details.
 */
function lessonlark_contact_menu() {
	add_theme_page( __( 'Contact details', 'lessonlark' ), __( 'Contact details', 'lessonlark' ), 'edit_theme_options', 'lessonlark-contact', 'lessonlark_contact_page' );
}
add_action( 'admin_menu', 'lessonlark_contact_menu' );

/**
 * Settings screen.
 */
function lessonlark_contact_page() {
	$c = lessonlark_contact_details();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Contact details', 'lessonlark' ); ?></h1>
		<p><?php esc_html_e( 'Enter these once. They appear in the footer, the “Book a session” section, and the call and email buttons, and the phone and email links update with them.', 'lessonlark' ); ?></p>
		<?php // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display-only flag. ?>
		<?php if ( isset( $_GET['updated'] ) ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Contact details saved.', 'lessonlark' ); ?></p></div>
		<?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="lessonlark_save_contact">
			<?php wp_nonce_field( 'lessonlark_save_contact' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="lessonlark-phone"><?php esc_html_e( 'Phone', 'lessonlark' ); ?></label></th>
					<td><input type="tel" id="lessonlark-phone" name="phone" class="regular-text" value="<?php echo esc_attr( $c['phone'] ); ?>" placeholder="(555) 012-3456">
					<p class="description"><?php esc_html_e( 'Shown as you type it. The call link uses just the digits (and a leading +).', 'lessonlark' ); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><label for="lessonlark-email"><?php esc_html_e( 'Email', 'lessonlark' ); ?></label></th>
					<td><input type="email" id="lessonlark-email" name="email" class="regular-text" value="<?php echo esc_attr( $c['email'] ); ?>" placeholder="hello@example.com"></td>
				</tr>
				<tr>
					<th scope="row"><label for="lessonlark-hours"><?php esc_html_e( 'Hours', 'lessonlark' ); ?></label></th>
					<td><input type="text" id="lessonlark-hours" name="hours" class="regular-text" value="<?php echo esc_attr( $c['hours'] ); ?>" placeholder="<?php esc_attr_e( 'Mon–Fri 3–8 PM · Sat 9 AM–1 PM', 'lessonlark' ); ?>"></td>
				</tr>
			</table>
			<p class="description"><?php esc_html_e( 'Phone and email are used on the call and email buttons, so fill in both. Hours are optional and are hidden if left empty. Until you save, your site shows sample contact details.', 'lessonlark' ); ?></p>
			<?php submit_button( __( 'Save contact details', 'lessonlark' ) ); ?>
		</form>
	</div>
	<?php
}

/**
 * Save the settings screen.
 */
function lessonlark_save_contact() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'lessonlark' ), 403 );
	}
	check_admin_referer( 'lessonlark_save_contact' );
	set_theme_mod(
		'lessonlark_contact',
		array(
			'phone' => isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '',
			'email' => isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '',
			'hours' => isset( $_POST['hours'] ) ? sanitize_text_field( wp_unslash( $_POST['hours'] ) ) : '',
		)
	);
	wp_safe_redirect( admin_url( 'themes.php?page=lessonlark-contact&updated=1' ) );
	exit;
}
add_action( 'admin_post_lessonlark_save_contact', 'lessonlark_save_contact' );

/**
 * Nudge on the Dashboard until contact details are filled in.
 */
function lessonlark_contact_notice() {
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'themes' ), true ) || ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$c = lessonlark_contact_details();
	if ( '' !== $c['phone'] && '' !== $c['email'] ) {
		return;
	}
	if ( get_user_meta( get_current_user_id(), 'lessonlark_contact_notice_dismissed', true ) ) {
		return;
	}
	$dismiss = wp_nonce_url( add_query_arg( 'lessonlark-contact-dismiss', '1' ), 'lessonlark_contact_dismiss' );
	?>
	<div class="notice notice-info">
		<p><strong><?php esc_html_e( 'Lessonlark:', 'lessonlark' ); ?></strong> <?php esc_html_e( 'Add your phone, email, and hours once and they’ll replace the sample contact details everywhere on your site.', 'lessonlark' ); ?></p>
		<p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=lessonlark-contact' ) ); ?>"><?php esc_html_e( 'Add contact details', 'lessonlark' ); ?></a>
			<a class="button-link" style="margin-left:8px" href="<?php echo esc_url( $dismiss ); ?>"><?php esc_html_e( 'Dismiss', 'lessonlark' ); ?></a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'lessonlark_contact_notice' );

/**
 * Remember a dismissal.
 */
function lessonlark_contact_notice_dismiss() {
	if ( empty( $_GET['lessonlark-contact-dismiss'] ) ) {
		return;
	}
	check_admin_referer( 'lessonlark_contact_dismiss' );
	update_user_meta( get_current_user_id(), 'lessonlark_contact_notice_dismissed', 1 );
	wp_safe_redirect( remove_query_arg( array( 'lessonlark-contact-dismiss', '_wpnonce' ) ) );
	exit;
}
add_action( 'admin_init', 'lessonlark_contact_notice_dismiss' );
