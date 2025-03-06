<?php
/**
 * VC Widgetised Sidebar config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Widgetised Sidebar', 'uncode-core') ,
	'base' => 'vc_widget_sidebar',
	'weight' => 8500,
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'fa fa-tags',
	'description' => esc_html__('Footer Widgets', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'widgetised_sidebars',
			'heading' => esc_html__('Sidebar', 'uncode-core') ,
			'param_name' => 'sidebar_id',
			'description' => esc_html__('Specify which widget area output.', 'uncode-core'),
			'admin_label' => true,
		) ,
		$add_widget_style,
		$add_widget_collapse_tablet,
		$add_widget_collapse,
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
