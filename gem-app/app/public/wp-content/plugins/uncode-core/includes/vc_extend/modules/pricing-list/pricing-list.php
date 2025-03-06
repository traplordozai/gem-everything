<?php
/**
 * Pricing List config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);
unset( $heading_size_h[ 'BigText' ] );

$text_color_options = uncode_core_vc_params_get_advanced_color_options( 'text_color', esc_html__("Heading color", 'uncode-core'), esc_html__("Specify heading color. NB. Please note that this option does not override the link color but applies to the plain text.", 'uncode-core'), esc_html__('Typography', 'uncode-core'), $uncode_colors, array( 'default_label' => true ) );
list( $add_text_color_type, $add_text_color, $add_text_color_solid, $add_text_color_gradient ) = $text_color_options;

$add_text_size = uncode_core_vc_params_get_text_size( 'sub_lead', esc_html__("Additional text size", 'uncode-core'), esc_html__("Typography", 'uncode-core') );

$border_color_options = uncode_core_vc_params_get_advanced_color_options( 'border_color', esc_html__("Border color", 'uncode-core'), esc_html__("Specify the border color.", 'uncode-core'), false, $flat_uncode_colors_w_transp, array( 'flat' => true ) );
list( $add_border_color_type, $add_border_color, $add_border_color_solid ) = $border_color_options;

vc_map(array(
	'name' => esc_html__('Pricing List', 'uncode-core') ,
	'base' => 'uncode_pricing_list',
	'weight' => 9099,
	'icon' => 'fa fa-list',
	'description' => esc_html__('Price list hours table menu', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '',
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Label', 'uncode-core') ,
			'param_name' => 'label',
			'description' => esc_html__('Specify a label.', 'uncode-core'),
			'admin_label' => true,
		) ,
		array(
			'type' => 'param_group',
			'heading' => esc_html__('List items', 'uncode-core') ,
			'param_name' => 'values',
			'description' => esc_html__( 'Create and order list items.', 'uncode-core' ),
			'value' => urlencode( json_encode( array(
				array(
					'entry' => esc_html__( 'Cosmopolitan', 'uncode-core' ),
					'value' => '$10',
				),
				array(
					'entry' => esc_html__( 'Daiquiri', 'uncode-core' ),
					'value' => '$12',
				),
				array(
					'entry' => esc_html__( 'Negroni', 'uncode-core' ),
					'value' => '$9',
				),
				array(
					'entry' => esc_html__( 'Margarita', 'uncode-core' ),
					'value' => '$11',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Main', 'uncode-core' ),
					'param_name' => 'entry',
					'description' => esc_html__( 'Specify the Main Text.', 'uncode-core' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Value', 'uncode-core' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Specify the Value Text.', 'uncode-core' ),
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__('Additional', 'uncode-core') ,
					'param_name' => 'text',
					'description' => esc_html__('Specify the Additional Text.', 'uncode-core')
				) ,
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Disabled', 'uncode-core' ),
					'param_name' => 'disabled',
					'description' => esc_html__( 'Enable to have the disabled style.', 'uncode-core' ),
					"value" => Array(
						'' => 'yes'
					) ,
				),
				array(
					"type" => "media_element",
					"heading" => esc_html__("Media", 'uncode-core') ,
					"param_name" => "media",
					"value" => "",
					"edit_field_class" => 'vc_column uncode_single_media',
					"description" => esc_html__("Specify a media from the Media Library.", 'uncode-core') ,
					"admin_label" => true
				) ,
			),
		),
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Horizontal space", 'uncode-core') ,
			"param_name" => "gutter_tab_h",
			"min" => 0,
			"max" => 3,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Specify the horizontal spacing between the elements that make up the same item.", 'uncode-core') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Vertical space", 'uncode-core') ,
			"param_name" => "tab_gap",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Specify the vertical spacing between items.", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Vertical alignment", 'uncode-core') ,
			"param_name" => "v_align",
			"description" => esc_html__("Specify the vertical alignment between the elements that make up the same item.", 'uncode-core') ,
			"value" => array(
				esc_html__('Middle', 'uncode-core') => 'middle',
				esc_html__('Top', 'uncode-core') => 'top',
				esc_html__('Bottom', 'uncode-core') => 'bottom',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Media Breakpoint", 'uncode-core') ,
			"param_name" => "media_break",
			"description" => esc_html__("Specify the breakpoint at which the media is placed above the textual elements.", 'uncode-core') ,
			"value" => array(
				esc_html__('Never', 'uncode-core') => '',
				esc_html__('Desktop', 'uncode-core') => 'desktop',
				esc_html__('Tablet', 'uncode-core') => 'tablet',
				esc_html__('Mobile', 'uncode-core') => 'mobile',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Media Width", 'uncode-core') ,
			"param_name" => "media_width_use_pixel",
			"description" => 'Specify the Media Width.',
			'dependency' => array(
				'element' => 'media_break',
				'value_not_equal_to' => 'desktop',
			) ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Media Width Value", 'uncode-core') ,
			"param_name" => "media_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 33,
			"description" => esc_html__("Specify the Media Width in percentage.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Media Width Value", 'uncode-core') ,
			'param_name' => 'media_width_pixel',
			'description' => esc_html__("Specify the Media Width in pixels.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'value' => 'yes'
			)
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Media Max Width", 'uncode-core') ,
			'param_name' => 'media_max_width',
			'description' => esc_html__("Specify the Media Max Width.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'media_break',
				'not_empty' => true
			)
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Media Aspect Ratio', 'uncode-core') ,
			'param_name' => 'media_ratio',
			'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
			"value" => array(
				esc_html__('Regular', 'uncode-core') => '',
				'1:1' => 'one-one',
				'2:1' => 'two-one',
				'3:2' => 'three-two',
				'4:3' => 'four-three',
				'5:4' => 'five-four',
				'10:3' => 'ten-three',
				'16:9' => 'sixteen-nine',
				'21:9' => 'twentyone-nine',
				'1:2' => 'one-two',
				'2:3' => 'two-three',
				'3:4' => 'three-four',
				'4:5' => 'four-five',
				'3:10' => 'three-ten',
				'9:16' => 'nine-sixteen',
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Media Shape', 'uncode-core') ,
			'param_name' => 'shape',
			'value' => array(
				esc_html__('Select…', 'uncode-core') => '',
				esc_html__('Rounded', 'uncode-core') => 'img-round',
				esc_html__('Circular', 'uncode-core') => 'img-circle'
			) ,
			'description' => esc_html__('Specify media shape.', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Media Border Radius", 'uncode-core') ,
			"param_name" => "img_radius",
			"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
			"std" => "",
			"value" => array(
				esc_html__('Extra Small', 'uncode-core') => 'xs',
				esc_html__('Small', 'uncode-core') => ' ',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
				esc_html__('Huge', 'uncode-core') => 'hg',
			),
			"std" => ' ',
			'dependency' => array(
				'element' => 'shape',
				'value' => 'img-round'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Border style", 'uncode-core') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify the border style.", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Solid', 'uncode-core') => 'solid',
				esc_html__('Dotted', 'uncode-core') => 'dotted',
				esc_html__('Dashed', 'uncode-core') => 'dashed',
				esc_html__('Double', 'uncode-core') => 'double',
			)
		) ,
		$add_border_color_type,
		$add_border_color,
		$add_border_color_solid,
		$add_text_color_type,
		$add_text_color,
		$add_text_color_solid,
		$add_text_color_gradient,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading semantic", 'uncode-core') ,
			"param_name" => "heading_semantic",
			"description" => esc_html__("Specify element tag.", 'uncode-core') ,
			"value" => $heading_semantic,
			'std' => 'h2',
			'group' => esc_html__('Typography', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading font family", 'uncode-core') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify heading font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify heading size.", 'uncode-core') ,
			'std' => 'h2',
			"value" => $heading_size_h,
			'group' => esc_html__('Typography', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom size', 'uncode-core') ,
			'param_name' => 'heading_custom_size',
			'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
			'group' => esc_html__('Typography', 'uncode-core'),
			'dependency' => array(
				'element' => 'text_size',
				'value' => array('custom'),
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading weight", 'uncode-core') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify heading weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('Typography', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading transform", 'uncode-core') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			"group" => esc_html__("Typography", 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading line height", 'uncode-core') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify heading line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('Typography', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading letter spacing", 'uncode-core') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify heading letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('Typography', 'uncode-core')
		) ,		
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading italic", 'uncode-core') ,
			"param_name" => "text_italic",
			"description" => esc_html__("Transform the heading to italic.", 'uncode-core') ,
			"value" => array(
				esc_html__('Normal', 'uncode-core') => '',
				esc_html__('Italic', 'uncode-core') => 'yes',
			) ,
			"group" => esc_html__("Typography", 'uncode-core')
		) ,
		$add_text_size,
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
