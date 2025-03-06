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

$data[ 'name' ]             = esc_html__( 'Gallery Simple', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Simple.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-3" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471,80471,80471,80471 ) ) .'" gutter_size="1" media_items="media,icon" screen_lg="1000" screen_md="600" screen_sm="480" single_width="3" images_size="three-two" single_overlay_opacity="50" single_text_anim_type="btt" single_h_align="center" single_padding="2" single_icon="fa fa-search3" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" lbox_caption="yes" no_double_tap="yes" carousel_rtl="" single_title_uppercase="" single_title_bold="" single_title_serif="" onclick="link_image" custom_links_target="_self" items="eyI4ODY4X2kiOnsic2luZ2xlX3dpZHRoIjoiNCIsInNpbmdsZV9oZWlnaHQiOiI0In0sIjg4NjJfaSI6eyJzaW5nbGVfd2lkdGgiOiI0Iiwic2luZ2xlX2hlaWdodCI6IjQifSwiODg2MF9pIjp7InNpbmdsZV93aWR0aCI6IjQifX0=" single_half_padding="" single_no_background=""][/vc_column][/vc_row]
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
