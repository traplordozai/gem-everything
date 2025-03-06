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

$data[ 'name' ]             = esc_html__( 'News Carousel Stage Padding', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Carousel-Stage-Padding.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="step" el_class="demos"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][uncode_index el_id="index-1041816597" index_type="carousel" loop="size:4|order_by:date|post_type:post" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="fluid" carousel_height_viewport="80" gutter_size="5" post_items="media|featured|onpost|poster,title,text|excerpt|75" product_items="title,price,media|featured|onpost|original" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_pointer_events="yes" stage_padding="25" single_text="overlay" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_text_visible="yes" single_text_anim_type="btt" single_overlay_visible="yes" single_h_align="center" single_v_position="bottom" single_reduced="three_quarter" single_reduced_mobile="yes" single_h_position="center" single_padding="2" single_title_dimension="h4" single_title_height="fontheight-357766" single_shadow="yes" shadow_weight="lg" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" custom_order="yes" order_ids="19264,19265,18999,18996,18998,18995,18997,18967"][/vc_column][/vc_row]
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
