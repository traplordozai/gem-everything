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

$data[ 'name' ]             = esc_html__( 'Footer Portfolio Collective', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Portfolio-Collective.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="accent" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="789139" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="175589"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="174813"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="913204"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="986733" el_class="skin-links"]<a href="#">About</a>
<a href="#">Services</a>
<a href="#">Work</a>
<a href="#">News</a>
<a href="#">Contact</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="509248"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="133203"]AMSTERDAM ⸺[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="159829"]13 Willem Gerresepad
Amsterdam, 1106 ZJ[/vc_custom_heading][vc_empty_space empty_h="2" mobile_visibility="yes"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="757521"]LONDON ⸺[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="208945"]91 Sutton Wick Lane
London, S42 0DG[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="163812"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="101305"]CONTACT ⸺[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="219276" el_class="skin-links"]+39 (0)215 770 0521
<a href="mailto:contact@yoursite.com">contact@yoursite.com</a>[/vc_custom_heading][vc_empty_space empty_h="2" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="0" bottom_padding="0" back_color="accent" overlay_color="color-jevc" overlay_alpha="15" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="936413" back_color_type="uncode-palette" overlay_color_type="uncode-palette" css=".vc_custom_1715695687133{padding-top: 18px !important;padding-bottom: 18px !important;}"][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="756079"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="154991"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="162452"][vc_column_text uncode_shortcode_id="197728" el_class="skin-links"]<a href="#">Cookie Policy</a> · <a href="#">Privacy Policy</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="609198"][uncode_socials el_class="skin-links"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
