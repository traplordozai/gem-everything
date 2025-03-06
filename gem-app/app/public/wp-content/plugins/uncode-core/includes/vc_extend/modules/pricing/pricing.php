<?php
/**
 * VC Pricing config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$price_color_options = uncode_core_vc_params_get_advanced_color_options( 'price_color', esc_html__("Block color", 'uncode-core'), esc_html__("Specify a color for the block.", 'uncode-core'), false, $flat_uncode_colors_w_accent, array( 'flat' => true, 'default_label' => true ) );
list( $add_price_color_type, $add_price_color, $add_price_color_solid ) = $price_color_options;

vc_map(array(
	'name' => esc_html__('Pricing Table', 'uncode-core') ,
	'base' => 'uncode_pricing',
	'weight' => 9100,
	'icon' => 'fa fa-list-alt',
	'php_class_name' => 'uncode_pricing',
	'description' => esc_html__('Price', 'uncode-core') ,
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
			'description' => esc_html__('Insert the price table title and separate with a pipe | if you want to have subtitle.', 'uncode-core') ,
			'value' => esc_html__('Title|Subtitle','uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Price', 'uncode-core') ,
			'param_name' => 'price',
			'description' => esc_html__('Insert the price and separate with a pipe | if you want to have subtitle.', 'uncode-core') ,
			'value' => esc_html__('$50|per month','uncode-core')
		) ,
		array(
			"type" => 'textarea_safe',
			"heading" => esc_html__("Body", 'uncode-core') ,
			"param_name" => "body",
			"description" => esc_html__("Insert body text line. Every new line is a block. If you separate with a pipe | the first part will be with bold style.", 'uncode-core') ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Button', 'uncode-core') ,
			'param_name' => 'button',
			'description' => esc_html__('Insert a link if you want a button.', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button hover effect", 'uncode-core') ,
			"param_name" => "hover_fx",
			"description" => esc_html__("Specify an effect on hover state.", 'uncode-core') ,
			"value" => array(
				'Inherit' => '',
				'Outlined' => 'outlined',
				'Flat' => 'full-colored',
			) ,
		) ,
		$add_price_color_type,
		$add_price_color,
		$add_price_color_solid,
		array(
			'type' => 'dropdown',
			'heading' => 'Colored elements',
			'param_name' => 'col_elements',
			'value' => array(
				esc_html__('Inside elements', 'uncode-core') => '',
				esc_html__('Top and bottom', 'uncode-core') => 'tb',
			) ,
			'description' => esc_html__('Specify how do you want to color the block. NB. This works only if you select a valid Block Color.', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Most popular", 'uncode-core') ,
			"param_name" => "most",
			"description" => esc_html__("Activate this to make the block to stick out, like featured.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Alignment", 'uncode-core') ,
			"param_name" => "align",
			"description" => esc_html__("Specify the text aligment.", 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
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
