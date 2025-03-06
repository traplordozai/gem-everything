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

$data[ 'name' ]             = esc_html__( 'Header Blog Editorial', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Blog-Editorial.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="84" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" row_name="blog" el_class="overflow-hidden"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-1" loop="size:5|order_by:date|post_type:post" style_preset="metro" single_height_viewport="yes" gutter_size="0" post_items="media|featured|onpost|poster,date,title" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="960" screen_md="770" screen_sm="640" single_text="overlay" single_width="3" single_fluid_height="42" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="100" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_overlay_anim="no" single_v_position="bottom" single_reduced="three_quarter" single_reduced_mobile="yes" single_padding="3" single_title_dimension="h3" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="400" post_matrix="matrix" no_double_tap="yes" single_title_uppercase="" single_title_bold="yes" footer_position="left" carousel_rtl="" single_no_background="" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsInNpbmdsZV9oZWlnaHQiOiI4Iiwic2luZ2xlX3RpdGxlX2RpbWVuc2lvbiI6ImZvbnRzaXplLTE1NTk0NCIsInNpbmdsZV9yZWR1Y2VkIjoidGhyZWVfcXVhcnRlciIsInNpbmdsZV9mbHVpZF9oZWlnaHQiOiI4NCJ9fQ=="][/vc_column][/vc_row]
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
