<?php
/**
 * VC Raw JS config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Raw JS', 'uncode-core') ,
	'base' => 'vc_raw_js',
	'weight' => 8300,
	'icon' => 'fa fa-code',
	'wrapper_class' => 'clearfix',
	'category' => array(
		esc_html__('Extra', 'uncode-core') ,
	),
	'description' => esc_html__('Javascript Code Functions', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => esc_html__('Raw js', 'uncode-core') ,
			'param_name' => 'content',
			'value' => esc_html__(base64_encode('<script type="text/javascript"> alert("Enter your js here!" ); </script>') , 'uncode-core') ,
			'description' => esc_html__('Enter your JS code.', 'uncode-core')
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
