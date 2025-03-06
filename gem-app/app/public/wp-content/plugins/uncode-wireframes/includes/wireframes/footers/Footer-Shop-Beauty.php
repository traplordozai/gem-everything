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

$data[ 'name' ]             = esc_html__( 'Footer Shop Beauty', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Beauty.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="118063" back_color_type="uncode-palette"][vc_column width="1/1"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="886085"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="196971"]Account[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">Manage Account</a><br />
<a href="#">Saved Items</a><br />
<a href="#">Orders &amp; Returns</a><br />
<a href="#">Redeem a Gift card</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="145917"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="120266"]Company[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">About</a><br />
<a href="#">Factories</a><br />
<a href="#">Careers</a><br />
<a href="#">International</a><br />
<a href="#">Accessibility</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="129495"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="747569"]Connect[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">Contact &amp; FAQ</a><br />
<a href="#">Instagram</a><br />
<a href="#">Twitter</a><br />
<a href="#">Affiliates</a><br />
<a href="#">Bulk Orders</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="364672"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="200138"][vc_column_text text_lead="small" uncode_shortcode_id="112698"]Exceptional quality. Ethical factories. Radical Transparency. Sign up to enjoy free U.S. shipping and returns on your first order.[/vc_column_text][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
