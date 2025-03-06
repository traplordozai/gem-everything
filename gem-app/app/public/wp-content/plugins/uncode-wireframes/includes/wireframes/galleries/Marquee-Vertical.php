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

$data[ 'name' ]             = esc_html__( 'Marquee Vertical', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Marquee-Vertical.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="80" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-wayh" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="gradient" shape_top_h_use_pixel="true" shape_top_height_percent="25" shape_top_color="color-jevc" shape_top_opacity="50" shape_top_index="1" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="25" shape_bottom_color="color-jevc" shape_bottom_opacity="50" shape_bottom_index="1" uncode_shortcode_id="910585" back_color_type="uncode-palette" el_class="overflow-hidden" shape_top_color_type="uncode-palette" shape_bottom_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="443468" mobile_height="50vh"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="1" uncode_shortcode_id="351666" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/4" uncode_shortcode_id="109855"][vc_gallery el_id="gallery-987" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471,80471,80471 ) ) .'" gutter_size="2" linear_orientation="vertical" linear_width="100%" linear_animation="marquee-scroll" linear_speed="-4" marquee_clone="yes" media_items="media|nolink|original" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="142091"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/4" uncode_shortcode_id="113286"][vc_gallery el_id="gallery-876" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" gutter_size="2" linear_orientation="vertical" linear_width="100%" linear_animation="marquee-scroll-opposite" linear_speed="-4" marquee_clone="yes" media_items="media|nolink|original" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="920400"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/4" uncode_shortcode_id="409177"][vc_gallery el_id="gallery-765" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" gutter_size="2" linear_orientation="vertical" linear_width="100%" linear_animation="marquee-scroll" linear_speed="-4" marquee_clone="yes" media_items="media|nolink|original" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="169577"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="547444"][vc_gallery el_id="gallery-543" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" gutter_size="2" linear_orientation="vertical" linear_width="100%" linear_animation="marquee-scroll-opposite" linear_speed="-4" marquee_clone="yes" media_items="media|nolink|original" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="912022"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
