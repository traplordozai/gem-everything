<?php
/**
 * VC Lottie config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Lottie', 'uncode-core') ,
	'base' => 'uncode_lottie',
	'weight' => 9200,
	'icon' => 'fa fa-film',
	'description' => esc_html__('Lottie', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'admin_label' => true,
			"description" => esc_html__("The module title. Leave blank to hide the title.", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Lottie JSON URL', 'uncode-core') ,
			'param_name' => 'json',
			'value' => '',
			'description' => esc_html__('Enter the URL for your Lottie JSON file.', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Animation trigger", 'uncode-core') ,
			"param_name" => "trigger",
			"description" => esc_html__("Choose with what action the animation should be initialized. NB. When working on the Frontend Editor, the Viewport and the Scroll Sync are disabled.", 'uncode-core') ,
			'admin_label' => true,
			"value" => array(
				esc_html__('Autoplay', 'uncode-core') => '',
				esc_html__('Viewport', 'uncode-core') => 'viewport',
				esc_html__('Scroll Sync', 'uncode-core') => 'scroll',
				esc_html__('Hover', 'uncode-core') => 'hover',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No loop", 'uncode-core') ,
			"param_name" => "no_loop",
			"description" => esc_html__("Disable animation looping.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'trigger',
				'value' => array('', 'viewport', 'hover'),
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Speed", 'uncode-core') ,
			"param_name" => "speed",
			"min" => 1,
			"max" => 250,
			"step" => 1,
			"value" => 10,
			"description" => esc_html__("Specify the animation speed. The default value is 10. NB. This option does not work with Scroll Sync.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'trigger',
				'value' => array('', 'viewport', 'hover'),
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Starting frame", 'uncode-core') ,
			"param_name" => "frame_from",
			"min" => 0,
			"max" => 99,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Specify, in percentages, the moment you want your animation to start.", 'uncode-core') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Ending frame", 'uncode-core') ,
			"param_name" => "frame_to",
			"min" => 1,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Specify, in percentages, the moment at which you want your animation to end.", 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Width unit", 'uncode-core') ,
			"param_name" => "media_width_use_pixel",
			"description" => 'Set this value if you want to constrain the Lottie width.',
			"value" => array(
				'' => 'yes'
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Width", 'uncode-core') ,
			"param_name" => "media_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Set the Lottie width with a percent value.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'is_empty' => true,
			),
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Width", 'uncode-core') ,
			'param_name' => 'media_width_pixel',
			'description' => esc_html__("Insert the Lottie width in pixel.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'value' => 'yes'
			),
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Alignment', 'uncode-core') ,
			'param_name' => 'alignment',
			'value' => array(
				esc_html__('Align Left', 'uncode-core') => '',
				esc_html__('Align Right', 'uncode-core') => 'right',
				esc_html__('Align Center', 'uncode-core') => 'center'
			) ,
			'description' => esc_html__('Specify the Lottie alignment.', 'uncode-core') ,
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
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
	)
));
