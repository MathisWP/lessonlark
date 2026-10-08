<?php
/**
 * Block markup shown in the booking patterns when the Lessonlark Booking plugin
 * isn't active: a simple "email or call us" card instead of a broken block.
 *
 * @package lessonlark
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:heading {"level":3,"fontSize":"x-large"} -->
<h3 class="wp-block-heading has-x-large-font-size"><?php echo esc_html__( 'Request a free consultation', 'lessonlark' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html__( 'Email or call us with your student’s grade and the subjects they need help with. We’ll reply within one business day.', 'lessonlark' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com"><?php echo esc_html__( 'Email us', 'lessonlark' ); ?></a></div>
	<!-- /wp:button -->

	<!-- wp:button {"className":"is-style-outline"} -->
	<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:+15550123456"><?php echo esc_html__( 'Call (555) 012-3456', 'lessonlark' ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
