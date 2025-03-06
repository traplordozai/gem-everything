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

$data[ 'name' ]             = esc_html__( 'Header Slider Creative Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Slider-Creative-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column width="1/1"][uncode_slider slider_interval="5000" slider_navspeed="700" slider_loop="yes"][vc_row_inner row_inner_height_percent="0" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="accent" overlay_alpha="80" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" css_animation="top-t-bottom" animation_delay="400" title=""]Short headline[/vc_custom_heading][vc_column_text text_lead="yes" css_animation="bottom-t-top" animation_delay="600"]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_icon icon="fa fa-arrow-down2" background_style="fa-rounded" size="fa-2x" outline="yes" css_animation="bottom-t-top" animation_speed="600" animation_delay="800" link="url:%23|||"][/vc_icon][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" css_animation="top-t-bottom" animation_delay="400" title=""]Short headline[/vc_custom_heading][vc_column_text text_lead="yes" css_animation="bottom-t-top" animation_delay="600"]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_icon icon="fa fa-arrow-down2" background_style="fa-rounded" size="fa-2x" outline="yes" css_animation="bottom-t-top" animation_speed="600" animation_delay="800" link="url:%23|||"][/vc_icon][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="90" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" css_animation="top-t-bottom" animation_delay="400" title=""]Short headline[/vc_custom_heading][vc_column_text text_lead="yes" css_animation="bottom-t-top" animation_delay="600"]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_icon icon="fa fa-arrow-down2" background_style="fa-rounded" size="fa-2x" outline="yes" css_animation="bottom-t-top" animation_speed="600" animation_delay="800" link="url:%23|||"][/vc_icon][/vc_column_inner][/vc_row_inner][/uncode_slider][/vc_column][/vc_row]w]
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
