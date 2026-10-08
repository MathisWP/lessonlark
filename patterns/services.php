<?php
/**
 * Title: Services
 * Slug: lessonlark/services
 * Categories: lessonlark, services
 * Keywords: subjects, services, features, cards
 * Description: Section heading and a responsive grid of six subject cards with icon tiles.
 *
 * @package lessonlark
 */

$lessonlark_subjects = array(
	array(
		'icon'  => '√x',
		'tile'  => 'tint',
		'title' => __( 'Math', 'lessonlark' ),
		'text'  => __( 'Arithmetic foundations through algebra, geometry, and calculus. We meet students where they are.', 'lessonlark' ),
	),
	array(
		'icon'  => 'H₂O',
		'tile'  => 'mint',
		'title' => __( 'Science', 'lessonlark' ),
		'text'  => __( 'Biology, chemistry, and physics made concrete with real-world examples and lab-report coaching.', 'lessonlark' ),
	),
	array(
		'icon'  => 'Aa',
		'tile'  => 'peach',
		'title' => __( 'Reading & Writing', 'lessonlark' ),
		'text'  => __( 'Comprehension, essay structure, and grammar that turn reluctant readers into confident writers.', 'lessonlark' ),
	),
	array(
		'icon'  => 'A+',
		'tile'  => 'tint',
		'title' => __( 'Test Prep', 'lessonlark' ),
		'text'  => __( 'SAT, ACT, and state exams with practice tests, proven strategy, and clear progress tracking.', 'lessonlark' ),
	),
	array(
		'icon'  => '¿?',
		'tile'  => 'mint',
		'title' => __( 'Languages', 'lessonlark' ),
		'text'  => __( 'Spanish and French conversation, vocabulary, and grammar, from first words to AP exams.', 'lessonlark' ),
	),
	array(
		'icon'  => '✎',
		'tile'  => 'peach',
		'title' => __( 'Study Skills', 'lessonlark' ),
		'text'  => __( 'Planning, note-taking, and focus habits that make every other subject easier.', 'lessonlark' ),
	),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr__( 'Subjects', 'lessonlark' ); ?>"},"anchor":"services","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div id="services" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php echo esc_html__( 'Subjects', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo esc_html__( 'Support for every subject, every grade', 'lessonlark' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"large"} -->
		<p class="has-text-align-center has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'Sessions are tailored to your student’s grade level, curriculum, and goals.', 'lessonlark' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","minimumColumnWidth":"19rem"}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)">
		<?php foreach ( $lessonlark_subjects as $lessonlark_subject ) : ?>
		<!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
			<!-- wp:group {"className":"lessonlark-icon-tile","backgroundColor":"<?php echo esc_attr( $lessonlark_subject['tile'] ); ?>","textColor":"primary","layout":{"type":"default"}} -->
			<div class="wp-block-group lessonlark-icon-tile has-primary-color has-<?php echo esc_attr( $lessonlark_subject['tile'] ); ?>-background-color has-text-color has-background">
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $lessonlark_subject['icon'] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $lessonlark_subject['title'] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted"} -->
			<p class="has-muted-color has-text-color"><?php echo esc_html( $lessonlark_subject['text'] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
