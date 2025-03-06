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

$data[ 'name' ]             = esc_html__( 'Header Shop Creative', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Shop-Creative.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" position_horizontal="left" position_vertical="middle" style="dark" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="400" width="1/1" mobile_height="300" link_to="||"][vc_row_inner row_inner_height_percent="80" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" top_divider="gradient"][vc_column_inner column_width_percent="100" position_vertical="bottom" override_padding="yes" column_padding="5" style="dark" gutter_size="3" back_image="'. uncode_wf_print_single_image( '23198' ) .'" back_position="center top" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="20" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="1200" width="7/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" sub_lead="yes" sub_reduced="yes" css_animation="curtain" animation_delay="1200" interval_animation="200"]Medium length display headline[/vc_custom_heading][vc_button size="" border_width="0" css_animation="bottom-t-top" animation_delay="2000" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="0" gutter_size="0" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="1200" width="5/12"][uncode_index el_id="index-193427" index_type="carousel" loop="size:3|order_by:date|post_type:post" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="fluid" carousel_height_viewport="50" gutter_size="0" post_items="media|featured|onpost|original,title,date" carousel_interval="5000" carousel_navspeed="1000" carousel_loop="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_dots_inside="yes" stage_padding="0" single_text="overlay" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim_move="yes" single_v_position="top" single_reduced="three_quarter" single_reduced_mobile="yes" single_padding="3" single_title_dimension="h4" single_border="yes"][uncode_index el_id="index-193426" index_type="carousel" loop="size:3|order_by:date|post_type:product|tax_query:63" index_back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" carousel_lg="1" carousel_md="2" carousel_sm="1" thumb_size="fluid" carousel_height_viewport="50" gutter_size="0" product_items="media|featured|onpost|original|show-sale|enhanced-atc,title,price|default" carousel_interval="3000" carousel_navspeed="1000" carousel_loop="yes" carousel_nav="yes" carousel_nav_mobile="yes" carousel_nav_skin="dark" stage_padding="0" single_text="overlay" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_v_position="top" single_padding="3" single_title_dimension="h4" single_border="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
