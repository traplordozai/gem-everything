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

$data[ 'name' ]             = esc_html__( 'Counter Text Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Text-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="46" size="fontsize-338686" height="fontheight-179065" weight="600"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Feature one[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="15" size="fontsize-338686" height="fontheight-179065" weight="600" suffix="K"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Feature two[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="91" size="fontsize-338686" height="fontheight-179065" weight="600"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Feature three[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="5" size="fontsize-338686" height="fontheight-179065" weight="600"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Feature four[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][/vc_column][/vc_row]
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
