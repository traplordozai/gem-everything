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

$data[ 'name' ]             = esc_html__( 'Footer Creative Product', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Product.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" back_color="accent" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="151520" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="137346"][/vc_column][vc_column column_width_percent="100" gutter_size="4" override_padding="yes" column_padding="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="8/12" uncode_shortcode_id="124987"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="191419"][vc_custom_heading text_color="accent" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" uncode_shortcode_id="120870" text_color_type="uncode-palette" back_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_separator sep_color=",Default"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="183214"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="175590"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="482468"]Change the color to match your brand or vision, add your logo.[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="159081"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="163668" el_class="skin-links"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="260437" el_class="skin-links"]Services[/vc_custom_heading][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="500" uncode_shortcode_id="159459" el_class="footer-links"]<a href="#">Online Store</a><br />
<a href="#">Retailers</a><br />
<a href="#">Product Support</a><br />
<a href="#">Service Request</a><br />
<a href="#">Service Center</a><br />
<a href="#">Warranty</a><br />
<a href="#">Download Center</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="141796" el_class="skin-links"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="106907" el_class="skin-links"]Headquarter[/vc_custom_heading][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="500" uncode_shortcode_id="186460" el_class="footer-links"]<a href="#">email@yourwebsite.com</a><br />
<a href="#">+556 214 567 000</a><br />
24 Queens Road, London[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="183214"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="558426"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_weight="500" uncode_shortcode_id="997828" el_class="skin-links"]<a href="#">Privacy Policy</a> · <a href="#">Refund Policy</a> · <a href="#">Shipping Policy</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="169904"][/vc_column][/vc_row]
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
