<?php
/**
 * Title: Stats
 * Slug: lessonlark/stats
 * Categories: lessonlark
 * Keywords: numbers, results, social proof
 * Description: Four quick facts about your service in a floating card.
 *
 * @package lessonlark
 */

$lessonlark_stats = array(
	array( __( 'K–12', 'lessonlark' ), __( 'every grade level', 'lessonlark' ) ),
	array( '1:1', __( 'every session', 'lessonlark' ) ),
	array( '6', __( 'subjects covered', 'lessonlark' ) ),
	array( __( '1 day', 'lessonlark' ), __( 'to hear back from me', 'lessonlark' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"align":"wide","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"shadow":"var:preset|shadow|soft"},"backgroundColor":"surface","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"6.5rem"}} -->
	<div class="wp-block-group alignwide has-surface-background-color has-background" style="border-radius:28px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);box-shadow:var(--wp--preset--shadow--soft)">
		<?php foreach ( $lessonlark_stats as $lessonlark_stat ) : ?>
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"primary","fontSize":"xx-large","fontFamily":"serif"} -->
			<p class="has-text-align-center has-primary-color has-text-color has-serif-font-family has-xx-large-font-size" style="font-weight:700;line-height:1"><?php echo esc_html( $lessonlark_stat[0] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"small"} -->
			<p class="has-text-align-center has-muted-color has-text-color has-small-font-size"><?php echo esc_html( $lessonlark_stat[1] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
