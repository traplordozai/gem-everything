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

$data[ 'name' ]             = esc_html__( 'Counter Creative Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Creative-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" kburns="yes" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" position_vertical="middle" style="dark" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="bottom" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="6/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Long headline to turn your visitors[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_horizontal="left" position_vertical="bottom" style="dark" gutter_size="2" overlay_alpha="0" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="3/12"][uncode_counter value="1978" size="fontsize-338686" height="fontheight-179065" weight="700" ][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="3/12"][uncode_counter value="50" size="fontsize-338686" height="fontheight-179065" weight="700"  suffix="K"][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_separator ][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="1/4"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-layers2" size="fa-4x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature one"]Change the color to match your brand or vision.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="10" medium_width="0" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="1/4"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-genius" size="fa-4x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature two"]Change the color to match your brand or vision.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="1/4"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-recycle2" size="fa-4x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature three"]Change the color to match your brand or vision.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  width="1/4"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-profile-male" size="fa-4x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature four"]Change the color to match your brand or vision.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
