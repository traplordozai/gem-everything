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

$data[ 'name' ]             = esc_html__( 'Content Wide Justify', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Wide-Justify.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="90" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" inverted_device_order="yes" uncode_shortcode_id="912736" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="191492" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="164016" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="2/3" uncode_shortcode_id="165737"][vc_column_text uncode_shortcode_id="270661"]Timeless elegance fused with a contemporary global perspective, crafting fashion with an authentic touch for every trendsetter.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="194530"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="201564" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/1" uncode_shortcode_id="195506"][vc_button border_width="0" uncode_shortcode_id="114761"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="justify" align_horizontal="align_right" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="left bottom" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/4" uncode_shortcode_id="115622" mobile_height="400" overlay_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="118435"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="170550"]Headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="691343"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="846743"]2024[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="919231"]Headline[/vc_custom_heading][/vc_column][/vc_row]
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
