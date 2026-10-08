<?php
/**
 * Title: Call to Action
 * Slug: lessonlark/cta
 * Categories: lessonlark, call-to-action
 * Keywords: cta, contact, book, consultation
 * Description: Rounded, high-contrast panel inviting visitors to book a consultation.
 *
 * @package lessonlark
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"align":"wide","className":"lessonlark-cta","style":{"border":{"radius":"32px"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"backgroundColor":"primary","textColor":"surface","layout":{"type":"constrained","contentSize":"40rem"}} -->
	<div class="wp-block-group alignwide lessonlark-cta has-surface-color has-primary-background-color has-text-color has-background" style="border-radius:32px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'Your student’s best year starts with one conversation', 'lessonlark' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
		<p class="has-text-align-center has-large-font-size"><?php echo esc_html__( 'Book a free 20-minute consultation. I’ll listen, get to know your student, and suggest a plan that fits.', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
			<!-- wp:button {"backgroundColor":"sunshine","textColor":"contrast"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-sunshine-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/#book' ) ); ?>"><?php echo esc_html__( 'Book your free consultation', 'lessonlark' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"metadata":{"name":"Call button","bindings":{"text":{"source":"lessonlark/contact","args":{"key":"call_label"}},"url":{"source":"lessonlark/contact","args":{"key":"phone_url"}}}},"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:+15550123456"><?php echo esc_html__( 'Call (555) 012-3456', 'lessonlark' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:paragraph {"align":"center","className":"lessonlark-soft-text","fontSize":"small"} -->
		<p class="has-text-align-center lessonlark-soft-text has-small-font-size"><?php echo esc_html__( 'Free · No commitment · Online or in person', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
