<?php
/**
 * VC Widget WC products config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Products Widget', 'uncode-core') ,
	'base' => 'uncode_woocommerce_widget_products',
	'icon' => 'icon-wpb-woocommerce',
	'weight' => -200,
	'category' => esc_html__('WooCommerce Widgets', 'uncode-core') ,
	'description' => esc_html__("A list of your store's products.", 'woocommerce') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode-core')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hide Title', 'uncode-core') ,
			'param_name' => 'hide_title',
			'description' => esc_html__('Hide the widget title and avoid to display the default title when you leave it empty.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of products to show', 'woocommerce') ,
			'param_name' => 'number',
			'value' => 5,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Show', 'woocommerce') ,
			'param_name' => 'show',
			"value" => array(
				esc_html__('All products', 'woocommerce') => '',
				esc_html__('Featured products', 'woocommerce') => 'featured',
				esc_html__('On-sale products', 'woocommerce') => 'onsale',
			),
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'woocommerce') ,
			'param_name' => 'orderby',
			"value" => array(
				esc_html__('Date', 'woocommerce') => 'date',
				esc_html__('Price', 'woocommerce') => 'price',
				esc_html__('Random', 'woocommerce') => 'rand',
				esc_html__('Sales', 'woocommerce') => 'sales',
			),
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order', 'woocommerce') ,
			'param_name' => 'order',
			"value" => array(
				esc_html__('ASC', 'woocommerce') => 'asc',
				esc_html__('DESC', 'woocommerce') => 'desc',
			),
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hide free products', 'uncode-core') ,
			'param_name' => 'hide_free',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show hidden products', 'uncode-core') ,
			'param_name' => 'show_hidden',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			)
		) ,
		$add_widget_style_no_stars,
		$add_widget_style_no_thumbs,
		$add_widget_style,
		$add_widget_collapse_desktop,
		$add_widget_collapse_tablet,
		$add_widget_collapse,
		$add_widget_icon,
		$add_widget_style_no_separator,
		$add_widget_style_title_typo,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core'),
			"group" => esc_html__("Extra", 'uncode-core') ,
		)
	)
));
