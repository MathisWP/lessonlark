<?php
/**
 * Title: Header
 * Slug: lessonlark/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Sticky header with logo, site title, navigation, and a call-to-action button.
 *
 * @package lessonlark
 */
?>
<!-- wp:group {"align":"full","className":"lessonlark-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull lessonlark-header has-base-background-color has-background" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":40} /-->
			<!-- wp:site-title {"level":0} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:navigation {"layout":{"type":"flex","justifyContent":"right"}} /-->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"style":{"spacing":{"padding":{"top":"0.6rem","bottom":"0.6rem","left":"1.25rem","right":"1.25rem"}}},"fontSize":"small"} -->
				<div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#book' ) ); ?>" style="padding-top:0.6rem;padding-right:1.25rem;padding-bottom:0.6rem;padding-left:1.25rem"><?php echo esc_html__( 'Book a session', 'lessonlark' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
