<?php
/**
 * VC Divider config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$sep_color_options = uncode_core_vc_params_get_advanced_color_options( 'sep_color', esc_html__("Color", 'uncode-core'), esc_html__("Separator color.", 'uncode-core'), false, $flat_uncode_colors_w_accent, array( 'flat' => true, 'default_label' => true ) );
list( $add_sep_color_type, $add_sep_color, $add_sep_color_solid ) = $sep_color_options;

vc_map(array(
	'name' => esc_html__('Divider', 'uncode-core') ,
	'base' => 'vc_separator',
	'weight' => 9400,
	'icon' => 'fa fa-arrows-h',
	'show_settings_on_create' => true,
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Separator line', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		$add_sep_color_type,
		$add_sep_color,
		$add_sep_color_solid,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon position', 'uncode-core') ,
			'param_name' => 'icon_position',
			'value' => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => "right"
			) ,
			'description' => esc_html__('Specify title location.', 'uncode-core')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'uncode-core') ,
			'param_name' => 'type',
			'value' => array(
				esc_html__('Border', 'uncode-core') => '',
				esc_html__('Dashed', 'uncode-core') => 'dashed',
				esc_html__('Dotted', 'uncode-core') => 'dotted',
				//esc_html__('Double', 'uncode-core') => 'double',
			) ,
			'description' => esc_html__('Separator style.', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom width', 'uncode-core') ,
			'param_name' => 'el_width',
			'description' => esc_html__('Insert the custom value in % or px.', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom thickness', 'uncode-core') ,
			'param_name' => 'el_height',
			'description' => esc_html__('Insert the custom value in em or px. This option can\'t be used with the separator with the icon.', 'uncode-core') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Activate scroll to top', 'uncode-core') ,
			'param_name' => 'scroll_top',
			'description' => esc_html__('Activate if you want the scroll top function with the icon.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true
			) ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode-core') ,
			'param_name' => 'link',
			'description' => esc_html__('Separator link.', 'uncode-core') ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true
			) ,
		) ,
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
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
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
