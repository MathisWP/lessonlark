<?php
/**
 * Title: FAQ
 * Slug: lessonlark/faq
 * Categories: lessonlark, text
 * Keywords: faq, questions, accordion
 * Description: Two-column FAQ with heading on the left and expandable questions on the right.
 *
 * @package lessonlark
 */

$lessonlark_faqs = array(
	array(
		__( 'How much does tutoring cost?', 'lessonlark' ),
		__( 'Rates depend on subject and grade level. We’ll share exact pricing during your free consultation, with no pressure and no long-term contract.', 'lessonlark' ),
	),
	array(
		__( 'Are sessions online or in person?', 'lessonlark' ),
		__( 'Both. Online sessions use a shared whiteboard and work on any laptop or tablet. In-person sessions are available locally.', 'lessonlark' ),
	),
	array(
		__( 'How do you choose a tutor for my student?', 'lessonlark' ),
		__( 'We match on subject expertise, schedule, and personality. If the fit isn’t right, we’ll switch tutors at no cost.', 'lessonlark' ),
	),
	array(
		__( 'How will I know it’s working?', 'lessonlark' ),
		__( 'You’ll get a short progress note after each session and a check-in call every month to review goals together.', 'lessonlark' ),
	),
	array(
		__( 'Can we pause or cancel?', 'lessonlark' ),
		__( 'Anytime. Sessions are booked week to week, and you can pause for holidays, exams, or sports seasons.', 'lessonlark' ),
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"38%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column" style="flex-basis:38%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html__( 'FAQ', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html__( 'Questions parents ask', 'lessonlark' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted"} -->
			<p class="has-muted-color has-text-color"><?php /* translators: %s: Link to the booking form. */ echo wp_kses_post( sprintf( __( 'Don’t see yours? <a href="%s">Get in touch</a> and we’ll answer within one business day.', 'lessonlark' ), esc_url( home_url( '/#book' ) ) ) ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"62%","className":"lessonlark-faq"} -->
		<div class="wp-block-column lessonlark-faq" style="flex-basis:62%">
			<?php foreach ( $lessonlark_faqs as $lessonlark_faq ) : ?>
			<!-- wp:details -->
			<details class="wp-block-details"><summary><?php echo esc_html( $lessonlark_faq[0] ); ?></summary>
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $lessonlark_faq[1] ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
