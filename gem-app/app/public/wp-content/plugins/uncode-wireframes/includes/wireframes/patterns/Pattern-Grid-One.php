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

$data[ 'name' ]             = esc_html__( 'Pattern Grid One', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'patterns' ];
$data[ 'custom_class' ]     = 'patterns';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'patterns/Pattern-Grid-One.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row][vc_column width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="180762"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="6/12" uncode_shortcode_id="107691"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="159488"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="819728"][uncode_module_placeholder][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="876327"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_visibility="yes" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="3/12" uncode_shortcode_id="789950"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="100776"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="6/12" uncode_shortcode_id="120625"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="265952"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="207165"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="433247"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="6/12" uncode_shortcode_id="111960"][uncode_module_placeholder][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="209705"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="6/12" uncode_shortcode_id="876464"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" width="3/12" uncode_shortcode_id="185455"][uncode_module_placeholder][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_visibility="yes" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="3/12" uncode_shortcode_id="950587"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
