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

$data[ 'name' ]             = esc_html__( 'Shop Techie', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Techie.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" el_class="products-carousel"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="0" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-4856116345675" index_type="carousel" loop="size:5|order_by:date|post_type:product" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-four" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|default" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="75" single_text="overlay" single_style="dark" single_overlay_opacity="50" single_text_visible="yes" single_text_anim_type="btt" single_overlay_anim="no" single_h_align="center" single_v_position="bottom" single_padding="1" single_text_reduced="yes" single_title_dimension="h6" single_title_weight="700" single_title_space="fontspace-781688" single_border="yes" single_css_animation="zoom-in"][/vc_column][/vc_row]
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
