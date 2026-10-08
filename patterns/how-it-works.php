<?php
/**
 * Title: How It Works
 * Slug: lessonlark/how-it-works
 * Categories: lessonlark
 * Keywords: steps, process, how it works
 * Description: Dark section with three numbered step cards.
 *
 * @package lessonlark
 */

$lessonlark_steps = array(
	array( '01', __( 'Free consultation', 'lessonlark' ), __( 'A relaxed 20-minute call about your student’s goals, strengths, and where they’re getting stuck.', 'lessonlark' ) ),
	array( '02', __( 'A plan that fits', 'lessonlark' ), __( 'We match your student with the right tutor and build a plan around how they actually learn.', 'lessonlark' ) ),
	array( '03', __( 'Progress you can see', 'lessonlark' ), __( 'Weekly sessions and short progress notes, so you always know what’s working and what’s next.', 'lessonlark' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow","backgroundColor":"sunshine","textColor":"contrast"} -->
		<p class="is-style-eyebrow has-contrast-color has-sunshine-background-color has-text-color has-background"><?php echo esc_html__( 'How it works', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'Getting started takes one conversation', 'lessonlark' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)">
		<?php foreach ( $lessonlark_steps as $lessonlark_step ) : ?>
		<!-- wp:column {"className":"lessonlark-step","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
		<div class="wp-block-column lessonlark-step" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)">
			<!-- wp:paragraph {"className":"lessonlark-step-num"} -->
			<p class="lessonlark-step-num"><?php echo esc_html( $lessonlark_step[0] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $lessonlark_step[1] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"lessonlark-soft-text"} -->
			<p class="lessonlark-soft-text"><?php echo esc_html( $lessonlark_step[2] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
