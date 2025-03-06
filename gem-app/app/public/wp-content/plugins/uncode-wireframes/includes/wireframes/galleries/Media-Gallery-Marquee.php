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

$data[ 'name' ]             = esc_html__( 'Media Gallery Marquee', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Media-Gallery-Marquee.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="color-wayh" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="170425" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="100890"][vc_gallery el_id="gallery-45678" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471,80471,80471,80471,80471 ) ) .'" gutter_size="3" linear_width="clamp(150px, 18vw, 320px)" linear_animation="marquee-scroll-opposite" linear_speed="0" marquee_clone="yes" draggable="yes" media_items="media|lightbox|original,title" single_text="under" css_grid_images_size="four-five" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_padding="1" single_border="yes" lbox_no_tmb="yes" custom_cursor="blur" uncode_shortcode_id="162422"][/vc_column][/vc_row]
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
