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

$data[ 'name' ]             = esc_html__( 'Portfolio Studio Architecture', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Studio-Architecture.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="0" gutter_size="1" column_width_percent="100" shift_y="0" z_index="1" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_opacity="100" shape_bottom_index="0" row_name="Portfolio"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-1041816556233" index_type="carousel" loop="size:5|order_by:date|post_type:portfolio" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="fluid" carousel_height_viewport="80" gutter_size="5" product_items="title,price,media|featured|onpost|original" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="0" single_text="overlay" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_text_anim_type="btt" single_image_anim="no" single_h_align="center" single_v_position="bottom" single_padding="3" single_text_reduced="yes" single_title_dimension="h3" single_shadow="yes" shadow_weight="sm" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" single_animation_first="yes" custom_order="yes" order_ids="19264,19265,18999,18996,18998,18995,18997,18967"][/vc_column][/vc_row]
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
