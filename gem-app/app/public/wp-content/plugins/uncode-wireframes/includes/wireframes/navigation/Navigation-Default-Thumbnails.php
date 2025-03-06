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

$data[ 'name' ]             = esc_html__( 'Navigation Default Thumbnails', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'navigation' ];
$data[ 'custom_class' ]     = 'navigation';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'navigation/Navigation-Default-Thumbnails.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="172056" css=".vc_custom_1642158261515{border-top-width: 1px !important;padding-top: 9px !important;padding-bottom: 9px !important;}" border_color_type="uncode-palette" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="177861"][uncode_navigation hide_label="yes" stacked_layout="yes" stacked_layout_mobile="yes" title_custom_typo="yes" title_weight="500" title_height="fontheight-357766" parent_type="icon" parent_responsive="yes" parent_mobile_visibility="yes" thumbnails_shape="circle" thumbnails_responsive="yes" el_id="index-1" parent_icon="fa fa-th-small" prev_icon="fa fa-arrow-left2" next_icon="fa fa-arrow-right2"][/vc_column][/vc_row]
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
