<?php
/**
 * Plugin Name:       Lessonlark Booking
 * Plugin URI:        https://mathiswp.com/
 * Description:       A ready-to-use "Book a session" form for tutoring sites, plus a Cal.com / Calendly scheduler block. Requests are emailed to you and saved under Bookings in wp-admin.
 * Version:           0.2.0
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Author:            MathisWP
 * Author URI:        https://mathiswp.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       lessonlark-booking
 *
 * @package lessonlark-booking
 */

defined( 'ABSPATH' ) || exit;

define( 'LESSONLARK_BOOKING_VERSION', '0.2.0' );
define( 'LESSONLARK_BOOKING_DIR', __DIR__ );

require_once __DIR__ . '/includes/fields.php';
require_once __DIR__ . '/includes/post-type.php';
require_once __DIR__ . '/includes/submission.php';

/**
 * Register the plugin's blocks.
 */
function lessonlark_booking_register_blocks() {
	register_block_type( __DIR__ . '/blocks/booking-form' );
	register_block_type( __DIR__ . '/blocks/scheduler' );
}
add_action( 'init', 'lessonlark_booking_register_blocks' );
