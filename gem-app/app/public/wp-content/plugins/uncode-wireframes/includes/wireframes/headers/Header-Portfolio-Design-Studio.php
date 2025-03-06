<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Header Portfolio Design Studio', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Portfolio-Design-Studio.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_section back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" content_parallax="0" uncode_shortcode_id="132898" back_color_type="uncode-palette"][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="4" sticky="yes" content_parallax="0" uncode_shortcode_id="285352"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="931770"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" css_animation="curtain-words" animation_speed="1000" animation_delay="200" interval_animation="100" uncode_shortcode_id="194209" heading_custom_size="clamp(30px,14vw,275px)"]Long Text Heading[/vc_custom_heading][uncode_vertical_text fixed="yes" text_align="bottom" position="right" flip="yes" vertical_text_h_pos="-3" vertical_text_v_pos="2" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" show_on_top="yes" uncode_shortcode_id="139065" text_color_type="uncode-palette"]Heading ⸻[/uncode_vertical_text][uncode_vertical_text fixed="yes" text_align="bottom" vertical_text_h_pos="3" vertical_text_v_pos="2" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" show_on_top="yes" hide_header="yes" uncode_shortcode_id="107869" text_color_type="uncode-palette"]⸻ Heading[/uncode_vertical_text][/vc_column][/vc_row][vc_row row_height_percent="100" back_image="'. uncode_wf_print_single_image( '80471' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 146478,143106 ) ) .'" bg_transition="scroll" bg_transition_time="0" bg_transition_threshold="40" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" css_animation="scroll-trigger" animation_scale_val="65" animation_opacity="100" animation_x="0" animation_y="0" animation_blur="0" animation_rotate="0" animation_perspective="0" animation_offset_top="100" animation_offset_bottom="150" disable_mobile="yes" disable_tablet="yes" content_parallax="0" uncode_shortcode_id="914948"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="199060" mobile_height="60vh"][/vc_column][/vc_row][/vc_section]
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
