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

$data[ 'name' ]             = esc_html__( 'Grid Media Sections', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Sections.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" position_vertical="middle" override_padding="yes" column_padding="4" style="dark" overlay_alpha="50" gutter_size="3" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="6/12" mobile_height="360" column_width_pixel="528"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="0" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="4" style="dark" gutter_size="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" mobile_height="260"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="4" style="dark" gutter_size="3" back_color="accent" back_image="'. uncode_wf_print_single_image( '84897' ) .'" overlay_color="accent" overlay_alpha="80" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" mobile_height="300"][vc_icon icon="fa fa-recycle2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h2' ) .'" text_reduced="yes" align="left" title="Feature two"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="0" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="4" style="dark" gutter_size="3" back_color="accent" back_image="'. uncode_wf_print_single_image( '84897' ) .'" overlay_color="accent" overlay_alpha="80" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" mobile_height="300"][vc_icon icon="fa fa-trophy2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h2' ) .'" text_reduced="yes" align="left" title="Feature one"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="4" style="dark" gutter_size="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" mobile_height="260"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
