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

$data[ 'name' ]             = esc_html__( 'Header Blog Writer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Blog-Writer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="6" column_width_percent="100" shift_y="0" z_index="0" inverted_device_order="yes" uncode_shortcode_id="206900"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="726194"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-four" uncode_shortcode_id="996708"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="134586"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="186823"][vc_column_inner width="1/1"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-160206' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="109081"]Heading[/vc_custom_heading][vc_custom_heading  text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="197749"]I am a writer, editor, &amp; psychologist expert.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color="" uncode_shortcode_id="626530" sep_color_type="uncode-solid" sep_color_solid="#dededb"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="680018"][vc_column_inner width="7/12"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="170159"]I partner with industry-leading brands to deliver impactful, and culturally meaningful content.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="5/12" uncode_shortcode_id="993475"][vc_button size="btn-lg" border_width="0" scale_mobile="no" uncode_shortcode_id="170280" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
