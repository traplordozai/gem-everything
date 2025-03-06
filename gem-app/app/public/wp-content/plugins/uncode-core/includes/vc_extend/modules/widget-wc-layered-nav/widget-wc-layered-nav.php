<?php
/**
 * VC Widget WC layered nav config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$attribute_array      = array();
$attribute_taxonomies = function_exists( 'wc_get_attribute_taxonomies' ) ? wc_get_attribute_taxonomies() : array();

if ( ! empty( $attribute_taxonomies ) ) {
	foreach ( $attribute_taxonomies as $tax ) {
		if ( function_exists( 'wc_attribute_taxonomy_name' ) ) {
			if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
				$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
			}
		}
	}
}

vc_map(array(
	'name' => esc_html__('Products Layered Nav', 'uncode-core') ,
	'base' => 'uncode_woocommerce_widget_layered_nav',
	'icon' => 'icon-wpb-woocommerce',
	'weight' => -200,
	'category' => esc_html__('WooCommerce Widgets', 'uncode-core') ,
	'description' => esc_html__('Display a list of attributes to filter products in your store.', 'woocommerce') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode-core')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Attribute', 'woocommerce') ,
			'param_name' => 'attribute',
			"value" => $attribute_array,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Display type', 'woocommerce') ,
			'param_name' => 'display_type',
			"value" => array(
				esc_html__('List', 'woocommerce') => 'list',
				esc_html__('Dropdown', 'woocommerce') => 'dropdown',
			),
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Query type', 'woocommerce') ,
			'param_name' => 'query_type',
			"value" => array(
				esc_html__('AND', 'woocommerce') => 'and',
				esc_html__('OR', 'woocommerce') => 'or',
			),
		) ,
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
