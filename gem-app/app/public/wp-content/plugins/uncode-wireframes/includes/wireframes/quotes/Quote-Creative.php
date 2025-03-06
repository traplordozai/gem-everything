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

$data[ 'name' ]             = esc_html__( 'Quote Creative', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Creative.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" el_class="inverted-device-order"][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="3" shift_y="0" shift_y_down="0" z_index="2" width="2/3"][vc_empty_space empty_h="2"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" sub_lead="yes" subheading="— Marc Scott, Executive Officer"]" Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers and more. "[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="-3" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-three" shadow="yes" shadow_weight="lg"][/vc_column][/vc_row]
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
