<?php
/**
 * Uncode WC Attribute Image config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$products_attributes_with_image = array();

if ( function_exists( 'uncode_wc_get_taxonomy_props' ) ) {
	foreach ( $all_product_atts as $key => $value ) {
		$tax_props = uncode_wc_get_taxonomy_props( $value );

		if ( isset( $tax_props->attribute_type ) && $tax_props->attribute_type === 'image' ) {
			$products_attributes_with_image[$key] = $value;
		}
	}
}

vc_map(array(
	'name' => esc_html__('Product Attribute Image', 'uncode-core') ,
	'base' => 'uncode_woocommerce_attribute_image',
	'icon' => 'fa fa-file-image-o',
	'weight' => -137,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Attribute Single Product Image', 'uncode-core') ,
	'params' => array(
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Product Attribute", 'uncode-core') ,
			"param_name" => "product_att",
			"description" => esc_html__("Select the product attribute.", 'uncode-core') ,
			"std" => '' ,
			"value" => $products_attributes_with_image,
			'admin_label' => true,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Link", 'uncode-core') ,
			"param_name" => "link",
			"description" => esc_html__("Choose whether to have a link and point it to the filtered shop page or to the product attribute archive.", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Shop Page', 'uncode-core') => 'shop',
				esc_html__('Attribute Archive', 'uncode-core') => 'archive',
			),
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Max Width", 'uncode-core') ,
			'param_name' => 'max_width',
			'description' => esc_html__("Insert the max width in pixel.", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class", 'uncode-core') ,
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", 'uncode-core') ,
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
	),
));
