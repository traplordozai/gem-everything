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

$data[ 'name' ]             = esc_html__( 'Gallery Grid Fullwidth', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Grid-Fullwidth.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_gallery el_id="gallery-9751014" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471,80471 ) ) .'" gutter_size="1" screen_lg="1000" screen_md="600" screen_sm="480" single_width="2" images_size="four-three" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_h_align="center" single_padding="2" single_icon="fa fa-plus2" single_border="yes" single_css_animation="alpha-anim" single_animation_speed="600" single_animation_delay="100" lbox_caption="yes" lbox_social="yes" lbox_deep="yes" lbox_no_tmb="yes" lbox_no_arrows="yes"][/vc_column][/vc_row]
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
