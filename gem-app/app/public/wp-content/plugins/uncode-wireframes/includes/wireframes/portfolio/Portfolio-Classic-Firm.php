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

$data[ 'name' ]             = esc_html__( 'Portfolio Classic Firm', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Classic-Firm.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" el_class="gradient portfolio" row_name="Works" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="0" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-48561198980" index_type="carousel" loop="size:6|order_by:date|post_type:portfolio" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="fluid" carousel_height_viewport="80" gutter_size="4" portfolio_items="media|featured|onpost|original,icon|md" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="25" single_text="overlay" single_shape="round" radius="xs" single_overlay_opacity="50" single_h_align="center" single_padding="2" single_shadow="yes" shadow_weight="xl" single_border="yes" single_css_animation="right-t-left" post_matrix="matrix" matrix_items="e30=" single_icon="fa fa-plus2"][/vc_column][/vc_row]
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
