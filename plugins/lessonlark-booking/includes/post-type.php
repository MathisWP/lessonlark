<?php
/**
 * "Bookings" admin screen: a private post type that keeps a copy of every request.
 *
 * @package lessonlark-booking
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the booking post type.
 */
function lessonlark_booking_register_post_type() {
	register_post_type(
		'lessonlark_booking',
		array(
			'labels'          => array(
				'name'               => __( 'Bookings', 'lessonlark-booking' ),
				'singular_name'      => __( 'Booking', 'lessonlark-booking' ),
				'menu_name'          => __( 'Bookings', 'lessonlark-booking' ),
				'all_items'          => __( 'All bookings', 'lessonlark-booking' ),
				'edit_item'          => __( 'Booking request', 'lessonlark-booking' ),
				'search_items'       => __( 'Search bookings', 'lessonlark-booking' ),
				'not_found'          => __( 'No booking requests yet. They’ll appear here as soon as someone submits the form.', 'lessonlark-booking' ),
				'not_found_in_trash' => __( 'No bookings in the trash.', 'lessonlark-booking' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => false,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-calendar-alt',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'lessonlark_booking_register_post_type' );

/**
 * List-table columns.
 *
 * @param array $columns Default columns.
 * @return array
 */
function lessonlark_booking_columns( $columns ) {
	return array(
		'cb'            => $columns['cb'],
		'title'         => __( 'Request', 'lessonlark-booking' ),
		'llb_status'    => __( 'Status', 'lessonlark-booking' ),
		'llb_contact'   => __( 'Contact', 'lessonlark-booking' ),
		'llb_grade'     => __( 'Grade', 'lessonlark-booking' ),
		'llb_subjects'  => __( 'Subjects', 'lessonlark-booking' ),
		'llb_received'  => __( 'Received', 'lessonlark-booking' ),
	);
}
add_filter( 'manage_lessonlark_booking_posts_columns', 'lessonlark_booking_columns' );

/**
 * Keep "Received" sortable like the core date column it replaces.
 *
 * @param array $columns Sortable columns.
 * @return array
 */
function lessonlark_booking_sortable_columns( $columns ) {
	$columns['llb_received'] = array( 'date', true );
	return $columns;
}
add_filter( 'manage_edit-lessonlark_booking_sortable_columns', 'lessonlark_booking_sortable_columns' );

/**
 * Whether the admin has marked a booking as followed up.
 *
 * @param int $post_id Booking ID.
 * @return bool
 */
function lessonlark_booking_is_followed_up( $post_id ) {
	return (bool) get_post_meta( $post_id, '_llb_followed_up', true );
}

/**
 * Mark a booking as followed up (recording when and by whom), or clear the flag.
 *
 * @param int  $post_id Booking ID.
 * @param bool $done    True to mark followed up, false to clear.
 */
function lessonlark_booking_set_followed_up( $post_id, $done ) {
	if ( $done ) {
		update_post_meta( $post_id, '_llb_followed_up', time() );
		update_post_meta( $post_id, '_llb_followed_up_by', get_current_user_id() );
	} else {
		delete_post_meta( $post_id, '_llb_followed_up' );
		delete_post_meta( $post_id, '_llb_followed_up_by' );
	}
}

/**
 * Human-readable follow-up status, e.g. "Followed up Oct 8 by Jack".
 *
 * @param int $post_id Booking ID.
 * @return string Plain text.
 */
function lessonlark_booking_followed_up_label( $post_id ) {
	$when = (int) get_post_meta( $post_id, '_llb_followed_up', true );
	if ( ! $when ) {
		return __( 'Needs follow-up', 'lessonlark-booking' );
	}
	$user = get_userdata( (int) get_post_meta( $post_id, '_llb_followed_up_by', true ) );
	$date = wp_date( get_option( 'date_format' ), $when );
	return $user
		/* translators: 1: Date. 2: User display name. */
		? sprintf( __( 'Followed up %1$s by %2$s', 'lessonlark-booking' ), $date, $user->display_name )
		/* translators: %s: Date. */
		: sprintf( __( 'Followed up %s', 'lessonlark-booking' ), $date );
}

/**
 * URL that flips a booking's follow-up flag and returns to the current screen.
 *
 * @param int  $post_id Booking ID.
 * @param bool $done    State to set.
 * @return string
 */
function lessonlark_booking_follow_up_url( $post_id, $done ) {
	return wp_nonce_url(
		admin_url( 'admin-post.php?action=lessonlark_booking_follow_up&post=' . $post_id . '&done=' . ( $done ? 1 : 0 ) ),
		'lessonlark_booking_follow_up_' . $post_id
	);
}

/**
 * Handle the follow-up toggle links.
 */
function lessonlark_booking_handle_follow_up() {
	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0;
	check_admin_referer( 'lessonlark_booking_follow_up_' . $post_id );
	if ( 'lessonlark_booking' !== get_post_type( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'lessonlark-booking' ), 403 );
	}
	lessonlark_booking_set_followed_up( $post_id, ! empty( $_GET['done'] ) );
	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url( 'edit.php?post_type=lessonlark_booking' ) );
	exit;
}
add_action( 'admin_post_lessonlark_booking_follow_up', 'lessonlark_booking_handle_follow_up' );

/**
 * "Mark as followed up" link under each booking's title in the list.
 *
 * @param array   $actions Row actions.
 * @param WP_Post $post    Post.
 * @return array
 */
function lessonlark_booking_row_actions( $actions, $post ) {
	if ( 'lessonlark_booking' !== $post->post_type || ! current_user_can( 'edit_post', $post->ID ) ) {
		return $actions;
	}
	$done = lessonlark_booking_is_followed_up( $post->ID );
	unset( $actions['inline hide-if-no-js'] ); // Quick Edit has nothing useful to edit here.
	$toggle = array(
		'llb_follow_up' => sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( lessonlark_booking_follow_up_url( $post->ID, ! $done ) ),
			$done ? esc_html__( 'Mark as not followed up', 'lessonlark-booking' ) : esc_html__( 'Mark as followed up', 'lessonlark-booking' )
		),
	);
	return $toggle + $actions;
}
add_filter( 'post_row_actions', 'lessonlark_booking_row_actions', 10, 2 );

/**
 * "Needs follow-up" / "Followed up" filter tabs above the list.
 *
 * @param array $views Default views.
 * @return array
 */
function lessonlark_booking_views( $views ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only filter.
	$current = isset( $_GET['llb_follow_up'] ) ? sanitize_key( $_GET['llb_follow_up'] ) : '';
	$base    = admin_url( 'edit.php?post_type=lessonlark_booking' );
	$tabs    = array(
		'pending' => __( 'Needs follow-up', 'lessonlark-booking' ),
		'done'    => __( 'Followed up', 'lessonlark-booking' ),
	);
	foreach ( $tabs as $key => $label ) {
		$views[ 'llb_' . $key ] = sprintf(
			'<a href="%1$s"%2$s>%3$s <span class="count">(%4$d)</span></a>',
			esc_url( add_query_arg( 'llb_follow_up', $key, $base ) ),
			$current === $key ? ' class="current" aria-current="page"' : '',
			esc_html( $label ),
			lessonlark_booking_count( $key )
		);
	}
	if ( $current && isset( $views['all'] ) ) {
		$views['all'] = str_replace( array( ' class="current"', ' aria-current="page"' ), '', $views['all'] );
	}
	return $views;
}
add_filter( 'views_edit-lessonlark_booking', 'lessonlark_booking_views' );

/**
 * Count bookings by follow-up state.
 *
 * @param string $state 'pending' or 'done'.
 * @return int
 */
function lessonlark_booking_count( $state ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'lessonlark_booking',
			'post_status'    => 'private',
			'fields'         => 'ids',
			'posts_per_page' => 1,
			'meta_query'     => array( lessonlark_booking_follow_up_clause( $state ) ), // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		)
	);
	return (int) $query->found_posts;
}

/**
 * Meta query clause for a follow-up state.
 *
 * @param string $state 'pending' or 'done'.
 * @return array
 */
function lessonlark_booking_follow_up_clause( $state ) {
	return array(
		'key'     => '_llb_followed_up',
		'compare' => 'done' === $state ? 'EXISTS' : 'NOT EXISTS',
	);
}

/**
 * Apply the filter tabs to the list query.
 *
 * @param WP_Query $query Query.
 */
function lessonlark_booking_filter_list( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() || 'lessonlark_booking' !== $query->get( 'post_type' ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only filter.
	$state = isset( $_GET['llb_follow_up'] ) ? sanitize_key( $_GET['llb_follow_up'] ) : '';
	if ( in_array( $state, array( 'pending', 'done' ), true ) ) {
		$query->set( 'meta_query', array( lessonlark_booking_follow_up_clause( $state ) ) );
	}
}
add_action( 'pre_get_posts', 'lessonlark_booking_filter_list' );

/**
 * Bulk actions: mark several bookings at once.
 *
 * @param array $actions Bulk actions.
 * @return array
 */
function lessonlark_booking_bulk_actions( $actions ) {
	unset( $actions['edit'] );
	return array(
		'llb_mark_done'    => __( 'Mark as followed up', 'lessonlark-booking' ),
		'llb_mark_pending' => __( 'Mark as not followed up', 'lessonlark-booking' ),
	) + $actions;
}
add_filter( 'bulk_actions-edit-lessonlark_booking', 'lessonlark_booking_bulk_actions' );

/**
 * Handle the bulk actions.
 *
 * @param string $redirect Redirect URL.
 * @param string $action   Chosen action.
 * @param int[]  $ids      Selected bookings.
 * @return string
 */
function lessonlark_booking_handle_bulk_actions( $redirect, $action, $ids ) {
	if ( ! in_array( $action, array( 'llb_mark_done', 'llb_mark_pending' ), true ) ) {
		return $redirect;
	}
	$changed = 0;
	foreach ( $ids as $id ) {
		if ( current_user_can( 'edit_post', $id ) ) {
			lessonlark_booking_set_followed_up( $id, 'llb_mark_done' === $action );
			++$changed;
		}
	}
	return add_query_arg( 'llb_updated', $changed, $redirect );
}
add_filter( 'handle_bulk_actions-edit-lessonlark_booking', 'lessonlark_booking_handle_bulk_actions', 10, 3 );

/**
 * Status badge styles on the Bookings screens.
 */
function lessonlark_booking_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || 'lessonlark_booking' !== $screen->post_type ) {
		return;
	}
	echo '<style>
		.llb-badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:12px;font-weight:600;line-height:1.6}
		.llb-badge--pending{background:#fcf0e3;color:#8a4b08}
		.llb-badge--done{background:#e7f6ec;color:#00651f}
		.column-llb_status{width:11em}
	</style>';
}
add_action( 'admin_head', 'lessonlark_booking_admin_styles' );

/**
 * Confirmation after a bulk action.
 */
function lessonlark_booking_list_notices() {
	$screen = get_current_screen();
	if ( ! $screen || 'lessonlark_booking' !== $screen->post_type ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display-only.
	if ( isset( $_GET['llb_updated'] ) ) {
		$count = absint( $_GET['llb_updated'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %d: Number of bookings. */
		printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', esc_html( sprintf( _n( '%d booking updated.', '%d bookings updated.', $count, 'lessonlark-booking' ), $count ) ) );
	}
}
add_action( 'admin_notices', 'lessonlark_booking_list_notices' );

/**
 * List-table column content.
 *
 * @param string $column  Column key.
 * @param int    $post_id Booking ID.
 */
function lessonlark_booking_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'llb_status':
			$done = lessonlark_booking_is_followed_up( $post_id );
			printf(
				'<span class="llb-badge llb-badge--%1$s" title="%2$s">%3$s</span>',
				$done ? 'done' : 'pending',
				esc_attr( lessonlark_booking_followed_up_label( $post_id ) ),
				$done ? esc_html__( '✓ Followed up', 'lessonlark-booking' ) : esc_html__( 'Needs follow-up', 'lessonlark-booking' )
			);
			break;
		case 'llb_contact':
			$email = get_post_meta( $post_id, '_llb_email', true );
			$phone = get_post_meta( $post_id, '_llb_phone', true );
			printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
			if ( $phone ) {
				echo '<br>' . esc_html( $phone );
			}
			break;
		case 'llb_grade':
			echo esc_html( get_post_meta( $post_id, '_llb_grade', true ) );
			break;
		case 'llb_subjects':
			echo esc_html( get_post_meta( $post_id, '_llb_subjects', true ) );
			break;
		case 'llb_received':
			// Core's date column says "Last Modified" for private posts; show when the request came in.
			echo esc_html( get_the_date( get_option( 'date_format' ), $post_id ) ) . '<br>' . esc_html( get_the_time( get_option( 'time_format' ), $post_id ) );
			break;
	}
}
add_action( 'manage_lessonlark_booking_posts_custom_column', 'lessonlark_booking_column_content', 10, 2 );

/**
 * Replace the edit screen's title box and publish box with a read-only details view.
 */
function lessonlark_booking_meta_boxes() {
	remove_meta_box( 'submitdiv', 'lessonlark_booking', 'side' );
	add_meta_box( 'lessonlark_booking_details', __( 'Request details', 'lessonlark-booking' ), 'lessonlark_booking_details_box', 'lessonlark_booking', 'normal', 'high' );
	add_meta_box( 'lessonlark_booking_actions', __( 'Actions', 'lessonlark-booking' ), 'lessonlark_booking_actions_box', 'lessonlark_booking', 'side', 'high' );
}
add_action( 'add_meta_boxes_lessonlark_booking', 'lessonlark_booking_meta_boxes' );

/**
 * Hide the editable title field; bookings are read-only.
 */
function lessonlark_booking_remove_title_support() {
	$screen = get_current_screen();
	if ( $screen && 'lessonlark_booking' === $screen->post_type && 'post' === $screen->base ) {
		remove_post_type_support( 'lessonlark_booking', 'title' );
	}
}
add_action( 'current_screen', 'lessonlark_booking_remove_title_support' );

/**
 * Details meta box.
 *
 * @param WP_Post $post Booking.
 */
function lessonlark_booking_details_box( $post ) {
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( lessonlark_booking_meta_labels() as $key => $label ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '' === $value ) {
			continue;
		}
		if ( '_llb_email' === $key ) {
			$value = sprintf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $value ), esc_html( $value ) );
		} elseif ( '_llb_page' === $key ) {
			$value = sprintf( '<a href="%1$s">%2$s</a>', esc_url( $value ), esc_html( $value ) );
		} else {
			$value = nl2br( esc_html( $value ) );
		}
		printf( '<tr><th scope="row">%1$s</th><td>%2$s</td></tr>', esc_html( $label ), $value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	}
	printf(
		'<tr><th scope="row">%1$s</th><td>%2$s</td></tr>',
		esc_html__( 'Received', 'lessonlark-booking' ),
		esc_html( get_the_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $post ) )
	);
	echo '</tbody></table>';
}

/**
 * Actions meta box: follow-up status and toggle, move to trash.
 *
 * @param WP_Post $post Booking.
 */
function lessonlark_booking_actions_box( $post ) {
	$done = lessonlark_booking_is_followed_up( $post->ID );
	printf(
		'<p><span class="llb-badge llb-badge--%1$s">%2$s</span></p>',
		$done ? 'done' : 'pending',
		esc_html( lessonlark_booking_followed_up_label( $post->ID ) )
	);
	if ( current_user_can( 'edit_post', $post->ID ) ) {
		printf(
			'<p><a class="button %1$s" href="%2$s">%3$s</a></p>',
			$done ? '' : 'button-primary',
			esc_url( lessonlark_booking_follow_up_url( $post->ID, ! $done ) ),
			$done ? esc_html__( 'Mark as not followed up', 'lessonlark-booking' ) : esc_html__( 'Mark as followed up', 'lessonlark-booking' )
		);
		if ( ! $done ) {
			echo '<p class="description">' . esc_html__( 'Contact the family however you like (email, phone, text), then mark it here so you know it’s handled.', 'lessonlark-booking' ) . '</p>';
		}
	}
	if ( current_user_can( 'delete_post', $post->ID ) ) {
		printf( '<p><a class="submitdelete" href="%1$s">%2$s</a></p>', esc_url( get_delete_post_link( $post->ID ) ), esc_html__( 'Move to Trash', 'lessonlark-booking' ) );
	}
}

/**
 * Show how many bookings still need follow-up next to the menu item.
 */
function lessonlark_booking_menu_badge() {
	global $menu;
	$count = lessonlark_booking_count( 'pending' );
	if ( ! $count ) {
		return;
	}
	foreach ( $menu as $i => $item ) {
		if ( 'edit.php?post_type=lessonlark_booking' === $item[2] ) {
			$menu[ $i ][0] .= sprintf( ' <span class="awaiting-mod count-%1$d"><span class="pending-count">%1$d</span></span>', $count ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		}
	}
}
add_action( 'admin_menu', 'lessonlark_booking_menu_badge', 99 );
