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

$data[ 'name' ]             = esc_html__( 'Portfolio Studio', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Studio.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="bottom-t-top" animation_speed="1000" animation_delay="400" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="2/12"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="3" sticky="yes" width="8/12"][uncode_index el_id="index-1" isotope_mode="fitRows" loop="size:1|order_by:date|post_type:portfolio" gutter_size="0" portfolio_items="media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" images_size="three-two" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim_move="yes" single_padding="2" single_title_dimension="h4" single_shadow="yes" shadow_weight="lg" single_border="yes"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="2/12"][uncode_index el_id="index-2" isotope_mode="fitRows" loop="size:1|order_by:date|post_type:portfolio" gutter_size="0" portfolio_items="title" screen_lg="1000" screen_md="600" screen_sm="480" single_width="12" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim_move="yes" single_padding="0" single_title_dimension="h4" single_shadow="yes" shadow_weight="lg" single_border="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="bottom-t-top" animation_speed="1000" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="2/12"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="3" width="8/12"][uncode_index el_id="index-3" isotope_mode="fitRows" loop="size:1|order_by:date|post_type:portfolio" gutter_size="0" portfolio_items="media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" images_size="three-two" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim_move="yes" single_padding="2" single_title_dimension="h4" single_shadow="yes" shadow_weight="lg" shadow_darker="yes" single_border="yes" offset="1"][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="2/12"][uncode_index el_id="index-4" isotope_mode="fitRows" loop="size:1|order_by:date|post_type:portfolio" gutter_size="0" portfolio_items="title" screen_lg="1000" screen_md="600" screen_sm="480" single_width="12" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim_move="yes" single_padding="0" single_title_dimension="h4" single_shadow="yes" shadow_weight="lg" single_border="yes" offset="1"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
