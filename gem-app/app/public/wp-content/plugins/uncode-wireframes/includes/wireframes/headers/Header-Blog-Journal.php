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

$data[ 'name' ]             = esc_html__( 'Header Blog Journal', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Blog-Journal.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="75" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="3"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-1" isotope_mode="fitRows" loop="size:3|order_by:date|post_type:post" style_preset="metro" single_height_viewport="yes" gutter_size="0" post_items="media|featured|onpost|poster,date,title,spacer|half" screen_lg="960" screen_md="480" screen_sm="480" single_text="overlay" single_width="3" single_fluid_height="75" single_overlay_opacity="49" single_text_visible="yes" single_text_anim_type="btt" single_overlay_visible="yes" single_v_position="bottom" single_reduced="three_quarter" single_reduced_mobile="yes" single_padding="3" single_title_dimension="h1" single_border="yes" single_css_animation="alpha-anim" single_animation_delay="200" post_matrix="matrix" matrix_amount="3" no_double_tap="yes" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsInNpbmdsZV90aXRsZV9kaW1lbnNpb24iOiJmb250c2l6ZS0xNTU5NDQiLCJzaW5nbGVfcmVkdWNlZCI6InRocmVlX3F1YXJ0ZXIiLCJzaW5nbGVfdGl0bGVfd2VpZ2h0IjoiIiwic2luZ2xlX3RpdGxlX3NwYWNlIjoiIiwic2luZ2xlX292ZXJsYXlfb3BhY2l0eSI6IjUwIn19"][/vc_column][/vc_row]
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
