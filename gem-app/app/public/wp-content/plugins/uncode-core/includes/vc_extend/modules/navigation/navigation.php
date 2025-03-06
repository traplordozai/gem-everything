<?php
/**
 * Module Navigation config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$navigation_font_size = $heading_size;
unset( $navigation_font_size[ 'BigText' ] );

vc_map(array(
	'name' => esc_html__('Navigation', 'uncode-core') ,
	'base' => 'uncode_navigation',
	'weight' => 8601,
	'icon' => 'fa fa-angle-double-right',
	'php_class_name' => 'uncode_module_navigation',
	'description' => esc_html__('Navigation', 'uncode-core') ,
	'show_settings_on_create' => true ,
	'params' => array(
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Title", 'uncode-core') ,
			"param_name" => "hide_title",
			"description" => esc_html__("Activate this to show the title.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Label", 'uncode-core') ,
			"param_name" => "hide_label",
			"description" => esc_html__("Activate this to show the prev/next label.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Index", 'uncode-core') ,
			"param_name" => "hide_parent",
			"description" => esc_html__("Activate this to show the parent navigation link.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Thumbnails", 'uncode-core') ,
			"param_name" => "hide_thumbnails",
			"description" => esc_html__("Activate this to show the thumbnails.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Loop", 'uncode-core') ,
			"param_name" => "no_loop",
			"description" => esc_html__("Activate this to loop the navigation.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => esc_html__('General', 'uncode-core') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Stacked', 'uncode-core') ,
			'param_name' => 'stacked_layout',
			"description" => esc_html__("Activate this to stack the elements.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Stacked Desktop", 'uncode-core') ,
			"param_name" => "stacked_layout_desktop",
			"description" => esc_html__("Activate this to stack the elements when the viewport is greater than 960px.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'stacked_layout',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Stacked Tablet", 'uncode-core') ,
			"param_name" => "stacked_layout_tablet",
			"description" => esc_html__("Activate this to stack the elements when the viewport is between 570px and 960px.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'stacked_layout',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Stacked Mobile", 'uncode-core') ,
			"param_name" => "stacked_layout_mobile",
			"description" => esc_html__("Activate this to stack the elements when the viewport is less than 570px.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'stacked_layout',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Items Gap", 'uncode-core') ,
			"param_name" => "navigation_gap",
			"description" => esc_html__("Set the horizontal gap.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'std' => 'standard',
			"value" => array(
				esc_html__('Small', 'uncode-core') => 'small',
				esc_html__('Standard', 'uncode-core') => 'standard',
				esc_html__('Large', 'uncode-core') => 'large',
				esc_html__('Extra Large', 'uncode-core') => 'extra-large'
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Vertical Space", 'uncode-core') ,
			"param_name" => "vertical_space",
			"description" => esc_html__("Set the vertical space between the label and the title.", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'std' => 'small',
			"value" => array(
				esc_html__('Small', 'uncode-core') => 'small',
				esc_html__('Standard', 'uncode-core') => 'standard',
				esc_html__('Large', 'uncode-core') => 'large',
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Custom typography', 'uncode-core') ,
			'param_name' => 'title_custom_typo',
			'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
			'group' => esc_html__('Title', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_title',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font family", 'uncode-core') ,
			"param_name" => "title_font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font size", 'uncode-core') ,
			"param_name" => "title_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => 'h6',
			"value" => $navigation_font_size,
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font weight", 'uncode-core') ,
			"param_name" => "title_weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "title_transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Line height", 'uncode-core') ,
			"param_name" => "title_height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Letter spacing", 'uncode-core') ,
			"param_name" => "title_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('Title', 'uncode-core') ,
			'dependency' => array(
				'element' => 'title_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Responsive', 'uncode-core') ,
			'param_name' => 'title_responsive',
			"description" => esc_html__("Enable it to set the visibility of elements according to the size of the viewport.", 'uncode-core') ,
			'group' => esc_html__('Title', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_title',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "title_desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Title', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'title_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "title_medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Title', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'title_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "title_mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Title', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'title_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Previous text', 'uncode-core') ,
			'param_name' => 'previous_label',
			'description' => esc_html__('Enter the text for the Previous label. NB. If it\'s empty the default value is "Previous".', 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_label',
				'is_empty' => true
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Next text', 'uncode-core') ,
			'param_name' => 'next_label',
			'description' => esc_html__('Enter the text for the Next label. NB. If it\'s empty the default value is "Next".', 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_label',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Position", 'uncode-core') ,
			"param_name" => "label_position",
			"description" => esc_html__("Select the position of the label.", 'uncode-core') ,
			"value" => array(
				esc_html__('Before Title', 'uncode-core') => '',
				esc_html__('After Title', 'uncode-core')  => 'after',
			) ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_label',
				'is_empty' => true
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Custom typography', 'uncode-core') ,
			'param_name' => 'label_custom_typo',
			'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_label',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font family", 'uncode-core') ,
			"param_name" => "label_font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font size", 'uncode-core') ,
			"param_name" => "label_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => '',
			"value" => $navigation_font_size,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font weight", 'uncode-core') ,
			"param_name" => "label_weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "label_transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Line height", 'uncode-core') ,
			"param_name" => "label_height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Letter spacing", 'uncode-core') ,
			"param_name" => "label_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('Label', 'uncode-core') ,
			'dependency' => array(
				'element' => 'label_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Responsive', 'uncode-core') ,
			'param_name' => 'label_responsive',
			"description" => esc_html__("Enable it to set the visibility of elements according to the size of the viewport.", 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_label',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "label_desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'label_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "label_medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'label_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "label_mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Label', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'label_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Index type', 'uncode-core') ,
			'param_name' => 'parent_type',
			"description" => esc_html__("Choose the type of the Index link.", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			"value" => array(
				esc_html__('Text', 'uncode-core') => '',
				esc_html__('Icon', 'uncode-core') => 'icon',
			) ,
			'dependency' => array(
				'element' => 'hide_parent',
				'is_empty' => true
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Index text', 'uncode-core') ,
			'param_name' => 'parent_label',
			'description' => esc_html__('Enter the text for the Index label. NB. If it\'s empty the default value is "Main".', 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_type',
				'is_empty' => true
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Custom typography', 'uncode-core') ,
			'param_name' => 'parent_custom_typo',
			'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'parent_type',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font family", 'uncode-core') ,
			"param_name" => "parent_font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font size", 'uncode-core') ,
			"param_name" => "parent_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => '',
			"value" => $navigation_font_size,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font weight", 'uncode-core') ,
			"param_name" => "parent_weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "parent_transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Line height", 'uncode-core') ,
			"param_name" => "parent_height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Letter spacing", 'uncode-core') ,
			"param_name" => "parent_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_custom_typo',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Index icon', 'uncode-core') ,
			'param_name' => 'parent_icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_type',
				'value' => array(
					'icon'
				)
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Index icon size', 'uncode-core') ,
			'param_name' => 'parent_icon_size',
			'value' => $icon_sizes,
			'std' => '',
			'description' => esc_html__("Set the icon size.", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'dependency' => array(
				'element' => 'parent_type',
				'value' => array(
					'icon'
				)
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Responsive', 'uncode-core') ,
			'param_name' => 'parent_responsive',
			"description" => esc_html__("Enable it to set the visibility of elements according to the size of the viewport.", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_parent',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "parent_desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'parent_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "parent_medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'parent_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "parent_mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Index', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'parent_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Shape", 'uncode-core') ,
			"param_name" => "thumbnails_shape",
			"description" => esc_html__("Choose the shape of the thumbnails", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Square', 'uncode-core') => '',
				esc_html__('Circle', 'uncode-core') => 'circle',
			) ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_thumbnails',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Size", 'uncode-core') ,
			"param_name" => "thumbnails_size",
			"description" => esc_html__("Choose the thumbnail size", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 'small',
				esc_html__('Large', 'uncode-core') => 'large',
			) ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_thumbnails',
				'is_empty' => true
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Responsive', 'uncode-core') ,
			'param_name' => 'thumbnails_responsive',
			"description" => esc_html__("Enable it to set the visibility of elements according to the size of the viewport.", 'uncode-core') ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'hide_thumbnails',
				'is_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "thumbnails_desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'thumbnails_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "thumbnails_medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'thumbnails_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "thumbnails_mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Thumbnails', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'thumbnails_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Previous icon', 'uncode-core') ,
			'param_name' => 'prev_icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			'group' => esc_html__('Icons', 'uncode-core') ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Next icon', 'uncode-core') ,
			'param_name' => 'next_icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			'group' => esc_html__('Icons', 'uncode-core') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon size', 'uncode-core') ,
			'param_name' => 'icon_size',
			'value' => $icon_sizes,
			'std' => '',
			'group' => esc_html__('Icons', 'uncode-core') ,
			'description' => esc_html__("Icon size.", 'uncode-core') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Responsive', 'uncode-core') ,
			'param_name' => 'icon_responsive',
			"description" => esc_html__("Enable it to set the visibility of elements according to the size of the viewport.", 'uncode-core') ,
			'group' => esc_html__('Icons', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "icon_desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Icons', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'icon_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "icon_medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Icons', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'icon_responsive',
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'param_holder_class' => 'inverted-checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "icon_mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Icons', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'icon_responsive',
				'value' => array(
					'yes'
				)
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core'),
			"group" => esc_html__("Extra", 'uncode-core') ,
		)
	) ,
));
