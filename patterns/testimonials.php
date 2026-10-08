<?php
/**
 * Title: Testimonials
 * Slug: lessonlark/testimonials
 * Categories: lessonlark, testimonials
 * Keywords: reviews, quotes, parents, students
 * Description: Three review cards. The quotes are samples. Replace them with real reviews from your families.
 *
 * @package lessonlark
 */

$lessonlark_testimonials = array(
	array(
		'quote'    => __( 'My daughter went from dreading math homework to finishing it on her own. Her confidence is the biggest change.', 'lessonlark' ),
		'initials' => __( '8th', 'lessonlark' ),
		'name'     => __( 'Parent of an 8th grader', 'lessonlark' ),
		'role'     => __( 'Math tutoring', 'lessonlark' ),
		'color'    => 'sunshine',
	),
	array(
		'quote'    => __( 'The practice plan actually made sense for how I study, and I walked into the SAT feeling ready instead of panicked.', 'lessonlark' ),
		'initials' => __( '11th', 'lessonlark' ),
		'name'     => __( 'High school junior', 'lessonlark' ),
		'role'     => __( 'SAT prep', 'lessonlark' ),
		'color'    => 'accent',
	),
	array(
		'quote'    => __( 'Scheduling is easy, the updates are clear, and our son genuinely likes his tutor. We couldn’t ask for more.', 'lessonlark' ),
		'initials' => __( '5th', 'lessonlark' ),
		'name'     => __( 'Parent of a 5th grader', 'lessonlark' ),
		'role'     => __( 'Reading & writing', 'lessonlark' ),
		'color'    => 'mint',
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"peach","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-peach-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php echo esc_html__( 'Testimonials', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'What families say', 'lessonlark' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","minimumColumnWidth":"19rem"}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)">
		<?php foreach ( $lessonlark_testimonials as $lessonlark_testimonial ) : ?>
		<!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
		<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
			<!-- wp:paragraph {"className":"lessonlark-stars"} -->
			<p class="lessonlark-stars">★★★★★</p>
			<!-- /wp:paragraph -->

			<!-- wp:quote {"style":{"layout":{"selfStretch":"fill","flexSize":null}}} -->
			<blockquote class="wp-block-quote">
				<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.45"}},"fontSize":"large","fontFamily":"serif"} -->
				<p class="has-serif-font-family has-large-font-size" style="line-height:1.45">“<?php echo esc_html( $lessonlark_testimonial['quote'] ); ?>”</p>
				<!-- /wp:paragraph -->
			</blockquote>
			<!-- /wp:quote -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"<?php echo esc_attr( $lessonlark_testimonial['color'] ); ?>","textColor":"contrast","layout":{"type":"default"}} -->
				<div class="wp-block-group lessonlark-avatar has-contrast-color has-<?php echo esc_attr( $lessonlark_testimonial['color'] ); ?>-background-color has-text-color has-background">
					<!-- wp:paragraph -->
					<p><?php echo esc_html( $lessonlark_testimonial['initials'] ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
					<p style="font-weight:700"><?php echo esc_html( $lessonlark_testimonial['name'] ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
					<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html( $lessonlark_testimonial['role'] ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
