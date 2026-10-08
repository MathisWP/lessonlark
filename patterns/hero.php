<?php
/**
 * Title: Hero
 * Slug: lessonlark/hero
 * Categories: lessonlark, featured, banner
 * Keywords: hero, header, intro, banner
 * Description: Two-column hero with headline, calls to action, social proof, and a collage of preview cards.
 *
 * @package lessonlark
 */
?>
<!-- wp:group {"align":"full","className":"lessonlark-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull lessonlark-hero" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<?php require __DIR__ . '/../inc/hero-intro.php'; ?>

		<!-- wp:column {"verticalAlignment":"center","width":"44%","className":"lessonlark-hero-art"} -->
		<div class="wp-block-column is-vertically-aligned-center lessonlark-hero-art" style="flex-basis:44%">
			<!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group">
					<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"tint","textColor":"primary","layout":{"type":"default"}} -->
					<div class="wp-block-group lessonlark-avatar has-primary-color has-tint-background-color has-text-color has-background">
						<!-- wp:paragraph -->
						<p>SR</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
						<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html__( 'Next session · Tue 4:00 PM', 'lessonlark' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
						<p style="font-weight:700"><?php echo esc_html__( 'Algebra II with Ms. Rivera', 'lessonlark' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"0.6rem","bottom":"0.6rem","left":"0.9rem","right":"0.9rem"}}},"backgroundColor":"mint","fontSize":"small"} -->
				<p class="has-mint-background-color has-background has-small-font-size" style="border-radius:12px;padding-top:0.6rem;padding-right:0.9rem;padding-bottom:0.6rem;padding-left:0.9rem;font-weight:600"><?php echo esc_html__( '✓ Homework plan ready  ·  ✓ Quiz review done', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"is-style-card lessonlark-float lessonlark-float--left","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-card lessonlark-float lessonlark-float--left has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"sunshine","fontSize":"xx-large","fontFamily":"serif"} -->
				<p class="has-sunshine-color has-text-color has-serif-font-family has-xx-large-font-size" style="font-weight:700;line-height:1"><?php echo esc_html__( '20 min', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"small"} -->
				<p class="has-small-font-size"><?php echo esc_html__( 'free first consultation, with no commitment', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"is-style-card lessonlark-float lessonlark-float--right","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group is-style-card lessonlark-float lessonlark-float--right" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
				<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html__( 'Progress note · Week 6', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"large","fontFamily":"serif"} -->
				<p class="has-serif-font-family has-large-font-size"><?php echo esc_html__( '“Fractions finally clicked today. Next up: decimals.”', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
				<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html__( 'From Ms. Rivera, your tutor', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
