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

$data[ 'name' ]             = esc_html__( 'Quote Small', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Small.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" style="inherited" row_name="Clients"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="4" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="zoom-in" animation_delay="200" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="900"][vc_gallery el_id="gallery-845248651" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 82903,82903,82903 ) ) .'" carousel_lg="1" carousel_md="1" carousel_sm="1" gutter_size="0" media_items="icon" carousel_type="fade" carousel_interval="5000" carousel_navspeed="200" carousel_nav_skin="dark" carousel_dots="yes" carousel_dots_mobile="yes" carousel_autoh="yes" carousel_textual="yes" stage_padding="0" single_style="dark" single_overlay_opacity="50" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h5" single_title_height="fontheight-357766" carousel_rtl="" single_half_padding="" single_title_uppercase="" single_title_bold="" single_title_serif="" single_no_background="" carousel_twitter="yes" title="Testimonials"][/vc_column][/vc_row]
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
