<?php
/**
 * Upsells and Cross Sells related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get upsells products IDs.
 */
function uncode_get_upsell_product_ids( $product_id ) {
	$product    = wc_get_product( $product_id );
	$upsell_ids = array();

	if ( ! $product ) {
		return $upsell_ids;
	}

	$upsell_ids = $product->get_upsell_ids();

	return $upsell_ids;
}

/**
 * Append a special class to the body when there are no upsells.
 */
function uncode_add_upsell_not_found_class( $classes ) {
	if ( is_product() ) {
		$product_id = get_the_ID();

		if ( $product_id > 0 ) {
			$upsells_ids = uncode_get_upsell_product_ids( $product_id );
			if ( ! ( is_array( $upsells_ids ) && count( $upsells_ids ) > 0 ) ) {
				$classes[] = 'no-product-upsells';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'uncode_add_upsell_not_found_class' );

/**
 * Append a special class to the body when there are no cross sells.
 */
function uncode_add_cross_sells_not_found_class( $classes ) {
	if ( is_cart() ) {
		$cross_sells = WC()->cart->get_cross_sells();

		if ( ! ( is_array( $cross_sells ) && count( $cross_sells ) > 0 ) ) {
			$classes[] = 'no-product-cross-sells';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'uncode_add_cross_sells_not_found_class' );
