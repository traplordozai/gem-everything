<?php
/**
 * WooCommerce PayPal Payments support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if WooCommerce PayPal Payments is active
if ( ! class_exists( 'WooCommerce' ) && ! defined( 'PPCP_FLAG_SUBSCRIPTION' ) ) {
	return;
}

if ( ! class_exists( 'Uncode_WooCommerce_PayPal_Payments' ) ) :

/**
 * Uncode_WooCommerce_PayPal_Payments Class
 */
class Uncode_WooCommerce_PayPal_Payments {
	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'body_class', array( $this, 'add_body_class' ) );
	}

	/**
	 * Add class to body.
	 */
	public function add_body_class( $classes ) {
		if ( is_cart() ) {
			$options = get_option( 'woocommerce-ppcp-settings' );
			$has_buttons_in_cart = isset( $options['button_cart_enabled'] ) && $options['button_cart_enabled'] ? true : false;

			if ( $has_buttons_in_cart ) {
				$classes[] = 'has-paypal-payments';
			}
		}

		return $classes;
	}
}

endif;

return new Uncode_WooCommerce_PayPal_Payments();
