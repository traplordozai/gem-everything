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

$data[ 'name' ]             = esc_html__( 'Logo-Marquee', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Logo-Marquee.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="271333" shape_dividers=""][vc_column width="1/1"][vc_gallery el_id="gallery-23456" type="linear" medias="'. uncode_wf_print_multiple_images( array( 17917,17917,17917,17917,17917,17917,17917,17917,17917,17917 ) ) .'" gutter_size="5" linear_width="clamp(100px, 8vw, 180px)" linear_animation="marquee-opposite" linear_speed="0" linear_hover="pause" media_items="media|custom_link|original" css_grid_images_size="two-one" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="1" single_border="yes" uncode_shortcode_id="511832" single_link="url:%23"][/vc_column][/vc_row]
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
