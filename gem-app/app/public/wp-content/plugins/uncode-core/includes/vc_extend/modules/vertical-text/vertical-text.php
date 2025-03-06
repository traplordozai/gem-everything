<?php
/**
 * Vertical Text config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$text_color_options = uncode_core_vc_params_get_advanced_color_options( 'text_color', esc_html__("Text color", 'uncode-core'), esc_html__("Specify text color. NB. Please note that this option does not override the link color but applies to the plain text.", 'uncode-core'), esc_html__('Text', 'uncode-core'), $uncode_colors, array( 'default_label' => true, 'dependency' => array( 'element' => 'element_type', 'is_empty' => true ) ) );
list( $add_text_color_type, $add_text_color, $add_text_color_solid, $add_text_color_gradient ) = $text_color_options;

$vertical_text_heading_size = $heading_size;
unset($vertical_text_heading_size['BigText']);

vc_map(array(
	'name' => esc_html__('Fixed Element', 'uncode-core') ,
	'base' => 'uncode_vertical_text',
	'icon' => 'fa fa-text-height',
	'php_class_name' => 'uncode_generic_admin',
	'weight' => 8900,
	'show_settings_on_create' => true,
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Fixed vertical text element', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Element Type", 'uncode-core') ,
			"param_name" => "element_type",
			"description" => esc_html__("Specify the element type.", 'uncode-core') ,
			"value" => array(
				esc_html__('Text', 'uncode-core') => '',
				esc_html__('Socials', 'uncode-core') => 'social',
			) ,
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Layout", 'uncode-core') ,
			"param_name" => "layout",
			"uncode_wrapper_class" => "fixed-text-layout",
			"description" => esc_html__("Specify the element layout.", 'uncode-core') ,
			"value" => array(
				esc_html__('Vertical', 'uncode-core') => '',
				esc_html__('Horizontal', 'uncode-core') => 'horizontal',
			) ,
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Fixed", 'uncode-core') ,
			"param_name" => "fixed",
			"description" => esc_html__("Activate this to positionate the element relative to the viewport.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Vertical", 'uncode-core') ,
			"param_name" => "text_align",
			"description" => esc_html__("Specify the vertical alignment.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Middle', 'uncode-core') => '',
				esc_html__('Top', 'uncode-core') => 'top',
				esc_html__('Bottom', 'uncode-core') => 'bottom',
			) ,
			'dependency' => array(
				'element' => 'layout',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Horizontal", 'uncode-core') ,
			"param_name" => "horizontal_align",
			"description" => esc_html__("Specify the horizontal alignment.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'horizontal',
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Position", 'uncode-core') ,
			"param_name" => "position",
			"description" => esc_html__("Specify the element position.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Left', 'uncode-core') => '',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'layout',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Position", 'uncode-core') ,
			"param_name" => "horizontal_position",
			"description" => esc_html__("Specify the element position.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Bottom', 'uncode-core') => '',
				esc_html__('Top', 'uncode-core') => 'top',
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'horizontal',
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Flip", 'uncode-core') ,
			"param_name" => "flip",
			"description" => esc_html__("Activate this to flip the element.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Horizontal position", 'uncode-core') ,
			"param_name" => "vertical_text_h_pos",
			"min" => -5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set the horizontal position.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'layout',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Vertical position", 'uncode-core') ,
			"param_name" => "horizontal_text_v_pos",
			"min" => -5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set the vertical position.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'horizontal',
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Vertical position", 'uncode-core') ,
			"param_name" => "vertical_text_v_pos",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set the vertical position.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'text_align',
				'not_empty' => true
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Horizontal position", 'uncode-core') ,
			"param_name" => "horizontal_text_h_pos",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set the horizontal position.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'horizontal_align',
				'not_empty' => true
			),
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom z-index", 'uncode-core') ,
			"param_name" => "z_index",
			"min" => 0,
			"max" => 10,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set a custom z-index to ensure the visibility of the element.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core') ,
			'dependency' => array(
				'element' => 'fixed',
				'is_empty' => true,
			),
		) ,
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Text', 'uncode-core') ,
			'param_name' => 'content',
			'value' => esc_html__('Vertical text.', 'uncode-core') ,
			'group' => esc_html__('Text', 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text font family", 'uncode-core') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("Text", 'uncode-core') ,
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			"value" => $vertical_text_heading_size,
			'group' => esc_html__('Text', 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text weight", 'uncode-core') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('Text', 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the text text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			"group" => esc_html__("Text", 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text line height", 'uncode-core') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('Text', 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text letter spacing", 'uncode-core') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify text letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('Text', 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text italic", 'uncode-core') ,
			"param_name" => "text_italic",
			"description" => esc_html__("Transform the text to italic.", 'uncode-core') ,
			"value" => array(
				esc_html__('Normal', 'uncode-core') => '',
				esc_html__('Italic', 'uncode-core') => 'yes',
			) ,
			"group" => esc_html__("Text", 'uncode-core'),
			'dependency' => array(
				'element' => 'element_type',
				'is_empty' => true,
			),
		) ,
		$add_text_color_type,
		$add_text_color,
		$add_text_color_solid,
		$add_text_color_gradient,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon size", 'uncode-core') ,
			"param_name" => "socials_size",
			"description" => esc_html__("Specify the icon dimension.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Large', 'uncode-core') => 'lead',
			) ,
			"group" => esc_html__("Socials", 'uncode-core') ,
			'dependency' => array(
				'element' => 'element_type',
				'value' => 'social',
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Show on Top", 'uncode-core') ,
			"param_name" => "show_on_top",
			"description" => esc_html__("Activate to show the element only when it is at the top of the page.", 'uncode-core') ,
			'group' => esc_html__('Effects', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'fixed',
				'not_empty' => true
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Show after Scroll", 'uncode-core') ,
			"param_name" => "show_after_scroll",
			"description" => esc_html__("Activate to show the element after scrolling the viewport.", 'uncode-core') ,
			'group' => esc_html__('Effects', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'show_on_top',
				'is_empty' => true
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Hide on Bottom", 'uncode-core') ,
			"param_name" => "hide_on_bottom",
			"description" => esc_html__("Activate to hide the element after scrolling to the bottom of the page.", 'uncode-core') ,
			'group' => esc_html__('Effects', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'show_on_top',
				'is_empty' => true
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Difference", 'uncode-core') ,
			"param_name" => "difference",
			"description" => esc_html__("This option applies the Difference Blend Mode.", 'uncode-core') ,
			'group' => esc_html__('Effects', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'fixed',
				'not_empty' => true
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
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
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
	) ,
));
