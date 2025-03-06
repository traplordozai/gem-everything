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

$data[ 'name' ]             = esc_html__( 'Shop Landing Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Landing-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="7" top_padding="2" bottom_padding="5" overlay_alpha="85" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" row_name="Man"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="left-t-right" animation_delay="200" width="6/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" desktop_visibility="yes" css_animation="curtain" animation_delay="400" interval_animation="200"]Short
headline[/vc_custom_heading][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][uncode_index el_id="index-150748445" index_type="carousel" loop="size:3|order_by:date|post_type:product" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="one-one" gutter_size="6" product_items="media|featured|onpost|original|hide-sale|enhanced-atc,title,price|default" carousel_interval="3000" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_mobile="yes" stage_padding="20" single_text="overlay" single_style="dark" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_v_position="top" single_reduced="half" single_padding="2" single_text_reduced="yes" single_title_dimension="h5" single_border="yes" custom_order="yes" order_ids="18933,19235,18934"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="4" overlay_alpha="50" gutter_size="2" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="-5" shift_y="0" shift_y_down="0" z_index="2" css_animation="right-t-left" animation_delay="400" width="3/12" link_to="|||"][vc_empty_space empty_h="1"][vc_empty_space empty_h="4"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="curtain" animation_delay="400" interval_animation="200"]Short
headline[/vc_custom_heading][vc_empty_space empty_h="4"][vc_empty_space empty_h="2"][/vc_column][/vc_row]
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
