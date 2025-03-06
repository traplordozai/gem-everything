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

$data[ 'name' ]             = esc_html__( 'Content Columns Links', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Columns-Links.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" el_class="inverted-device-order"][vc_column column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" el_class="inverted-device-order"][vc_column column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" radius="sm" width="1/3"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" subheading="Change the color to match your brand and more."]Medium length headline[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" icon="fa fa-arrow-right2" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
