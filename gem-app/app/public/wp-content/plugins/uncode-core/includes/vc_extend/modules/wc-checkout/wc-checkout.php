<?php
/**
 * WC Checkout config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$checkout_form_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'checkout_form_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Checkout Form", 'uncode-core'), $uncode_colors );
list( $add_checkout_form_back_color_type, $add_checkout_form_back_color, $add_checkout_form_back_color_solid, $add_checkout_form_back_color_gradient ) = $checkout_form_back_color_options;

$order_payment_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'order_payment_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Order Payment", 'uncode-core'), $uncode_colors );
list( $add_order_payment_back_color_type, $add_order_payment_back_color, $add_order_payment_back_color_solid, $add_order_payment_back_color_gradient ) = $order_payment_back_color_options;

$checkout_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Layout", 'uncode-core') ,
		"param_name" => "checkout_layout",
		"value" => array(
			esc_html__('Vertical', 'uncode-core') => '',
			esc_html__('Horizontal', 'uncode-core') => 'horizontal',
		) ,
		"description" => esc_html__("Specify the layout of the Checkout module.", 'uncode-core')
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Main Column Size", 'uncode-core') ,
		"param_name" => "checkout_main_area_size",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"value" => 8,
		"description" => esc_html__("Set the size of the Checkout Form column.", 'uncode-core') ,
		"dependency" => array(
			'element' => "checkout_layout",
			'value' => array(
				'horizontal'
			)
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Columns gap", 'uncode-core') ,
		"custom_class" => "gutter_size",
		"param_name" => "checkout_columns_gap",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the columns gap.", 'uncode-core') ,
		"dependency" => array(
			'element' => "checkout_layout",
			'value' => array(
				'horizontal'
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Columns Equal Height", 'uncode-core') ,
		"param_name" => "equal_height",
		"description" => esc_html__("Activate this to have columns that are all equally tall, matching the height of the tallest. NB. It doesn't work on Mobile breakpoint.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"dependency" => array(
			'element' => "checkout_layout",
			'value' => array(
				'horizontal'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Vertical align", 'uncode-core') ,
		"param_name" => "checkout_vertical_align",
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
		) ,
		"description" => esc_html__("Specify the vertical alignment of the contents inside the tables.", 'uncode-core')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Enhanced Thank-You Page", 'uncode-core') ,
		"param_name" => "enhanced_thankyou_page",
		"description" => esc_html__("Activate this to inherit the layout and Skins in the Thank-You page.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
);

$checkout_form_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Headings visibility", 'uncode-core') ,
		"param_name" => "checkout_form_show_titles",
		"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"std" => 'yes',
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Notices layout", 'uncode-core') ,
		"param_name" => "checkout_form_notices_layout",
		"description" => esc_html__('Specify the position of the notices and the login/coupon form.', 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('On top', 'uncode-core') => 'top',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Compact layout", 'uncode-core') ,
		"param_name" => "checkout_form_compact",
		"description" => esc_html__('Activate this to activate the compact layout.', 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "checkout_form_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "checkout_form_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"dependency" => array(
			'element' => "checkout_form_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "checkout_form_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_checkout_form_back_color_type,
	$add_checkout_form_back_color,
	$add_checkout_form_back_color_solid,
	$add_checkout_form_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "checkout_form_sticky",
		"description" => esc_html__("Activate this to stick the Checkout Form column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
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
		"param_name" => "checkout_form_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
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
		"param_name" => "checkout_form_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
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
		"param_name" => "checkout_form_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Checkout Form", 'uncode-core') ,
		'dependency' => array(
			'element' => 'checkout_form_shadow',
			'not_empty' => true
		) ,
	) ,
);

$checkout_form_off_grid_options = uncode_core_vc_params_get_off_grid_options( 'checkout_form', esc_html__("Checkout Form", 'uncode-core'), 'checkout_layout' );
$checkout_form_options          = array_merge( $checkout_form_options, $checkout_form_off_grid_options );
$checkout_params                = array_merge( $checkout_params, $checkout_form_options );

$order_payment_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Heading visibility", 'uncode-core') ,
		"param_name" => "order_payment_show_titles",
		"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"std" => 'yes',
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide table header", 'uncode-core') ,
		"param_name" => "order_payment_hide_table_headers",
		"description" => esc_html__('Activate this to hide the header of the table.', 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"group" => esc_html__("Order Payment", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Compact layout", 'uncode-core') ,
		"param_name" => "order_payment_form_compact",
		"description" => esc_html__('Activate this to activate the compact layout.', 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Show thumbnails", 'uncode-core') ,
		"param_name" => "order_payment_show_thumbs",
		"description" => esc_html__('Activate this to show product thumbnails.', 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Count icon style", 'uncode-core') ,
		"param_name" => "order_payment_count_icon_style",
		"description" => esc_html__('Specify the style of the count icon.', 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"value" => array(
			esc_html__('Accent', 'uncode-core')    => '',
			esc_html__('Default', 'uncode-core') => 'no-accent',
		) ,
		"dependency" => array(
			'element' => "order_payment_show_thumbs",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "order_payment_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "order_payment_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"dependency" => array(
			'element' => "order_payment_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "order_payment_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_order_payment_back_color_type,
	$add_order_payment_back_color,
	$add_order_payment_back_color_solid,
	$add_order_payment_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "order_payment_sticky",
		"description" => esc_html__("Activate this to stick the Order Payment column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
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
		"param_name" => "order_payment_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
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
		"param_name" => "order_payment_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
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
		"param_name" => "order_payment_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Order Payment", 'uncode-core') ,
		'dependency' => array(
			'element' => 'order_payment_shadow',
			'not_empty' => true
		) ,
	) ,
);

$order_payment_off_grid_options = uncode_core_vc_params_get_off_grid_options( 'order_payment', esc_html__("Order Payment", 'uncode-core'), 'checkout_layout' );
$order_payment_options          = array_merge( $order_payment_options, $order_payment_off_grid_options );
$checkout_params                = array_merge( $checkout_params, $order_payment_options );
$checkout_params                = array_merge( $checkout_params, uncode_core_vc_params_get_wc_typography_options( $wc_heading_options ) );
$checkout_button_options        = uncode_core_get_wc_button_options( 'checkout', $button_options );
$checkout_button_options[]      = array(
	"type" => "dropdown",
	"heading" => esc_html__("Button Alignment", 'uncode-core') ,
	"param_name" => "main_button_alignment",
	"description" => esc_html__("Specify the alignment of the main button.", 'uncode-core') ,
	"group" => esc_html__("Buttons & Forms", 'uncode-core') ,
	"value" => array(
		esc_html__('Left', 'uncode-core') => '',
		esc_html__('Right', 'uncode-core') => 'right',
	) ,
);
$checkout_params                = array_merge( $checkout_params, uncode_core_vc_params_get_wc_buttons_and_forms_options( $checkout_button_options ) );
$checkout_params                = array_merge( $checkout_params, $wc_extra_options );

vc_map(array(
	'name' => esc_html__('Checkout', 'uncode-core') ,
	'base' => 'uncode_woocommerce_checkout',
	'weight' => -100,
	'show_settings_on_create' => true,
	'icon' => 'fa fa-credit-card',
	'category' => array(
		esc_html__('WooCommerce', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Payment', 'uncode-core') ,
	'params' => $checkout_params
));
