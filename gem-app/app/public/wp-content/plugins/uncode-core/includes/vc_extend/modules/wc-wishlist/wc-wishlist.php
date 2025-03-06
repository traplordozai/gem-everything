<?php
/**
 * WC Wishlist config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$add_text_size = uncode_core_vc_params_get_text_size( 'icon_text_size', false, esc_html__("General", 'uncode-core') );

$wishilist_params = array(
	$add_text_size,
	$add_css_animation,
	$add_animation_speed,
	$add_animation_delay,
);

$wishilist_params   = array_merge( $wishilist_params, $wc_extra_options );
$wishilist_params[] = array(
	"type" => 'checkbox',
	"heading" => esc_html__("Text Uppercase", 'uncode-core') ,
	"param_name" => "text_uppercase",
	'group' => esc_html__('General', 'uncode-core'),
	"description" => esc_html__('Activate this to have the wishlist button in uppercase.', 'uncode-core') ,
	"value" => array(
		'' => 'yes'
	),
);

$wishilist_params[] = array(
	"type" => 'checkbox',
	"heading" => esc_html__("Text Bold", 'uncode-core') ,
	"param_name" => "bold_text",
	'group' => esc_html__('General', 'uncode-core'),
	"description" => esc_html__('Activate this to highlight part of the text in boldface.', 'uncode-core') ,
	"value" => array(
		'' => 'yes'
	),
);

vc_map(array(
	'name' => esc_html__('Product Wishlist', 'uncode-core') ,
	'base' => 'uncode_woocommerce_wishlist',
	'icon' => 'fa fa-heart',
	'weight' => -135,
	'show_settings_on_create' => true,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Single Product Heart Like Preference', 'uncode-core') ,
	'params' => $wishilist_params,
));
