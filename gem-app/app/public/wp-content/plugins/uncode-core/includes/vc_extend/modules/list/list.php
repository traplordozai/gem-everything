<?php
/**
 * VC List config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$add_text_size = uncode_core_vc_params_get_text_size( 'larger' );

$icon_color_options = uncode_core_vc_params_get_advanced_color_options( 'icon_color', esc_html__("Icon color", 'uncode-core'), esc_html__("Specify a color for the icon.", 'uncode-core'), false, $flat_uncode_colors_w_accent, array( 'flat' => true, 'dependency' => array( 'element' => 'icon', 'not_empty' => true, 'default_label' => true ) ) );
list( $add_icon_color_type, $add_icon_color, $add_icon_color_solid ) = $icon_color_options;

vc_map(array(
	'name' => esc_html__('List', 'uncode-core') ,
	'base' => 'uncode_list',
	'weight' => 9450,
	'icon' => 'fa fa-list-ol',
	'php_class_name' => 'uncode_list',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Listing Icons', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('List text', 'uncode-core') ,
			'param_name' => 'content',
		) ,
		$add_text_size,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'value' => '',
			'admin_label' => true,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		$add_icon_color_type,
		$add_icon_color,
		$add_icon_color_solid,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
	) ,
));
