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

$data[ 'name' ]             = esc_html__( 'Empty Cart Two', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Empty-Cart-Two.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="90" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="100" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="zoom-in" animation_delay="200" width="1/1" column_width_pixel="500"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="one-one" alignment="center" shape="img-circle" media_width_pixel="100"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="curtain" animation_delay="300" interval_animation="100"][uncode_hl_text color="color-uydo" opacity="1" height="8" animate="true" offset="0em"]Medium length display headline[/uncode_hl_text][/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision.[/vc_column_text][vc_button button_color="accent" size="btn-lg" radius="btn-circle" hover_fx="full-colored" border_width="0" scale_mobile="no" link="|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
