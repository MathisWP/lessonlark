<?php
/**
 * Title: Book a session
 * Slug: lessonlark/booking
 * Categories: lessonlark, contact
 * Keywords: book, booking, contact, form, consultation
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Description: Booking section with next steps on the left and the booking form in a card. Shows email/phone buttons if the Lessonlark Booking plugin isn't active.
 *
 * @package lessonlark
 */

$lessonlark_steps = array(
	__( 'Tell us a bit about your student using the form.', 'lessonlark' ),
	__( 'We reply within one business day to schedule a free 20-minute call.', 'lessonlark' ),
	__( 'We match you with the right tutor and book the first session.', 'lessonlark' ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr__( 'Book a session', 'lessonlark' ); ?>"},"anchor":"book","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"tint","layout":{"type":"constrained"}} -->
<div id="book" class="wp-block-group alignfull has-tint-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"40%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html__( 'Book a session', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html__( 'Tell us about your student', 'lessonlark' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
			<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'It takes about a minute. There’s no cost and no commitment.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40)">
				<?php foreach ( $lessonlark_steps as $lessonlark_i => $lessonlark_step ) : ?>
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
				<div class="wp-block-group">
					<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"sunshine","textColor":"contrast","layout":{"type":"default"}} -->
					<div class="wp-block-group lessonlark-avatar has-contrast-color has-sunshine-background-color has-text-color has-background">
						<!-- wp:paragraph -->
						<p><?php echo esc_html( $lessonlark_i + 1 ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:paragraph {"style":{"spacing":{"padding":{"top":"0.55rem"}}}} -->
					<p style="padding-top:0.55rem"><?php echo esc_html( $lessonlark_step ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<?php endforeach; ?>
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"style":{"border":{"radius":"20px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0.25rem","margin":{"top":"var:preset|spacing|40"}}},"backgroundColor":"surface","layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group has-surface-background-color has-background" style="border-radius:20px;margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
				<p style="font-weight:700"><?php echo esc_html__( 'Prefer to talk?', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"name":"Phone, email & hours","bindings":{"content":{"source":"lessonlark/contact","args":{"key":"talk"}}}},"textColor":"muted","fontSize":"small"} -->
				<p class="has-muted-color has-text-color has-small-font-size"><a href="tel:+15550123456"><?php echo esc_html__( '(555) 012-3456', 'lessonlark' ); ?></a> · <a href="mailto:hello@example.com">hello@example.com</a><br><?php echo esc_html__( 'Mon–Fri 3–8 PM · Sat 9 AM–1 PM', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%">
			<!-- wp:group {"style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"shadow":"var:preset|shadow|lifted"},"backgroundColor":"surface","layout":{"type":"default"}} -->
			<div class="wp-block-group has-surface-background-color has-background" style="border-radius:28px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);box-shadow:var(--wp--preset--shadow--lifted)">
				<?php if ( WP_Block_Type_Registry::get_instance()->is_registered( 'lessonlark/booking-form' ) ) : ?>
				<!-- wp:lessonlark/booking-form /-->
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
