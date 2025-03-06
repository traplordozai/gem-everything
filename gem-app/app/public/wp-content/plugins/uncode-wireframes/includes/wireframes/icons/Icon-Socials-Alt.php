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

$data[ 'name' ]             = esc_html__( 'Icon Socials Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Socials-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="50" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-facebook" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-twitter" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-linkedin" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-vimeo" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-spotify" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/6"][vc_icon icon="fa fa-dribbble" background_style="fa-squared" size="fa-3x" outline="yes" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column][/vc_row]
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
