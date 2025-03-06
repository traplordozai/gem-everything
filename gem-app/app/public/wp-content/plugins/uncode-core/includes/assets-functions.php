<?php
/**
 * Assets functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Wrapper for wp_deregister_script
 */
function uncode_deregister_script( $tag ) {
	wp_deregister_script( $tag );
	wp_dequeue_script( $tag );
}

/**
 * Defer non-critial CSS
 */
function uncode_core_defer_non_critical_css() {
	if ( function_exists( 'uncode_defer_non_critical_css') ) {
		add_filter( 'style_loader_tag', 'uncode_defer_non_critical_css', 10, 2 );
	}
}
add_action( 'init', 'uncode_core_defer_non_critical_css' );
