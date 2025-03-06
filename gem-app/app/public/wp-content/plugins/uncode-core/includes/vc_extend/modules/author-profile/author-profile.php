<?php
/**
 * VC Author Profile config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$avatar_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'avatar_back_color', esc_html__("Avatar Background color", 'uncode-core'), esc_html__("Specify a background color for the box.", 'uncode-core'), false, $uncode_colors, array( 'dependency' => array( 'element' => 'avatar_border', 'not_empty' => true ) ) );
list( $add_avatar_back_color_type, $add_avatar_back_color, $add_avatar_back_color_solid, $add_avatar_back_color_gradient ) = $avatar_back_color_options;

$text_color_options = uncode_core_vc_params_get_advanced_color_options( 'text_color', esc_html__("Title color", 'uncode-core'), esc_html__("Specify text color.", 'uncode-core'), false, $uncode_colors, array( 'default_label' => true ) );
list( $add_text_color_type, $add_text_color, $add_text_color_solid, $add_text_color_gradient ) = $text_color_options;

$button_color_options = uncode_core_vc_params_get_advanced_color_options( 'button_color', esc_html__("Button color", 'uncode-core'), esc_html__("Specify button color.", 'uncode-core'), esc_html__("Button", 'uncode-core'), $uncode_colors, array( 'default_label' => true ) );
list( $add_button_color_type, $add_button_color, $add_button_color_solid, $add_button_color_gradient ) = $button_color_options;

$user_list = array(
	esc_html__('Default user', 'uncode-core') => ''
);

$user_list_original = uncode_transient_users();
$has_lean_transient = false;

if ( isset( $user_list_original['users_list'] ) ) {
	$user_list_original = $user_list_original['users_list'];
	$has_lean_transient = true;
}

foreach ( $user_list_original as $user_key => $user ) {
	$_user_id        = $has_lean_transient ? $user_key : $user->ID;
	$_display_name   = $has_lean_transient ? $user : $user->display_name;
	$count_user_post = count_user_posts( $_user_id );
	if ( $count_user_post > 0 || apply_filters( 'uncode_author_profile_no_post', false ) ) { //user is author too or it doesn't matter
		$user_list[$_display_name] = $_user_id;
	}
}

$size_arr = array(
	esc_html__('Standard', 'uncode-core') => '',
	esc_html__('Small', 'uncode-core') => 'btn-sm',
	esc_html__('Large', 'uncode-core') => 'btn-lg',
	esc_html__('Extra-Large', 'uncode-core') => 'btn-xl',
	esc_html__('Button link', 'uncode-core') => 'btn-link',
	esc_html__('Standard link', 'uncode-core') => 'link',
);

$add_text_size = uncode_core_vc_params_get_text_size( 'sub_lead' );
$add_text_size[ 'dependency' ] =  array(
	'element' => 'author_bio',
	'not_empty' => true,
);

vc_map(array(
	'base' => 'uncode_author_profile',
	'name' => esc_html__('Author Profile', 'uncode-core') ,
	'icon' => 'fa fa-user',
	'php_class_name' => 'uncode_author_profile',
	'weight' => 9150,
	'category' => array(
		esc_html__('Dynamic', 'uncode-core') ,
	),
	'description' => esc_html__('Info Bio User Avatar', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'uncode_shortcode_id',
			'heading' => esc_html__('Unique ID', 'uncode-core') ,
			'param_name' => 'uncode_shortcode_id',
			'description' => '' ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Select user", 'uncode-core') ,
			"param_name" => "user_id",
			"admin_label" => true,
			"description" => esc_html__("Select an option if you want to display a different user than the author.", 'uncode-core') ,
			"value" => $user_list ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Display avatar', 'uncode-core') ,
			'param_name' => 'avatar',
			'description' => esc_html__("Specify whether to show the avatar or not.", 'uncode-core') ,
			"value" => array(
				esc_html__('Use global recognized avatar (Gravatar)', 'uncode-core') => 'gravatar',
				esc_html__('Use custom avatar', 'uncode-core') => 'custom',
				esc_html__('Do not display any avatar', 'uncode-core') => 'hide',
			) ,
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Custom avatar", 'uncode-core') ,
			"param_name" => "custom_avatar",
			"value" => "",
			"description" => esc_html__("Specify an image from the media library.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'avatar',
				'value' => array(
					'custom',
				) ,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Avatar position", 'uncode-core') ,
			"param_name" => "avatar_position",
			"description" => esc_html__("Specify where to position the author avatar with respect to the text.", 'uncode-core') ,
			"value" => array(
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Top', 'uncode-core') => 'top',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'avatar',
				'value' => array(
					'gravatar',
					'custom',
				) ,
			) ,
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Avatar size", 'uncode-core') ,
			"param_name" => "avatar_size",
			"description" => esc_html__("Intended in pixels. Enter an integer number.", 'uncode-core') ,
			"value" => "100",
			'dependency' => array(
				'element' => 'avatar',
				'value' => array(
					'gravatar',
					'custom',
				) ,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Avatar style", 'uncode-core') ,
			"param_name" => "avatar_style",
			"description" => esc_html__("Select the look of the avatar image.", 'uncode-core') ,
			"value" => array(
				esc_html__('Square', 'uncode-core') => '',
				esc_html__('Circular', 'uncode-core') => 'img-circle',
				esc_html__('Rounded', 'uncode-core') => 'img-round',
			),
			"std" => "img-circle" ,
			'dependency' => array(
				'element' => 'avatar',
				'value' => array(
					'gravatar',
					'custom',
				) ,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Avatar border", 'uncode-core') ,
			"param_name" => "avatar_border",
			"description" => esc_html__("Specify whether to display a solid border around the avatar image or not.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'avatar',
				'value' => array(
					'gravatar',
					'custom',
				) ,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Avatar Border Skin", 'uncode-core') ,
			"param_name" => "avatar_skin",
			"description" => esc_html__("Specify the Skin of the avatar box.", 'uncode-core') ,
			"value" => array(
				esc_html__('Light', 'uncode-core') => 'light',
				esc_html__('Dark', 'uncode-core') => 'dark'
			) ,
			'dependency' => array(
				'element' => 'avatar_border',
				'not_empty' => true,
			) ,
		) ,
		$add_avatar_back_color_type,
		$add_avatar_back_color,
		$add_avatar_back_color_solid,
		$add_avatar_back_color_gradient,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Author Name Link", 'uncode-core') ,
			"param_name" => "author_name_linked",
			"description" => esc_html__("Link the author name to the author post page.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			"std" => "yes" ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title semantic", 'uncode-core') ,
			"param_name" => "heading_semantic",
			"description" => esc_html__("Specify element tag.", 'uncode-core') ,
			"value" => $heading_semantic,
			'std' => 'h2',
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
			'std' => 'h2',
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
			"heading" => esc_html__("Title transform", 'uncode-core') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the author name text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title line height", 'uncode-core') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify title line height.", 'uncode-core') ,
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
			"type" => 'dropdown',
			"heading" => esc_html__("Title italic", 'uncode-core') ,
			"param_name" => "text_italic",
			"description" => esc_html__("Transform the author name to italic.", 'uncode-core') ,
			"value" => array(
				esc_html__('Normal', 'uncode-core') => '',
				esc_html__('Italic', 'uncode-core') => 'yes',
			) ,
		) ,
		$add_text_color_type,
		$add_text_color,
		$add_text_color_solid,
		$add_text_color_gradient,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Separator", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate the separator. This will appear under the text.", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Under author name', 'uncode-core') => 'yes',
				esc_html__('Under author bio', 'uncode-core') => 'under',
				esc_html__('Over author name', 'uncode-core') => 'over'
			) ,
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
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Display author bio", 'uncode-core') ,
			"param_name" => "author_bio",
			"description" => esc_html__("Activate to display author bio text.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"std" => 'yes',
		) ,
		$add_text_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Reduce author bio top space", 'uncode-core') ,
			"param_name" => "sub_reduced",
			"description" => esc_html__("Activate this to reduce the author bio top margin.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'author_bio',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Display social and contact method icons", 'uncode-core') ,
			"param_name" => "social",
			"description" => esc_html__("Specify whether to display the list of author's social profiles and external urls.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"std" => "yes" ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Display button", 'uncode-core') ,
			"param_name" => "display_button",
			"description" => esc_html__("Use a button to redirect users to the author post page or a custom link.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'uncode-core') ,
			'param_name' => 'button_content',
			'value' => esc_html__('All author posts', 'uncode-core') ,
			'description' => esc_html__('Text on the button.', 'uncode-core') ,
			"group" => esc_html__("Button", 'uncode-core'),
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button link", 'uncode-core') ,
			"param_name" => "button_link",
			"description" => esc_html__("Specify whether to link the button to the author post page or a different link.", 'uncode-core') ,
			"value" => array(
				esc_html__('Link to the author post page', 'uncode-core') => '',
				esc_html__('Custom link', 'uncode-core') => 'custom',
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode-core') ,
			'param_name' => 'link',
			'description' => esc_html__('Button link.', 'uncode-core') ,
			'dependency' => array(
				'element' => 'button_link',
				'value' => 'custom',
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
		) ,
		$add_button_color_type,
		$add_button_color,
		$add_button_color_solid,
		$add_button_color_gradient,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'uncode-core') ,
			'param_name' => 'size',
			'value' => $size_arr,
			'description' => esc_html__('Button size.', 'uncode-core') ,
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Shape", 'uncode-core') ,
			"param_name" => "radius",
			"description" => esc_html__("You can shape the button with the corners round, squared or circle.", 'uncode-core') ,
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('Default', 'uncode-core') => 'btn-default-shape',
				esc_html__('Round', 'uncode-core') => 'btn-round',
				esc_html__('Circle', 'uncode-core') => 'btn-circle',
				esc_html__('Square', 'uncode-core') => 'btn-square'
			) ,
			"group" => esc_html__("Button", 'uncode-core'),
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Hover effect", 'uncode-core') ,
			"param_name" => "hover_fx",
			"description" => esc_html__("Specify an effect on hover state.", 'uncode-core') ,
			"value" => array(
				'Inherit' => '',
				'Outlined' => 'outlined',
				'Flat' => 'full-colored',
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Outlined inverse', 'uncode-core') ,
			'param_name' => 'outline',
			'description' => esc_html__("Outlined buttons don't have a full background color. NB: this option is available only with Hover Effect > Outlined.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Skin text', 'uncode-core') ,
			'param_name' => 'text_skin',
			'description' => esc_html__("Keep the text color as the Skin. NB: this option works well with Hover Effect > Outlined.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Outlined', 'uncode-core') ,
			'param_name' => 'outline',
			'description' => esc_html__("Outlined buttons doesn't have a full background color.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => true,
				 // default true, display an "EMPTY" icon?
				'iconsPerPage' => 1100,
				 // default 100, how many icons per/page to display
				'type' => 'uncode'
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
			'dependency' => array(
				'element' => 'display_button',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon position", 'uncode-core') ,
			"param_name" => "icon_position",
			"description" => esc_html__("Choose the position of the icon.", 'uncode-core') ,
			"value" => array(
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
			"group" => esc_html__("Button", 'uncode-core') ,
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
			'group' => esc_html__('Extra', 'uncode-core')
		) ,
	)
));
