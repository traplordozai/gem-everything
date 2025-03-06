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

$data[ 'name' ]             = esc_html__( 'Content Grid Icons', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Grid-Icons.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="50" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-wayh" overlay_alpha="100" equal_height="yes" gutter_size="0" shift_y="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_icon icon="fa fa-heart2" size="fa-4x" align="" title="Feature one"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column][vc_column column_width_percent="100" position_horizontal="left" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="100" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3" mobile_height="260"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_icon icon="fa fa-circle-compass" size="fa-4x" align="" title="Feature two"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="50" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-wayh" overlay_alpha="100" equal_height="yes" gutter_size="0" shift_y="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="100" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_height="0" width="1/3" mobile_height="260"][/vc_column][vc_column column_width_percent="100" position_horizontal="left" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_icon icon="fa fa-puzzle" size="fa-4x" align="" title="Feature three"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column][vc_column column_width_percent="100" position_horizontal="left" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="100" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3" mobile_height="260"][/vc_column][/vc_row]
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
