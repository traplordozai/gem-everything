<?php
/**
 * WooCommerce Additional Variation Images support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if WooCommerce Additional Variation Images is active
if ( ! defined( 'WC_ADDITIONAL_VARIATION_IMAGES_VERSION' ) ) {
	return;
}

if ( ! class_exists( 'Uncode_WooCommerce_Additional_Variation_Images' ) ) :

/**
 * Uncode_WooCommerce_Additional_Variation_Images Class
 */
class Uncode_WooCommerce_Additional_Variation_Images {
	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'uncode_woocommerce_get_default_product_gallery_settings_post_id', array( $this, 'set_product_id' ) );
	}

	/**
	 * Set correct Product ID during the AJAX request.
	 */
	public function set_product_id( $product_id ) {
		if ( isset( $_REQUEST['wc-ajax'] ) && $_REQUEST['wc-ajax'] === 'wc_additional_variation_images_get_images' ) {
			$variation_id = isset( $_REQUEST['variation_id'] ) && $_REQUEST['variation_id'] ? $_REQUEST['variation_id'] : 0;

			if ( $variation_id > 0 ) {
				$variation  = wc_get_product( $variation_id );
				$product_id = $variation->get_parent_id();
			}
		}

		return $product_id;
	}
}

endif;

return new Uncode_WooCommerce_Additional_Variation_Images();
