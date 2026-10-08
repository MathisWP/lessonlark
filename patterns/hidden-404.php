<?php
/**
 * Title: 404 content
 * Slug: lessonlark/hidden-404
 * Inserter: no
 *
 * @package lessonlark
 */
?>
<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'Page not found', 'lessonlark' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo esc_html__( 'The page you’re looking for doesn’t exist. Try searching, or head back home.', 'lessonlark' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'search form label', 'lessonlark' ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr_x( 'Search', 'search button text', 'lessonlark' ); ?>","align":"center"} /-->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Back to home', 'lessonlark' ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
