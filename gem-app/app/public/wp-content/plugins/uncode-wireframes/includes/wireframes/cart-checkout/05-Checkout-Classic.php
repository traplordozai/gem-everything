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

$data[ 'name' ]             = esc_html__( 'Checkout Classic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'checkouts/Checkout-Classic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][uncode_woocommerce_checkout enhanced_thankyou_page="yes" checkout_layout="horizontal" checkout_main_area_size="7" checkout_columns_gap="4" checkout_vertical_align="top" checkout_form_compact="yes" order_payment_hide_table_headers="yes" order_payment_form_compact="yes" order_payment_show_thumbs="yes" order_payment_count_icon_style="no-accent" order_payment_override_padding="yes" order_payment_column_padding="3" order_payment_back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" order_payment_sticky="yes" custom_titles_typography="yes" titles_size="h5" text_lead="small" bold_text="yes" checkout_activate_custom_buttons="yes" checkout_button_wide="yes" checkout_button_border_width="0" checkout_button_scale_mobile="no" checkout_vertical_space="3"][/vc_column][/vc_row]
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
