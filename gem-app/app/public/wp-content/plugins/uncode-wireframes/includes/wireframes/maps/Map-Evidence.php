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

$data[ 'name' ]             = esc_html__( 'Map Evidence', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'maps' ];
$data[ 'custom_class' ]     = 'maps';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'maps/Map-Evidence.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="40" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_fixed="yes" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="900"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="100" equal_height="yes" gutter_size="1" shift_y="0" style="inherited"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" shadow="sm" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full="" link_to="||" css=".vc_custom_1554731853853{padding-top: 9px !important;padding-right: 9px !important;padding-bottom: 9px !important;padding-left: 9px !important;}"][vc_gmaps map_color="color-wayh" ui_color="color-prif" zoom="13" map_saturation="-100" map_brightness="0" latlon="51.50735, -0.12776" size="400"][/vc_column_inner][/vc_row_inner][vc_column_text]Change the color to match your brand or vision and more.[/vc_column_text][vc_button button_color="accent" border_width="0" link="url:%23||target:%20_blank|"]Click the button[/vc_button][/vc_column][/vc_row]
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
