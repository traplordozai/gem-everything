<?php
/**
 * Uncode WC Additional Information config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Product Information', 'uncode-core') ,
	'base' => 'uncode_single_product_additional_info',
	'php_class_name' => 'uncode_generic_admin',
	'icon' => 'fa fa-info-circle',
	'weight' => -135,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Single Product Variations Additional', 'uncode-core') ,
	'params' => array(
		$add_text_size,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
		) ,
	)
));
