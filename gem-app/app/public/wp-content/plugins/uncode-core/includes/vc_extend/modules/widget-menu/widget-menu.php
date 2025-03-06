<?php
/**
 * VC Widget Menu config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$custom_menus = array(esc_html__('Select…','uncode-core') => '');
$menus = get_terms('nav_menu', array(
	'hide_empty' => false
));
if (is_array($menus)) {
	foreach ($menus as $single_menu)
	{
		$custom_menus[$single_menu->name] = $single_menu->term_id;
	}
}
vc_map(array(
	'name' => 'WP ' . esc_html__("Custom Menu", 'uncode-core') ,
	'base' => 'vc_wp_custommenu',
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
			'type' => 'dropdown',
			'heading' => esc_html__('Menu', 'uncode-core') ,
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty($custom_menus) ? esc_html__('Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'uncode-core') : esc_html__('Specify menu', 'uncode-core') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Horizontal menu', 'uncode-core') ,
			'param_name' => 'nav_menu_horizontal',
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => true
			)
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		)
	)
));
