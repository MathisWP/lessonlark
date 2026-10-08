<?php
/**
 * Title: About the tutor
 * Slug: lessonlark/about
 * Categories: lessonlark, about
 * Keywords: about, bio, tutor, team, photo, meet
 * Description: Photo and short bio with a checklist of credentials. Replace the sample photo, name, and text with your own.
 *
 * @package lessonlark
 */

$lessonlark_points = array(
	__( 'Former middle school math teacher', 'lessonlark' ),
	__( 'Specializes in grades 5–10 math and test prep', 'lessonlark' ),
	__( 'Every session ends with a short note for parents', 'lessonlark' ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr__( 'About the tutor', 'lessonlark' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"lessonlark-hero-art"} -->
		<div class="wp-block-column is-vertically-aligned-center lessonlark-hero-art" style="flex-basis:42%">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"lessonlark-photo","style":{"border":{"radius":"28px"}}} -->
			<figure class="wp-block-image size-full has-custom-border lessonlark-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-portrait.svg' ); ?>" alt="" style="border-radius:28px;aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"58%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html__( 'Meet your tutor', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html__( 'Hi, I’m Sam Rivera', 'lessonlark' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
			<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'I help students who think they’re “just not a math person” find out that they are. My sessions are calm, structured, and built around how your student actually learns.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html__( 'Before tutoring full time, I taught in the classroom, so I know what teachers expect and where students tend to get stuck. My goal is simple: a student who walks into class feeling ready.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"lessonlark-checklist"} -->
			<ul class="wp-block-list lessonlark-checklist">
				<?php foreach ( $lessonlark_points as $lessonlark_point ) : ?>
				<!-- wp:list-item -->
				<li><?php echo esc_html( $lessonlark_point ); ?></li>
				<!-- /wp:list-item -->
				<?php endforeach; ?>
			</ul>
			<!-- /wp:list -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#book' ) ); ?>"><?php echo esc_html__( 'Book a free consultation', 'lessonlark' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
