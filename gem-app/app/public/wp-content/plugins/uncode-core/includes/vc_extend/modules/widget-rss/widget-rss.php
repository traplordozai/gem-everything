<?php
/**
 * VC Widget Archives config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => 'WP ' . esc_html__('RSS', 'uncode-core') ,
	'base' => 'vc_wp_rss',
	'icon' => 'fa fa-wordpress',
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 500,
	'category' => array(
		esc_html__('WordPress Widgets', 'uncode-core') ,
	),
	'description' => esc_html__('Widgets', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('RSS feed URL', 'uncode-core') ,
			'param_name' => 'url',
			'description' => esc_html__('Enter the RSS feed URL.', 'uncode-core') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items', 'uncode-core') ,
			'param_name' => 'items',
			'value' => array(
				esc_html__('10 - Default', 'uncode-core') => '',
				1,
				2,
				3,
				4,
				5,
				6,
				7,
				8,
				9,
				10,
				11,
				12,
				13,
				14,
				15,
				16,
				17,
				18,
				19,
				20
			) ,
			'description' => esc_html__('How many items would you like to display?', 'uncode-core') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode-core') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Display item content?', 'uncode-core') => 'show_summary',
				esc_html__('Display item author if available?', 'uncode-core') => 'show_author',
				esc_html__('Display item date?', 'uncode-core') => 'show_date'
			)
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		)
	)
));
