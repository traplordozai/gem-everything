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

$data[ 'name' ]             = esc_html__( 'Header Classic Yoga', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Yoga.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="70" overlay_animated="yes" overlay_animated_1_color="accent" overlay_animated_size="0.35" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="30" shape_bottom_color="accent" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="205831" back_color_type="uncode-palette" overlay_animated_1_color_type="uncode-palette" shape_bottom_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="714865"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1400" width="1/1" uncode_shortcode_id="135766" column_width_pixel="1000"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" color_blend="multiply" css_animation="curtain" animation_speed="1400" uncode_shortcode_id="133677" heading_custom_size="clamp(38px,6vw,75px)"]This is a long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" css_animation="curtain" animation_speed="1400" animation_delay="200" uncode_shortcode_id="197829"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_custom_heading][vc_button button_color="accent" size="btn-lg" hover_fx="full-colored" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="498689"]Click the button[/vc_button][vc_empty_space][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0" z_index="0" uncode_shortcode_id="976688" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="3" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_visibility="yes" mobile_width="0" css_animation="bottom-t-top" animation_speed="1400" animation_delay="400" width="2/12" uncode_shortcode_id="117891"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shadow="yes" shadow_weight="std" css_animation="parallax" parallax_intensity="2" uncode_shortcode_id="606496"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="2" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" css_animation="bottom-t-top" animation_speed="1400" animation_delay="300" width="3/12" uncode_shortcode_id="997455"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shadow="yes" shadow_weight="std" uncode_shortcode_id="120587"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_width="4" mobile_width="0" css_animation="bottom-t-top" animation_speed="1400" width="4/12" uncode_shortcode_id="506143"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shadow="yes" shadow_weight="lg" shadow_darker="yes" css_animation="parallax" parallax_intensity="3" uncode_shortcode_id="197486"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="-2" shift_y="0" shift_y_down="0" z_index="2" medium_width="2" mobile_visibility="yes" mobile_width="0" css_animation="bottom-t-top" animation_speed="1400" animation_delay="600" width="2/12" uncode_shortcode_id="786288"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shadow="yes" shadow_weight="std" css_animation="parallax" parallax_intensity="2" uncode_shortcode_id="182833"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="-3" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" css_animation="bottom-t-top" animation_speed="1400" animation_delay="200" width="3/12" uncode_shortcode_id="337277"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shadow="yes" shadow_weight="lg" css_animation="parallax" parallax_intensity="1" uncode_shortcode_id="498347"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
