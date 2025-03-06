<?php
/**
 * VC TwentyTwenty config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'base' => 'uncode_twentytwenty',
	'name' => esc_html__('Before and After', 'uncode-core') ,
	'icon' => 'fa fa-adjust',
	'php_class_name' => 'uncode_twentytwenty',
	'weight' => 8850,
	'description' => esc_html__('Images difference compare', 'uncode-core') ,
	'params' => array(
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media before", 'uncode-core') ,
			"param_name" => "media_before",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode-core') ,
			"admin_label" => true
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media after", 'uncode-core') ,
			"param_name" => "media_after",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode-core') ,
			"admin_label" => true
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
		) ,
	)
));
