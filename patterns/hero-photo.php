<?php
/**
 * Title: Hero with photo
 * Slug: lessonlark/hero-photo
 * Categories: lessonlark, featured, banner
 * Keywords: hero, header, intro, banner, photo, image
 * Description: Two-column hero with headline and calls to action next to a photo. Replace the sample photo with your own.
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
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"lessonlark-photo","style":{"border":{"radius":"28px"}}} -->
			<figure class="wp-block-image size-full has-custom-border lessonlark-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-portrait.svg' ); ?>" alt="" style="border-radius:28px;aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"is-style-card lessonlark-float lessonlark-float--left lessonlark-photo-badge","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0.25rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group is-style-card lessonlark-float lessonlark-float--left lessonlark-photo-badge" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
				<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html__( 'Progress note · Week 6', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontFamily":"serif"} -->
				<p class="has-serif-font-family"><?php echo esc_html__( '“Fractions finally clicked today. Next up: decimals.”', 'lessonlark' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
