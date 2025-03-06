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

$data[ 'name' ]             = esc_html__( 'Content Cards Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Cards-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="4" bottom_padding="4" back_color="accent" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="157212" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="2" override_padding="yes" column_padding="3" style="dark" overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/4" uncode_shortcode_id="157796" overlay_color_type="uncode-palette"][vc_empty_space empty_h="5"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="557935"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="139133"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="120479"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="2" override_padding="yes" column_padding="3" style="dark" overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="100" width="1/4" uncode_shortcode_id="406053" overlay_color_type="uncode-palette"][vc_empty_space empty_h="5"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="557935"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="139133"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="120479"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="2" override_padding="yes" column_padding="3" style="dark" overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" width="1/4" uncode_shortcode_id="474837" overlay_color_type="uncode-palette"][vc_empty_space empty_h="5"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="557935"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="139133"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="120479"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="2" override_padding="yes" column_padding="3" style="dark" overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="300" width="1/4" uncode_shortcode_id="418623" overlay_color_type="uncode-palette"][vc_empty_space empty_h="5"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="557935"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="139133"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="120479"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][/vc_row]
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
