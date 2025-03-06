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

$data[ 'name' ]             = esc_html__( 'Header Shop Creative Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Shop-Creative-2024.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 84889 ) ) .'" bg_transition_time="0" bg_carousel_time="2000" bg_transition_threshold="0" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="5" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="714732" css=".vc_custom_1715700318814{border-right-width: 36px !important;border-left-width: 36px !important;}" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="142175"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="250176"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/2" uncode_shortcode_id="536557"][vc_empty_space empty_h="5"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="1/2" uncode_shortcode_id="713624"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" css_animation="curtain" animation_speed="1000" interval_animation="20" uncode_shortcode_id="141977" heading_custom_size="clamp(22px,8vw,60px)"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" css_animation="curtain-words" animation_speed="1000" interval_animation="20" uncode_shortcode_id="269258"]Medium headline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="555984"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/2" uncode_shortcode_id="870697"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="700" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" uncode_shortcode_id="162250" heading_custom_size="clamp(35px,8vw,80px)"]<a href="#intro">↓</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="5" width="1/2" uncode_shortcode_id="890336"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="700" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" uncode_shortcode_id="492491" heading_custom_size="clamp(35px,8vw,80px)"]24 ⸻ 25[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
