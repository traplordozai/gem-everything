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

$data[ 'name' ]             = esc_html__( 'Portfolio Sticky Cards', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Sticky-Cards.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="2" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="step" uncode_shortcode_id="133109" back_color_type="uncode-palette" el_class="portfolio-row"][vc_column column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="542738"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="1" sticky="yes" uncode_shortcode_id="192618" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="113758"][uncode_index el_id="index-879821" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="1000" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_opacity="15" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="top" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" custom_cursor="diff" uncode_shortcode_id="997925" offset="0" heading_custom_size="clamp(25px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="5"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" sticky="yes" uncode_shortcode_id="814542" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="793672"][uncode_index el_id="index-879821" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="1000" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_opacity="15" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="top" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" custom_cursor="diff" uncode_shortcode_id="277066" offset="1" heading_custom_size="clamp(25px,5vw,60px)"][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="5"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" sticky="yes" uncode_shortcode_id="814542" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="202306"][uncode_index el_id="index-879821" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="1000" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_opacity="15" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="top" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" custom_cursor="diff" uncode_shortcode_id="152520" offset="2" heading_custom_size="clamp(25px,5vw,60px)"][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="5"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" sticky="yes" uncode_shortcode_id="814542" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="585693"][uncode_index el_id="index-879821" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="1000" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_opacity="15" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="top" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" custom_cursor="diff" uncode_shortcode_id="198911" offset="3" heading_custom_size="clamp(25px,5vw,60px)"][vc_empty_space empty_h="4" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="5"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="4" sticky="yes" uncode_shortcode_id="653320" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="161948"][uncode_index el_id="index-879821" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="1000" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_opacity="15" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="top" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" custom_cursor="diff" uncode_shortcode_id="395821" offset="4" heading_custom_size="clamp(25px,5vw,60px)"][vc_empty_space empty_h="5"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
