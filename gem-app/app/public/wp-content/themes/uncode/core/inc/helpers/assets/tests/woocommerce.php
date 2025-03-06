<?php
/**
 * WooCommerce test
 */

function uncode_page_require_asset_woocommerce( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_woocommerce', false ) ) {
		return true;
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_woocommerce() || is_shop() || is_cart() || is_checkout() || is_wc_endpoint_url() ) {
			return true;
		}

		$woo_cart = apply_filters( 'uncode_woo_cart', ot_get_option('_uncode_woocommerce_cart') );
		$woo_icon = apply_filters( 'uncode_woo_icon', ot_get_option('_uncode_woocommerce_cart_icon') );

		if ($woo_cart === 'on' && $woo_icon !== '') {
			return true;
		}

		foreach ( $content_array as $content ) {
			if (
				strpos( $content, '[uncode_woocommerce_' ) !== false
				||
				strpos( $content, 'post_type:product' ) !== false
				||
				strpos( $content, '[add_to_cart' ) !== false
				||
				strpos( $content, '[product ' ) !== false
			) {
				return true;
			}
		}

		// WooCommerce styles are required in the wishlist page
		if ( class_exists( 'YITH_WCWL' ) ) {
			$wishlist_page = absint( get_option( 'yith_wcwl_wishlist_page_id' ) );

			if ( $wishlist_page > 0 ) {
				if ( is_page( $wishlist_page ) ) {
					return true;
				}
			}
		}
	}

	return false;
}
