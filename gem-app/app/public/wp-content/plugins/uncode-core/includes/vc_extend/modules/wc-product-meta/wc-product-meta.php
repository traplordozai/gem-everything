<?php
/**
 * VC Product Reviews config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$add_text_size = uncode_core_vc_params_get_text_size( 'text_lead' );

vc_map(array(
	'name' => esc_html__('Product Meta', 'uncode-core') ,
	'base' => 'uncode_single_product_meta',
	'php_class_name' => 'uncode_generic_admin',
	'icon' => 'fa fa-tag',
	'weight' => -135,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Single Product Sku', 'uncode-core') ,
	'params' => array(
		$add_text_size,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Inline', 'uncode-core') ,
			'param_name' => 'inline',
			'description' => esc_html__('Set the inline style for the Product Meta.', 'uncode-core') ,
			'value' => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			),
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
	)
));
