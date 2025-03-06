<?php
/**
 * VC Icon Box config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$add_text_size = uncode_core_vc_params_get_text_size( 'text_lead', false, esc_html__("Text", 'uncode-core') );

$icon_color_options = uncode_core_vc_params_get_advanced_color_options( 'icon_color', esc_html__("Icon color", 'uncode-core'), esc_html__("Specify icon color. NB. This doesn't work for media icons.", 'uncode-core'), false, $uncode_colors, array( 'default_label' => true ) );
list( $add_icon_color_type, $add_icon_color, $add_icon_color_solid, $add_icon_color_gradient ) = $icon_color_options;

$add_parallax_options = uncode_core_vc_params_get_parallax_options();
$add_parallax_centered_options = uncode_core_vc_params_get_parallax_centered_options();

$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

$icon_box_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Icon position", 'uncode-core') ,
		"param_name" => "position",
		'admin_label' => true,
		"value" => array(
			esc_html__('Icon top', 'uncode-core') => '',
			esc_html__('Icon bottom', 'uncode-core') => 'bottom',
			esc_html__('Icon left', 'uncode-core') => 'left',
			esc_html__('Icon right', 'uncode-core') => 'right',
		) ,
		'description' => esc_html__('Specify where the icon is positioned inside the module.', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Icon Lateral Reduced Space", 'uncode-core') ,
		"param_name" => "space_reduced",
		"description" => esc_html__("Reduce the space between the icon and the text elements (Title and Text).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'position',
			'value' => array(
				'left',
				'right'
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title & text top", 'uncode-core') ,
		"param_name" => "title_aligned_icon",
		"description" => esc_html__("Activate this to align the title and text to top. NB. Default title is vertically middle aligned with the icon.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'position',
			'value' => array(
				'left',
				'right'
			)
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Icon display', 'uncode-core') ,
		'param_name' => 'display',
		'description' => esc_html__('Specify the display mode.', 'uncode-core') ,
		"value" => array(
			esc_html__('Block', 'uncode-core') => '',
			esc_html__('Inline', 'uncode-core') => 'inline',
			esc_html__('Absolute', 'uncode-core') => 'absolute-center'
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'uncode-core') ,
		'param_name' => 'icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'value' => '',
		'admin_label' => true,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
	) ,
	array(
		"type" => "media_element",
		"heading" => esc_html__("Icon media", 'uncode-core') ,
		"param_name" => "icon_image",
		"value" => "",
		"description" => esc_html__("Specify a media icon from the Media Library.", 'uncode-core') ,
	) ,
	$add_icon_color_type,
	$add_icon_color,
	$add_icon_color_solid,
	$add_icon_color_gradient,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Icon background style', 'uncode-core') ,
		'param_name' => 'background_style',
		'value' => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Circle', 'uncode-core') => 'fa-rounded',
			esc_html__('Square', 'uncode-core') => 'fa-squared',
		) ,
		'description' => esc_html__("Background style for icon. NB. This doesn't work for media icons.", 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Icon size', 'uncode-core') ,
		'param_name' => 'size',
		'value' => $icon_sizes,
		'std' => '',
		'description' => esc_html__("Icon size. NB. This doesn't work for media icons.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'icon_image',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "textfield",
		'heading' => esc_html__('Media icon size', 'uncode-core') ,
		'param_name' => 'media_size',
		'std' => '',
		'description' => esc_html__("Media icon size in pixel. NB. If it's empty the default value is 50.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'icon_image',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Icon outlined', 'uncode-core') ,
		'param_name' => 'outline',
		'description' => esc_html__("Outlined icon doesn't have a full background color.", 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'background_style',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Icon animated', 'uncode-core') ,
		'param_name' => 'icon_automatic',
		'description' => esc_html__("Activate the animation effect.", 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'background_style',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Icon shadow', 'uncode-core') ,
		'param_name' => 'shadow',
		'description' => esc_html__('Icon shadow.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'background_style',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Title', 'uncode-core') ,
		'param_name' => 'title',
		'admin_label' => true,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title semantic", 'uncode-core') ,
		"param_name" => "heading_semantic",
		"description" => esc_html__("Specify element tag.", 'uncode-core') ,
		"value" => $heading_semantic,
		'std' => 'h3',
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font family", 'uncode-core') ,
		"param_name" => "text_font",
		"description" => esc_html__("Specify title font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title size", 'uncode-core') ,
		"param_name" => "text_size",
		"description" => esc_html__("Specify title size.", 'uncode-core') ,
		'std' => 'h3',
		"value" => $heading_size,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title weight", 'uncode-core') ,
		"param_name" => "text_weight",
		"description" => esc_html__("Specify title weight.", 'uncode-core') ,
		"value" => $heading_weight,
		'std' => '',
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title line height", 'uncode-core') ,
		"param_name" => "text_height",
		"description" => esc_html__("Specify text line height.", 'uncode-core') ,
		"value" => $heading_height,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title letter spacing", 'uncode-core') ,
		"param_name" => "text_space",
		"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
	) ,
	array(
		'type' => 'vc_link',
		'heading' => esc_html__('URL (Link)', 'uncode-core') ,
		'param_name' => 'link',
		'description' => esc_html__('Add link to icon.', 'uncode-core')
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Title linked', 'uncode-core') ,
		'param_name' => 'linked_title',
		'description' => esc_html__('Activate this to enable the Url (Link) or Media Lightbox in the title element.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		'type' => 'media_element',
		'heading' => esc_html__('Media lightbox', 'uncode-core') ,
		'param_name' => 'media_lightbox',
		'description' => esc_html__('Specify a media from the lightbox.', 'uncode-core') ,
	) ,
	array(
		'type' => 'textarea_html',
		'heading' => esc_html__('Text', 'uncode-core') ,
		'param_name' => 'content',
		'admin_label' => true,
		"value" => '',
		"group" => esc_html__("Text", 'uncode-core') ,
	) ,
	$add_text_size,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Text top space reduced", 'uncode-core') ,
		"param_name" => "text_reduced",
		"description" => esc_html__("Activate this to reduce the text top margin.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'position',
			'value' => array(
				'',
				'bottom'
			)
		) ,
		"group" => esc_html__("Text", 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Text additional link', 'uncode-core') ,
		'param_name' => 'link_text',
		'description' => esc_html__('Add a text link if you wish, this will be added under the text.', 'uncode-core'),
		"group" => esc_html__("Text", 'uncode-core') ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Add top margin', 'uncode-core') ,
		'param_name' => 'add_margin',
		'description' => esc_html__('Add text top margin.', 'uncode-core') ,
		"group" => esc_html__("Text", 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'position',
			'value' => array(
				'left',
				'right'
			)
		) ,
	) ,
	$add_css_animation_w_parallax,
	$add_animation_speed,
	$add_animation_delay,
	$add_parallax_options,
	$add_parallax_centered_options,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'dependency' => array(
			'element' => 'media_lightbox',
			'not_empty' => true,
		) ,
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
		'group' => esc_html__('Extra', 'uncode-core') ,
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
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			) ,
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

$icon_box_params = array_merge($icon_box_params, $uncode_advanced_videos);

vc_map(array(
	'name' => esc_html__('Icon Box', 'uncode-core') ,
	'base' => 'vc_icon',
	'icon' => 'fa fa-star',
	'weight' => 9700,
	'php_class_name' => 'uncode_generic_admin',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Icon lightbox video', 'uncode-core') ,
	'params' => $icon_box_params
));
