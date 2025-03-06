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

$data[ 'name' ]             = esc_html__( 'Quote Carousel Stage Padding', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Carousel-Stage-Padding.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="50" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-565644378" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 82903,82903,82903,82903 ) ) .'" carousel_lg="1" carousel_md="1" carousel_sm="1" gutter_size="4" media_items="media|lightbox|poster" carousel_interval="5000" carousel_navspeed="200" carousel_loop="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_autoh="yes" carousel_textual="yes" stage_padding="75" single_style="dark" single_overlay_opacity="50" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h5" single_title_height="fontheight-357766" single_css_animation="zoom-in" single_animation_delay="200" carousel_rtl="" single_half_padding="" single_title_uppercase="" single_title_bold="" single_title_serif="" single_no_background="" carousel_twitter="yes"][/vc_column][/vc_row]
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
