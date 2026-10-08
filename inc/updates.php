<?php
/**
 * Update notifications for the self-hosted theme.
 *
 * Checks the GitHub releases of MathisWP/lessonlark and offers the attached
 * lessonlark.zip as a normal one-click update in wp-admin. Only published
 * releases with that zip count: tags, branches, pre-releases, and GitHub's
 * auto-generated source archives are ignored, so dev files never reach users.
 *
 * The bundled Lessonlark Booking plugin updates along with the theme (see
 * inc/bundled-plugin.php).
 *
 * @package lessonlark
 */

defined( 'ABSPATH' ) || exit;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
use YahnisElsts\PluginUpdateChecker\v5p7\Vcs\Api;

/**
 * Set up the update checker.
 *
 * @return \YahnisElsts\PluginUpdateChecker\v5p7\Theme\UpdateChecker|null
 */
function lessonlark_init_updates() {
	require_once __DIR__ . '/vendor/plugin-update-checker/plugin-update-checker.php';

	$checker = PucFactory::buildUpdateChecker(
		'https://github.com/MathisWP/lessonlark/',
		get_template_directory() . '/functions.php',
		'lessonlark'
	);
	$checker->setBranch( 'main' );
	$checker->getVcsApi()->enableReleaseAssets( '/^lessonlark\.zip$/i', Api::REQUIRE_RELEASE_ASSETS );

	// Releases only: don't fall back to tags or the branch if no release qualifies.
	add_filter(
		$checker->getUniqueName( 'vcs_update_detection_strategies' ),
		static function ( $strategies ) {
			return array_intersect_key( $strategies, array( Api::STRATEGY_LATEST_RELEASE => true ) );
		}
	);

	return $checker;
}

// Update checks only happen in wp-admin, scheduled cron runs, and WP-CLI.
if ( is_admin() || wp_doing_cron() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	lessonlark_init_updates();
}
