<?php
/**
 * VC Widget Links config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$link_category = array(
	esc_html__('All Links', 'uncode-core') => ''
);
$link_cats = get_terms('link_category');
if (is_array($link_cats)) {
	foreach ($link_cats as $link_cat)
	{
		$link_category[$link_cat->name] = $link_cat->term_id;
	}
}
vc_map(array(
	'name' => 'WP ' . esc_html__('Links', 'uncode-core') ,
	'base' => 'vc_wp_links',
	'icon' => 'fa fa-wordpress',
	'class' => 'wpb_vc_wp_widget',
	'weight' => -500,
	'category' => array(
		esc_html__('WordPress Widgets', 'uncode-core') ,
	),
	'description' => esc_html__('Widgets', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Link Category', 'uncode-core') ,
			'param_name' => 'category',
			'value' => $link_category,
			'admin_label' => true
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort by', 'uncode-core') ,
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Link title', 'uncode-core') => 'name',
				esc_html__('Link rating', 'uncode-core') => 'rating',
				esc_html__('Link ID', 'uncode-core') => 'id',
				esc_html__('Random', 'uncode-core') => 'rand'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode-core') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Show Link Image', 'uncode-core') => 'images',
				esc_html__('Show Link Name', 'uncode-core') => 'name',
				esc_html__('Show Link Description', 'uncode-core') => 'description',
				esc_html__('Show Link Rating', 'uncode-core') => 'rating'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of links to show', 'uncode-core') ,
			'param_name' => 'limit'
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		)
	)
));
