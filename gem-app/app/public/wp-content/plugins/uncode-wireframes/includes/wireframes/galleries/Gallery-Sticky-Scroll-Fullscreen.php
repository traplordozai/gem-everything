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

$data[ 'name' ]             = esc_html__( 'Gallery Sticky Scroll Fullscreen', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Sticky-Scroll-Fullscreen.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="267918" border_color_type="uncode-palette" back_color_type="uncode-palette" el_class="demo-section demo-dark-background" shape_dividers="" back_color_solid="#ff0000" overlay_color_type="uncode-palette" overlay_color_solid="#ff0000" border_color_solid="#ff0000"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="275481" back_color_type="uncode-palette" back_color_solid="#ff0000" overlay_color_type="uncode-palette" overlay_color_solid="#ff0000" border_color_type="uncode-palette" border_color_solid="#ff0000"][vc_gallery el_id="gallery-211280" type="sticky-scroll" medias="'. uncode_wf_print_multiple_images( array( 80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462 ) ) .'" sticky_thumb_size="relative" sticky_th_vh_lg="100" sticky_th_vh_md="100" sticky_th_vh_sm="100" gutter_size="0" media_items="media|nolink|original" single_overlay_color="color-jevc" single_overlay_opacity="15" single_image_anim="no" single_h_align="center" single_padding="2" single_border="yes" horizontal_th_size="vh" uncode_shortcode_id="111222"][/vc_column][/vc_row]
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
