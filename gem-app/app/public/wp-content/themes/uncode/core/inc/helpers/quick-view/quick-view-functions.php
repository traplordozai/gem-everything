<?php
/**
 * Quick View class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if WooCommerce is active
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Check if it is a quick view action
 */
function uncode_is_quick_view() {
	$actions = apply_filters( 'uncode_check_quick_view_actions', array( 'uncode_load_ajax_quick_view' ) );
	return defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $actions, true );
}

/**
 * Get quick view Content Block ID
 */
function uncode_get_quick_view_content_block_id( $post_type = 'product' ) {
	$content_block_id = apply_filters( 'uncode_get_' . $post_type . '_quick_view_content_block_id', ot_get_option( '_uncode_' . $post_type . '_index_quick_view_content_block' ) );
	$content_block_id = absint( apply_filters( 'wpml_object_id', $content_block_id, 'product', true ) );

	return $content_block_id ? $content_block_id : false;
}
