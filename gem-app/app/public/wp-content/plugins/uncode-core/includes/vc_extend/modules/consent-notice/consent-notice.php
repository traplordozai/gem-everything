<?php
/**
 * VC Consent Notice config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$notice_color_options = uncode_core_vc_params_get_advanced_color_options( 'notice_color', esc_html__("Consent Notice Color", 'uncode-core'), esc_html__("Specify consent notice color.", 'uncode-core'), false, $uncode_colors );
list( $add_notice_color_type, $add_notice_color, $add_notice_color_solid, $add_notice_color_gradient ) = $notice_color_options;

if ( class_exists( 'Uncode_Toolkit_Privacy' ) ) :
vc_map(array(
	'name' => esc_html__('Consent Notice', 'uncode-core') ,
	'base' => 'uncode_consent_notice',
	'weight' => 8800,
	'icon' => 'fa fa-exclamation-circle',
	'wrapper_class' => 'clearfix',
	'php_class_name' => 'uncode_generic_admin',
	'description' => esc_html__('Privacy GDPR Fallback', 'uncode-core') ,
	'params' => array(
		$add_notice_color_type,
		$add_notice_color,
		$add_notice_color_solid,
		$add_notice_color_gradient,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
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
		),
	) ,
));
endif;
