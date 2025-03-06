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

$data[ 'name' ]             = esc_html__( 'Team Members Carousel Fullwidth', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-Carousel-Fullwidth.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="0" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" style="inherited" css=".vc_custom_1555675677008{border-bottom-width: 1px !important;}"][vc_column width="1/1"][vc_gallery el_id="gallery-33778" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 84155,84155,84155,84155,84155,84155,84155,84155,84155,84155 ) ) .'" gallery_back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" carousel_lg="6" carousel_md="3" carousel_sm="1" thumb_size="three-four" gutter_size="0" media_items="media|lightbox|original,title,caption,team-social" carousel_interval="0" carousel_navspeed="400" carousel_nav="yes" carousel_dots="yes" stage_padding="0" single_overlay_opacity="50" single_h_align="center" single_reduced="three_quarter" single_h_position="center" single_padding="2" single_title_dimension="h5" single_border="yes" carousel_rtl="" single_half_padding="" single_title_uppercase="" single_title_serif="" single_no_background=""][/vc_column][/vc_row]
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
