<?php
/**
 * Install, activate, and update the Lessonlark Booking plugin that ships inside
 * this theme (plugins/lessonlark-booking), from a one-click admin notice.
 *
 * @package lessonlark
 */

defined( 'ABSPATH' ) || exit;

const LESSONLARK_PLUGIN_SLUG = 'lessonlark-booking';
const LESSONLARK_PLUGIN_FILE = 'lessonlark-booking/lessonlark-booking.php';

/**
 * Version of the plugin bundled with the theme.
 *
 * @return string
 */
function lessonlark_bundled_plugin_version() {
	$data = get_file_data( get_template_directory() . '/plugins/' . LESSONLARK_PLUGIN_FILE, array( 'Version' => 'Version' ) );
	return $data['Version'];
}

/**
 * Where the plugin stands on this site.
 *
 * @return string 'missing', 'inactive', 'outdated', or 'ok'.
 */
function lessonlark_bundled_plugin_status() {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	$installed = get_plugins();
	if ( ! isset( $installed[ LESSONLARK_PLUGIN_FILE ] ) ) {
		return 'missing';
	}
	if ( version_compare( $installed[ LESSONLARK_PLUGIN_FILE ]['Version'], lessonlark_bundled_plugin_version(), '<' ) ) {
		return 'outdated';
	}
	return is_plugin_active( LESSONLARK_PLUGIN_FILE ) ? 'ok' : 'inactive';
}

/**
 * Whether the installed plugin folder IS the theme's bundled copy (a symlink or a
 * bind mount, as in local dev setups). realpath() can't see through bind mounts,
 * so drop a probe file in the source and look for it in the target.
 *
 * @return bool
 */
function lessonlark_plugin_dir_is_bundled_copy() {
	$source = get_template_directory() . '/plugins/' . LESSONLARK_PLUGIN_SLUG;
	$target = WP_PLUGIN_DIR . '/' . LESSONLARK_PLUGIN_SLUG;
	if ( ! is_dir( $target ) ) {
		return false;
	}
	$probe = '.lessonlark-probe-' . wp_generate_password( 8, false );
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents -- tiny probe, removed immediately.
	if ( false === @file_put_contents( $source . '/' . $probe, '1' ) ) {
		// Can't write to the theme: fall back to comparing resolved paths.
		return realpath( $source ) === realpath( $target );
	}
	$same = file_exists( $target . '/' . $probe );
	wp_delete_file( $source . '/' . $probe );
	return $same;
}

/**
 * Copy the bundled plugin into wp-content/plugins, replacing any older copy.
 *
 * Nothing is deleted until the new copy is in place: copy to a temp folder,
 * rename the old folder to a backup, move the new one in (restoring the backup
 * if that fails), and only then remove the backup.
 *
 * @return true|WP_Error
 */
function lessonlark_install_bundled_plugin() {
	global $wp_filesystem;
	require_once ABSPATH . 'wp-admin/includes/file.php';

	if ( lessonlark_plugin_dir_is_bundled_copy() ) {
		return new WP_Error( 'same', __( 'The installed plugin is the theme’s own copy, so there’s nothing to install.', 'lessonlark' ) );
	}
	if ( ! WP_Filesystem() ) {
		return new WP_Error( 'fs', __( 'WordPress can’t write to the plugins folder on this server.', 'lessonlark' ) );
	}

	$source = trailingslashit( $wp_filesystem->wp_themes_dir() ) . get_template() . '/plugins/' . LESSONLARK_PLUGIN_SLUG;
	$target = trailingslashit( $wp_filesystem->wp_plugins_dir() ) . LESSONLARK_PLUGIN_SLUG;
	$temp   = $target . '-installing';
	$backup = $target . '-previous';

	// Leftovers from an earlier interrupted run are ours to clear.
	$wp_filesystem->delete( $temp, true );
	$wp_filesystem->delete( $backup, true );

	if ( ! $wp_filesystem->mkdir( $temp ) ) {
		return new WP_Error( 'mkdir', __( 'Could not create the plugin folder.', 'lessonlark' ) );
	}
	$copied = copy_dir( $source, $temp );
	if ( is_wp_error( $copied ) ) {
		$wp_filesystem->delete( $temp, true );
		return $copied;
	}

	$had_previous = $wp_filesystem->exists( $target );
	if ( $had_previous && ! $wp_filesystem->move( $target, $backup ) ) {
		$wp_filesystem->delete( $temp, true );
		return new WP_Error( 'backup', __( 'Could not replace the existing plugin folder. Your current version was left untouched.', 'lessonlark' ) );
	}
	if ( ! $wp_filesystem->move( $temp, $target ) ) {
		if ( $had_previous ) {
			$wp_filesystem->move( $backup, $target );
		}
		$wp_filesystem->delete( $temp, true );
		return new WP_Error( 'move', __( 'Could not move the plugin into place. Your current version was restored.', 'lessonlark' ) );
	}
	if ( $had_previous ) {
		$wp_filesystem->delete( $backup, true );
	}

	wp_clean_plugins_cache();
	return true;
}

/**
 * Admin notice with the next step.
 */
function lessonlark_bundled_plugin_notice() {
	// Result of a just-finished action.
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display-only.
	$result = isset( $_GET['lessonlark-plugin-result'] ) ? sanitize_key( $_GET['lessonlark-plugin-result'] ) : '';
	if ( $result ) {
		$messages = array(
			'installed' => __( 'Lessonlark Booking is installed and active. The “Book a session” form is live on your front page.', 'lessonlark' ),
			'updated'   => __( 'Lessonlark Booking has been updated.', 'lessonlark' ),
			'activated' => __( 'Lessonlark Booking is active. The “Book a session” form is live on your front page.', 'lessonlark' ),
		);
		if ( isset( $messages[ $result ] ) ) {
			printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', esc_html( $messages[ $result ] ) );
		} else {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display-only.
			$detail = isset( $_GET['lessonlark-plugin-error'] ) ? sanitize_text_field( wp_unslash( $_GET['lessonlark-plugin-error'] ) ) : '';
			printf(
				'<div class="notice notice-error"><p>%1$s %2$s</p><p>%3$s</p></div>',
				esc_html__( 'Lessonlark Booking couldn’t be installed automatically.', 'lessonlark' ),
				esc_html( $detail ),
				sprintf(
					/* translators: %s: folder path inside the theme. */
					esc_html__( 'You can install it by hand: zip the %s folder from the theme and upload it under Plugins → Add New → Upload Plugin.', 'lessonlark' ),
					'<code>plugins/lessonlark-booking</code>'
				)
			);
		}
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'themes', 'plugins' ), true ) ) {
		return;
	}
	$status = lessonlark_bundled_plugin_status();
	if ( 'ok' === $status ) {
		return;
	}
	$caps = array(
		'missing'  => 'install_plugins',
		'inactive' => 'activate_plugins',
		'outdated' => 'update_plugins',
	);
	if ( ! current_user_can( $caps[ $status ] ) ) {
		return;
	}
	$dismiss_key = $status . ':' . lessonlark_bundled_plugin_version();
	if ( get_user_meta( get_current_user_id(), 'lessonlark_plugin_notice_dismissed', true ) === $dismiss_key ) {
		return;
	}

	$copy = array(
		'missing'  => array(
			__( 'Your theme includes a free “Book a session” form. Install the bundled Lessonlark Booking plugin to turn it on. Until then, the booking section shows your email and phone instead.', 'lessonlark' ),
			__( 'Install & activate', 'lessonlark' ),
			'install',
		),
		'inactive' => array(
			__( 'The Lessonlark Booking plugin is installed but not active, so the booking section is showing your email and phone instead of the form.', 'lessonlark' ),
			__( 'Activate Lessonlark Booking', 'lessonlark' ),
			'activate',
		),
		'outdated' => array(
			/* translators: %s: Plugin version number. */
			sprintf( __( 'This theme includes a newer version of the Lessonlark Booking plugin (%s).', 'lessonlark' ), lessonlark_bundled_plugin_version() ),
			__( 'Update Lessonlark Booking', 'lessonlark' ),
			'update',
		),
	);
	list( $text, $label, $action ) = $copy[ $status ];

	$action_url  = wp_nonce_url( add_query_arg( 'lessonlark-plugin', $action ), 'lessonlark_plugin_' . $action );
	$dismiss_url = wp_nonce_url( add_query_arg( 'lessonlark-plugin', 'dismiss' ), 'lessonlark_plugin_dismiss' );
	?>
	<div class="notice notice-info">
		<p><strong><?php esc_html_e( 'Lessonlark:', 'lessonlark' ); ?></strong> <?php echo esc_html( $text ); ?></p>
		<p>
			<a class="button button-primary" href="<?php echo esc_url( $action_url ); ?>"><?php echo esc_html( $label ); ?></a>
			<a class="button-link" style="margin-left:8px" href="<?php echo esc_url( $dismiss_url ); ?>"><?php esc_html_e( 'Dismiss', 'lessonlark' ); ?></a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'lessonlark_bundled_plugin_notice' );

/**
 * Handle notice buttons.
 */
function lessonlark_bundled_plugin_actions() {
	if ( ! isset( $_GET['lessonlark-plugin'] ) ) {
		return;
	}
	$action = sanitize_key( $_GET['lessonlark-plugin'] );
	check_admin_referer( 'lessonlark_plugin_' . $action );

	$back = remove_query_arg( array( 'lessonlark-plugin', '_wpnonce', 'lessonlark-plugin-result', 'lessonlark-plugin-error' ) );

	if ( 'dismiss' === $action ) {
		update_user_meta( get_current_user_id(), 'lessonlark_plugin_notice_dismissed', lessonlark_bundled_plugin_status() . ':' . lessonlark_bundled_plugin_version() );
		wp_safe_redirect( $back );
		exit;
	}

	$caps = array(
		'install'  => 'install_plugins',
		'activate' => 'activate_plugins',
		'update'   => 'update_plugins',
	);
	if ( ! isset( $caps[ $action ] ) || ! current_user_can( $caps[ $action ] ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'lessonlark' ), 403 );
	}

	if ( 'activate' !== $action ) {
		$installed = lessonlark_install_bundled_plugin();
		if ( is_wp_error( $installed ) ) {
			wp_safe_redirect(
				add_query_arg(
					array(
						'lessonlark-plugin-result' => 'error',
						'lessonlark-plugin-error'  => rawurlencode( $installed->get_error_message() ),
					),
					$back
				)
			);
			exit;
		}
	}

	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! is_plugin_active( LESSONLARK_PLUGIN_FILE ) && current_user_can( 'activate_plugins' ) ) {
		$activated = activate_plugin( LESSONLARK_PLUGIN_FILE );
		if ( is_wp_error( $activated ) ) {
			wp_safe_redirect(
				add_query_arg(
					array(
						'lessonlark-plugin-result' => 'error',
						'lessonlark-plugin-error'  => rawurlencode( $activated->get_error_message() ),
					),
					$back
				)
			);
			exit;
		}
	}

	$results = array(
		'install'  => 'installed',
		'update'   => 'updated',
		'activate' => 'activated',
	);
	wp_safe_redirect( add_query_arg( 'lessonlark-plugin-result', $results[ $action ], $back ) );
	exit;
}
add_action( 'admin_init', 'lessonlark_bundled_plugin_actions' );
