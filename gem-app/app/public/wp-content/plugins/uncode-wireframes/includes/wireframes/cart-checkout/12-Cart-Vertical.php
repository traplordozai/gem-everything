<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Cart Vertical', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'carts/Cart-Vertical.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider_inv="curve-opacity" shape_bottom_invert="yes" shape_bottom_h_use_pixel="" shape_bottom_height="72" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0" el_class="gradient" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Short headline[/vc_custom_heading][vc_empty_space empty_h="5"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" shape_dividers=""][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="-5" shift_y_fixed="yes" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="sm" shadow="lg" width="1/1" column_width_pixel="728"][uncode_woocommerce_cart cart_vertical_align="top" cart_hide_table_headers="yes" cart_table_override_padding="yes" cart_table_column_padding="0" show_cross_sells="yes" cross_sells_after_cart_table="yes" cross_sells_margin_top="4" cross_sells_carousel_lg="3" cross_sells_carousel_md="3" cross_sells_carousel_sm="1" custom_titles_typography="yes" titles_size="h4" bold_text="yes" cart_activate_custom_buttons="yes" cart_button_button_color="accent" cart_button_size="btn-xl" cart_button_wide="yes" cart_button_hover_fx="full-colored" cart_button_border_width="0" cart_button_scale_mobile="no"][/vc_column][/vc_row]
';

// Check if this wireframe is for a content block
if ( $data[ 'is_content_block' ] && ! $is_content_block ) {
	$data[ 'custom_class' ] .= ' for-content-blocks';
}

// Check if this wireframe requires a plugin
foreach ( $data[ 'dependency' ]  as $dependency ) {
	if ( ! UNCDWF_Dynamic::has_dependency( $dependency ) ) {
		$data[ 'custom_class' ] .= ' has-dependency needs-' . $dependency;
	}
}

vc_add_default_templates( $data );
