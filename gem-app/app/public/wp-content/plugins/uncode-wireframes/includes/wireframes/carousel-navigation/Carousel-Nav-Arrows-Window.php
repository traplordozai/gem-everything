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

$data[ 'name' ]             = esc_html__( 'Carousel Nav Arrows Window', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'carousel-navigation' ];
$data[ 'custom_class' ]     = 'carousel-navigation';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'carousel-navigation/Carousel-Nav-Arrows-Window.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="145624" border_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="293333"][vc_gallery el_id="gallery-1234567890" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-two" gutter_size="0" media_items="media|nolink|original,icon" carousel_interval="0" carousel_navspeed="400" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="409049"][uncode_carousel_nav padding="0" arrows_position="el_absolute" arrows_width="window" arrows_v_align="middle" h_align="center" arrows_padding="2" arrow_style="round" icon="fa fa-arrow-right2" hide_counter="yes" uncode_shortcode_id="129899"][/vc_column][/vc_row]
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
