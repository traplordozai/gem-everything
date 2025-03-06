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

$data[ 'name' ]             = esc_html__( 'Icon Heading', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Heading.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" overlay_alpha="50" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" row_name="About Us"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" overlay_alpha="100" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="600"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Long headline on two lines of text to turn your visitors into users[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="100" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="100" medium_width="3" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/4"][vc_icon icon="fa fa-video3" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" linked_title="yes" align="left" title="Feature one"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="100" medium_width="3" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/4"][vc_icon icon="fa fa-mobile2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" align="left" title="Feature two"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="100" medium_width="3" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0"  zoom_width="0" zoom_height="0" width="1/4"][vc_icon icon="fa fa-tools" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" linked_title="yes" align="left" title="Feature three"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_visibility="yes" medium_width="3" mobile_width="7" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_icon icon="fa fa-layers2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" align="left" title="Feature four"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
