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

$data[ 'name' ]             = esc_html__( 'Content Medias Off-Grid Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Medias-Off-Grid-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="0" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="7/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-three" shadow="yes"][/vc_column][vc_column column_width_percent="80" position_horizontal="left" overlay_alpha="50" gutter_size="2" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="5/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Long headline to turn your visitors[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="1"][vc_column column_width_percent="100" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="4" shift_y="3" shift_y_down="0" z_index="2" shadow="lg" width="4/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Medium length display headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][/vc_column][vc_column column_width_use_pixel="yes" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="2" shift_y="-5" shift_y_down="0" z_index="0" width="8/12" column_width_pixel="900"][vc_empty_space empty_h="2" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shadow="yes" shadow_weight="std"][/vc_column][/vc_row]
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
