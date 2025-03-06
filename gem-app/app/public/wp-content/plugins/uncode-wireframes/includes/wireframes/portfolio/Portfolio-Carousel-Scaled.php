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

$data[ 'name' ]             = esc_html__( 'Portfolio Carousel Scaled', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Carousel-Scaled.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="50" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="step" bottom_divider="gradient" shape_dividers=""][vc_column column_width_use_pixel="yes" position_vertical="bottom" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="900"][uncode_index el_id="index-8989138976" index_type="carousel" loop="size:5|order_by:date|post_type:portfolio" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-two" gutter_size="5" portfolio_items="media|featured|onpost|original,title" carousel_v_align="middle" carousel_interval="0" carousel_navspeed="700" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_half_opacity="yes" carousel_scaled="yes" carousel_pointer_events="yes" stage_padding="0" single_style="dark" single_overlay_color="color-wayh" single_overlay_opacity="50" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h5" single_shadow="yes" shadow_weight="xl" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="400" single_animation_first="yes"][/vc_column][/vc_row]
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
