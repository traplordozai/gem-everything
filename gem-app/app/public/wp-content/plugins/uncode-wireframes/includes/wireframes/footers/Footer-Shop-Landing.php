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

$data[ 'name' ]             = esc_html__( 'Footer Shop Landing', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Landing.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1633610884504{border-top-width: 1px !important;}" uncode_shortcode_id="367375" back_color_type="uncode-palette" border_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="122250"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="427151"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="131406"][vc_column_text text_lead="yes" uncode_shortcode_id="403782"]<a href="#">Manage Account</a><br />
<a href="#">Saved Items</a><br />
<a href="#">Orders &amp; Returns</a><br />
<a href="#">Redeem a Gift card</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="105216" column_width_pixel="400"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="169391"]Stay tuned[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="105060"]Exceptional quality. Ethical factories. Radical Transparency. Shipping and returns.[/vc_column_text][vc_empty_space empty_h="1" medium_visibility="yes" mobile_visibility="yes"][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="no-labels-background"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="992329"][vc_column_text text_lead="yes" uncode_shortcode_id="170163"]<a href="#">About</a><br />
<a href="#">Factories</a><br />
<a href="#">Careers</a><br />
<a href="#">Accessibility</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
