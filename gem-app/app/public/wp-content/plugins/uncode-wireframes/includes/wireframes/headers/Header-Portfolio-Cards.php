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

$data[ 'name' ]             = esc_html__( 'Header Portfolio Cards', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Portfolio-Cards.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="0" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="200828" back_color_type="uncode-palette" row_name="top"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="947159"][vc_empty_space empty_h="2" desktop_visibility="yes"][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" css_animation="single-curtain" animation_speed="1600" interval_animation="20" uncode_shortcode_id="963041"]Heading[/vc_custom_heading][vc_separator sep_color=",Default"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="778266"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="200428"]Heading[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="4" mobile_width="7" width="1/3" uncode_shortcode_id="216795"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="100978"]Heading[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="163571"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="355173"]Heading[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
