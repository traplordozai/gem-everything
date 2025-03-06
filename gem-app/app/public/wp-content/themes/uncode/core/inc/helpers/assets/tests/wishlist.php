<?php
/**
 * Wishlist test
 *
 * Only the wishlist page is checked, because we require
 * the wishlist assets also when the WooCommerce test is true
 *
 */

function uncode_page_require_asset_wishlist( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_wishlist', false ) ) {
		return true;
	}

	if ( class_exists( 'YITH_WCWL' ) ) {
		$woo_wishlist      = apply_filters( 'uncode_woo_wishlist', ot_get_option('_uncode_woocommerce_wishlist') );
		$woo_wishlist_icon = apply_filters( 'uncode_woo_wishlist_icon', ot_get_option('_uncode_woocommerce_wishlist_icon') );

		if ($woo_wishlist === 'on' && $woo_wishlist_icon !== '') {
			return true;
		}

		$wishlist_page = absint( get_option( 'yith_wcwl_wishlist_page_id' ) );

		if ( $wishlist_page > 0 ) {
			if ( is_page( $wishlist_page ) ) {
				return true;
			}
		}
	}

	return false;
}
