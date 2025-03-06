<?php
/**
 * VC Column config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$back_color_options = uncode_core_vc_params_get_advanced_color_options( 'back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Style", 'uncode-core'), $uncode_colors );
list( $add_back_color_type, $add_back_color, $add_back_color_solid, $add_back_color_gradient ) = $back_color_options;

$overlay_color_options = uncode_core_vc_params_get_advanced_color_options( 'overlay_color', esc_html__("Overlay color", 'uncode-core'), esc_html__("Specify an overlay color for the background.", 'uncode-core'), esc_html__("Style", 'uncode-core'), $uncode_colors );
list( $add_overlay_color_type, $add_overlay_color, $add_overlay_color_solid, $add_overlay_color_gradient ) = $overlay_color_options;

$overlay_animated_1_options = uncode_core_vc_params_get_advanced_color_options( 'overlay_animated_1_color', esc_html__("Overlay Animated Color 1", 'uncode-core'), esc_html__("Specify the first Overlay Animated Color.", 'uncode-core'), esc_html__("Style", 'uncode-core'), $flat_uncode_colors_w_accent, array( 'flat' => true, 'dependency' => array( 'element' => 'overlay_animated', 'not_empty' => true ) ) );
list( $add_overlay_animated_1_type, $add_overlay_animated_1, $add_overlay_animated_1_solid ) = $overlay_animated_1_options;

$overlay_animated_2_options = uncode_core_vc_params_get_advanced_color_options( 'overlay_animated_2_color', esc_html__("Overlay Animated Color 2", 'uncode-core'), esc_html__("Specify the second Overlay Animated Color.", 'uncode-core'), esc_html__("Style", 'uncode-core'), $flat_uncode_colors_w_accent, array( 'flat' => true, 'dependency' => array( 'element' => 'overlay_animated', 'not_empty' => true ) ) );
list( $add_overlay_animated_2_type, $add_overlay_animated_2, $add_overlay_animated_2_solid ) = $overlay_animated_2_options;

$border_color_options = uncode_core_vc_params_get_advanced_color_options( 'border_color', esc_html__("Border color", 'uncode-core'), esc_html__("Specify a border color.", 'uncode-core'), esc_html__("Custom", 'uncode-core'), $flat_uncode_colors_w_transp, array( 'flat' => true ) );
list( $add_border_color_type, $add_border_color, $add_border_color_solid ) = $border_color_options;

$add_column_css_animation = uncode_core_vc_params_get_css_animation();

vc_map(array(
	"name" => esc_html__("Column", 'uncode-core') ,
	"base" => "vc_column",
	"is_container" => true,
	"content_element" => false,
	"params" => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
			'group' => esc_html__('Aspect', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Content Width", 'uncode-core') ,
			"param_name" => "column_width_use_pixel",
			"edit_field_class" => 'vc_column row_height',
			"description" => 'Set this value if you want to constrain the column width.',
			"group" => esc_html__("Aspect", 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Content Width Value", 'uncode-core') ,
			"param_name" => "column_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Set the column width with a percent value.", 'uncode-core') ,
			"group" => esc_html__("Aspect", 'uncode-core') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Content Width Value", 'uncode-core') ,
			'param_name' => 'column_width_pixel',
			'description' => esc_html__("Insert the column width in pixel.", 'uncode-core') ,
			"group" => esc_html__("Aspect", 'uncode-core') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'value' => 'yes'
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Horizontal position", 'uncode-core') ,
			"param_name" => "position_horizontal",
			"description" => esc_html__("Specify the horizontal position of the content if you have decreased the width value.", 'uncode-core') ,
			"std" => 'center',
			"value" => array(
				'Left' => 'left',
				'Center' => 'center',
				'Right' => 'right'
			) ,
			'group' => esc_html__('Aspect', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Vertical position", 'uncode-core') ,
			"param_name" => "position_vertical",
			"description" => esc_html__("Specify the vertical position of the content.", 'uncode-core') ,
			"value" => array(
				'Top' => 'top',
				'Middle' => 'middle',
				'Bottom' => 'bottom',
				'Justify' => 'justify'
			) ,
			'group' => esc_html__('Aspect', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text alignment", 'uncode-core') ,
			"param_name" => "align_horizontal",
			"description" => esc_html__("Specify the alignment inside the content box.", 'uncode-core') ,
			"value" => array(
				'Left' => 'align_left',
				'Center' => 'align_center',
				'Right' => 'align_right',
			) ,
			'group' => esc_html__('Aspect', 'uncode-core')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Inner Vertical Spacing", 'uncode-core') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 6,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the vertical rhythm between elements.", 'uncode-core') ,
			'group' => esc_html__('Aspect', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Custom padding", 'uncode-core') ,
			"param_name" => "override_padding",
			"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
			"group" => esc_html__("Aspect", 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom padding value", 'uncode-core') ,
			"param_name" => "column_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the column padding.", 'uncode-core') ,
			"group" => esc_html__("Aspect", 'uncode-core') ,
			"dependency" => array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Extend height", 'uncode-core') ,
			"param_name" => "expand_height",
			"description" => esc_html__("Activate this to expand the height of the column to 100% when you have fluid content such as Maps. If you need to create equal height columns do not use this option but use the Rows > Columns > Columns Equal Height.", 'uncode-core') ,
			'group' => esc_html__('Aspect', 'uncode-core') ,
			"dependency" => array(
				'element' => "position_vertical",
				'value' => array(
					'top', 'middle', 'bottom'
				)
			) ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Skin", 'uncode-core') ,
			"param_name" => "style",
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark'
			) ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font Family", 'uncode-core') ,
			"param_name" => "font_family",
			"description" => esc_html__("Specify the column font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Style', 'uncode-core') ,
		) ,
		$add_back_color_type,
		$add_back_color,
		$add_back_color_solid,
		$add_back_color_gradient,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Background Media", 'uncode-core') ,
			"param_name" => "back_image",
			"value" => "",
			"description" => esc_html__("Specify a media from the Media Library.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Background Multiple", 'uncode-core') ,
			"param_name" => "multiple_media",
			"description" => esc_html__("Activate the Background Multiple option.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode-core') ,
			'dependency' => array(
				'element' => "back_image",
				'not_empty' => true
			)
		),
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Additional Background Media', 'uncode-core') ,
			'param_name' => 'medias',
			'value' => '',
			'description' => esc_html__('Specify additional Backgrounds from the Media Library.', 'uncode-core') ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			'dependency' => array(
				'element' => "multiple_media",
				'not_empty' => true
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dynamic Background", 'uncode-core') ,
			"param_name" => "back_image_auto",
			"description" => esc_html__("Enable the Dynamic Background.", 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode-core') ,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Dynamic media", 'uncode-core') ,
			"param_name" => "back_image_option",
			"description" => esc_html__("Set the source for the Dynamic Background.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core'),
			"value" => array(
				esc_html__('Featured Image', 'uncode-core') => '',
				esc_html__('Secondary Featured Image', 'uncode-core') => 'secondary',
			) ,
			"dependency" => array(
				'element' => "back_image_auto",
				'not_empty' => true
			) ,
		) ,
		$add_background_repeat,
		$add_background_attachment,
		$add_background_position,
		$add_background_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax", 'uncode-core') ,
			"param_name" => "parallax",
			"description" => esc_html__("Activate the Parallax effect. NB. Not available with Slides Scroll.", 'uncode-core') ,
			"value" => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"dependency" => array(
				'element' => "back_image",
				'not_empty' => true
			) ,
			"group" => esc_html__("Style", 'uncode-core')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Zoom effect", 'uncode-core') ,
			"param_name" => "kburns",
			"description" => esc_html__("Activate the Zoom effect you prefer.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core'),
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Ken Burns', 'uncode-core') => 'yes',
				esc_html__('Zoom Out', 'uncode-core') => 'zoom',
				esc_html__('Magnetic', 'uncode-core') => 'magnetic'
			) ,
			"dependency" => array(
				'element' => "back_image",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "dropdown",
			'heading' => esc_html__('Method', 'uncode-core') ,
			'param_name' => 'bg_transition',
			"value" => array(
				esc_html__('Slideshow', 'uncode-core') => '',
				esc_html__('Scroll', 'uncode-core') => 'scroll',
				esc_html__('Mouse', 'uncode-core') => 'mouse',
			) ,
			'description' => esc_html__('Specify a method that triggers the change of Backgrounds.', 'uncode-core') ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			'dependency' => array(
				'element' => "medias",
				'not_empty' => true
			)
		) ,
		array(
			"type" => "uncode_numeric_textfield",
			"heading" => esc_html__("Transition", 'uncode-core') ,
			'param_name' => 'bg_transition_time',
			"std" => 250,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"description" => esc_html__("Specify a transition time in milliseconds.", 'uncode-core') ,
			'dependency' => array(
				'element' => "medias",
				'not_empty' => true
			)
		) ,
		array(
			"type" => "uncode_numeric_textfield",
			"heading" => esc_html__("Interval", 'uncode-core') ,
			'param_name' => 'bg_carousel_time',
			"std" => 5000,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"description" => esc_html__("Specify an interval time in milliseconds.", 'uncode-core') ,
			'dependency' => array(
				'element' => "bg_transition",
				'is_empty' => true
			)
		) ,
		array(
			"type" => "textfield",
			"heading" => esc_html__("Distance", 'uncode-core') ,
			'param_name' => 'bg_transition_pace_mouse',
			"std" => 200,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"description" => esc_html__("Specify a distance in pixels at which the change of Backgrounds occurs.", 'uncode-core') ,
			'dependency' => array(
				'element' => "bg_transition",
				'value' => array('mouse')
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Manual Tempo", 'uncode-core') ,
			"param_name" => "multi_scroll_manually",
			"description" => esc_html__("Specify the change of Background according to a manual Tempo.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"dependency" => array(
				'element' => "bg_transition",
				'value' => array('scroll')
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Tempo", 'uncode-core') ,
			'param_name' => 'bg_transition_pace',
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 20,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"description" => esc_html__("Specify the rate at which the change of Backgrounds occurs.", 'uncode-core') ,
			'dependency' => array(
				'element' => "multi_scroll_manually",
				'not_empty' => true
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Threshold", 'uncode-core') ,
			"param_name" => "bg_transition_threshold",
			"min" => 0,
			"max" => 50,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Specify a tolerance threshold that determines when the background change is triggered. For instance, setting it to '0' means the change will start as soon as the element enters the viewport. If set to '50', the change will occur when the element reaches 50% of the viewport.", 'uncode-core') ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			'dependency' => array(
				'element' => "bg_transition",
				'value' => array('', 'scroll')
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Random", 'uncode-core') ,
			"param_name" => "multi_random",
			"description" => esc_html__("Activate the random order.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"dependency" => array(
				'element' => "medias",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile Slideshow", 'uncode-core') ,
			"param_name" => "mobile_slideshow",
			"description" => esc_html__("Activate the Mobile Slideshow.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			'dependency' => array(
				'element' => "bg_transition",
				'value' => array('mouse')
			)
		) ,
		array(
			"type" => "uncode_numeric_textfield",
			"heading" => esc_html__("Mobile Slideshow Interval", 'uncode-core') ,
			'param_name' => 'bg_carousel_time_mobile',
			"std" => 5000,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"description" => esc_html__("Specify an interval time in milliseconds.", 'uncode-core') ,
			"dependency" => array(
				'element' => "mobile_slideshow",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Mobile Threshold", 'uncode-core') ,
			"param_name" => "bg_transition_threshold_mobile",
			"min" => 0,
			"max" => 50,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Specify a tolerance threshold that determines when the background change is triggered.", 'uncode-core') ,
			"group" => esc_html__("Backgrounds", 'uncode-core') ,
			"dependency" => array(
				'element' => "mobile_slideshow",
				'not_empty' => true
			) ,
		) ,
		$add_overlay_color_type,
		$add_overlay_color,
		$add_overlay_color_solid,
		$add_overlay_color_gradient,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Overlay Opacity", 'uncode-core') ,
			"param_name" => "overlay_alpha",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the transparency for the overlay.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay Blend Mode", 'uncode-core') ,
			"param_name" => "overlay_color_blend",
			"description" => esc_html__("Specify a Blend Mode.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Multiply', 'uncode-core') => 'multiply',
				esc_html__('Screen', 'uncode-core') => 'screen',
				esc_html__('Overlay', 'uncode-core') => 'overlay',
				esc_html__('Darken', 'uncode-core') => 'darken',
				esc_html__('Lighten', 'uncode-core') => 'lighten',
				esc_html__('Color dodge', 'uncode-core') => 'color-dodge',
				esc_html__('Color burn', 'uncode-core') => 'color-burn',
				esc_html__('Hard light', 'uncode-core') => 'hard-light',
				esc_html__('Soft light', 'uncode-core') => 'soft-light',
				esc_html__('Difference', 'uncode-core') => 'difference',
				esc_html__('Exclusion', 'uncode-core') => 'exclusion',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Overlay Animated", 'uncode-core') ,
			"param_name" => "overlay_animated",
			"description" => esc_html__("Activate the animated overlay.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode-core') ,
		) ,
		$add_overlay_animated_1_type,
		$add_overlay_animated_1,
		$add_overlay_animated_1_solid,
		$add_overlay_animated_2_type,
		$add_overlay_animated_2,
		$add_overlay_animated_2_solid,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay Animated Speed", 'uncode-core') ,
			"param_name" => "overlay_animated_speed",
			"description" => esc_html__("Specify the Overlay Animated Speed.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Slow', 'uncode-core') => '1500',
				esc_html__('Fast', 'uncode-core') => '100',
			) ,
			'dependency' => array(
				'element' => 'overlay_animated',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay Animated Size", 'uncode-core') ,
			"param_name" => "overlay_animated_size",
			"description" => esc_html__("Specify the Overlay Animated Size.", 'uncode-core') ,
			"group" => esc_html__("Style", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => '1.2',
				esc_html__('Extra Small', 'uncode-core') => '1.75',
				esc_html__('Large', 'uncode-core') => '0.7',
				esc_html__('Extra Large', 'uncode-core') => '0.35',
			) ,
			'dependency' => array(
				'element' => 'overlay_animated',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border radius", 'uncode-core') ,
			"param_name" => "radius",
			"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Extra Small', 'uncode-core') => 'xs',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
				esc_html__('Huge', 'uncode-core') => 'hg',
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Shadow", 'uncode-core') ,
			"param_name" => "shadow",
			"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Extra Small', 'uncode-core') => 'xs',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shadow Darker", 'uncode-core') ,
			"param_name" => "shadow_darker",
			"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
			"value" => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode-core') ,
			'dependency' => array(
				'element' => 'shadow',
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "css_editor",
			"heading" => esc_html__('CSS', 'uncode-core') ,
			"description" => esc_html__("NB. This could be not compatible on some browsers with the Border Radius and Shadow options.", 'uncode-core') ,
			"param_name" => "css",
			"group" => esc_html__('Custom', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Lateral border mobile", 'uncode-core') ,
			"param_name" => "preserve_border",
			"description" => esc_html__("By default, columns are stack on mobile, and lateral borders are hidden. Use this option to preserve custom lateral Borders on mobile.", 'uncode-core') ,
			'group' => esc_html__('Custom', 'uncode-core'),
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "preserve_border_tablet",
			"description" => esc_html__("Use this option to preserve lateral borders on tablet.", 'uncode-core') ,
			'group' => esc_html__('Custom', 'uncode-core'),
			"value" => array(
				'' => 'yes'
			) ,
			"dependency" => array(
				'element' => "preserve_border",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "preserve_border_mobile",
			"description" => esc_html__("Use this option to preserve lateral borders on Mobile.", 'uncode-core') ,
			'group' => esc_html__('Custom', 'uncode-core'),
			"value" => array(
				'' => 'yes'
			) ,
			"dependency" => array(
				'element' => "preserve_border",
				'not_empty' => true
			) ,
		) ,
		$add_border_color_type,
		$add_border_color,
		$add_border_color_solid,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode-core') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode-core') ,
			"group" => esc_html__("Custom", 'uncode-core') ,
			"value" => $border_style,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift x-axis", 'uncode-core') ,
			"param_name" => "shift_x",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the X axis.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift x-axis fixed", 'uncode-core') ,
			"param_name" => "shift_x_fixed",
			"description" => esc_html__("Deactive shift-x responsiveness.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode-core') ,
			"param_name" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis. This works on the margin-top property.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis fixed", 'uncode-core') ,
			"param_name" => "shift_y_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis downward", 'uncode-core') ,
			"param_name" => "shift_y_down",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to move toward the element below. This works on the margin-bottom property.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis downward fixed", 'uncode-core') ,
			"param_name" => "shift_y_down_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode-core') ,
			'group' => esc_html__('Off-grid', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
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
			'group' => esc_html__('Off-grid', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"heading" => esc_html__("Tablet text alignment", 'uncode-core') ,
			"type" => 'dropdown',
			"param_name" => "align_medium",
			"description" => esc_html__("Specify the text alignment inside the content box in tablet layout mode.", 'uncode-core') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_tablet',
				'Center' => 'align_center_tablet',
				'Right' => 'align_right_tablet',
			) ,
			'group' => esc_html__('Responsive', 'uncode-core')
		) ,
		array(
			"heading" => esc_html__("Tablet column width", 'uncode-core') ,
			"type" => "type_numeric_slider",
			"param_name" => "medium_width",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("NB. If you change this value for one column you must specify a value for every column of the row.", 'uncode-core') ,
			"group" => esc_html__("Responsive", 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"heading" => esc_html__("Mobile text alignment", 'uncode-core') ,
			"type" => 'dropdown',
			"param_name" => "align_mobile",
			"description" => esc_html__("Specify the text alignment inside the content box in mobile layout mode.", 'uncode-core') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_mobile',
				'Center' => 'align_center_mobile',
				'Right' => 'align_right_mobile',
			) ,
			'group' => esc_html__('Responsive', 'uncode-core')
		) ,
		array(
			"heading" => esc_html__("Mobile column width", 'uncode-core') ,
			"type" => "type_numeric_slider",
			"param_name" => "mobile_width",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("NB. If you change this value for one column you must specify a value for every column of the row.", 'uncode-core') ,
			"group" => esc_html__("Responsive", 'uncode-core')
		) ,
		array(
			"heading" => esc_html__("Mobile minimum height", 'uncode-core') ,
			"type" => "textfield",
			"param_name" => "mobile_height",
			"description" => esc_html__("Enter the mobile minimum height. Ex: 140px, 50vh, etc.", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core')
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Parallax", 'uncode-core') ,
			"param_name" => 'parallax_intensity',
			"description" => esc_html__("Specify the Parallax intensity. NB. If you select a Parallax animation for the Column, please be careful not to use animation effects on inner Elements because the Animation will not be recognized and instantiated correctly. In other words, a Column with the Parallax effect cannot contain Modules with entrance Animations. Please also note that Parallax is not available with Slides Scroll and, for performance reasons, it is disabled when working with the Frontend Editor.", 'uncode-core') ,
			'group' => esc_html__('Animation', 'uncode-core'),
			'value' => array(
				esc_html__('No', 'uncode-core') => '',
				esc_html__('10%', 'uncode-core') => 1,
				esc_html__('20%', 'uncode-core') => 2,
				esc_html__('30%', 'uncode-core') => 3,
				esc_html__('40%', 'uncode-core') => 4,
				esc_html__('50%', 'uncode-core') => 5,
				esc_html__('60%', 'uncode-core') => 6,
				esc_html__('70%', 'uncode-core') => 7,
				esc_html__('80%', 'uncode-core') => 8,
				esc_html__('90%', 'uncode-core') => 9,
				esc_html__('100%', 'uncode-core') => 10
			) ,
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax in Header", 'uncode-core') ,
			"param_name" => "parallax_centered",
			"description" => esc_html__("This option is recommended for elements that are in the Header, visible before you start scrolling the page.", 'uncode-core') ,
			"value" => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Animation", 'uncode-core'),
			"dependency" => array(
				'element' => "parallax_intensity",
				'not_empty' => true
			) ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Custom link *', 'uncode-core') ,
			'param_name' => 'link_to',
			'description' => esc_html__('Enter a custom link for the column. NB. For performance reasons, this option is disabled while working with the Frontend Editor.', 'uncode-core') ,
			'group' => esc_html__('Extra', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode-core') ,
			"param_name" => "sticky",
			"description" => esc_html__("Activate this to stick the element when scrolling. NB. It doesn't work on mobile and it's not compatible with the Columns Equal Height and Off-Grid options.", 'uncode-core') ,
			'group' => esc_html__('Extra', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Skew", 'uncode-core') ,
			"param_name" => "skew",
			"description" => esc_html__("Apply the Skew effect at the page scroll. NB. For performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
			"value" => array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Extra", 'uncode-core'),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Expand Toggle", 'uncode-core') ,
			"param_name" => "toggle",
			"description" => esc_html__("Activate the 'Expand Toggle' option. NB. It does not work with Column Vertical Position set to Justify setting.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Extra", 'uncode-core'),
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class", 'uncode-core') ,
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", 'uncode-core') ,
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
		array(
			"heading" => esc_html__("Max height", 'uncode-core') ,
			"type" => "textfield",
			"value" => 200,
			"param_name" => "max_height",
			"description" => esc_html__("Specify the max height of the of the toggled Column. Ex: 20vh, 100px, etc.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"heading" => esc_html__("Max height mobile", 'uncode-core') ,
			"type" => "textfield",
			"value" => '',
			"param_name" => "max_height_mobile",
			"description" => esc_html__("Specify the max height of the of the toggled Column on mobile. Ex: 20vh, 100px, etc.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "max_height",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "uncode_inner_tabs",
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			"heading" => esc_html__("Buttons state", 'uncode-core') ,
			"param_name" => "toggle_buttons",
			"description" => "",
			"group" => esc_html__("Toggle", 'uncode-core'),
			"tabs" => array(
				esc_html__('Closed', 'uncode-core') => 'closed',
				esc_html__('Open', 'uncode-core') => 'open',
			),
		) ,
		array(
			"heading" => esc_html__("Toggle text (closed state)", 'uncode-core') ,
			"type" => "textfield",
			"param_name" => "closed_txt",
			"description" => esc_html__("Specify the text for the button that will open the Toggle.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => esc_html__("Open", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'closed',
				)
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon (closed state)', 'uncode-core') ,
			'param_name' => 'icon_closed',
			'description' => esc_html__('Specify an optional icon for the button that will open the Toggle.', 'uncode-core') ,
			'value' => '',
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'closed',
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Button margin (closed state)", 'uncode-core') ,
			"param_name" => "btn_margin",
			"description" => esc_html__("Specify the margin top for the button that will open the Toggle.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
			) ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'closed',
				)
			) ,
		) ,
		array(
			"heading" => esc_html__("Toggle text (open state)", 'uncode-core') ,
			"type" => "textfield",
			"value" => esc_html__("Close", 'uncode-core') ,
			"param_name" => "open_txt",
			"description" => esc_html__("Specify the text for the button that will close the Toggle.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'open',
				)
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon (open state)', 'uncode-core') ,
			'param_name' => 'icon_open',
			'description' => esc_html__('Specify an optional icon for the button that will close the Toggle.', 'uncode-core') ,
			'value' => '',
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'open',
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Button margin (open state)", 'uncode-core') ,
			"param_name" => "btn_margin_open",
			"description" => esc_html__("Specify the margin top for the button that will close the Toggle.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('None', 'uncode-core') => 'no',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
			) ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
			"tab" => array(
				'element' => "toggle_buttons",
				'value' => array(
					'open',
				)
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon position", 'uncode-core') ,
			"param_name" => "icon_position",
			"description" => esc_html__("Specify the position of the icon.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => array(
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Fade", 'uncode-core') ,
			"param_name" => "fade",
			"description" => esc_html__("Specify a fade effect on the Column content.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Large', 'uncode-core') => 'lg',
			) ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Button align", 'uncode-core') ,
			"param_name" => "btn_align",
			"description" => esc_html__("Specify the Button alignment.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Scroll Back To Row", 'uncode-core') ,
			"param_name" => "toggle_scroll",
			"description" => esc_html__("Specifies that the moment you close the Toggle it should scroll to the container Row.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Desktop", 'uncode-core') ,
			"param_name" => "toggle_navbar",
			"description" => esc_html__("Consider the Navbar on Desktop at the moment you close the Toggle and you Scroll Back to Row.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'toggle_scroll',
				'not_empty' => true
			) ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Mobile", 'uncode-core') ,
			"param_name" => "toggle_navbar_mobile",
			"description" => esc_html__("Consider the Navbar on Mobile at the moment you close the Toggle and you Scroll Back to Row.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'toggle_scroll',
				'not_empty' => true
			) ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Trigger resize event", 'uncode-core') ,
			"param_name" => "trigger_resize",
			"description" => esc_html__("Use this setting for special circumstances, such as when the page or columns contain other modules that require a Resize event to function properly.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
		array(
			"heading" => "Toggle Button Extra Class",
			"type" => "textfield",
			"param_name" => "toggle_classes",
			"description" => esc_html__("Enter possible extra classes that allow you to modify the Toggle Button. Ex: 'btn btn-accent btn-lg btn-custom-typo font-359101 font-weight-700'.", 'uncode-core') ,
			"group" => esc_html__("Toggle", 'uncode-core') ,
			"dependency" => array(
				'element' => "toggle",
				'not_empty' => true
			) ,
		) ,
	) ,
	"js_view" => 'UncodeColumnView'
));
