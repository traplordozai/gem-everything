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

$data[ 'name' ]             = esc_html__( 'Header Classic Logistic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Logistic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 84889,84889 ) ) .'" bg_transition_time="300" bg_carousel_time="3000" bg_transition_threshold="0" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="784130" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1400" width="1/1" mobile_height="340" uncode_shortcode_id="400814"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="512458"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="6" align_mobile="align_center_mobile" mobile_width="0" width="2/3" uncode_shortcode_id="175567"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" css_animation="curtain-words" animation_speed="1200" uncode_shortcode_id="458956" heading_custom_size="clamp(42px,8vw,80px)"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="205128"]Change the color to match your brand or vision, add your logo.[/vc_column_text][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_button button_color="accent" size="btn-lg" hover_fx="full-colored" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="198191"]Click the button[/vc_button][vc_empty_space empty_h="4"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="200647"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
