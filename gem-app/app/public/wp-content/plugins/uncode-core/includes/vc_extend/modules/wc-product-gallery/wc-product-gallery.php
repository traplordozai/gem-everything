<?php
/**
 * VC Product Gallery config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$uncode_single_product_gallery_params = array(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout *', 'uncode-core') ,
		'param_name' => 'layout',
		'value' => array(
			esc_html__('Standard', 'uncode-core') => '',
			esc_html__('Standard Vertical Nav', 'uncode-core') => 'std-lateral',
			esc_html__('Stack', 'uncode-core') => 'stack',
			esc_html__('Stack Vertical Nav', 'uncode-core') => 'stack-lateral',
			esc_html__('Grid', 'uncode-core') => 'grid',
		) ,
		'admin_label' => true,
		'description' => esc_html__('Specify the module layout mode. NB. This option is disabled while working with the Frontend Editor, only the Stack preview is available.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Gutter thumb", 'uncode-core') ,
		"param_name" => "gutter_thumb_grid",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the space between thumbs.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'layout',
			'value' => 'grid' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Disable lightbox", 'uncode-core') ,
		"param_name" => "lightbox",
		"description" => esc_html__("Activate to disable lightbox on product images.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Lightbox skin", 'uncode-core') ,
		"param_name" => "lbox_skin",
		"description" => esc_html__("Set the Lightbox skin", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'value' => array(
			esc_html__('Dark', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'white',
		) ,
		'std' => 'thumbs',
		'dependency' => array(
			'element' => 'lightbox',
			'is_empty' => true ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Disable zoom", 'uncode-core') ,
		"param_name" => "zoom",
		"description" => esc_html__("Activate to disable drag Zoom effect on product image.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Disable zoom Mobile", 'uncode-core') ,
		"param_name" => "zoom_mobile",
		"description" => esc_html__("Activate to disable drag Zoom effect on product image on mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'zoom',
			'is_empty' => true ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Columns", 'uncode-core') ,
		"param_name" => "columns",
		"min" => 2,
		"max" => 6,
		"step" => 1,
		'dependency' => array(
			'element' => 'layout',
			'is_empty' => true
		) ,
		"value" => 3,
		"description" => esc_html__("Specify how many columns to display for your product Gallery thumbs.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Disable carousel", 'uncode-core') ,
		"param_name" => "carousel",
		"description" => esc_html__("Activate to disable Carousel Slider when you click Gallery thumbs.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'layout',
			'is_empty' => true
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Navigation", 'uncode-core') ,
		"param_name" => "nav",
		"description" => esc_html__("Set the Navigation style", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'value' => array(
			esc_html__('Nothing', 'uncode-core') => '',
			esc_html__('Thumbs', 'uncode-core') => 'thumbs',
			esc_html__('Dots', 'uncode-core') => 'dots',
		) ,
		'std' => 'thumbs',
		'dependency' => array(
			'element' => 'carousel',
			'is_empty' => true ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Navigation Thumbs Gap", 'uncode-core') ,
		"param_name" => "gutter_thumb",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the thumbs gap.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'nav',
			'value' => 'thumbs' ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Gallery Thumbs Gap", 'uncode-core') ,
		"param_name" => "gutter_thumb_2",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the thumbs gap.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel',
			'not_empty' => true ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Thumbs Ratio', 'uncode-core') ,
		'param_name' => 'images_size',
		'description' => esc_html__('Specify the aspect ratio for the thumbnails.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'layout',
			'value' => array( '', 'std-lateral', 'stack-lateral' ),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Inner Padding", 'uncode-core') ,
		"param_name" => "inner_padding",
		"description" => esc_html__("Activate this to have an inner padding with the same size as the Thumbs Gutter.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'nav',
			'value' => 'thumbs' ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Vertical Space", 'uncode-core') ,
		"param_name" => "gutter_size",
		"min" => 0,
		"max" => 6,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the vertical rhythm between elements.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'layout',
			'value' => array( 'stack', 'stack-lateral' ),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots Inside", 'uncode-core') ,
		"param_name" => "dots_inside",
		"description" => esc_html__("Activate to have the dots inside the carousel.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'nav',
			'value' => 'dots' ,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Display Badges", 'uncode-core') ,
		"param_name" => "product_badges",
		"description" => esc_html__("Activate the WooCommerce special badges.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"std" => 'yes',
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Preserve Grid on Mobile", 'uncode-core') ,
		"param_name" => "mobile_grid",
		"description" => esc_html__("Activate to preserve the grid layout on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'layout',
			'value' => 'grid',
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
);

if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
	$default_gallery_params = array();

	// List of allowed params when using the default gallery
	$allowed_params = array(
		'layout',
		'zoom',
		'columns',
		'product_badges',
		'mobile_grid',
		'css_animation',
		'animation_speed',
		'animation_delay',
		'el_id',
		'el_class',
	);

	foreach ( $uncode_single_product_gallery_params as $param_key => $param_value ) {
		if ( isset( $param_value['param_name'] ) && in_array( $param_value['param_name'] , $allowed_params ) ) {
			if ( $param_value['param_name'] === 'zoom' ) {
				$param_value['dependency'] = array(
					'element'  => 'layout',
					'value' => array( '', 'std-lateral' ),
				);
			} else if ( $param_value['param_name'] === 'product_badges' ) {
				$thumbs_gap = array(
					"type" => "type_numeric_slider",
					"heading" => esc_html__("Thumbs gap", 'uncode-core') ,
					"param_name" => "gutter_size",
					"min" => 0,
					"max" => 6,
					"step" => 1,
					"value" => 3,
					"description" => esc_html__("Set the thumbs gap.", 'uncode-core') ,
					'group' => esc_html__('General', 'uncode-core') ,
				);

				$default_gallery_params[] = $thumbs_gap;
			}

			$default_gallery_params[] = $param_value;
		}
	}

	$uncode_single_product_gallery_params = $default_gallery_params;
}

vc_map(array(
	'name' => esc_html__('Product Gallery', 'uncode-core') ,
	'base' => 'uncode_single_product_gallery',
	'php_class_name' => 'uncode_generic_admin',
	'icon' => 'fa fa-list-ul',
	'weight' => -130,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Single Product Images Photos Zoom Lightbox Carousel', 'uncode-core') ,
	'params' => $uncode_single_product_gallery_params
));
