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

$data[ 'name' ]             = esc_html__( 'Quote Background', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Background.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="50" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-366919024" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 82903,82903,82903 ) ) .'" carousel_lg="1" carousel_md="1" carousel_sm="1" gutter_size="0" media_items="media|nolink|original" carousel_type="fade" carousel_interval="5000" carousel_navspeed="400" carousel_dots="yes" carousel_dots_mobile="yes" carousel_autoh="yes" carousel_textual="yes" stage_padding="0" single_overlay_opacity="50" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h3" single_title_height="fontheight-357766" single_css_animation="zoom-in" single_animation_delay="200" carousel_twitter="yes" title="Testimonials"][/vc_column][/vc_row]
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
