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

$data[ 'name' ]             = esc_html__( 'Footer Shop Ajax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Ajax.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="905405" back_color_type="uncode-palette"][vc_column column_width_percent="75" position_horizontal="left" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="4/12" uncode_shortcode_id="202851"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="500" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="211266"]Newsletter — Sign Up[/vc_custom_heading][vc_column_text uncode_shortcode_id="166616"]Be the first to know about special offers, new product launches, and events.[/vc_column_text][contact-form-7 id="'. uncode_wf_print_form_id( '96891' ) .'"][/vc_column][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="131740"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="883809"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="165884"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="195195"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="500" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="194174"]Shop[/vc_custom_heading][vc_column_text uncode_shortcode_id="171122"]<a href="#">Shop All</a>
<a href="#">Woman Collection</a>
<a href="#">Man Collection</a>
<a href="#">Accessories</a>
<a href="#">New Arrivals</a>
<a href="#">Latest Collection</a>
<a href="#">Gift Card</a>
<a href="#">Top Sellers</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="144566"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="500" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="127802"]Customers[/vc_custom_heading][vc_column_text uncode_shortcode_id="690699"]<a href="#">Faqs</a>
<a href="#">Shipping</a>
<a href="#">Returns</a>
<a href="#">Terms</a>
<a href="#">Contact Us</a>
<a href="#">Privacy</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="203926"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="500" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="143003"]Contact Us[/vc_custom_heading][vc_column_text uncode_shortcode_id="188615"]<a href="mailto:help@yourwebsite.com">help@yourwebsite.com</a>
1-888-625-8064
1-888-912-8375[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-prif" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="103597" back_color_type="uncode-palette" border_color_type="uncode-palette" css=".vc_custom_1660660920736{border-top-width: 1px !important;padding-top: 18px !important;padding-bottom: 18px !important;}" shape_dividers=""][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="141969"][uncode_copyright text_lead="small"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="7" width="1/2" uncode_shortcode_id="699097"][uncode_socials][/vc_column][/vc_row]
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
