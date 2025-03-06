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

$data[ 'name' ]             = esc_html__( 'Header Creative Designer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Designer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step_2_3" shape_top_flip="yes" shape_top_h_use_pixel="true" shape_top_height_percent="75" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" uncode_shortcode_id="456409" back_color_type="uncode-palette" shape_top_color_type="uncode-palette" back_size="initial"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="203723"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading text_color="accent" text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" sub_lead="yes" sub_reduced="yes" css_animation="curtain-words" animation_speed="800" uncode_shortcode_id="125146" text_color_type="uncode-palette"]Medium length headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="725234"][vc_column_inner column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="-5" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="2/3" uncode_shortcode_id="237066"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="parallax" parallax_intensity="4" parallax_centered="yes" uncode_shortcode_id="674807"][vc_button size="btn-link" custom_typo="yes" scale_mobile="no" css_animation="alpha-anim" animation_speed="800" animation_delay="600" icon="fa fa-arrow-down2" uncode_shortcode_id="806462" link="url:%23works"]Discover[/vc_button][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" parallax_intensity="2" width="1/3" uncode_shortcode_id="536493"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" css_animation="curtain" animation_speed="800" animation_delay="400" uncode_shortcode_id="787770" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="3" desktop_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][uncode_vertical_text text_align="top" position="right" flip="yes" vertical_text_h_pos="3" vertical_text_v_pos="2" z_index="0" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" mobile_visibility="yes" uncode_shortcode_id="421322"]⸻ Welcome[/uncode_vertical_text][/vc_column][/vc_row]
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
