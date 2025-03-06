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

$data[ 'name' ]             = esc_html__( 'News Carousel Firm', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Carousel-Firm.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" el_class="gradient" row_name="Latest News"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="0" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-373564085" index_type="carousel" loop="size:9|order_by:date|post_type:post" carousel_lg="3" carousel_md="2" carousel_sm="1" thumb_size="two-one" gutter_size="3" post_items="media|featured|onpost|original,date,title,sep-one|full,extra,icon" portfolio_items="media|featured|onpost|original,icon|md" carousel_interval="0" carousel_navspeed="400" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="0" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_h_align="center" single_padding="2" single_text_lead="yes" single_title_dimension="h3" single_border="yes" single_css_animation="right-t-left" no_double_tap="yes" single_icon="fa fa-plus2"][/vc_column][/vc_row]
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
