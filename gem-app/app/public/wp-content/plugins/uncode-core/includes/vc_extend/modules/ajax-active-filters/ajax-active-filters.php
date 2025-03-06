<?php
/**
 * Uncode AJAX Active Filters config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Ajax Active Filters', 'uncode-core') ,
	'base' => 'uncode_ajax_active_filters',
	'icon' => 'fa fa-filter',
	'weight' => 10,
	// 'category' => array(
	// 	esc_html__('WooCommerce', 'uncode-core') ,
	// ),
	'description' => esc_html__('WooCommerce Ajax Filter', 'uncode-core') ,
	'params' => array(
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Title", 'uncode-core') ,
			"param_name" => "title",
			"description" => esc_html__("The module title. Leave blank to hide the title.", 'uncode-core') ,
			'admin_label' => true,
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Clear All", 'uncode-core') ,
			"param_name" => "show_clear",
			"description" => esc_html__("Display the 'Clear All' button.", 'uncode-core') ,
			"value" => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			),
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Display", 'uncode-core') ,
			"param_name" => "display",
			"description" => esc_html__("Choose how to display the terms.", 'uncode-core') ,
			"value" => array(
				esc_html__('List', 'uncode-core') => '',
				esc_html__('Inline', 'uncode-core') => 'inline',
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Columns", 'uncode-core') ,
			"param_name" => "columns_num",
			"min" => 2,
			"max" => 6,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Number of columns", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display',
				'value' => array( 'columns' ),
			) ,
		) ,
		$add_widget_style,
		$add_widget_collapse_desktop,
		$add_widget_collapse_tablet,
		$add_widget_collapse_tablet,
		$add_widget_collapse,
		$add_widget_collapse,
		$add_widget_icon,
		$add_widget_style_no_separator,
		$add_widget_style_title_typo,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
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
