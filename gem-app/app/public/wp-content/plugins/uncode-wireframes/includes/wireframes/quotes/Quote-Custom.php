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

$data[ 'name' ]             = esc_html__( 'Quote Custom', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'quotes' ];
$data[ 'custom_class' ]     = 'quotes';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'quotes/Quote-Custom.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" position_vertical="middle" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" media_width_pixel="100"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more."]Marc Scott, Executive Officer[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" link="url:%23|||" icon="fa fa-arrow-right2"]Click the button[/vc_button][/vc_column][vc_column width="1/3"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" media_width_pixel="100"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more."]Marc Scott, Executive Officer[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" link="url:%23|||" icon="fa fa-arrow-right2"]Click the button[/vc_button][/vc_column][vc_column width="1/3"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" media_width_pixel="100"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more."]Marc Scott, Executive Officer[/vc_custom_heading][vc_button size="btn-link" border_width="0" icon_position="right" link="url:%23|||" icon="fa fa-arrow-right2"]Click the button[/vc_button][/vc_column][/vc_row]
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
