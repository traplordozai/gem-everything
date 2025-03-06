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

$data[ 'name' ]             = esc_html__( 'Portfolio Carousel Fullscreen', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Carousel-Fullscreen.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" style="inherited" row_name="blog" shape_dividers=""][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-36613222" index_type="carousel" loop="size:9|order_by:date|post_type:portfolio" carousel_lg="3" carousel_md="2" carousel_sm="1" thumb_size="fluid" gutter_size="0" portfolio_items="media|featured|onpost|original,category,title,spacer|two" carousel_interval="0" carousel_navspeed="200" carousel_loop="yes" carousel_nav="yes" carousel_nav_mobile="yes" carousel_dots="yes" carousel_dots_mobile="yes" carousel_dots_inside="yes" stage_padding="0" single_text="overlay" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_overlay_anim="no" single_image_anim_move="yes" single_h_align="center" single_h_align_mobile="center" single_v_position="bottom" single_padding="3" single_text_reduced="yes" single_title_dimension="h4" single_border="yes" single_css_animation="right-t-left" single_animation_speed="200" single_animation_delay="400" items="e30="][/vc_column][/vc_row]
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
