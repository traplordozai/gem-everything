<?php
/**
 * VC Share config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Share', 'uncode-core') ,
	'base' => 'uncode_share',
	'weight' => 8700,
	'icon' => 'fa fa-share',
	'php_class_name' => 'uncode_share',
	'description' => esc_html__('Socials', 'uncode-core') ,
	'params' => array(
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Share layout", 'uncode-core') ,
			"param_name" => "layout",
			"description" => esc_html__("Specify the sharing area layout.", 'uncode-core') ,
			"value" => array(
				esc_html__('One popup button', 'uncode-core') => '',
				esc_html__('Social buttons', 'uncode-core') => 'multiple',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Bigger icons", 'uncode-core') ,
			"param_name" => "bigger",
			"description" => esc_html__("Activate this to have bigger icons.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No background", 'uncode-core') ,
			"param_name" => "no_back",
			"description" => esc_html__("Activate this to remove the background hover effect.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Label', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('Insert the label for the share module.', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate this to add a separator between the value and the description.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
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
