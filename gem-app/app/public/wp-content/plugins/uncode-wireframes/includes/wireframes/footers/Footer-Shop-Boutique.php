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

$data[ 'name' ]             = esc_html__( 'Footer Shop Boutique', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Boutique.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="bottom" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'"]Sign up to our newsletter[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="input-underline"][/vc_column_inner][/vc_row_inner][vc_separator][vc_row_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Headquarter[/vc_custom_heading][vc_column_text]9876 Design Blvd,
Suite 543, Beverly Hills,
CA 90212[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Customers[/vc_custom_heading][vc_column_text]<a href="#">Customer Care</a>
<a href="#">Returns and Refunds</a>
<a href="#">Privacy Policy</a>
<a href="#">Terms of Use</a>
<a href="#">Condition of Sale</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Services[/vc_custom_heading][vc_column_text]<a href="#">Opening your Account</a>
<a href="#">How To Shop</a>
<a href="#">Shipping</a>
<a href="#">Track your Order</a>
<a href="#">Store Locator</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" style="dark" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_icon display="inline" icon="fa fa-cc-visa" size="fa-2x"][/vc_icon][vc_icon display="inline" icon="fa fa-cc-mastercard" size="fa-2x"][/vc_icon][vc_icon display="inline" icon="fa fa-cc-paypal" size="fa-2x"][/vc_icon][vc_icon display="inline" icon="fa fa-cc-stripe" size="fa-2x"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
