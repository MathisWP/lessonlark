<?php
/**
 * Front-end markup for the Scheduler block.
 *
 * @package lessonlark-booking
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

$llb_url   = trim( (string) $attributes['url'] );
$llb_parts = wp_parse_url( $llb_url );
$llb_host  = isset( $llb_parts['host'] ) ? strtolower( $llb_parts['host'] ) : '';

/**
 * Hosts the scheduler may embed. Add a self-hosted Cal.com domain here if you use one.
 *
 * @param string[] $hosts Base domains; subdomains are allowed too.
 */
$llb_hosts   = apply_filters( 'lessonlark_booking_scheduler_hosts', array( 'cal.com', 'calendly.com' ) );
$llb_allowed = false;
foreach ( $llb_hosts as $llb_base ) {
	if ( $llb_host === $llb_base || str_ends_with( $llb_host, '.' . $llb_base ) ) {
		$llb_allowed = true;
		break;
	}
}

if ( ! $llb_url || ! $llb_allowed || ( $llb_parts['scheme'] ?? '' ) !== 'https' ) {
	// Nothing to show visitors. Nudge editors so an empty block isn't a silent mystery.
	if ( current_user_can( 'edit_posts' ) ) {
		printf(
			'<div %1$s><p class="lessonlark-scheduler__notice">%2$s</p></div>',
			get_block_wrapper_attributes(), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html__( 'Scheduler: add your Cal.com or Calendly link in the block settings. (Only editors see this message.)', 'lessonlark-booking' )
		);
	}
	return;
}

// Calendly's inline-embed parameters hide its cookie banner and match the page.
if ( str_ends_with( $llb_host, 'calendly.com' ) ) {
	$llb_url = add_query_arg(
		array(
			'embed_type'       => 'Inline',
			'embed_domain'     => wp_parse_url( home_url(), PHP_URL_HOST ),
			'hide_gdpr_banner' => '1',
		),
		$llb_url
	);
}

$llb_height = max( 400, min( 1600, (int) $attributes['height'] ) );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'lessonlark-scheduler' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="height:<?php echo esc_attr( $llb_height ); ?>px">
	<iframe src="<?php echo esc_url( $llb_url ); ?>" title="<?php esc_attr_e( 'Choose a time for your session', 'lessonlark-booking' ); ?>" loading="lazy" allow="payment"></iframe>
</div>
