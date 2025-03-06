<?php
/**
 * VC Widget WC product categories config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Product Categories', 'uncode-core') ,
	'base' => 'uncode_woocommerce_widget_product_categories',
	'icon' => 'icon-wpb-woocommerce',
	'weight' => -200,
	'category' => esc_html__('WooCommerce Widgets', 'uncode-core') ,
	'description' => esc_html__('A list or dropdown of product categories.', 'woocommerce') ,
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
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'woocommerce') ,
			'param_name' => 'orderby',
			"value" => array(
				esc_html__('Category order', 'woocommerce') => 'order',
				esc_html__('Name', 'woocommerce') => 'name',
			),
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show as dropdown', 'woocommerce') ,
			'param_name' => 'dropdown',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show product counts', 'woocommerce') ,
			'param_name' => 'count',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show hierarchy', 'woocommerce') ,
			'param_name' => 'hierarchical',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Only show children of the current category', 'woocommerce') ,
			'param_name' => 'show_children_only',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hide empty categories', 'woocommerce') ,
			'param_name' => 'hide_empty',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Maximum depth', 'woocommerce') ,
			'param_name' => 'max_depth',
		) ,
		$add_widget_style,
		$add_widget_collapse_desktop,
		$add_widget_collapse_tablet,
		$add_widget_collapse,
		$add_widget_icon,
		$add_widget_style_no_separator,
		$add_widget_style_title_typo,
		$add_widget_style_no_arrows,
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
