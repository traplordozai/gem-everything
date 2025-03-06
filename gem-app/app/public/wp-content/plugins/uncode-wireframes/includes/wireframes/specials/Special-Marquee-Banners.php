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

$data[ 'name' ]             = esc_html__( 'Special Marquee Banners', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Special-Marquee-Banners.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="85" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="689803"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="2" style="dark" back_color="color-wayh" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 84889 ) ) .'" bg_transition="mouse" bg_transition_time="0" bg_transition_pace_mouse="300" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="5" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="146492" back_color_type="uncode-palette" el_class="overflow-hidden-uncont" overlay_color_type="uncode-palette" link_to="url:%23" mobile_height="500"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="marquee-scroll-opposite" marquee_clone="yes" marquee_speed="0" uncode_shortcode_id="478803" heading_custom_size="clamp(35px,12vw,150px)"]Heading /[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="2" style="dark" back_color="color-wayh" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 84889 ) ) .'" bg_transition="mouse" bg_transition_time="0" bg_transition_pace_mouse="300" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="5" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="830910" el_class="overflow-hidden-uncont" overlay_color_type="uncode-palette" back_color_type="uncode-palette" link_to="url:%23" mobile_height="500"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="marquee-scroll-opposite" marquee_clone="yes" marquee_speed="0" uncode_shortcode_id="721675" heading_custom_size="clamp(35px,12vw,150px)"]Heading /[/vc_custom_heading][/vc_column][/vc_row]
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
