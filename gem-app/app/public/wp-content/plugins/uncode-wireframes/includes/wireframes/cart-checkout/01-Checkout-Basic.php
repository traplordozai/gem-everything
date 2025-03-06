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

$data[ 'name' ]             = esc_html__( 'Checkout Basic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cart-checkout' ];
$data[ 'custom_class' ]     = 'cart-checkout';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'checkouts/Checkout-Basic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][uncode_woocommerce_checkout enhanced_thankyou_page="yes" checkout_form_compact="yes" order_payment_form_compact="yes" order_payment_override_padding="yes" order_payment_column_padding="3" order_payment_back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" order_payment_radius="sm" custom_titles_typography="yes" titles_size="h4" bold_text="yes" main_button_alignment="right" form_style="no-labels-default"][/vc_column][/vc_row]
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
