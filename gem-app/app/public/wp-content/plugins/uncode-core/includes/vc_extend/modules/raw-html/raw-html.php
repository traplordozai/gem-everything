<?php
/**
 * VC Raw HTML config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Raw HTML', 'uncode-core') ,
	'base' => 'vc_raw_html',
	'weight' => 8350,
	'icon' => 'fa fa-code',
	'category' => array(
		esc_html__('Extra', 'uncode-core') ,
	),
	'description' => esc_html__('Code', 'uncode-core') ,
	'wrapper_class' => 'clearfix',
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => esc_html__('Raw HTML', 'uncode-core') ,
			'param_name' => 'content',
			'value' => base64_encode('<p>I am raw html block.<br/>Click edit button to change this html</p>') ,
			'description' => esc_html__('Enter your HTML content.', 'uncode-core')
		) ,
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
	)
));
