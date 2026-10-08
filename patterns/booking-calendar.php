<?php
/**
 * Title: Book a session (calendar)
 * Slug: lessonlark/booking-calendar
 * Categories: lessonlark, contact
 * Keywords: book, booking, calendly, cal.com, schedule, calendar
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Description: Booking section with a Cal.com or Calendly calendar so visitors pick an exact time. Paste your booking link into the Scheduler block.
 *
 * @package lessonlark
 */

$lessonlark_points = array(
	__( 'Pick any open slot. It’s confirmed instantly.', 'lessonlark' ),
	__( 'You’ll get a calendar invite and a reminder.', 'lessonlark' ),
	__( 'Need to reschedule? Use the link in your email.', 'lessonlark' ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr__( 'Book a session (calendar)', 'lessonlark' ); ?>"},"anchor":"book","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"tint","layout":{"type":"constrained"}} -->
<div id="book" class="wp-block-group alignfull has-tint-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"36%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:36%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html__( 'Book a session', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html__( 'Choose a time that works for you', 'lessonlark' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
			<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'Your first 20-minute consultation is free. We’ll talk goals, then build a plan together.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"lessonlark-checklist"} -->
			<ul class="wp-block-list lessonlark-checklist">
				<?php foreach ( $lessonlark_points as $lessonlark_point ) : ?>
				<!-- wp:list-item -->
				<li><?php echo esc_html( $lessonlark_point ); ?></li>
				<!-- /wp:list-item -->
				<?php endforeach; ?>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"64%"} -->
		<div class="wp-block-column" style="flex-basis:64%">
			<!-- wp:group {"style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"shadow":"var:preset|shadow|lifted"},"backgroundColor":"surface","layout":{"type":"default"}} -->
			<div class="wp-block-group has-surface-background-color has-background" style="border-radius:28px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);box-shadow:var(--wp--preset--shadow--lifted)">
				<?php if ( WP_Block_Type_Registry::get_instance()->is_registered( 'lessonlark/scheduler' ) ) : ?>
				<!-- wp:lessonlark/scheduler {"height":720} /-->
				<?php else : ?>
				<?php require __DIR__ . '/../inc/booking-fallback.php'; ?>
				<?php endif; ?>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
