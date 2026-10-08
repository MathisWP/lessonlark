<?php
/**
 * Title: Footer
 * Slug: lessonlark/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Dark footer with brand, subject links, navigation, contact details, and copyright.
 *
 * @package lessonlark
 */

$lessonlark_footer_heading = '<!-- wp:heading {"level":2,"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"}},"textColor":"sunshine","fontSize":"small","fontFamily":"sans"} -->
			<h2 class="wp-block-heading has-sunshine-color has-text-color has-sans-font-family has-small-font-size" style="font-weight:700;letter-spacing:0.1em;text-transform:uppercase">%s</h2>
			<!-- /wp:heading -->';
?>
<!-- wp:group {"align":"full","className":"lessonlark-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull lessonlark-footer has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"36%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column" style="flex-basis:36%">
			<!-- wp:site-title {"level":0,"fontSize":"large"} /-->

			<!-- wp:paragraph {"className":"lessonlark-soft-text"} -->
			<p class="lessonlark-soft-text"><?php echo esc_html__( 'Personal tutoring that helps students grow with confidence, one session at a time.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column">
			<?php printf( $lessonlark_footer_heading, esc_html__( 'Subjects', 'lessonlark' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<!-- wp:list {"fontSize":"small"} -->
			<ul class="wp-block-list has-small-font-size">
				<?php foreach ( array( __( 'Math', 'lessonlark' ), __( 'Science', 'lessonlark' ), __( 'Reading & Writing', 'lessonlark' ), __( 'Test Prep', 'lessonlark' ) ) as $lessonlark_subject ) : ?>
				<!-- wp:list-item -->
				<li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>"><?php echo esc_html( $lessonlark_subject ); ?></a></li>
				<!-- /wp:list-item -->
				<?php endforeach; ?>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column">
			<?php printf( $lessonlark_footer_heading, esc_html__( 'Explore', 'lessonlark' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.6rem"}},"fontSize":"small"} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column">
			<?php printf( $lessonlark_footer_heading, esc_html__( 'Contact', 'lessonlark' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<!-- wp:paragraph {"metadata":{"name":"Email & phone","bindings":{"content":{"source":"lessonlark/contact","args":{"key":"email_phone"}}}},"fontSize":"small"} -->
			<p class="has-small-font-size"><a href="mailto:hello@example.com">hello@example.com</a><br><a href="tel:+15550123456"><?php echo esc_html__( '(555) 012-3456', 'lessonlark' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"metadata":{"name":"Hours","bindings":{"content":{"source":"lessonlark/contact","args":{"key":"hours"}}}},"className":"lessonlark-soft-text","fontSize":"small"} -->
			<p class="lessonlark-soft-text has-small-font-size"><?php echo esc_html__( 'Mon–Fri 3–8 PM · Sat 9 AM–1 PM', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:group {"align":"wide","className":"lessonlark-footer-bottom","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide lessonlark-footer-bottom" style="margin-top:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:paragraph {"className":"lessonlark-soft-text","fontSize":"small"} -->
		<p class="lessonlark-soft-text has-small-font-size"><?php /* translators: 1: Current year. 2: Site name. */ printf( esc_html__( '© %1$s %2$s. All rights reserved.', 'lessonlark' ), esc_html( gmdate( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"fontSize":"small"} -->
		<p class="has-small-font-size"><a href="#"><?php echo esc_html__( 'Back to top ↑', 'lessonlark' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
