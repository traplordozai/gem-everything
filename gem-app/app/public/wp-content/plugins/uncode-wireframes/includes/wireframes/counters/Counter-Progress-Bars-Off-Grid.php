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

$data[ 'name' ]             = esc_html__( 'Counter Progress Bars Off-Grid', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Progress-Bars-Off-Grid.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="40" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" mobile_height="340"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0"][vc_column_inner column_width_percent="100" gutter_size="4" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="3/12"][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_custom_heading heading_semantic="h3"]Short headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="4" style="dark" gutter_size="3" back_color="accent" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="-5" shift_y_down="0" z_index="0" shadow="lg" radius="std" shadow_responsive="yes" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Long headline on two lines of text to turn your visitors into users[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers and more.[/vc_column_text][vc_progress_bar values="%5B%7B%22label%22%3A%22Tagline%20one%22%2C%22value%22%3A%2290%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%7D%2C%7B%22label%22%3A%22Tagline%20two%22%2C%22value%22%3A%2280%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%7D%2C%7B%22label%22%3A%22Tagline%20three%22%2C%22value%22%3A%2270%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%7D%5D"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
