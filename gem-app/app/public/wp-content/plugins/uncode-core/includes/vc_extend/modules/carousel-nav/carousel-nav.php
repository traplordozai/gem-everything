<?php
/**
 * Uncode Carousel Nav config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$owl_nav_font_size = $heading_size_h;
unset( $owl_nav_font_size[ 'BigText' ] );

vc_map( array(
	'base' => 'uncode_carousel_nav',
	'name' => esc_html__('Carousel/Slider Nav', 'uncode-core') ,
	'icon' => 'fa fa-exchange',
	'weight' => 8600,
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Carousel Navigation Arrows Next Previous Slider Progress Counter Slides Dots', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		array(
			"heading" => esc_html__("Target", 'uncode-core') ,
			'admin_label' => true,
			"type" => "textfield",
			"param_name" => "target",
			"description" => esc_html__("Paste here the Target reference of the Posts or Media Gallery module to which you want to connect the Carousel/Slider Navigation module. PS. If the two modules are in the same Row, there is no need to connect them because the connection is automatic.
", 'uncode-core') ,
		) ,
		array(
			"heading" => esc_html__("Skin", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "skin",
			"description" => esc_html__("Specify the Skin coloration of the module. Any Skins selected in the components take precedence over this general setting.", 'uncode-core') ,
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark',
			) ,
		) ,
		array(
			"heading" => esc_html__("Position", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "position",
			"edit_field_class" => "owl-nav-position-sel",
			"description" => esc_html__("Set the positioning of the module with respect to the layout flow.", 'uncode-core') ,
			"value" => array(
				esc_html__('Relative', 'uncode-core') => '',
				esc_html__('Absolute', 'uncode-core') => 'absolute',
			) ,
		) ,
		array(
			"heading" => esc_html__("Width", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "width",
			"description" => esc_html__("Sets the width of the Navigation module.", 'uncode-core') ,
			"value" => array(
				esc_html__('Limit Width', 'uncode-core') => '',
				esc_html__('Window Width', 'uncode-core') => 'window',
			) ,
			'dependency' => array(
				'element' => 'position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Padding", 'uncode-core') ,
			"param_name" => "padding",
			"description" => esc_html__("Set the horizontal padding.", 'uncode-core') ,
			"edit_field_class" => "h_dot_padding",
			"type" => "type_numeric_slider",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
		) ,
		array(
			"heading" => esc_html__("Vertical Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "v_align",
			"description" => esc_html__("Set the vertical alignment of the components.", 'uncode-core') ,
			"value" => array(
				esc_html__('Bottom', 'uncode-core') => '',
				esc_html__('Middle', 'uncode-core') => 'middle',
				esc_html__('Top', 'uncode-core') => 'top',
			) ,
			'dependency' => array(
				'element' => 'position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Force Limit Width", 'uncode-core') ,
			"param_name" => "limit_width",
			"description" => esc_html__("Sets the width to Limit Width when the container is Full Width. PS. This option is most useful with Content Slider.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
			'dependency' => array(
				'element' => 'position',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Extra Vertical Space", 'uncode-core') ,
			"param_name" => "space",
			"description" => esc_html__("Activate this to add extra top space.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
		) ,
		array(
			"heading" => esc_html__("Horizontal Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "h_align",
			"description" => esc_html__("Set the Horizontal Alignment. Justify distributes the elements in the available width. PS. Please note that Dots and Counter are merged in the presence of Arrows.", 'uncode-core') ,
			"value" => array(
				esc_html__('Justify', 'uncode-core') => '',
				esc_html__('Center', 'uncode-core') => 'center',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
				esc_html__('Inherit', 'uncode-core') => 'inherit',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Hide Arrows", 'uncode-core') ,
			"param_name" => "hide_arrows",
			"description" => esc_html__("Hide the component.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'admin_label' => true,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			"heading" => esc_html__("Skin", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_skin",
			"description" => esc_html__("Specify the Skin coloration of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Group', 'uncode-core') => '',
				esc_html__('Inherit', 'uncode-core') => 'inherit',
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Position", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_position",
			"edit_field_class" => "owl-nav-position-sel",
			"description" => esc_html__("Set the positioning of the module with respect to the layout flow.", 'uncode-core') ,
			"value" => array(
				esc_html__('Relative', 'uncode-core') => '',
				esc_html__('Absolute', 'uncode-core') => 'el_absolute',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Width", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_width",
			"description" => esc_html__("Set the positioning of the component with respect to the width.", 'uncode-core') ,
			"value" => array(
				esc_html__('Limit Width Inside', 'uncode-core') => '',
				esc_html__('Limit Width Outside', 'uncode-core') => 'outer',
				esc_html__('Window Width', 'uncode-core') => 'window',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Vertical Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_v_align",
			"description" => esc_html__("Set the vertical alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Bottom', 'uncode-core') => '',
				esc_html__('Middle', 'uncode-core') => 'middle',
				esc_html__('Top', 'uncode-core') => 'top',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Extra Vertical Space", 'uncode-core') ,
			"param_name" => "arrows_space",
			"description" => esc_html__("Activate this to add extra top space.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
			'dependency' => array(
				'element' => 'arrows_v_align',
				'value' => array('', 'top'),
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_h_align",
			"description" => esc_html__("Set the Horizontal Alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Justify', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Padding", 'uncode-core') ,
			"param_name" => "arrows_padding",
			"description" => esc_html__("Set the horizontal padding.", 'uncode-core') ,
			"edit_field_class" => "h_dot_padding",
			"type" => "type_numeric_slider",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Background Style", 'uncode-core') ,
			"param_name" => "arrow_style",
			"description" => esc_html__("Set the Background Style of the Arrows.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('No Background', 'uncode-core') => 'transparent',
				esc_html__('Round', 'uncode-core') => 'round',
				esc_html__('Round Outline', 'uncode-core') => 'outline',
				esc_html__('Square', 'uncode-core') => 'square',
				esc_html__('Square Outline', 'uncode-core') => 'outline-square',
			) ,
			'std' => '',
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Background Size', 'uncode-core') ,
			'param_name' => 'arrow_bg_size',
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('None', 'uncode-core') => 'no',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
			) ,
			'std' => '',
			'description' => esc_html__("Set the Background Size of the Arrows.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Shadow', 'uncode-core') ,
			'param_name' => 'arrow_shadow',
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
			'description' => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrow_style',
				'value' => array('round', 'square'),
			) ,
		) ,		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Arrow Icon (Right)', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify the next arrow icon from library, the left arrow will be specular.', 'uncode-core') ,
			'value' => 'fa fa-angle-right',
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon position', 'uncode-core') ,
			'param_name' => 'icon_position',
			"value" => array(
				esc_html__('Outside', 'uncode-core') => '',
				esc_html__('Inside', 'uncode-core') => 'inside',
				esc_html__('Hidden', 'uncode-core') => 'hidden',
			) ,
			'std' => '',
			'description' => esc_html__("Set the positioning of the icon with respect to the Previous and Next elements.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_text',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Arrow size', 'uncode-core') ,
			'param_name' => 'arrow_size',
			'value' => array(
				esc_html__('Standard', 'uncode-core') => '',
				esc_html__('0.5x', 'uncode-core') => 'fa-05x',
				esc_html__('0.75x', 'uncode-core') => 'fa-075x',
				esc_html__('2x', 'uncode-core') => 'fa-2x',
				esc_html__('3x', 'uncode-core') => 'fa-3x',
				esc_html__('4x', 'uncode-core') => 'fa-4x',
				esc_html__('5x', 'uncode-core') => 'fa-5x',
			),
			'std' => '',
			'description' => esc_html__("Set the Arrows size.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Arrows text", 'uncode-core') ,
			"param_name" => "arrows_text",
			"description" => esc_html__("Activate the additional Arrows Next and Prev texts.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Previous text', 'uncode-core') ,
			'param_name' => 'previous_label',
			'description' => esc_html__('Insert the Previous Text.', 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_text',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Next text', 'uncode-core') ,
			'param_name' => 'next_label',
			'description' => esc_html__('Insert the Next Text.', 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_text',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Arrows animated", 'uncode-core') ,
			"param_name" => "animated_arrows",
			"description" => esc_html__("Specify the Arrows animation style on hover.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => array(
				esc_html__('No', 'uncode-core') => '',
				esc_html__('Style 1', 'uncode-core') => 'default',
				esc_html__('Style 2', 'uncode-core') => 'yes',
			) ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Arrows magnetic", 'uncode-core') ,
			"param_name" => "magnetic_arrows",
			"description" => esc_html__("Activate the Magnetic effect option.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Arrows On Hover", 'uncode-core') ,
			"param_name" => "arrows_hover",
			"description" => esc_html__("Activate this to animate the component on hover. PS. The animation is disabled on the Frontend Editor.", 'uncode-core') ,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Hover animation", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrows_animation",
			"description" => esc_html__("Specify the entrance animation of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Opacity', 'uncode-core') => '',
				esc_html__('Top to bottom', 'uncode-core') => 'top-t-bottom',
				esc_html__('Bottom to top', 'uncode-core') => 'bottom-t-top',
				esc_html__('Left to right', 'uncode-core') => 'left-t-right',
				esc_html__('Right to left', 'uncode-core') => 'right-t-left',
				esc_html__('From outside', 'uncode-core') => 'outside',
			) ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_hover',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Arrow left order", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrow_left_order",
			"description" => esc_html__("Set the Arrow Left order.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('1', 'uncode-core') => '1',
				esc_html__('2', 'uncode-core') => '2',
				esc_html__('3', 'uncode-core') => '3',
				esc_html__('4', 'uncode-core') => '4',
			) ,
			'std' => '',
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'is_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Arrow right order", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "arrow_right_order",
			"description" => esc_html__("Set the Arrow Right order.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('1', 'uncode-core') => '1',
				esc_html__('2', 'uncode-core') => '2',
				esc_html__('3', 'uncode-core') => '3',
				esc_html__('4', 'uncode-core') => '4',
			) ,
			'std' => '',
			'group' => esc_html__('Arrows', 'uncode-core') ,
			'dependency' => array(
				'element' => 'arrows_position',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Responsive", 'uncode-core') ,
			"param_name" => "arrows_visibility",
			"description" => esc_html__("Activate the Responsive visibility options.", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'hide_arrows',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "arrows_desktop_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'arrows_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "arrows_medium_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'arrows_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "arrows_mobile_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Arrows', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'arrows_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Hide Dots", 'uncode-core') ,
			"param_name" => "hide_dots",
			"description" => esc_html__("Hide the component.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'admin_label' => true,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			"heading" => esc_html__("Position", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_position",
			"edit_field_class" => "owl-nav-position-sel",
			"description" => esc_html__("Set the positioning of the module with respect to the layout flow.", 'uncode-core') ,
			"value" => array(
				esc_html__('Relative', 'uncode-core') => '',
				esc_html__('Absolute', 'uncode-core') => 'el_absolute',
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_dots',
				'is_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Skin", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_skin",
			"description" => esc_html__("Specify the Skin coloration of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Group', 'uncode-core') => '',
				esc_html__('Inherit', 'uncode-core') => 'inherit',
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark',
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Width", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_width",
			"description" => esc_html__("Set the positioning of the component with respect to the width.", 'uncode-core') ,
			"value" => array(
				esc_html__('Limit Width', 'uncode-core') => '',
				esc_html__('Window Width', 'uncode-core') => 'window',
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Vertical Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_v_align",
			"description" => esc_html__("Set the vertical alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Bottom', 'uncode-core') => '',
				esc_html__('Top', 'uncode-core') => 'top',
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Extra Vertical Space", 'uncode-core') ,
			"param_name" => "dots_space",
			"description" => esc_html__("Activate this to add extra top space.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_h_align",
			"description" => esc_html__("Set the Horizontal Alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Padding", 'uncode-core') ,
			"param_name" => "dots_padding",
			"description" => esc_html__("Set the horizontal padding.", 'uncode-core') ,
			"type" => "type_numeric_slider",
			"edit_field_class" => "h_dot_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Type", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_style",
			"description" => esc_html__("Set the design type for the Dots component.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => array(
				esc_html__('Bullets', 'uncode-core') => '',
				esc_html__('Lines', 'uncode-core') => 'lines',
				esc_html__('Numbers', 'uncode-core') => 'numbers',
			) ,
			'dependency' => array(
				'element' => 'hide_dots',
				'is_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Style", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_look",
			"description" => esc_html__("Set the style for the Dots component.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Shadow', 'uncode-core') => 'shadow',
				esc_html__('Raw', 'uncode-core') => 'raw',
				esc_html__('Border', 'uncode-core') => 'border',
			) ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('', 'lines')
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Width", 'uncode-core') ,
			"param_name" => "dot_single_width",
			"description" => esc_html__("Set the width of the individual Dot.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_dots',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Dot Number Align", 'uncode-core') ,
			"param_name" => "dot_number_align",
			"description" => esc_html__("Set the alignment of the Dot Number.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('numbers')
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Active Width", 'uncode-core') ,
			"param_name" => "dot_single_active",
			"description" => esc_html__("Set the width of the active Dot.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('', 'lines'),
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Height", 'uncode-core') ,
			"param_name" => "dot_single_height",
			"description" => esc_html__("Set the height of the individual Dot.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('lines'),
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Space", 'uncode-core') ,
			"param_name" => "dot_single_space",
			"description" => esc_html__("Set the spacing between the various Dots.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_dots',
				'is_empty' => true,
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('single')
			// ) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Radius", 'uncode-core') ,
			"param_name" => "dot_single_radius",
			"description" => esc_html__("Set the radius of the individual Dot.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('', 'lines'),
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('single')
			// ) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Dot Boundary", 'uncode-core') ,
			"param_name" => "dot_single_boundary",
			"description" => esc_html__("Set the boundary of the individual Dot.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_look',
				'value' => array('shadow', 'border'),
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('single')
			// ) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Double digits", 'uncode-core') ,
			"param_name" => "digits",
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"description" => esc_html__("Activate the Double Digits for the Dot Number.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_style',
				'value' => array('numbers'),
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dots On Hover", 'uncode-core') ,
			"param_name" => "dots_hover",
			"description" => esc_html__("Activate this to animate the component on hover. PS. The animation is disabled on the Frontend Editor.", 'uncode-core') ,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'not_empty' => true,
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"heading" => esc_html__("Hover animation", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_animation",
			"description" => esc_html__("Specify the entrance animation of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Opacity', 'uncode-core') => '',
				esc_html__('Top to bottom', 'uncode-core') => 'top-t-bottom',
				esc_html__('Bottom to top', 'uncode-core') => 'bottom-t-top',
				esc_html__('Left to right', 'uncode-core') => 'left-t-right',
				esc_html__('Right to left', 'uncode-core') => 'right-t-left',
			) ,
			'dependency' => array(
				'element' => 'dots_hover',
				'not_empty' => true,
			) ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"heading" => esc_html__("Dots order", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "dots_order",
			"description" => esc_html__("Set the Dots component order.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('1', 'uncode-core') => '1',
				esc_html__('2', 'uncode-core') => '2',
				esc_html__('3', 'uncode-core') => '3',
				esc_html__('4', 'uncode-core') => '4',
			) ,
			'std' => '',
			'group' => esc_html__('Dots', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dots_position',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Responsive", 'uncode-core') ,
			"param_name" => "dots_visibility",
			"description" => esc_html__("Activate the Responsive visibility options.", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'hide_dots',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "dots_desktop_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'dots_visibility',
				'not_empty' => true,
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "dots_medium_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'dots_visibility',
				'not_empty' => true,
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "dots_mobile_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Dots', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'dots_visibility',
				'not_empty' => true,
			) ,
			// "tab" => array(
			// 	'element' => "dots_settings",
			// 	'value' => array('general')
			// ) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Hide Counter", 'uncode-core') ,
			"param_name" => "hide_counter",
			"description" => esc_html__("Hide the component.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'admin_label' => true,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			"heading" => esc_html__("Skin", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_skin",
			"description" => esc_html__("Specify the Skin coloration of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Group', 'uncode-core') => '',
				esc_html__('Inherit', 'uncode-core') => 'inherit',
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Position", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_position",
			"edit_field_class" => "owl-nav-position-sel",
			"description" => esc_html__("Set the positioning of the module with respect to the layout flow.", 'uncode-core') ,
			"value" => array(
				esc_html__('Relative', 'uncode-core') => '',
				esc_html__('Absolute', 'uncode-core') => 'el_absolute',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_counter',
				'is_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Width", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_width",
			"description" => esc_html__("Set the positioning of the component with respect to the width.", 'uncode-core') ,
			"value" => array(
				esc_html__('Limit Width', 'uncode-core') => '',
				esc_html__('Window Width', 'uncode-core') => 'window',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Vertical Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_v_align",
			"description" => esc_html__("Set the vertical alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Bottom', 'uncode-core') => '',
				esc_html__('Top', 'uncode-core') => 'top',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Extra Vertical Space", 'uncode-core') ,
			"param_name" => "counter_space",
			"description" => esc_html__("Activate this to add extra top space.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Alignment", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_h_align",
			"description" => esc_html__("Set the Horizontal Alignment of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Horizontal Padding", 'uncode-core') ,
			"param_name" => "counter_padding",
			"description" => esc_html__("Set the horizontal padding.", 'uncode-core') ,
			"edit_field_class" => "h_dot_padding",
			"type" => "type_numeric_slider",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Total Visibility", 'uncode-core') ,
			"param_name" => "hide_counter_total",
			"description" => esc_html__("Set the Counter component Total Visibility.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => array(
				esc_html__('Visible', 'uncode-core') => '',
				esc_html__('Half opacity', 'uncode-core') => 'opacity',
				esc_html__('Hidden', 'uncode-core') => 'yes',
			) ,
			'dependency' => array(
				'element' => 'hide_counter',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Min Width", 'uncode-core') ,
			"param_name" => "counter_index_width",
			"description" => esc_html__("Set the minimum width.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_counter_total',
				'value' => array('', 'opacity'),
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Double digits", 'uncode-core') ,
			"param_name" => "counter_digits",
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"description" => esc_html__("Activate the Double Digits of the Counter.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_counter',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Counter Separator", 'uncode-core') ,
			"param_name" => "counter_sep",
			"description" => esc_html__("Set a custom Counter separator.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'hide_counter_total',
				'value' => array('', 'opacity'),
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Counter On Hover", 'uncode-core') ,
			"param_name" => "counter_hover",
			"description" => esc_html__("Activate this to animate the component on hover. PS. The animation is disabled on the Frontend Editor.", 'uncode-core') ,
			"value" => Array(
				esc_html__("True", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Hover animation", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_animation",
			"description" => esc_html__("Specify the entrance animation of the component.", 'uncode-core') ,
			"value" => array(
				esc_html__('Opacity', 'uncode-core') => '',
				esc_html__('Top to bottom', 'uncode-core') => 'top-t-bottom',
				esc_html__('Bottom to top', 'uncode-core') => 'bottom-t-top',
				esc_html__('Left to right', 'uncode-core') => 'left-t-right',
				esc_html__('Right to left', 'uncode-core') => 'right-t-left',
			) ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_hover',
				'not_empty' => true,
			) ,
		) ,
		array(
			"heading" => esc_html__("Counter order", 'uncode-core') ,
			"type" => "dropdown",
			"param_name" => "counter_order",
			"description" => esc_html__("Set the Counter order.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('1', 'uncode-core') => '1',
				esc_html__('2', 'uncode-core') => '2',
				esc_html__('3', 'uncode-core') => '3',
				esc_html__('4', 'uncode-core') => '4',
			) ,
			'std' => '',
			'group' => esc_html__('Counter', 'uncode-core') ,
			'dependency' => array(
				'element' => 'counter_position',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Responsive", 'uncode-core') ,
			"param_name" => "counter_visibility",
			"description" => esc_html__("Activate the Responsive visibility options.", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'hide_counter',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "counter_desktop_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'counter_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "counter_medium_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'counter_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "counter_mobile_visibility",
			"edit_field_class" => "device_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Counter', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'counter_visibility',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font family", 'uncode-core') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify the font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("Typography", 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify heading size.", 'uncode-core') ,
			'std' => '',
			"value" => $owl_nav_font_size,
			"group" => esc_html__("Typography", 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom font size', 'uncode-core') ,
			'param_name' => 'heading_custom_size',
			'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
			"group" => esc_html__("Typography", 'uncode-core') ,
			'dependency' => array(
				'element' => 'text_size',
				'value' => array('custom'),
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font weight", 'uncode-core') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify font weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			"group" => esc_html__("Typography", 'uncode-core'),
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Letter spacing", 'uncode-core') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify the letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			"group" => esc_html__("Typography", 'uncode-core')
		) ,		
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
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
	)
) );
