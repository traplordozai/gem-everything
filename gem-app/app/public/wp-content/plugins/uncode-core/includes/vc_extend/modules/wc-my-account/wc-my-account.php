<?php
/**
 * WC My Account config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$my_account_nav_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'my_account_nav_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Navigation", 'uncode-core'), $uncode_colors );
list( $add_my_account_nav_back_color_type, $add_my_account_nav_back_color, $add_my_account_nav_back_color_solid, $add_my_account_nav_back_color_gradient ) = $my_account_nav_back_color_options;

$my_account_content_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'my_account_content_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Content", 'uncode-core'), $uncode_colors );
list( $add_my_account_content_back_color_type, $add_my_account_content_back_color, $add_my_account_content_back_color_solid, $add_my_account_content_back_color_gradient ) = $my_account_content_back_color_options;

$account_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Main Column Size", 'uncode-core') ,
		"param_name" => "my_account_main_area_size",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"value" => 8,
		"description" => esc_html__("Set the size of the My Account Form column.", 'uncode-core') ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Columns gap", 'uncode-core') ,
		"custom_class" => "gutter_size",
		"param_name" => "my_account_columns_gap",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the columns gap.", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Columns Equal Height", 'uncode-core') ,
		"param_name" => "equal_height",
		"description" => esc_html__("Activate this to have columns that are all equally tall, matching the height of the tallest. NB. It doesn't work on Mobile breakpoint.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Vertical align", 'uncode-core') ,
		"param_name" => "my_account_vertical_align",
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
		) ,
		"description" => esc_html__("Specify the vertical alignment of the contents inside the tables.", 'uncode-core')
	) ,
);

$account_nav_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "my_account_nav_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "my_account_nav_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		"dependency" => array(
			'element' => "my_account_nav_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "my_account_nav_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_my_account_nav_back_color_type,
	$add_my_account_nav_back_color,
	$add_my_account_nav_back_color_solid,
	$add_my_account_nav_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "my_account_nav_sticky",
		"description" => esc_html__("Activate this to stick the Navigation column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		) ,
		"dependency" => array(
			'element' => "equal_height",
			'is_empty' => true
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "my_account_nav_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
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
		"param_name" => "my_account_nav_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		"value" => array(
			esc_html__('Disabled', 'uncode-core') => '',
			esc_html__('None', 'uncode-core') => 'none',
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
		"param_name" => "my_account_nav_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Navigation", 'uncode-core') ,
		'dependency' => array(
			'element' => 'my_account_nav_shadow',
			'not_empty' => true
		) ,
	) ,
);

$account_params = array_merge( $account_params, $account_nav_options );

$account_content_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "my_account_content_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Content", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "my_account_content_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Content", 'uncode-core') ,
		"dependency" => array(
			'element' => "my_account_content_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "my_account_content_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Content", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_my_account_content_back_color_type,
	$add_my_account_content_back_color,
	$add_my_account_content_back_color_solid,
	$add_my_account_content_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "my_account_content_sticky",
		"description" => esc_html__("Activate this to stick the Content column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Content", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		) ,
		"dependency" => array(
			'element' => "equal_height",
			'is_empty' => true
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "my_account_content_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Content", 'uncode-core') ,
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
		"param_name" => "my_account_content_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Content", 'uncode-core') ,
		"value" => array(
			esc_html__('Disabled', 'uncode-core') => '',
			esc_html__('None', 'uncode-core') => 'none',
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
		"param_name" => "my_account_content_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Content", 'uncode-core') ,
		'dependency' => array(
			'element' => 'my_account_content_shadow',
			'not_empty' => true
		) ,
	) ,
);

$account_params         = array_merge( $account_params, $account_content_options );
$account_params         = array_merge( $account_params, uncode_core_vc_params_get_wc_typography_options() );
$account_params         = array_merge( $account_params, uncode_core_vc_params_get_wc_buttons_and_forms_options( false ) );
$account_params         = array_merge( $account_params, $wc_extra_options );

vc_map(array(
	'name' => esc_html__('My Account', 'uncode-core') ,
	'base' => 'uncode_woocommerce_my_account',
	'icon' => 'icon-wpb-woocommerce',
	'weight' => -110,
	'show_settings_on_create' => true,
	'icon' => 'fa fa-user',
	'category' => array(
		esc_html__('WooCommerce', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce User', 'uncode-core') ,
	'params' => $account_params
));
