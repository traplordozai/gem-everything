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

$data[ 'name' ]             = esc_html__( 'Header Classic Lawyer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Lawyer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="80" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider="step_3_4" shape_bottom_h_use_pixel="" shape_bottom_height="54" shape_bottom_opacity="100" shape_bottom_safe="yes" shape_bottom_index="0"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="left-t-right" animation_speed="1000" animation_delay="600" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="4" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="4/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Tagline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="4" overlay_alpha="50" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="8/12"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" css_animation="curtain-words" animation_delay="600"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_button button_color="accent" border_width="0" css_animation="bottom-t-top" animation_delay="800" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
