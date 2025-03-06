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

$data[ 'name' ]             = esc_html__( 'Icon Left Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Left-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" top_divider="gradient" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-adjustments" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature one" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-flag2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature two" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3" link_to="|||"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-trophy2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature three" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-globe2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature four" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-beaker" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature five" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3" link_to="|||"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-global" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Feature six" link="|||"]Change the color to match your brand or vision, add your logo and more.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
