<?php
/**
 * VC Single Media config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$adv_dep = 	array(
	'element' => 'advanced',
	'value' => 'yes'
);

$add_text_size = uncode_core_vc_params_get_text_size( 'text_lead', false, esc_html__("Advanced", 'uncode-core'), $adv_dep );

$back_color_options = uncode_core_vc_params_get_advanced_color_options( 'media_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the thumbnail.", 'uncode-core'), esc_html__("Advanced", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'advanced', 'value' => 'yes' ) ) );
list( $add_back_color_type, $add_back_color, $add_back_color_solid, $add_back_color_gradient ) = $back_color_options;

$overlay_color_options = uncode_core_vc_params_get_advanced_color_options( 'media_overlay_color', esc_html__("Overlay color", 'uncode-core'), esc_html__("Specify an overlay color for the thumbnail.", 'uncode-core'), esc_html__("Advanced", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'advanced', 'value' => 'yes' ) ) );
list( $add_overlay_color_type, $add_overlay_color, $add_overlay_color_solid, $add_overlay_color_gradient ) = $overlay_color_options;

$add_parallax_options = uncode_core_vc_params_get_parallax_options();
$add_parallax_centered_options = uncode_core_vc_params_get_parallax_centered_options();

$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);

$single_media_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Title', 'uncode-core') ,
		'param_name' => 'title',
		'description' => esc_html__('Enter text which will be used as module title. Leave blank if no title is needed.', 'uncode-core')
	) ,
	array(
		"type" => "media_element",
		"heading" => esc_html__("Media", 'uncode-core') ,
		"param_name" => "media",
		"value" => "",
		"edit_field_class" => 'vc_column uncode_single_media',
		"description" => esc_html__("Specify a media from the Media Library.", 'uncode-core') ,
		"admin_label" => true
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dynamic Media", 'uncode-core') ,
		"param_name" => "dynamic",
		"description" => esc_html__("Activate to display a media from Select Media or Product Gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Dynamic source", 'uncode-core') ,
		"param_name" => "dynamic_source",
		"description" => esc_html__("Set the source for the Dynamic Media.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'dynamic',
			'not_empty' => true,
		) ,
		"value" => array(
			esc_html__('Featured Image', 'uncode-core') => '',
			esc_html__('Secondary Featured Image', 'uncode-core') => 'secondary',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Caption", 'uncode-core') ,
		"param_name" => "caption",
		"description" => 'Activate to have the caption under the image.',
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Lightbox', 'uncode-core') ,
		'param_name' => 'media_lightbox',
		'description' => esc_html__('Activate if you want to open the media in the lightbox.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		)
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Poster', 'uncode-core') ,
		'param_name' => 'media_poster',
		'description' => esc_html__('Activate if you want to view the poster image instead (this is usefull for other media than images with the use of the lightbox).', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		)
	) ,
	array(
		'type' => 'vc_link',
		'heading' => esc_html__('URL (Link)', 'uncode-core') ,
		'param_name' => 'media_link',
		'description' => esc_html__('Enter URL if you want this image to have a link.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_link_large',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Width unit", 'uncode-core') ,
		"param_name" => "media_width_use_pixel",
		"description" => 'Set this value if you want to constrain the media width.',
		"group" => esc_html__("Style", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Width", 'uncode-core') ,
		"param_name" => "media_width_percent",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Set the media width with a percent value.", 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_width_use_pixel',
			'is_empty' => true,
		)
	) ,
	array(
		'type' => 'textfield',
		"heading" => esc_html__("Width", 'uncode-core') ,
		'param_name' => 'media_width_pixel',
		'description' => esc_html__("Insert the media width in pixel.", 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_width_use_pixel',
			'value' => 'yes'
		)
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
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
		'group' => esc_html__('Style', 'uncode-core') ,
		'admin_label' => true,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Alignment', 'uncode-core') ,
		'param_name' => 'alignment',
		'value' => array(
			esc_html__('Align Left', 'uncode-core') => '',
			esc_html__('Align Right', 'uncode-core') => 'right',
			esc_html__('Align Center', 'uncode-core') => 'center'
		) ,
		'description' => esc_html__('Specify image alignment.', 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Shape', 'uncode-core') ,
		'param_name' => 'shape',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Rounded', 'uncode-core') => 'img-round',
			esc_html__('Circular', 'uncode-core') => 'img-circle'
		) ,
		'description' => esc_html__('Specify media shape.', 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
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
		"type" => 'checkbox',
		"heading" => esc_html__("Border", 'uncode-core') ,
		"param_name" => "border",
		"description" => 'Activate to have a border around like a thumbnail.',
		"group" => esc_html__("Style", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow", 'uncode-core') ,
		"param_name" => "shadow",
		"description" => 'Activate this for the shadow effect.',
		"group" => esc_html__("Style", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Shadow type", 'uncode-core') ,
		"param_name" => "shadow_weight",
		"description" => esc_html__("Specify the shadow option preset.", 'uncode-core') ,
		"group" => esc_html__("Style", 'uncode-core') ,
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
		'dependency' => array(
			'element' => 'shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow Darker", 'uncode-core') ,
		"param_name" => "shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
		'dependency' => array(
			'element' => 'shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced preset", 'uncode-core') ,
		"param_name" => "advanced",
		"description" => 'Activate if you want to have advanced options.',
		"group" => esc_html__("Style", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced Video Settings", 'uncode-core') ,
		"param_name" => "advanced_videos",
		"description" => esc_html__("Activate the Videos tab with special options for autoplay videos.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Style', 'uncode-core') ,
	) ,
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Media', 'uncode-core') ,
		'param_name' => 'media_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
		'value' => 'media',
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'caption',
				esc_html__('Caption', 'uncode-core') ,
			) ,
			array(
				'description',
				esc_html__('Description', 'uncode-core') ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'team-social',
				esc_html__('Team socials', 'uncode-core') ,
			) ,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Block layout", 'uncode-core') ,
		"param_name" => "media_text",
		"description" => esc_html__("Specify the text positioning inside the thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Content overlay', 'uncode-core') => 'overlay',
			esc_html__('Content under image', 'uncode-core') => 'under'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "media_style",
		"description" => esc_html__("Specify the Skin inside the content thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	$add_back_color_type,
	$add_back_color,
	$add_back_color_solid,
	$add_back_color_gradient,
	$add_overlay_color_type,
	$add_overlay_color,
	$add_overlay_color_solid,
	$add_overlay_color_gradient,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay coloration", 'uncode-core') ,
		"param_name" => "media_overlay_coloration",
		"description" => wp_kses(__("Specify the coloration style for the overlay.<br />NB. For the gradient you can't customize the overlay color.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => array(
			esc_html__('Fully colored', 'uncode-core') => '',
			esc_html__('Gradient top', 'uncode-core') => 'top_gradient',
			esc_html__('Gradient bottom', 'uncode-core') => 'bottom_gradient',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Overlay Blend Mode", 'uncode-core') ,
		"param_name" => "media_overlay_color_blend",
		"description" => esc_html__("Specify a Blend Mode.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
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
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Overlay Opacity", 'uncode-core') ,
		"param_name" => "media_overlay_opacity",
		"min" => 1,
		"max" => 100,
		"step" => 1,
		"value" => 50,
		"description" => esc_html__("Set the overlay opacity.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay visibility", 'uncode-core') ,
		"param_name" => "media_overlay_visible",
		"description" => esc_html__("Activate this to show the overlay as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay animation", 'uncode-core') ,
		"param_name" => "media_overlay_anim",
		"description" => esc_html__("Activate this to animate the overlay on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text visibility", 'uncode-core') ,
		"param_name" => "media_text_visible",
		"description" => esc_html__("Activate this to show the text as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation", 'uncode-core') ,
		"param_name" => "media_text_anim",
		"description" => esc_html__("Activate this to animate the text on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation type", 'uncode-core') ,
		"param_name" => "media_text_anim_type",
		"description" => esc_html__("Specify the animation type.", 'uncode-core') ,
		"value" => array(
			esc_html__('Opacity', 'uncode-core') => '',
			esc_html__('Bottom to top', 'uncode-core') => 'btt',
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_text_anim',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration", 'uncode-core') ,
		"param_name" => "media_image_coloration",
		"description" => esc_html__("Specify the image coloration mode.", 'uncode-core') ,
		"value" => array(
			esc_html__('Standard', 'uncode-core') => '',
			esc_html__('Desaturated', 'uncode-core') => 'desaturated',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration animation", 'uncode-core') ,
		"param_name" => "media_image_color_anim",
		"description" => esc_html__("Activate this to animate the image coloration on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Static', 'uncode-core') => '',
			esc_html__('Animated', 'uncode-core') => 'yes',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image animation", 'uncode-core') ,
		"param_name" => "media_image_anim",
		"description" => esc_html__("Activate this to animate the image on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Image magnetic", 'uncode') ,
		"param_name" => "media_image_magnetic",
		"description" => esc_html__("Enable this option to enable the magnetic effect and slightly move the image according with the mouse position.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_image_anim',
			'value' => array('yes'),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content alignment", 'uncode-core') ,
		"param_name" => "media_h_align",
		"description" => esc_html__("Specify the horizontal alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content vertical position", 'uncode-core') ,
		"param_name" => "media_v_position",
		"description" => esc_html__("Specify the text vertical position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content dimension reduced", 'uncode-core') ,
		"param_name" => "media_reduced",
		"description" => esc_html__("Specify the text reduction amount to shrink the overlay content dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('100%', 'uncode-core') => '',
			esc_html__('75%', 'uncode-core') => 'three_quarter',
			esc_html__('50%', 'uncode-core') => 'half',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content horizontal position", 'uncode-core') ,
		"param_name" => "media_h_position",
		"description" => esc_html__("Specify the text horizontal position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_reduced',
			'not_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Content Padding", 'uncode-core') ,
		"param_name" => "media_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the text padding", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Reduced Gap", 'uncode-core') ,
		"param_name" => "media_text_reduced",
		"description" => esc_html__("Activate this to have less space between all the text elements inside the thumbnail.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Multiple click areas", 'uncode-core') ,
		"param_name" => "media_elements_click",
		"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when available).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_text',
			'value' => 'overlay',
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title text transform", 'uncode-core') ,
		"param_name" => "media_title_transform",
		"description" => esc_html__("Specify the title text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font family", 'uncode-core') ,
		"param_name" => "media_title_family",
		"description" => esc_html__("Specify the title font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title size", 'uncode-core') ,
		"param_name" => "media_title_dimension",
		"description" => esc_html__("Specify the title dimension.", 'uncode-core') ,
		"value" => $heading_size_h,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom size', 'uncode-core') ,
		'param_name' => 'heading_custom_size',
		'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_title_dimension',
			'value' => array('custom'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font weight", 'uncode-core') ,
		"param_name" => "media_title_weight",
		"description" => esc_html__("Specify the title font weight.", 'uncode-core') ,
		"value" =>$heading_weight,
		'std' => '',
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title line height", 'uncode-core') ,
		"param_name" => "media_title_height",
		"description" => esc_html__("Specify the title line height.", 'uncode-core') ,
		"value" => $heading_height,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title letter spacing", 'uncode-core') ,
		"param_name" => "media_title_space",
		"description" => esc_html__("Specify the title letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Title Custom Text', 'uncode-core') ,
		"param_name" => "media_title_custom",
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'description' => esc_html__('Type a custom title.', 'uncode-core'),
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Description Custom Text', 'uncode-core') ,
		"param_name" => "media_subtitle_custom",
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'description' => esc_html__('Type a custom description.', 'uncode-core'),
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Caption Custom Text', 'uncode-core') ,
		"param_name" => "media_caption_custom",
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'description' => esc_html__('Type a custom caption.', 'uncode-core'),
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	$add_text_size,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Meta typography', 'uncode-core') ,
		'param_name' => 'media_meta_custom_typo',
		'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font size", 'uncode-core') ,
		"param_name" => "media_meta_size",
		"description" => esc_html__("Specify the meta dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('Small', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'default',
			esc_html__('Large', 'uncode-core') => 'large',
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font weight", 'uncode-core') ,
		"param_name" => "media_meta_weight",
		"description" => esc_html__("Specify the meta font weight.", 'uncode-core') ,
		"value" =>$heading_weight,
		"std" => '',
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta text transform", 'uncode-core') ,
		"param_name" => "media_meta_transform",
		"description" => esc_html__("Specify the meta text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Advanced", 'uncode-core') ,
		'dependency' => array(
			'element' => 'media_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'uncode-core') ,
		'param_name' => 'media_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'value' => '',
		'settings' => array(
			'emptyIcon' => true,
				// default true, display an "EMPTY" icon?
			'iconsPerPage' => 1100,
				// default 100, how many icons per/page to display
			'type' => 'uncode'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes'
		) ,
		'group' => esc_html__('Advanced', 'uncode-core') ,
	) ,
	$add_css_animation_w_parallax,
	$add_animation_speed,
	$add_animation_delay,
	$add_parallax_options,
	$add_parallax_centered_options,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Rotating", 'uncode-core') ,
		"param_name" => "rotating",
		"description" => esc_html__("Apply a rotating animation to Single Media.", 'uncode-core') ,
		'value' => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Rotate on scroll', 'uncode-core') => 'scroll',
			esc_html__('Rotate constantly', 'uncode-core') => 'always',
			esc_html__('Rotate constantly, speed up on scroll', 'uncode-core') => 'speed',
			esc_html__('Rotate constantly, speed up on hover', 'uncode-core') => 'hover',
		) ,
		'group' => esc_html__('Animation', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop Play Hover", 'uncode-core') ,
		"param_name" => "play_hover",
		"description" => esc_html__("Activate this option to have videos that start on hover when a Poster image is set.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop play last frame", 'uncode-core') ,
		"param_name" => "play_pause",
		"description" => esc_html__("Activate this option to have videos that restart from the last frame played, otherwise they restart from the beginning.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Mobile behavior", 'uncode-core') ,
		"param_name" => "mobile_videos",
		"description" => esc_html__("Set the mobile behavior, it's possible to have autoplay video or replace it with the Poster image (suggested option if you have multiple videos on the same page or if the videos are heavy).", 'uncode-core') ,
		"value" => array(
			esc_html__('Replace with poster', 'uncode-core') => '',
			esc_html__('Autoplay videos', 'uncode-core') => 'autoplay',
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Skin',
		'param_name' => 'lbox_skin',
		'value' => array(
			esc_html__('Dark', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'white',
		) ,
		'description' => esc_html__('Specify the lightbox Skin.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Transparency',
		'param_name' => 'lbox_transparency',
		'value' => array(
			esc_html__('Semi-Transparent', 'uncode-core') => '',
			esc_html__('Opaque', 'uncode-core') => 'opaque',
		) ,
		'description' => esc_html__('Specify the transparency style of the Lightbox background.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows",
		"description" => esc_html__("Specify whether to have navigation Arrows or not.", 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_connected',
			'value' => $lbox_enhance ? 'yes' : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows Background", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows_bg",
		"description" => esc_html__("Specify the background transparency.", 'uncode-core') ,
		"value" => array(
			esc_html__('Transparent', 'uncode-core') => '',
			esc_html__('Semi-Transparent', 'uncode-core') => 'semi-transparent',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_gallery_arrows',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Direction',
		'param_name' => 'lbox_dir',
		'value' => array(
			esc_html__('Horizontal', 'uncode-core') => '',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
		) ,
		'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => !$lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title", 'uncode-core') ,
		"param_name" => "lbox_title",
		"description" => esc_html__("Activate this to add the media title.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Caption", 'uncode-core') ,
		"param_name" => "lbox_caption",
		"description" => esc_html__("Activate this to add the media caption.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Social", 'uncode-core') ,
		"param_name" => "lbox_social",
		"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Deeplinking", 'uncode-core') ,
		"param_name" => "lbox_deep",
		"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,

	array(
		'type' => 'textfield',
		"heading" => esc_html__("Deeplinking ID", 'uncode-core') ,
		"param_name" => "lbox_deep_id",
		'value' => '',
		"description" => esc_html__("Set the unique ID.", 'uncode-core') ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_deep',
			'value' => $lbox_enhance ? 'yes' : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No arrows", 'uncode-core') ,
		"param_name" => "lbox_no_arrows",
		"description" => esc_html__("Activate this for not showing the arrows.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_connected',
			'value' => !$lbox_enhance ? 'yes' : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Actual Size", 'uncode-core') ,
		"param_name" => "lbox_actual_size",
		"description" => esc_html__("Set the magnification to real pixels of the image.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Fullscreen", 'uncode-core') ,
		"param_name" => "lbox_full",
		"description" => esc_html__("Set the fullscreen magnification on the monitor viewport.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Download", 'uncode-core') ,
		"param_name" => "lbox_download",
		"description" => esc_html__("Enable image downloading.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Zoom Origin", 'uncode-core') ,
		"param_name" => "lbox_zoom_origin",
		"description" => esc_html__("Set the zoom effect from the thumbnail, this only works if you are using the image with the original ratio.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Connect to other media", 'uncode-core') ,
		"param_name" => "lbox_connected",
		"description" => esc_html__("Activate this to connect the lightbox with other media in the same page with this option active.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Counter", 'uncode-core') ,
		"param_name" => "lbox_counter",
		"description" => esc_html__("Show the counter with the count of images in the gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_connected',
			'value' => $lbox_enhance ? 'yes' : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No thumbnails", 'uncode-core') ,
		"param_name" => "lbox_no_tmb",
		"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_connected',
			'value' => $lbox_enhance ? 'yes' : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Lightbox Transition", 'uncode-core') ,
		"param_name" => "lbox_transition",
		"description" => esc_html__("Specifies the transition between images. This works if the images have already been preloaded by the plugin script.", 'uncode-core') ,
		"value" => array(
			esc_html__('Slide', 'uncode-core') => '',
			esc_html__('Fade', 'uncode-core') => 'lg-fade',
			esc_html__('Zoom In', 'uncode-core') => 'lg-zoom-in',
			esc_html__('Zoom In Big', 'uncode-core') => 'lg-zoom-in-big',
			esc_html__('Zoom Out', 'uncode-core') => 'lg-zoom-out',
			esc_html__('Zoom Out Big', 'uncode-core') => 'lg-zoom-out-big',
			esc_html__('Zoom Out In', 'uncode-core') => 'lg-zoom-out-in',
			esc_html__('Zoom In Out', 'uncode-core') => 'lg-zoom-in-out',
			esc_html__('Soft Zoom', 'uncode-core') => 'lg-soft-zoom',
			esc_html__('Slide Circular', 'uncode-core') => 'lg-slide-circular',
			esc_html__('Slide Vertical', 'uncode-core') => 'lg-slide-vertical',
			esc_html__('Lollipop', 'uncode-core') => 'lg-lollipop',
			esc_html__('Lollipop Reverse', 'uncode-core') => 'lg-lollipop-rev',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_connected',
			'value' => $lbox_enhance ? 'yes' : 'nothing' ,
		) ,
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
		"type" => 'checkbox',
		"heading" => esc_html__("Remove double tap", 'uncode-core') ,
		"param_name" => "no_double_tap",
		"description" => esc_html__("Remove the double tap action on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'advanced',
			'value' => 'yes',
		) ,
		'group' => esc_html__('Responsive', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Special Cursor", 'uncode-core') ,
		"param_name" => "custom_cursor",
		"description" => esc_html__("Enable this to activate the special curson when you hover over the items.", 'uncode-core') ,
		"value" => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark',
			esc_html__('Accent', 'uncode-core') => 'accent',
			esc_html__('Difference', 'uncode-core') => 'diff',
			esc_html__('Blur', 'uncode-core') => 'blur',
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Special Cursor Tooltip", 'uncode-core') ,
		"param_name" => "cursor_title",
		"description" => esc_html__("Activate the Cursor textual Tooltip.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'custom_cursor',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Thumbnail title", 'uncode-core') ,
		"param_name" => "hide_title_tooltip",
		"description" => esc_html__("Use this option to display the original Title element. When using a Tooltip on desktop, it may be useful to show the original thumbnail title only on mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hide', 'uncode-core') => '',
			esc_html__('Display on mobile', 'uncode-core') => 'mobile',
			esc_html__('Display on desktop', 'uncode-core') => 'desktop',
			esc_html__('Display always', 'uncode-core') => 'always',
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Tooltip Boing", 'uncode-core') ,
		"param_name" => "cursor_title_boing",
		"description" => esc_html__("Activate the Tooltip Boing effect when moving from one element to another.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Transparent Background", 'uncode-core') ,
		"param_name" => "hide_cursor_bg",
		"description" => esc_html__("Activate to remove the Tooltip background.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom Tooltip text', 'uncode-core') ,
		'param_name' => 'custom_tooltip',
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		'description' => esc_html__('Enter a custom text for the Tooltip. Ex: Read More.', 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Extra tooltip class', 'uncode-core') ,
		'param_name' => 'tooltip_class',
		'description' => esc_html__("Enter possible extra classes that allow you to modify the Tooltip style. Ex: 'h2 font-weight-700 font-136269'.", 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Skew", 'uncode-core') ,
		"param_name" => "skew",
		"description" => esc_html__("Apply the Skew effect at the page scroll. NB. For performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
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
		"group" => esc_html__("Extra", 'uncode-core') ,
		'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core')
	)
);

if ( $lbox_enhance ) {
	$uncode_advanced_videos = array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Advanced Videos", 'uncode-core') ,
			"param_name" => "lb_video_advanced",
			"description" => esc_html__("Activate for the advanced video options.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Autoplay videos", 'uncode-core') ,
			"param_name" => "lb_autoplay",
			"description" => esc_html__("Set the autoplay.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Mute videos", 'uncode-core') ,
			"param_name" => "lb_muted",
			"description" => esc_html__("Set the mute option.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
	);

} else {
	$uncode_advanced_videos = array();
}

$single_media_params = array_merge($single_media_params, $uncode_advanced_videos);

vc_map(array(
	'name' => esc_html__('Single Media', 'uncode-core') ,
	'base' => 'vc_single_image',
	'icon' => 'fa fa-image',
	'weight' => 9850,
	'php_class_name' => 'uncode_single_media',
	'js_view' => 'UncodeSingleMedia',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
		esc_html__('Dynamic', 'uncode-core') ,
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('Media image lightbox video audio YouTube Vimeo video featured product Photos', 'uncode-core') ,
	'params' => $single_media_params
));
