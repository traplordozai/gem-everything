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

$data[ 'name' ]             = esc_html__( 'Quote Split Fullwidth', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Split-Fullwidth.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="4" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1555597678984{border-top-width: 1px !important;border-bottom-width: 1px !important;}" el_class="inverted-device-order"][vc_column column_width_use_pixel="yes" position_vertical="middle" override_padding="yes" column_padding="2" overlay_alpha="50" gutter_size="3" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2" column_width_pixel="528"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" text_color="accent"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]" Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more. "[/vc_custom_heading][vc_column_text]— Marc Scott, Executive Officer[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_percent="100" media_ratio="four-three"][/vc_column][/vc_row]
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
