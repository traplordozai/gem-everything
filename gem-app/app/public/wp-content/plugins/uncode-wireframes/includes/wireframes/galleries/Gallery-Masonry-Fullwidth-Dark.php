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

$data[ 'name' ]             = esc_html__( 'Gallery Masonry Fullwidth Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Masonry-Fullwidth-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_percent="100" position_horizontal="left" position_vertical="bottom" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-43823678" isotope_mode="packery" medias="'. uncode_wf_print_multiple_images( array( 80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462 ) ) .'" explode_albums="yes" filtering="yes" filtering_full_width="yes" filtering_position="right" filter_all_opposite="yes" filtering_uppercase="yes" filter_mobile="yes" gutter_size="2" media_items="media,icon" screen_lg="1100" screen_md="760" screen_sm="100" single_width="2" single_overlay_opacity="50" single_h_align="center" single_padding="2" single_icon="fa fa-plus2" single_border="yes" single_css_animation="zoom-in" lbox_caption="yes" lbox_social="yes" carousel_rtl="" single_title_uppercase="" single_title_serif="" single_no_background=""][/vc_column][/vc_row]
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
