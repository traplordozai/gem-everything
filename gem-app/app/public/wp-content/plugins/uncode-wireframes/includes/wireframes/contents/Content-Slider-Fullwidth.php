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

$data[ 'name' ]             = esc_html__( 'Content Slider Fullwidth', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Slider-Fullwidth.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="75" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="1200"][uncode_slider slider_type="fade" slider_interval="0" slider_navspeed="1000" slider_dot_position="left" slider_dot_width="limit" slider_width_percent="100" h_padding="2"][vc_row_inner row_inner_height_percent="0" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" style="dark" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="right-t-left" animation_speed="1000" width="1/2"][vc_icon position="left" icon="fa fa-mobile2" size="fa-4x" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" title="TAGLINE"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" css_animation="curtain-words"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="2"][vc_column_text]— Marc Scott, Executive Officer[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" style="dark" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="right-t-left" animation_speed="1000" width="1/2"][vc_icon position="left" icon="fa fa-mobile2" size="fa-4x" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" title="TAGLINE"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" css_animation="curtain-words"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="2"][vc_column_text]— Marc Scott, Executive Officer[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" style="dark" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="right-t-left" animation_speed="1000" width="1/2"][vc_icon position="left" icon="fa fa-mobile2" size="fa-4x" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" title="TAGLINE"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" css_animation="curtain-words"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="2"][vc_column_text]— Marc Scott, Executive Officer[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="4" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][/vc_column_inner][/vc_row_inner][/uncode_slider][/vc_column][/vc_row]
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
