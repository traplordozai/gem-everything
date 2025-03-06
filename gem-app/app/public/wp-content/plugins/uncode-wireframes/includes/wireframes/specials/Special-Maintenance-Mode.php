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

$data[ 'name' ]             = esc_html__( 'Special Maintenance Mode', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Special-Maintenance-Mode.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" position_horizontal="left" position_vertical="middle" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="600"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="0" medium_width="4" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_uppercase="" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more."]Long headline to turn your visitors into users[/vc_custom_heading][vc_progress_bar values="%5B%7B%22label%22%3A%22STATUS%20PROGRESS%22%2C%22value%22%3A%2290%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%7D%5D" bar_color="accent" units="%"][vc_button size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
