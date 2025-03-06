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

$data[ 'name' ]             = esc_html__( 'Cart Full Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'carts/Cart-Full-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][uncode_woocommerce_cart cart_layout="horizontal" cart_main_area_size="7" cart_columns_gap="0" thumb_size="medium" cart_table_override_padding="yes" cart_table_column_padding="5" cart_table_style="dark" cart_table_back_color="accent" cart_totals_override_padding="yes" cart_totals_column_padding="5" cart_totals_style="dark" cart_totals_back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" cart_totals_sticky="yes" show_cross_sells="yes" cross_sells_after_cart_table="yes" cross_sells_margin_top="4" cross_sells_carousel_lg="4" cross_sells_carousel_md="3" cross_sells_carousel_sm="1" custom_titles_typography="yes" text_lead="small" bold_text="yes" cart_activate_custom_buttons="yes" cart_button_button_color="accent" cart_button_size="btn-xl" cart_button_wide="yes" cart_button_text_skin="yes" cart_button_border_width="0" form_style="default-underline" cart_button_scale_mobile="no"][/vc_column][/vc_row]
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
