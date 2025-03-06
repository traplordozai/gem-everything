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

$data[ 'name' ]             = esc_html__( 'Map Icons', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'maps' ];
$data[ 'custom_class' ]     = 'maps';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'maps/Map-Icons.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="600"][vc_custom_heading heading_semantic="h3" sub_lead="yes" sub_reduced="yes" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more."]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon icon="fa fa-mobile2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="Tel: +44 (0)20 7405 7686"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon icon="fa fa-envelope2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="info@youremail.com"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon icon="fa fa-map-pin" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="401 7th Ave, New York, NY 10001, USA"][/vc_icon][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="0"][vc_gmaps map_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" ui_color="accent" zoom="13" map_saturation="-100" map_brightness="5" latlon="40.7143528, -74.0059731" size="500"][/vc_column][/vc_row]
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
