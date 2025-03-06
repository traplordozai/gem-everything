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

$data[ 'name' ]             = esc_html__( 'Checkout Fancy', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'checkouts/Checkout-Fancy.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="xl" width="1/1" column_width_pixel="1400"][uncode_woocommerce_checkout enhanced_thankyou_page="yes" checkout_layout="horizontal" checkout_main_area_size="7" checkout_columns_gap="0" equal_height="yes" checkout_vertical_align="top" checkout_form_compact="yes" checkout_form_override_padding="yes" checkout_form_column_padding="4" checkout_form_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" order_payment_hide_table_headers="yes" order_payment_form_compact="yes" order_payment_show_thumbs="yes" order_payment_count_icon_style="no-accent" order_payment_override_padding="yes" order_payment_column_padding="4" order_payment_style="dark" order_payment_back_color="accent" custom_titles_typography="yes" titles_size="h3" bold_text="yes" checkout_activate_custom_buttons="yes" checkout_button_size="btn-lg" checkout_button_radius="btn-circle" checkout_button_wide="yes" checkout_button_border_width="0" checkout_button_scale_mobile="no" checkout_vertical_space="3"][/vc_column][/vc_row]
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
