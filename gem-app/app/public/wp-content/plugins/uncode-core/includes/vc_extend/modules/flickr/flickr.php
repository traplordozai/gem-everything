<?php
/**
 * VC Flickr config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'base' => 'vc_flickr',
	'name' => esc_html__('Flickr Widget', 'uncode-core') ,
	'icon' => 'fa fa-flickr',
	'weight' => 8450,
	'description' => esc_html__('Images Feed Photos', 'uncode-core') ,
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as module title. Leave blank if no title is needed.', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Flickr ID', 'uncode-core') ,
			'param_name' => 'flickr_id',
			'admin_label' => true,
			'description' => sprintf(wp_kses(__('To find your flickID visit %s.', 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) , '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Number of photos', 'uncode-core') ,
			'param_name' => 'count',
			'value' => array(
				9,
				8,
				7,
				6,
				5,
				4,
				3,
				2,
				1
			) ,
			'description' => esc_html__('Number of photos.', 'uncode-core')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Type', 'uncode-core') ,
			'param_name' => 'type',
			'value' => array(
				esc_html__('User', 'uncode-core') => 'user',
				esc_html__('Group', 'uncode-core') => 'group'
			) ,
			'description' => esc_html__('Photo stream type.', 'uncode-core')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Display', 'uncode-core') ,
			'param_name' => 'display',
			'value' => array(
				esc_html__('Latest', 'uncode-core') => 'latest',
				esc_html__('Random', 'uncode-core') => 'random'
			) ,
			'description' => esc_html__('Photo order.', 'uncode-core')
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
		)
	)
));
