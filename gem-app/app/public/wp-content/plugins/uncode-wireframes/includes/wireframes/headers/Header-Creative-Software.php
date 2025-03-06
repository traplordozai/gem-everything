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

$data[ 'name' ]             = esc_html__( 'Header Creative Software', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Software.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="50" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="843786" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="124036"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="185461" column_width_pixel="960"][vc_custom_heading text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="accent" radius="sm" uncode_shortcode_id="439853" back_color_type="uncode-palette" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" inline_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 80471 ) ) .'" media_height="100" uncode_shortcode_id="133263" heading_custom_size="clamp(45px,6vw,70px)"]Long headline to turn your [uncode_inline_image] visitors into [uncode_rotating_text fx="zoom" words="customers|revenue"]users[/uncode_rotating_text][/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" css_animation="curtain" animation_speed="1000" animation_delay="400" uncode_shortcode_id="188347"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_button button_color="accent" size="btn-lg" hover_fx="full-colored" border_width="0" scale_mobile="no" uncode_shortcode_id="117754" button_color_type="uncode-palette"]Click the button[/vc_button][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '130535' ) .'" back_position="center bottom" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step" shape_top_h_use_pixel="true" shape_top_height_percent="28" shape_top_opacity="100" shape_top_index="0" bottom_divider="step" uncode_shortcode_id="143471" back_color_type="uncode-palette" back_size="initial"][vc_column column_width_percent="100" position_vertical="bottom" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="2" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="760603" overlay_color_type="uncode-palette" el_class="background-drop"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shape="img-round" shadow="yes" shadow_weight="lg" shadow_darker="yes" uncode_shortcode_id="191808"][/vc_column][/vc_row]
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
