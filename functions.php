<?php
/**
 * Lessonlark functions.
 *
 * @package lessonlark
 */

if ( ! function_exists( 'lessonlark_setup' ) ) {
	/**
	 * Theme setup.
	 */
	function lessonlark_setup() {
		// Make the editor use the front-end stylesheet.
		add_editor_style( 'style.css' );
	}
}
add_action( 'after_setup_theme', 'lessonlark_setup' );

/**
 * Enqueue the theme stylesheet.
 */
function lessonlark_enqueue_styles() {
	wp_enqueue_style(
		'lessonlark-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'lessonlark_enqueue_styles' );

/**
 * Register block styles used by the theme's patterns.
 * Their CSS lives in style.css.
 */
function lessonlark_register_block_styles() {
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'eyebrow',
			'label' => __( 'Eyebrow', 'lessonlark' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'card',
			'label' => __( 'Card', 'lessonlark' ),
		)
	);
}
add_action( 'init', 'lessonlark_register_block_styles' );

/**
 * Register a pattern category for this theme's patterns.
 */
function lessonlark_register_pattern_category() {
	register_block_pattern_category(
		'lessonlark',
		array(
			'label'       => __( 'Lessonlark', 'lessonlark' ),
			'description' => __( 'Patterns for tutoring and education sites.', 'lessonlark' ),
		)
	);
}
add_action( 'init', 'lessonlark_register_pattern_category' );

if ( is_admin() ) {
	require_once get_template_directory() . '/inc/bundled-plugin.php';
}

require_once get_template_directory() . '/inc/updates.php';
require_once get_template_directory() . '/inc/contact.php';
