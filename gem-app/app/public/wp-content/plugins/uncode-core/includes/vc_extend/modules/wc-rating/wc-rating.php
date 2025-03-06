<?php
/**
 * Uncode WC Rating config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Product Rating', 'uncode-core') ,
	'base' => 'uncode_single_product_rating',
	'php_class_name' => 'uncode_generic_admin',
	'icon' => 'fa fa-star',
	'weight' => -135,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Single Product Stars', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Disable link', 'uncode-core') ,
			'param_name' => 'no_link',
			'description' => esc_html__('This option disables the default link to the Product Review section. It can be useful to show the rate of the product within the Quick-View. NB. Use this option if you insert the Product Review section within other Page Builder elements that are not directly accessible from the page scroll.', 'uncode-core') ,
			'value' => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			),
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
	)
));
