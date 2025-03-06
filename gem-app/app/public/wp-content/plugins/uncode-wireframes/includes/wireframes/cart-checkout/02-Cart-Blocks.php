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

$data[ 'name' ]             = esc_html__( 'Cart Blocks', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'carts/Cart-Blocks.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="55" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="left top" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="3/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_color="color-wvjs"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="-5" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="lg" shadow_darker="yes" width="9/12"][uncode_woocommerce_cart cart_hide_table_headers="yes" thumb_size="medium" cart_table_override_padding="yes" cart_table_column_padding="5" cart_table_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" cart_totals_override_padding="yes" cart_totals_column_padding="5" cart_totals_style="dark" cart_totals_back_color="accent" custom_titles_typography="yes" titles_size="h3" bold_text="yes" cart_activate_custom_buttons="yes" cart_button_size="btn-xl" cart_button_radius="btn-circle" cart_button_wide="yes" cart_button_border_width="0" cart_button_scale_mobile="no"][/vc_column][/vc_row]
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
