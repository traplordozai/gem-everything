<?php
/**
 * VC Countdown config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Countdown', 'uncode-core') ,
	'base' => 'uncode_countdown',
	'icon' => 'fa fa-clock-o',
	'weight' => 8900,
	'php_class_name' => 'uncode_countdown',
	'description' => esc_html__('Numbers date days months progress value deadline', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Final date', 'uncode-core') ,
			'param_name' => 'date',
			'description' => esc_html__('Input the countdown date with this format YYYY/MM/DD. ex. 2022/05/20', 'uncode-core') ,
			'admin_label' => true
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font family", 'uncode-core') ,
			"param_name" => "font",
			"description" => esc_html__("Specify the countdown font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font size", 'uncode-core') ,
			"param_name" => "size",
			"description" => esc_html__("Specify the countdown font size.", 'uncode-core') ,
			"value" => $heading_size,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font weight", 'uncode-core') ,
			"param_name" => "weight",
			"description" => esc_html__("Specify the countdown font weight.", 'uncode-core') ,
			"value" =>$heading_weight,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown text transform", 'uncode-core') ,
			"param_name" => "transform",
			"description" => esc_html__("Specify the countdown text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown line height", 'uncode-core') ,
			"param_name" => "height",
			"description" => esc_html__("Specify the countdown line height.", 'uncode-core') ,
			"value" => $heading_height,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate this to add a separator between the value and the description.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text under', 'uncode-core') ,
			'param_name' => 'text',
			'description' => esc_html__('Input a text under the countdown.', 'uncode-core') ,
			'value' => ''
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
