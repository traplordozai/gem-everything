<?php
/**
 * WooCommerce related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Ensure that WC is installed
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 *	Remove legacy WC modules
 */
function uncode_core_wc_remove_wc_blocks() {
	if ( apply_filters( 'uncode_remove_legacy_wc_blocks', true ) ) {
		vc_remove_element( 'woocommerce_cart' );
		vc_remove_element( 'woocommerce_checkout' );
		vc_remove_element( 'woocommerce_my_account' );
		vc_remove_element( 'woocommerce_order_tracking' );
		vc_remove_element( 'recent_products' );
		vc_remove_element( 'featured_products' );
		vc_remove_element( 'products' );
		vc_remove_element( 'product_categories' );
		vc_remove_element( 'sale_products' );
		vc_remove_element( 'best_selling_products' );
		vc_remove_element( 'top_rated_products' );
		vc_remove_element( 'product_attribute' );
	}
}
add_filter( 'admin_init', 'uncode_core_wc_remove_wc_blocks' );
