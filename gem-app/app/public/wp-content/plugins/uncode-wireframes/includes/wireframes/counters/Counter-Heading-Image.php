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

$data[ 'name' ]             = esc_html__( 'Counter Heading Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Heading-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" row_name="Team"][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="4" medium_width="5" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="7/12"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Long headline to turn your visitors into users[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][uncode_counter value="32" counter_color="accent" size="h1" height="fontheight-179065" weight="600" dimension="h1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_color="accent"]Feature one[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][uncode_counter value="120" counter_color="accent" size="h1" height="fontheight-179065" weight="600" dimension="h1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_color="accent"]Feature two[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][uncode_counter value="256" counter_color="accent" size="h1" height="fontheight-179065" weight="600" dimension="h1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_color="accent"]Feature three[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="5/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-four" shadow="yes" shadow_weight="lg"][/vc_column][/vc_row]
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
