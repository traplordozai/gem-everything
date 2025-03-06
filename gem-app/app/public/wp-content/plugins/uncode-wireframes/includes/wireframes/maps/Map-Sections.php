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

$data[ 'name' ]             = esc_html__( 'Map Sections', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'maps' ];
$data[ 'custom_class' ]     = 'maps';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'maps/Map-Sections.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'"]Medium length display headline[/vc_custom_heading][vc_row_inner][vc_column_inner width="2/3"][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon position="left" icon="fa fa-mobile2" size="fa-2x" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="Tel: +44 (0)20 7405 7686"][/vc_icon][vc_icon position="left" icon="fa fa-envelope2" size="fa-2x" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="info@youremail.com"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="50" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" position_horizontal="left" expand_height="yes" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" mobile_height="360"][vc_gmaps map_color="accent" ui_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" zoom="13" map_saturation="-100" map_brightness="0" latlon="40.790278, -73.959722" address="401 7th Ave, New York, NY 10001, USA"][/vc_column][/vc_row]
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
