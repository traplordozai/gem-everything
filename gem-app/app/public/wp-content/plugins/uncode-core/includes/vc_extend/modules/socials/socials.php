<?php
/**
 * VC Socials config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map( array(
	'base' => 'uncode_socials',
	'name' => esc_html__('Social Icons', 'uncode-core') ,
	'icon' => 'fa fa-twitter',
	'php_class_name' => 'uncode_socials',
	'weight' => 8650,
	'description' => esc_html__('Share', 'uncode-core') ,
	'params' => array(
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon size", 'uncode-core') ,
			"param_name" => "size",
			"description" => esc_html__("Specify the icon dimension.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Large', 'uncode-core') => 'lead',
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
	)
) );
