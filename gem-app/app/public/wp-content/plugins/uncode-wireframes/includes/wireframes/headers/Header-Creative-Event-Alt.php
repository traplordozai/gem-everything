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

$data[ 'name' ]             = esc_html__( 'Header Creative Event Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Event-2024.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="1" top_padding="1" bottom_padding="1" back_color="accent" overlay_alpha="50" equal_height="yes" gutter_size="1" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="661164" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="8/12" mobile_height="55vh" uncode_shortcode_id="100094" back_color_type="uncode-palette"][vc_empty_space empty_h="3"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="202041" heading_custom_size="clamp(55px,8vw,150px)"]Medium length headline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="160146"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" uncode_shortcode_id="129174" limit_content=""][vc_column_inner column_width_percent="50" position_horizontal="left" gutter_size="2" override_padding="yes" column_padding="3" back_color="color-gyho" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/1" uncode_shortcode_id="175384" back_color_type="uncode-palette" mobile_height="400"][vc_custom_heading text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="accent" radius="lg" uncode_shortcode_id="175875" text_color_type="uncode-palette" back_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="165948"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="3"][vc_button border_width="0" scale_mobile="no" uncode_shortcode_id="189544"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" uncode_shortcode_id="191702" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" radius="hg" width="1/1" mobile_height="300" uncode_shortcode_id="266059" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" uncode_shortcode_id="472431" media_width_pixel="80"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="213676"]This is a long headline to turn your visitors into users for your website[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="178526"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
