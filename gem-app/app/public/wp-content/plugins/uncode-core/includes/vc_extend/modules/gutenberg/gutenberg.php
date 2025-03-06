<?php
/**
 * VC Gutenberg config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__( 'Gutenberg Editor', 'uncode-core' ),
	'base' => 'vc_gutenberg',
	'icon' => 'fa fa-google',
	'wrapper_class' => 'clearfix',
	'weight' => 8200,
	'params' => array(
		array(
			'type' => 'gutenberg',
			'holder' => 'div',
			'heading' => esc_html__( 'Gutengerg Editor', 'uncode-core' ),
			'description' => esc_html__( 'Insert Gutenberg editor in your layout', 'uncode-core' ),
			'param_name' => 'content',
			'value' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'uncode-core' ),
		),
		/*$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,*/
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
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'uncode-core' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'uncode-core' ),
		),
	),
));
