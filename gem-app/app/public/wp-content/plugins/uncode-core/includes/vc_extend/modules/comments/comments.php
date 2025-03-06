<?php
/**
 * Module Comments config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Comments', 'uncode-core') ,
	'base' => 'uncode_comments',
	'weight' => 8239,
	'icon' => 'fa fa-comments',
	'php_class_name' => 'uncode_module_comments',
	'description' => esc_html__('Comments Form Reply Discussio', 'uncode-core') ,
	'show_settings_on_create' => true ,
	'params' => array(
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
