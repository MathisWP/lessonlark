<?php
/**
 * Title: Blog heading
 * Slug: lessonlark/hidden-blog-heading
 * Inserter: no
 *
 * @package lessonlark
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
	<p class="is-style-eyebrow"><?php echo esc_html__( 'Blog', 'lessonlark' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1} -->
	<h1 class="wp-block-heading"><?php echo esc_html__( 'Study tips & news', 'lessonlark' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
	<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'Practical advice for students and parents, from our tutors.', 'lessonlark' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
