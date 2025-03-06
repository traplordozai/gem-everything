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

$data[ 'name' ]             = esc_html__( 'Counter Progress Bar Equal Height', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Progress-Bar-Equal-Height.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="100" equal_height="yes" gutter_size="0" shift_y="0"][vc_column column_width_percent="100" position_horizontal="left" override_padding="yes" column_padding="5" overlay_alpha="100" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" sub_reduced="yes" text_uppercase=""]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="2/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" sub_reduced="yes" text_uppercase=""]Medium length display[/vc_custom_heading][vc_progress_bar values="%5B%7B%22label%22%3A%22Feature%20one%22%2C%22value%22%3A%2290%22%7D%2C%7B%22label%22%3A%22Feature%20two%22%2C%22value%22%3A%2280%22%7D%2C%7B%22label%22%3A%22Feature%20three%22%2C%22value%22%3A%2270%22%7D%5D" bar_color="accent" units="%"][/vc_column][/vc_row]
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
