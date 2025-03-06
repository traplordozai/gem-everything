<?php
/**
 * VC Heading config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$text_color_options = uncode_core_vc_params_get_advanced_color_options( 'text_color', esc_html__("Heading color", 'uncode-core'), esc_html__("Specify heading color. NB. Please note that this option does not override the link color but applies to the plain text.", 'uncode-core'), esc_html__('General', 'uncode-core'), $uncode_colors, array( 'default_label' => true ) );
list( $add_text_color_type, $add_text_color, $add_text_color_solid, $add_text_color_gradient ) = $text_color_options;

$new_css_animation =  array (
	esc_html__('Lines curtain', 'uncode-core') => 'curtain',
	esc_html__('Words curtain', 'uncode-core') => 'curtain-words',
	esc_html__('Words sliding', 'uncode-core') => 'single-slide',
	esc_html__('Words sliding reverse', 'uncode-core') => 'single-slide-opposite',
	esc_html__('Letters curtain', 'uncode-core') => 'single-curtain',
	esc_html__('Letters typewriter', 'uncode-core') => 'typewriter',
);
$alt_css_animation =  array (
	esc_html__('Parallax', 'uncode-core') => 'parallax',
	esc_html__('Marquee Auto (right to left)', 'uncode-core') => 'marquee',
	esc_html__('Marquee Auto (left to right)', 'uncode-core') => 'marquee-opposite',
	esc_html__('Marquee Scroll (right to left)', 'uncode-core') => 'marquee-scroll',
	esc_html__('Marquee Scroll (left to right)', 'uncode-core') => 'marquee-scroll-opposite',
);
$old_css_animation = $add_column_css_animation;
$old_css_animation = $old_css_animation['value'];
$add_text_css_animation = $add_css_animation;
$add_text_css_animation['value'] = array_merge($old_css_animation, $new_css_animation, $alt_css_animation);
$add_text_css_animation['dependency'] = array( 'element' => 'inline_media', 'is_empty' => true );
$add_text_alt_css_animation = $add_css_animation;
$add_text_alt_css_animation['param_name'] = 'css_alt_animation';
$add_text_alt_css_animation['value'] = array_merge($old_css_animation, $alt_css_animation);
$add_text_alt_css_animation['dependency'] = array( 'element' => 'inline_media', 'not_empty' => true );
$add_alt_animation_speed = $add_animation_speed;
$add_alt_animation_speed['param_name'] = 'css_alt_animation_speed';
$add_alt_animation_speed['dependency']['element'] = 'css_alt_animation';
$add_alt_animation_delay = $add_animation_delay;
$add_alt_animation_delay['param_name'] = 'css_alt_animation_delay';
$add_alt_animation_delay['dependency']['element'] = 'css_alt_animation';

$add_inline_img_css_animation = $add_css_animation;
$add_inline_img_css_animation['group'] = esc_html__('Inline Images', 'uncode-core');
$add_inline_img_css_animation['param_name'] = 'inline_media_anim';
$add_inline_img_css_animation['dependency'] = array( 'element' => 'inline_media', 'not_empty' => true );
$add_inline_img_css_animation_speed = $add_animation_speed;
$add_inline_img_css_animation_speed['group'] = esc_html__('Inline Images', 'uncode-core');
$add_inline_img_css_animation_speed['param_name'] = 'inline_media_anim_speed';
$add_inline_img_css_animation_speed['dependency'] = array( 'element' => 'inline_media_anim', 'not_empty' => true );
$add_inline_img_css_animation_delay = $add_animation_delay;
$add_inline_img_css_animation_delay['group'] = esc_html__('Inline Images', 'uncode-core');
$add_inline_img_css_animation_delay['param_name'] = 'inline_media_anim_delay';
$add_inline_img_css_animation_delay['dependency'] = array( 'element' => 'inline_media_anim', 'not_empty' => true );

$add_text_size = uncode_core_vc_params_get_text_size( 'sub_lead', esc_html__("Subheading text size", 'uncode-core'), esc_html__("Additional", 'uncode-core') );

$add_parallax_options = uncode_core_vc_params_get_parallax_options();
$add_parallax_centered_options = uncode_core_vc_params_get_parallax_centered_options();

$back_color_options = uncode_core_vc_params_get_advanced_color_options( 'back_color', esc_html__("Badge background color", 'uncode-core'), esc_html__("Specify the Badge background color.", 'uncode-core'), esc_html__("Badge", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'badge_style', 'not_empty' => true ) ) );
list( $add_back_color_type, $add_back_color, $add_back_color_solid, $add_back_color_gradient ) = $back_color_options;

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);

vc_map(array(
	'name' => esc_html__('Heading', 'uncode-core') ,
	'base' => 'vc_custom_heading',
	'icon' => 'fa fa-header',
	'php_class_name' => 'uncode_generic_admin',
	'weight' => 9800,
	'show_settings_on_create' => true,
	'shortcode' => true,
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
		esc_html__('Dynamic', 'uncode-core') ,
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('Heading title name price excerpt subheading product description text', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Heading text', 'uncode-core') ,
			'param_name' => 'content',
			'admin_label' => true,
			'value' => esc_html__('This is a custom heading element.', 'uncode-core') ,
			//'description' => esc_html__('Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core'),
			'dependency' => array(
				'element' => 'auto_text',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Dynamic heading", 'uncode-core') ,
			"param_name" => "auto_text",
			"description" => esc_html__("Activate this to pull dynamic text content (title or excerpt).", 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core') ,
			'admin_label' => true,
			"value" => array(
				esc_html__('No', 'uncode-core') => '',
				esc_html__('Get the Title', 'uncode-core') => 'yes',
				esc_html__('Get the Excerpt or Description', 'uncode-core') => 'excerpt',
				esc_html__('Get the Price for Single Product (WooCommerce)', 'uncode-core') => 'price',
			) ,
		) ,
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
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading font family", 'uncode-core') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify heading font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify a Heading font size.", 'uncode-core') ,
			'std' => 'h2',
			"value" => $heading_size_h,
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Heading Custom Size', 'uncode-core') ,
			'param_name' => 'heading_custom_size',
			'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
			'group' => esc_html__('General', 'uncode-core'),
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
			'group' => esc_html__('General', 'uncode-core')
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
			"group" => esc_html__("General", 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading line height", 'uncode-core') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify heading line height.", 'uncode-core') ,
			"value" => $heading_height,
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Heading letter spacing", 'uncode-core') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify heading letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			'group' => esc_html__('General', 'uncode-core')
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
			"group" => esc_html__("General", 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			"heading" => esc_html__("Heading indent", 'uncode-core') ,
			"param_name" => "text_indent",
			"description" => esc_html__("Specify an additional indent. Ex: 20%, 12vw, 60px.", 'uncode-core') ,
			"group" => esc_html__("General", 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator colored", 'uncode-core') ,
			"param_name" => "separator_color",
			"description" => esc_html__("Color the separator with the accent color.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'separator',
				'not_empty' => true,
			) ,
			"group" => esc_html__("Additional", 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator double space", 'uncode-core') ,
			"param_name" => "separator_double",
			"description" => esc_html__("Activate to increase the separator space.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'separator',
				'not_empty' => true,
			) ,
			"group" => esc_html__("Additional", 'uncode-core')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Heading Display', 'uncode-core') ,
			'param_name' => 'heading_display',
			'admin_label' => true,
			'value' => array(
				esc_html__('Block', 'uncode-core') => '',
				esc_html__('Inline', 'uncode-core') => 'inline',
			) ,
			'group' => esc_html__('Additional', 'uncode-core') ,
			'description' => esc_html__('Specify the display mode.', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Heading Badge style", 'uncode-core') ,
			"param_name" => "badge_style",
			"description" => esc_html__("Activate to enable the Badge style.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("Additional", 'uncode-core'),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Heading Inline Images", 'uncode-core') ,
			"param_name" => "inline_media",
			"description" => esc_html__("Activate to enable the Heading with Inline Images.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes", 'uncode-core') => 'yes'
			) ,
			'admin_label' => true,
			"group" => esc_html__("Additional", 'uncode-core'),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Heading Text Stroke", 'uncode-core') ,
			"param_name" => "text_stroke",
			"description" => esc_html__("Activate the Text Stroke option. Note: This option is only visible when a custom hexadecimal color is specified in the Heading Color option.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Additional", 'uncode-core'),
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Heading Blend Mode", 'uncode-core') ,
			"param_name" => "color_blend",
			"description" => esc_html__("Specify a Blend Mode for the Heading.", 'uncode-core') ,
			"group" => esc_html__("Additional", 'uncode-core'),
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
			"type" => "dropdown",
			"heading" => esc_html__("Heading Separator", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate the separator. This will appear under the text.", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Under Heading', 'uncode-core') => 'yes',
				esc_html__('Under Subheading', 'uncode-core') => 'under',
				esc_html__('Over Heading', 'uncode-core') => 'over'
			) ,
			"group" => esc_html__("Additional", 'uncode-core'),
			'dependency' => array(
				'element' => 'auto_text',
				'value' => array(
					'',
					'yes',
					'excerpt',
				),
			) ,
		) ,
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Subheading', 'uncode-core') ,
			"param_name" => "subheading",
			"description" => esc_html__("Add a Subheading text.", 'uncode-core') ,
			"group" => esc_html__("Additional", 'uncode-core') ,
			'admin_label' => true,
			'dependency' => array(
				'element' => 'auto_text',
				'value' => array(
					'',
					'yes',
					'excerpt',
				),
			) ,
		) ,
		$add_text_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Subheading reduced space", 'uncode-core') ,
			"param_name" => "sub_reduced",
			"description" => esc_html__("Activate this to reduce the subheading top margin.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Additional", 'uncode-core') ,
			'dependency' => array(
				'element' => 'auto_text',
				'value' => array(
					'',
					'yes',
					'excerpt',
				),
			) ,
		) ,
		array(
			"type" => 'checkbox',
			'heading' => esc_html__('Subheading Foreword', 'uncode-core') ,
			"param_name" => "foreword",
			"description" => esc_html__("Activate this to convert the Subheading to Foreword Text.", 'uncode-core') ,
			"group" => esc_html__("Additional", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
		) ,
		$add_back_color_type,
		$add_back_color,
		$add_back_color_solid,
		$add_back_color_gradient,
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Media', 'uncode-core') ,
			'param_name' => 'medias',
			'has_galleries' => true,
			'value' => '',
			'description' => esc_html__('Select items from the Media Library and insert the shortcode [uncode_inline_image] into the Heading Text where you want the media to appear.', 'uncode-core') ,
			'group' => esc_html__('Inline Images', 'uncode-core') ,
			'dependency' => array(
				'element' => 'inline_media',
				'not_empty' => true
			) ,
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
			'group' => esc_html__('Inline Images', 'uncode-core') ,
			'dependency' => array(
				'element' => 'inline_media',
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Max Height", 'uncode-core') ,
			"param_name" => "media_height",
			"description" => esc_html__("Set the maximum height of the media as a percentage relative to the line-height, which determines the upper limit of the height.", 'uncode-core') ,
			"min" => 1,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			'group' => esc_html__('Inline Images', 'uncode-core') ,
			'dependency' => array(
				'element' => 'inline_media',
				'not_empty' => true
			) ,
		) ,		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Adjacent', 'uncode-core') ,
			'param_name' => 'media_space',
			'description' => esc_html__('Specifies the space between adjacent images.', 'uncode-core') ,
			"value" => array(
				esc_html__('No Space', 'uncode-core') => '',
				'Overlapping' => 'over',
				'Space' => 'gutter',
			) ,
			'group' => esc_html__('Inline Images', 'uncode-core') ,
			'dependency' => array(
				'element' => 'inline_media',
				'not_empty' => true
			) ,
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
			'group' => esc_html__('Inline Images', 'uncode-core') ,
			'dependency' => array(
				'element' => 'inline_media',
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border radius", 'uncode-core') ,
			"param_name" => "img_radius",
			"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
			'group' => esc_html__('Inline Images', 'uncode-core') ,
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
		$add_inline_img_css_animation,
		$add_inline_img_css_animation_speed,
		$add_inline_img_css_animation_delay,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border radius", 'uncode-core') ,
			"param_name" => "radius",
			"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
			"group" => esc_html__("Badge", 'uncode-core'),
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Extra Small', 'uncode-core') => 'xs',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
			) ,
			'dependency' => array(
				'element' => 'badge_style',
				'value' => array(
					'yes',
				),
			) ,
		) ,
		$add_text_css_animation,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Marquee Edge to Edge", 'uncode-core') ,
			"param_name" => "marquee_clone",
			"description" => esc_html__("Repeat the Marquee to cover the viewport.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'marquee',
					'marquee-scroll',
					'marquee-opposite',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Marquee Space", 'uncode-core') ,
			"param_name" => "marquee_space",
			"description" => esc_html__("Specify space between Marquee repetitions.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 1,
				esc_html__('Medium', 'uncode-core') => 2,
				esc_html__('Large', 'uncode-core') => 3,
				esc_html__('Extra Large', 'uncode-core') => 4,
				esc_html__('No Space', 'uncode-core') => 0,
			) ,
			'dependency' => array(
				'element' => 'marquee_clone',
				'not_empty' => true,
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Marquee Speed", 'uncode-core') ,
			"param_name" => "marquee_speed",
			"description" => esc_html__("Specify the Marquee speed.", 'uncode-core') ,
			"min" => -4,
			"max" => 4,
			"step" => 1,
			"value" => 0,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'marquee',
					'marquee-scroll',
					'marquee-opposite',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		$add_animation_speed,
		$add_animation_delay,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Marquee Hover Slow Down", 'uncode-core') ,
			"param_name" => "marquee_hover",
			"description" => esc_html__("Enable this option to reduce the speed of the Marquee animation when hovered.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'marquee',
					'marquee-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Blurred margins", 'uncode-core') ,
			"param_name" => "marquee_blur",
			"description" => esc_html__("[...]", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'marquee',
					'marquee-opposite',
					'marquee-scroll',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Marquee Trigger", 'uncode-core') ,
			"param_name" => "marquee_trigger",
			"description" => esc_html__("Specify the starting point of the Marquee.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Row Top', 'uncode-core') => 'row',
				esc_html__('Row Middle', 'uncode-core') => 'row-middle',
			) ,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'marquee-scroll',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Desktop", 'uncode-core') ,
			"param_name" => "marquee_navbar",
			"description" => esc_html__("Consider the Navbar on Desktop for the Marquee Trigger.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'marquee_trigger',
				'value' => array('row', 'row-middle'),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Mobile", 'uncode-core') ,
			"param_name" => "marquee_navbar_mobile",
			"description" => esc_html__("Consider the Navbar on Mobile for the Marquee Trigger.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'marquee_trigger',
				'value' => array('row', 'row-middle'),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation interval', 'uncode-core') ,
			'param_name' => 'interval_animation',
			'admin_label' => true,
			'value' => array(
				esc_html__('Default (ms 0)', 'uncode-core') => '',
				esc_html__('ms 20', 'uncode-core') => 20,
				esc_html__('ms 40', 'uncode-core') => 40,
				esc_html__('ms 60', 'uncode-core') => 60,
				esc_html__('ms 80', 'uncode-core') => 80,
				esc_html__('ms 100', 'uncode-core') => 100,
				esc_html__('ms 120', 'uncode-core') => 120,
				esc_html__('ms 140', 'uncode-core') => 140,
				esc_html__('ms 160', 'uncode-core') => 160,
				esc_html__('ms 180', 'uncode-core') => 180,
				esc_html__('ms 200', 'uncode-core') => 200,
				esc_html__('ms 250', 'uncode-core') => 250,
				esc_html__('ms 300', 'uncode-core') => 300,
				esc_html__('ms 350', 'uncode-core') => 350,
				esc_html__('ms 400', 'uncode-core') => 400,
				esc_html__('ms 450', 'uncode-core') => 450,
				esc_html__('ms 500', 'uncode-core') => 500,
			) ,
			'dependency' => array(
				'element' => 'css_animation',
				'value' => array(
					'curtain',
					'curtain-words',
					'single-curtain',
					'single-slide',
					'single-slide-opposite',
					'typewriter',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
			'description' => esc_html__('Specify the interval between animations.', 'uncode-core')
		) ,

		$add_text_alt_css_animation,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Marquee Edge to Edge", 'uncode-core') ,
			"param_name" => "marquee_clone_alt",
			"description" => esc_html__("Repeat the Marquee to cover the viewport.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_alt_animation',
				'value' => array(
					'marquee',
					'marquee-scroll',
					'marquee-opposite',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Marquee Space", 'uncode-core') ,
			"param_name" => "marquee_space_alt",
			"description" => esc_html__("Specify space between Marquee repetitions.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 1,
				esc_html__('Medium', 'uncode-core') => 2,
				esc_html__('Large', 'uncode-core') => 3,
				esc_html__('Extra Large', 'uncode-core') => 4,
				esc_html__('No Space', 'uncode-core') => 0,
			) ,
			'dependency' => array(
				'element' => 'marquee_clone_alt',
				'not_empty' => true,
			), 
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Marquee Speed", 'uncode-core') ,
			"param_name" => "marquee_speed_alt",
			"description" => esc_html__("Specify the Marquee speed.", 'uncode-core') ,
			"min" => -4,
			"max" => 4,
			"step" => 1,
			"value" => 0,
			'dependency' => array(
				'element' => 'css_alt_animation',
				'value' => array(
					'marquee',
					'marquee-scroll',
					'marquee-opposite',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		$add_alt_animation_speed,
		$add_alt_animation_delay,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Marquee Hover Slow Down", 'uncode-core') ,
			"param_name" => "marquee_hover_alt",
			"description" => esc_html__("Enable this option to reduce the speed of the Marquee animation when hovered.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_alt_animation',
				'value' => array(
					'marquee',
					'marquee-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Blurred margins", 'uncode-core') ,
			"param_name" => "marquee_blur_alt",
			"description" => esc_html__("[...]", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'css_alt_animation',
				'value' => array(
					'marquee',
					'marquee-opposite',
					'marquee-scroll',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Marquee Trigger", 'uncode-core') ,
			"param_name" => "marquee_trigger_alt",
			"description" => esc_html__("Specify the starting point of the Marquee.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Row Top', 'uncode-core') => 'row',
				esc_html__('Row Middle', 'uncode-core') => 'row-middle',
			) ,
			'dependency' => array(
				'element' => 'css_alt_animation',
				'value' => array(
					'marquee-scroll',
					'marquee-scroll-opposite',
				),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Desktop", 'uncode-core') ,
			"param_name" => "marquee_navbar_alt",
			"description" => esc_html__("Consider the Navbar on Desktop for the Marquee Trigger.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'marquee_trigger_alt',
				'value' => array('row', 'row-middle'),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Consider Navbar on Mobile", 'uncode-core') ,
			"param_name" => "marquee_navbar_mobile_alt",
			"description" => esc_html__("Consider the Navbar on Mobile for the Marquee Trigger.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'marquee_trigger_alt',
				'value' => array('row', 'row-middle'),
			) ,
			'group' => esc_html__('Animation', 'uncode-core') ,
		) ,
		$add_parallax_options,
		$add_parallax_centered_options,
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
			"heading" => esc_html__("Skew", 'uncode-core') ,
			"param_name" => "skew",
			"description" => esc_html__("Apply the Skew effect at the page scroll. NB. For performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Extra', 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode-core') ,
			"param_name" => "sticky_trigger",
			"description" => esc_html__("With this option, the heading is sticky in the center of the container Row, it is suggested to use a Row larger than the viewport to see the effect.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'group' => esc_html__('Extra', 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Sticky Method", 'uncode-core') ,
			"param_name" => "sticky_trigger_option",
			"description" => esc_html__("Set whether the title should preserve its 'footprint' or be positioned absolutely in the layout.", 'uncode-core') ,
			'group' => esc_html__('Extra', 'uncode-core') ,
			'admin_label' => true,
			"value" => array(
				esc_html__('Relative', 'uncode-core') => '',
				esc_html__('Absolute', 'uncode-core') => 'no-height',
			) ,
			'dependency' => array(
				'element' => 'sticky_trigger',
				'not_empty' => true,
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
