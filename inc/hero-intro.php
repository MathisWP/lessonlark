<?php
/**
 * Hero text column (badge, headline, intro, buttons, grade row), shared by the
 * Hero and Hero with photo patterns.
 *
 * @package lessonlark
 */

defined( 'ABSPATH' ) || exit;
?>
		<!-- wp:column {"verticalAlignment":"center","width":"56%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html__( '★ One-on-one tutoring, K–12', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"xxx-large"} -->
			<h1 class="wp-block-heading has-xxx-large-font-size"><?php /* translators: %s: Highlighted word, "confidence". */ printf( esc_html__( 'Tutoring that builds %s, not just grades', 'lessonlark' ), '<mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color">' . esc_html__( 'confidence', 'lessonlark' ) . '</mark>' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
			<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html__( 'One-on-one sessions shaped around how your student learns best, in math, science, reading, and test prep. Online or in person.', 'lessonlark' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#book' ) ); ?>"><?php echo esc_html__( 'Book a free consultation', 'lessonlark' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#services' ) ); ?>"><?php echo esc_html__( 'Explore subjects', 'lessonlark' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
				<!-- wp:group {"className":"lessonlark-avatar-stack","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group lessonlark-avatar-stack">
					<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"sunshine","textColor":"contrast","layout":{"type":"default"}} -->
					<div class="wp-block-group lessonlark-avatar has-contrast-color has-sunshine-background-color has-text-color has-background">
						<!-- wp:paragraph -->
						<p>K</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"accent","textColor":"contrast","layout":{"type":"default"}} -->
					<div class="wp-block-group lessonlark-avatar has-contrast-color has-accent-background-color has-text-color has-background">
						<!-- wp:paragraph -->
						<p>6</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"lessonlark-avatar","backgroundColor":"primary","textColor":"surface","layout":{"type":"default"}} -->
					<div class="wp-block-group lessonlark-avatar has-surface-color has-primary-background-color has-text-color has-background">
						<!-- wp:paragraph -->
						<p>12</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
				<p class="has-muted-color has-text-color has-small-font-size"><?php echo wp_kses_post( __( '<strong>Every grade</strong>, online or in person', 'lessonlark' ) ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
