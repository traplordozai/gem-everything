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

$data[ 'name' ]             = esc_html__( 'Header Creative Bistrot', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Bistrot.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="70" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="964768" back_color_type="uncode-palette" column_width_pixel="1600"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/1" uncode_shortcode_id="311488"][vc_custom_heading text_color="accent" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="single-curtain" animation_speed="1200" uncode_shortcode_id="665882" text_color_type="uncode-palette"]Headline[/vc_custom_heading][vc_custom_heading text_color="accent" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" css_animation="curtain-words" animation_speed="1200" uncode_shortcode_id="167965" text_color_type="uncode-palette"]Medium length headline[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="90" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 84889,84889,84889 ) ) .'" bg_transition_time="0" bg_carousel_time="1000" bg_transition_threshold="20" overlay_color="accent" overlay_alpha="15" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="step" uncode_shortcode_id="112220" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="130526" mobile_height="55vh"][/vc_column][/vc_row]
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
