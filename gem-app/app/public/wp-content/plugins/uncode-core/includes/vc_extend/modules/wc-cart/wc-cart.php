<?php
/**
 * WC Cart config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$cart_table_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'cart_table_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Cart Table", 'uncode-core'), $uncode_colors );
list( $add_cart_table_back_color_type, $add_cart_table_back_color, $add_cart_table_back_color_solid, $add_cart_table_back_color_gradient ) = $cart_table_back_color_options;

$cart_totals_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'cart_totals_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Cart Totals", 'uncode-core'), $uncode_colors );
list( $add_cart_totals_back_color_type, $add_cart_totals_back_color, $add_cart_totals_back_color_solid, $add_cart_totals_back_color_gradient ) = $cart_totals_back_color_options;

$cross_sells_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'cross_sells_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the column.", 'uncode-core'), esc_html__("Cross-Sells", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'cross_sells_after_cart_table', 'is_empty' => true ) ) );
list( $add_cross_sells_back_color_type, $add_cross_sells_back_color, $add_cross_sells_back_color_solid, $add_cross_sells_back_color_gradient ) = $cross_sells_back_color_options;

$cart_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Layout", 'uncode-core') ,
		"param_name" => "cart_layout",
		"value" => array(
			esc_html__('Vertical', 'uncode-core') => '',
			esc_html__('Horizontal', 'uncode-core') => 'horizontal',
		) ,
		"description" => esc_html__("Specify the layout of the Cart module.", 'uncode-core')
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Main Column Size", 'uncode-core') ,
		"param_name" => "cart_main_area_size",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"value" => 8,
		"description" => esc_html__("Set the size of the Cart Table (and if active Cross-Sells) column.", 'uncode-core') ,
		"dependency" => array(
			'element' => "cart_layout",
			'value' => array(
				'horizontal'
			)
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Columns gap", 'uncode-core') ,
		"custom_class" => "gutter_size",
		"param_name" => "cart_columns_gap",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the columns gap.", 'uncode-core') ,
		"dependency" => array(
			'element' => "cart_layout",
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
			'element' => "cart_layout",
			'value' => array(
				'horizontal'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Vertical align", 'uncode-core') ,
		"param_name" => "cart_vertical_align",
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
		) ,
		"description" => esc_html__("Specify the vertical alignment of the contents inside the tables.", 'uncode-core')
	) ,
);

$cart_table_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Heading visibility", 'uncode-core') ,
		"param_name" => "cart_table_show_titles",
		"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		"std" => 'yes',
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide table header", 'uncode-core') ,
		"param_name" => "cart_hide_table_headers",
		"description" => esc_html__('Activate this to hide the header of the table.', 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"group" => esc_html__("Cart Table", 'uncode-core') ,
	) ,
	$wc_thumb_size_options,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Compact layout", 'uncode-core') ,
		"param_name" => "cart_table_compact",
		"description" => esc_html__('Activate this to activate the compact layout.', 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "cart_table_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "cart_table_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		"dependency" => array(
			'element' => "cart_table_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "cart_table_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_cart_table_back_color_type,
	$add_cart_table_back_color,
	$add_cart_table_back_color_solid,
	$add_cart_table_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "cart_table_sticky",
		"description" => esc_html__("Activate this to stick the Cart Table column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
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
		"param_name" => "cart_table_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
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
		"param_name" => "cart_table_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
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
		"param_name" => "cart_table_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cart_table_shadow',
			'not_empty' => true
		) ,
	) ,
);

$cart_table_off_grid_options = uncode_core_vc_params_get_off_grid_options( 'cart_table', esc_html__("Cart Table", 'uncode-core'), 'cart_layout' );
$cart_table_options          = array_merge( $cart_table_options, $cart_table_off_grid_options );
$cart_params                 = array_merge( $cart_params, $cart_table_options );

$cart_total_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Heading visibility", 'uncode-core') ,
		"param_name" => "cart_totals_show_titles",
		"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
		"std" => 'yes',
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "cart_totals_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "cart_totals_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
		"dependency" => array(
			'element' => "cart_totals_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "cart_totals_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core')
	) ,
	$add_cart_totals_back_color_type,
	$add_cart_totals_back_color,
	$add_cart_totals_back_color_solid,
	$add_cart_totals_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky", 'uncode-core') ,
		"param_name" => "cart_totals_sticky",
		"description" => esc_html__("Activate this to stick the Cart Totals column when scrolling. NB. Only one column at the time can be sticky and it doesn't work with Columns Equal Height.", 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
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
		"param_name" => "cart_totals_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
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
		"type" => "dropdown",
		"heading" => esc_html__("Shadow", 'uncode-core') ,
		"param_name" => "cart_totals_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
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
		"param_name" => "cart_totals_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Cart Totals", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cart_totals_shadow',
			'not_empty' => true
		) ,
	) ,
);

$cart_totals_off_grid_options = uncode_core_vc_params_get_off_grid_options( 'cart_totals', esc_html__("Cart Totals", 'uncode-core'), 'cart_layout' );
$cart_total_options           = array_merge( $cart_total_options, $cart_totals_off_grid_options );
$cart_params                  = array_merge( $cart_params, $cart_total_options );

$cross_sells_options = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Enable Cross-Sells", 'uncode-core') ,
		"param_name" => "show_cross_sells",
		"description" => esc_html__("Activate this to show the Cross-Sells module.", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Heading visibility", 'uncode-core') ,
		"param_name" => "cross_sells_show_titles",
		"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"std" => 'yes',
		"value" => array(
			'' => 'yes'
		),
		"dependency" => array(
			'element' => "show_cross_sells",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("After cart table", 'uncode-core') ,
		"param_name" => "cross_sells_after_cart_table",
		"description" => esc_html__("Activate this to insert Cross-Sells after cart table (inherits Cart Table style settings).", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"dependency" => array(
			'element' => "show_cross_sells",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Margin Top", 'uncode-core') ,
		"custom_class" => "gutter_size",
		"param_name" => "cross_sells_margin_top",
		"min" => 0,
		"max" => 6,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the top margin.", 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"dependency" => array(
			'element' => "cross_sells_after_cart_table",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "cross_sells_override_padding",
		"description" => esc_html__('Activate this to define custom paddings.', 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"dependency" => array(
			'element' => "cross_sells_after_cart_table",
			'is_empty' => true
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding value", 'uncode-core') ,
		"custom_class" => "column_padding",
		"param_name" => "cross_sells_column_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the column padding.", 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"dependency" => array(
			'element' => "cross_sells_override_padding",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "cross_sells_style",
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		"description" => esc_html__("Specify the Skin coloration of the column.", 'uncode-core'),
		"dependency" => array(
			'element' => "cross_sells_after_cart_table",
			'is_empty' => true
		) ,
	) ,
	$add_cross_sells_back_color_type,
	$add_cross_sells_back_color,
	$add_cross_sells_back_color_solid,
	$add_cross_sells_back_color_gradient,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "cross_sells_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
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
		"param_name" => "cross_sells_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
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
		"param_name" => "cross_sells_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Cross-Sells", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cross_sells_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Desktop', 'uncode-core') ,
		'param_name' => 'cross_sells_carousel_lg',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 960px.', 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core'),
		"dependency" => array(
			'element' => "show_cross_sells",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Tablet', 'uncode-core') ,
		'param_name' => 'cross_sells_carousel_md',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 570px to 960px.', 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core'),
		"dependency" => array(
			'element' => "show_cross_sells",
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Device', 'uncode-core') ,
		'param_name' => 'cross_sells_carousel_sm',
		'value' => 1,
		'description' => esc_html__('Insert the numbers of items for the viewport from 0 to 570px.', 'uncode-core') ,
		"group" => esc_html__("Cross-Sells", 'uncode-core'),
		"dependency" => array(
			'element' => "show_cross_sells",
			'value' => array(
				'yes'
			)
		) ,
	) ,
);

$cart_params           = array_merge( $cart_params, $cross_sells_options );
$cart_params           = array_merge( $cart_params, uncode_core_vc_params_get_wc_typography_options( $wc_heading_options ) );
$cart_button_options   = uncode_core_get_wc_button_options( 'cart', $button_options );
$cart_button_options[] = array(
	"type" => "dropdown",
	"heading" => esc_html__("Button Alignment", 'uncode-core') ,
	"param_name" => "main_button_alignment",
	"description" => esc_html__("Specify the alignment of the main button.", 'uncode-core') ,
	"group" => esc_html__("Buttons & Forms", 'uncode-core') ,
	"value" => array(
		esc_html__('Right', 'uncode-core') => '',
		esc_html__('Left', 'uncode-core') => 'left',
	) ,
);
$cart_params           = array_merge( $cart_params, uncode_core_vc_params_get_wc_buttons_and_forms_options( $cart_button_options, true ) );
$cart_params           = array_merge( $cart_params, $wc_extra_options );

vc_map(array(
	'name' => esc_html__('Cart', 'uncode-core') ,
	'base' => 'uncode_woocommerce_cart',
	'weight' => -50,
	'show_settings_on_create' => true,
	'icon' => 'fa fa-shopping-bag1',
	'category' => array(
		esc_html__('WooCommerce', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Cart', 'uncode-core') ,
	'params' => $cart_params,
));
