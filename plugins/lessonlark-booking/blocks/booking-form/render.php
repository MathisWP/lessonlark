<?php
/**
 * Front-end markup for the Booking form block.
 *
 * @package lessonlark-booking
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

$llb_defaults = lessonlark_booking_default_config();
$llb_config   = array(
	'recipient' => sanitize_email( $attributes['recipient'] ),
	'success'   => '' !== trim( $attributes['successMessage'] ) ? $attributes['successMessage'] : $llb_defaults['success'],
	'confirm'   => (bool) $attributes['sendConfirmation'],
	'subjects'  => '' !== trim( $attributes['subjects'] ) ? $attributes['subjects'] : $llb_defaults['subjects'],
);
$llb_subjects = lessonlark_booking_parse_subjects( $llb_config['subjects'] );
$llb_submit   = '' !== trim( $attributes['submitLabel'] ) ? $attributes['submitLabel'] : __( 'Request my free consultation', 'lessonlark-booking' );

// One block usually appears once per page; give the first one a stable anchor for no-JS redirects.
$llb_instance = lessonlark_booking_next_instance();
$llb_id = 1 === $llb_instance ? 'lessonlark-booking' : 'lessonlark-booking-' . $llb_instance;
$llb_p  = $llb_id . '-'; // Prefix for input IDs.

// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display-only status flag.
$llb_status = isset( $_GET['lessonlark_booking'] ) ? sanitize_key( $_GET['lessonlark_booking'] ) : '';

// The page to come back to after a no-JS submit. The handler re-validates it against this host.
$llb_host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
$llb_uri    = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';
$llb_return = remove_query_arg( 'lessonlark_booking', set_url_scheme( 'http://' . $llb_host . $llb_uri ) );
?>
<div <?php echo get_block_wrapper_attributes( array( 'id' => $llb_id, 'class' => 'lessonlark-booking' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="lessonlark-booking__success" role="status" tabindex="-1" <?php echo 'sent' === $llb_status && 1 === $llb_instance ? '' : 'hidden'; ?>>
		<span class="lessonlark-booking__success-icon" aria-hidden="true">✓</span>
		<p class="lessonlark-booking__success-title"><?php esc_html_e( 'Request sent!', 'lessonlark-booking' ); ?></p>
		<p class="lessonlark-booking__success-text"><?php echo esc_html( $llb_config['success'] ); ?></p>
	</div>

	<form class="lessonlark-booking__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate <?php echo 'sent' === $llb_status && 1 === $llb_instance ? 'hidden' : ''; ?>>
		<p class="lessonlark-booking__alert" role="alert" <?php echo 'error' === $llb_status && 1 === $llb_instance ? '' : 'hidden'; ?>><?php esc_html_e( 'Sorry, something went wrong. Please check the form and try again.', 'lessonlark-booking' ); ?></p>

		<div class="lessonlark-booking__grid">
			<div class="lessonlark-booking__field">
				<label for="<?php echo esc_attr( $llb_p ); ?>name"><?php esc_html_e( 'Your name', 'lessonlark-booking' ); ?> <span class="lessonlark-booking__req" aria-hidden="true">*</span></label>
				<input id="<?php echo esc_attr( $llb_p ); ?>name" name="llb_parent_name" type="text" autocomplete="name" required maxlength="120" data-error="<?php esc_attr_e( 'Please enter your name.', 'lessonlark-booking' ); ?>">
			</div>

			<div class="lessonlark-booking__field">
				<label for="<?php echo esc_attr( $llb_p ); ?>email"><?php esc_html_e( 'Email', 'lessonlark-booking' ); ?> <span class="lessonlark-booking__req" aria-hidden="true">*</span></label>
				<input id="<?php echo esc_attr( $llb_p ); ?>email" name="llb_email" type="email" autocomplete="email" required data-error="<?php esc_attr_e( 'Please enter a valid email address.', 'lessonlark-booking' ); ?>">
			</div>

			<div class="lessonlark-booking__field">
				<label for="<?php echo esc_attr( $llb_p ); ?>phone"><?php esc_html_e( 'Phone', 'lessonlark-booking' ); ?> <span class="lessonlark-booking__opt"><?php esc_html_e( '(optional)', 'lessonlark-booking' ); ?></span></label>
				<input id="<?php echo esc_attr( $llb_p ); ?>phone" name="llb_phone" type="tel" autocomplete="tel">
			</div>

			<div class="lessonlark-booking__field">
				<label for="<?php echo esc_attr( $llb_p ); ?>grade"><?php esc_html_e( 'Student’s grade', 'lessonlark-booking' ); ?></label>
				<select id="<?php echo esc_attr( $llb_p ); ?>grade" name="llb_grade">
					<option value=""><?php esc_html_e( 'Choose…', 'lessonlark-booking' ); ?></option>
					<?php foreach ( lessonlark_booking_grades() as $llb_grade ) : ?>
					<option value="<?php echo esc_attr( $llb_grade ); ?>"><?php echo esc_html( $llb_grade ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<?php if ( $llb_subjects ) : ?>
		<fieldset class="lessonlark-booking__field">
			<legend><?php esc_html_e( 'Subjects', 'lessonlark-booking' ); ?></legend>
			<div class="lessonlark-booking__chips">
				<?php foreach ( $llb_subjects as $llb_subject ) : ?>
				<label class="lessonlark-booking__chip"><input type="checkbox" name="llb_subjects[]" value="<?php echo esc_attr( $llb_subject ); ?>"><span><?php echo esc_html( $llb_subject ); ?></span></label>
				<?php endforeach; ?>
			</div>
		</fieldset>
		<?php endif; ?>

		<fieldset class="lessonlark-booking__field">
			<legend><?php esc_html_e( 'Sessions', 'lessonlark-booking' ); ?></legend>
			<div class="lessonlark-booking__chips">
				<?php foreach ( lessonlark_booking_formats() as $llb_i => $llb_format ) : ?>
				<label class="lessonlark-booking__chip"><input type="radio" name="llb_format" value="<?php echo esc_attr( $llb_format ); ?>" <?php checked( 0, $llb_i ); ?>><span><?php echo esc_html( $llb_format ); ?></span></label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<div class="lessonlark-booking__field">
			<label for="<?php echo esc_attr( $llb_p ); ?>times"><?php esc_html_e( 'Best days & times', 'lessonlark-booking' ); ?></label>
			<input id="<?php echo esc_attr( $llb_p ); ?>times" name="llb_times" type="text" placeholder="<?php esc_attr_e( 'e.g. Weekday afternoons after 4 PM', 'lessonlark-booking' ); ?>">
		</div>

		<div class="lessonlark-booking__field">
			<label for="<?php echo esc_attr( $llb_p ); ?>message"><?php esc_html_e( 'What would you like help with?', 'lessonlark-booking' ); ?></label>
			<textarea id="<?php echo esc_attr( $llb_p ); ?>message" name="llb_message" rows="4" maxlength="5000" placeholder="<?php esc_attr_e( 'Upcoming tests, tricky topics, goals for this year…', 'lessonlark-booking' ); ?>"></textarea>
		</div>

		<div class="lessonlark-booking__hp" aria-hidden="true">
			<label for="<?php echo esc_attr( $llb_p ); ?>website"><?php esc_html_e( 'Leave this field empty', 'lessonlark-booking' ); ?></label>
			<input id="<?php echo esc_attr( $llb_p ); ?>website" name="llb_website" type="text" tabindex="-1" autocomplete="off">
		</div>

		<input type="hidden" name="action" value="lessonlark_booking_submit">
		<input type="hidden" name="llb_form" value="<?php echo esc_attr( lessonlark_booking_config_key( $llb_config ) ); ?>">
		<input type="hidden" name="llb_token" value="<?php echo esc_attr( lessonlark_booking_sign( (string) time() ) ); ?>">
		<input type="hidden" name="llb_return" value="<?php echo esc_url( $llb_return ); ?>">

		<div class="lessonlark-booking__footer">
			<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button" data-sending="<?php esc_attr_e( 'Sending…', 'lessonlark-booking' ); ?>"><?php echo esc_html( $llb_submit ); ?></button></div>
			<p class="lessonlark-booking__note"><?php esc_html_e( 'Free, no commitment. You’ll hear back within one business day.', 'lessonlark-booking' ); ?></p>
		</div>
	</form>
</div>
