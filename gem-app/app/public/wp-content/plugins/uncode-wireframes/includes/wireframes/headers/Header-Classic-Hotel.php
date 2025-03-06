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

$data[ 'name' ]             = esc_html__( 'Header Classic Hotel', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Hotel.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="center bottom" kburns="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" uncode_shortcode_id="513596" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="bottom-t-top" animation_speed="1000" animation_delay="200" width="1/1" uncode_shortcode_id="156773" column_width_pixel="1000"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" css_animation="curtain" animation_speed="1000" mobile_visibility="yes" uncode_shortcode_id="311228"]This is a tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" css_animation="curtain" animation_speed="1000" animation_delay="100" interval_animation="100" uncode_shortcode_id="180027"]Medium length
[uncode_rotating_text fx="zoom" words="message|tagline"]headline[/uncode_rotating_text][/vc_custom_heading][vc_icon icon="fa fa-play" background_style="fa-rounded" size="fa-2x" icon_automatic="yes" css_animation="zoom-in" animation_speed="1000" animation_delay="600" uncode_shortcode_id="661174" media_lightbox="'. uncode_wf_print_single_image( '88180' ) .'"][/vc_icon][/vc_column][/vc_row]
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
