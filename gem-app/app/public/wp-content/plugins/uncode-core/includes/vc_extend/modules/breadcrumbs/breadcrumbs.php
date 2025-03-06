<?php
/**
 * Breadcrumbs config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
	'base' => 'uncode_breadcrumbs',
	'name' => esc_html__('Breadcrumbs', 'uncode-core') ,
	'icon' => 'fa fa-ellipsis-h',
	'weight' => 8602,
	'category' => array(
		esc_html__('Dynamic', 'uncode-core') ,
	),
	'description' => esc_html__('Navigation', 'uncode-core') ,
	'params' => array(
		$add_text_size,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Separators", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Specify a separator.", 'uncode-core') ,
			'group' => esc_html__('Text', 'uncode-core'),
			'std' => 'slash',
			"value" => array(
				esc_html__('None', 'uncode-core') => 'none',
				esc_html__('/ (Slash)', 'uncode-core') => 'slash',
				esc_html__('| (Vertical bar)', 'uncode-core') => 'pipe',
				esc_html__('- (Dash)', 'uncode-core') => 'dash',
				esc_html__('• (Bullet)', 'uncode-core') => 'bullet',
				esc_html__('‣ (Triangle)', 'uncode-core') => 'triangle',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("WooCommerce", 'uncode-core') ,
			"param_name" => "wc_breadcrumbs",
			"description" => esc_html__("Use the default WooCommerce breadcrumbs structure.", 'uncode-core') ,
			'group' => esc_html__('Text', 'uncode-core'),
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		$add_text_css_animation,
		$add_animation_speed,
		$add_animation_delay,
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
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
	)
) );
