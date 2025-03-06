<?php
/**
 * Star Rating config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$text_color_options = uncode_core_vc_params_get_advanced_color_options( 'text_color', esc_html__("Stars color", 'uncode-core'), esc_html__("Specify the Star Rating main color.", 'uncode-core'), false, $uncode_colors, array( 'default_label' => true ) );
list( $add_text_color_type, $add_text_color, $add_text_color_solid, $add_text_color_gradient ) = $text_color_options;

$add_text_size = uncode_core_vc_params_get_text_size( 'sub_lead', esc_html__("Additional text size", 'uncode-core'), false );

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);
unset( $heading_size_h[ 'BigText' ] );

vc_map(array(
	'name' => esc_html__('Stars Rating', 'uncode-core') ,
	'base' => 'uncode_star_rating',
	'weight' => 9000,
	'icon' => 'fa fa-star-o',
	'description' => esc_html__('Star review rate rating vote average', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '',
		) ,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Value', 'uncode-core' ),
            'value' => 4.50,
            'param_name' => 'rate',
            'description' => esc_html__( 'Specify the Stars Rating value on a basis of 5 ratings. Ex. 4.5.', 'uncode-core' ),
            'admin_label' => true,
        ),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Stars size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify the Stars Rating size.", 'uncode-core') ,
			'std' => 'custom',
			"value" => $heading_size_h,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom size', 'uncode-core') ,
			'param_name' => 'custom_size',
			'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
            'value' => '15px',
			'dependency' => array(
				'element' => 'text_size',
				'value' => array('custom'),
			) ,
		) ,
        array(
			"type" => 'dropdown',
            'heading' => esc_html__('Display', 'uncode-core') ,
            'param_name' => 'display',
            'description' => esc_html__('Specify the display mode.', 'uncode-core'),
			"value" => array(
				esc_html__('Block', 'uncode-core') => '',
				esc_html__('Inline', 'uncode-core') => 'inline-block',
			) ,
        ) ,
        $add_text_color_type,
		$add_text_color,
		$add_text_color_solid,
		$add_text_color_gradient,
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Additional text', 'uncode-core') ,
            'param_name' => 'text',
            'description' => esc_html__('Insert an additional Text.', 'uncode-core')
        ) ,
		$add_text_size,
        array(
			"type" => 'dropdown',
            'heading' => esc_html__('Additional text display', 'uncode-core') ,
            'param_name' => 'text_display',
            'description' => esc_html__('Specify the Additional Text display mode.', 'uncode-core'),
			"value" => array(
				esc_html__('Block', 'uncode-core') => '',
				esc_html__('Inline', 'uncode-core') => 'inline-block',
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
