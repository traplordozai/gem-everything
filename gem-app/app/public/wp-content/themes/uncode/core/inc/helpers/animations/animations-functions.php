<?php
/**
 * Animations related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Disable animations on mobile devices
 */
function uncode_animations_enabled() {
	$animations_enabled = ot_get_option( '_uncode_disable_animations_mobile' ) === 'on' && wp_is_mobile() ? false : true;
	$animations_enabled = apply_filters( 'uncode_animations_enabled', $animations_enabled );

	return $animations_enabled;
}
