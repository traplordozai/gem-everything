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

$data[ 'name' ]             = esc_html__( 'Content Content Carousel', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Content-Carousel.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" align_horizontal="align_center" style="light" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_slider slider_interval="5000" slider_navspeed="1000"][vc_row_inner row_inner_height_percent="0" overlay_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0"][vc_column_inner width="1/2"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100"][/vc_column_inner][vc_column_inner width="1/2"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0"][vc_column_inner width="1/2"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" shift_y="0"][vc_column_inner width="1/2"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100"][/vc_column_inner][vc_column_inner width="1/2"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/uncode_slider][/vc_column][/vc_row]
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
