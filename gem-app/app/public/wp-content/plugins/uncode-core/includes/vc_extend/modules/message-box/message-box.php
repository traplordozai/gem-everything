<?php
/**
 * VC Message Box config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$message_color_options = uncode_core_vc_params_get_advanced_color_options( 'message_color', esc_html__("Message box color", 'uncode-core'), esc_html__("Specify message box color.", 'uncode-core'), false, $uncode_colors );
list( $add_message_color_type, $add_message_color, $add_message_color_solid, $add_message_color_gradient ) = $message_color_options;

vc_map(array(
	'name' => esc_html__('Message Box', 'uncode-core') ,
	'base' => 'vc_message',
	'weight' => 8750,
	'php_class_name' => 'uncode_message',
	'icon' => 'fa fa-info',
	'description' => esc_html__('Notification Notice Info', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		$add_message_color_type,
		$add_message_color,
		$add_message_color_solid,
		$add_message_color_gradient,
		array(
			'type' => 'textarea_html',
			'class' => 'messagebox_text',
			'param_name' => 'content',
			'heading' => esc_html__('Message text', 'uncode-core') ,
			'value' => wp_kses(__('<p>I am message box. Click edit button to change this text.</p>', 'uncode-core'), array( 'p' => array()))
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
	) ,
));
