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

$data[ 'name' ]             = esc_html__( 'Header Creative Freelance', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Freelance.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="7" top_padding="7" bottom_padding="7" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" css_animation="curtain" animation_delay="400" interval_animation="200"][uncode_hl_text color="'. uncode_wf_print_color( 'color-xsdn' ) .'" opacity=".25" height="15%" animate="true" offset="0.15em"]Long headline on two lines to turn your visitors into users[/uncode_hl_text][/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="2" shift_y="0" z_index="0"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" style="dark" gutter_size="4" overlay_alpha="50" medium_width="6" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="150"][vc_icon icon="fa fa-play" background_style="fa-rounded" size="fa-3x" icon_automatic="yes" shadow="yes" css_animation="zoom-in" animation_speed="1000" animation_delay="800" media_lightbox="'. uncode_wf_print_single_image( '80471' ) .'"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
