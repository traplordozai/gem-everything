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

$data[ 'name' ]             = esc_html__( 'Content List Services', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-List-Services.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="621486"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="182665"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="553715" heading_custom_size="clamp(30px,5vw,50px)"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_separator sep_color="" uncode_shortcode_id="473947"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="4/12" uncode_shortcode_id="165738"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="6" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="652707"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="122757"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="715031"][vc_column_inner width="1/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="103280"]01[/vc_custom_heading][/vc_column_inner][vc_column_inner width="5/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="797521"]Medium headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12" uncode_shortcode_id="129883"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" uncode_shortcode_id="976592" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="2" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="715031"][vc_column_inner width="1/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="924750"]02[/vc_custom_heading][/vc_column_inner][vc_column_inner width="5/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="991016"]Medium headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12" uncode_shortcode_id="129883"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="300" uncode_shortcode_id="142998" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="2" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="715031"][vc_column_inner width="1/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="216142"]03[/vc_custom_heading][/vc_column_inner][vc_column_inner width="5/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="152289"]Medium headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12" uncode_shortcode_id="129883"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="300" uncode_shortcode_id="199038" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
