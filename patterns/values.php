<?php
/**
 * Title: How I teach
 * Slug: lessonlark/values
 * Categories: lessonlark, about
 * Keywords: values, approach, teaching, philosophy, features
 * Description: Three cards describing your teaching approach.
 *
 * @package lessonlark
 */

$lessonlark_values = array(
	array(
		'icon'  => '♡',
		'tile'  => 'peach',
		'title' => __( 'Patient', 'lessonlark' ),
		'text'  => __( 'No rushing and no judgment. I slow down until it clicks, then build from there.', 'lessonlark' ),
	),
	array(
		'icon'  => '✎',
		'tile'  => 'tint',
		'title' => __( 'Personal', 'lessonlark' ),
		'text'  => __( 'Every plan follows your student’s own curriculum, goals, and way of learning.', 'lessonlark' ),
	),
	array(
		'icon'  => '✓',
		'tile'  => 'mint',
		'title' => __( 'Transparent', 'lessonlark' ),
		'text'  => __( 'A short note after every session, so you always know what your student covered and what’s next.', 'lessonlark' ),
	),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr__( 'How I teach', 'lessonlark' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"tint","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-tint-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php echo esc_html__( 'How I teach', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'What every session looks like', 'lessonlark' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"17rem"}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)">
		<?php foreach ( $lessonlark_values as $lessonlark_value ) : ?>
		<!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
			<!-- wp:group {"className":"lessonlark-icon-tile","backgroundColor":"<?php echo esc_attr( $lessonlark_value['tile'] ); ?>","textColor":"primary","layout":{"type":"default"}} -->
			<div class="wp-block-group lessonlark-icon-tile has-primary-color has-<?php echo esc_attr( $lessonlark_value['tile'] ); ?>-background-color has-text-color has-background">
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $lessonlark_value['icon'] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $lessonlark_value['title'] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted"} -->
			<p class="has-muted-color has-text-color"><?php echo esc_html( $lessonlark_value['text'] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
