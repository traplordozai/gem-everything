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

$data[ 'name' ]             = esc_html__( 'Map Classic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'maps' ];
$data[ 'custom_class' ]     = 'maps';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'maps/Map-Classic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="50" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" row_height_use_pixel="yes" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" align_horizontal="align_center" expand_height="yes" overlay_alpha="100" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" zoom_width="0" zoom_height="0"][vc_gmaps zoom="13" map_saturation="-100" map_brightness="5" latlon="40.7143528, -74.0059731" size="500"][vc_column_text]401 7th Ave, New York, NY 10001, USA[/vc_column_text][/vc_column][/vc_row]
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
