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

$data[ 'name' ]             = esc_html__( 'Header Classic Consultants Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Consultants-2024.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="85" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="135952" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="139493"][vc_custom_heading text_color="accent" heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_weight="700" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="177413" text_color_type="uncode-palette"]Research &amp; strategy[/vc_custom_heading][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" inline_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471 ) ) .'" media_ratio="one-one" media_height="90" uncode_shortcode_id="147033" heading_custom_size="clamp(40px,7.5vw,100px)"]The marketing [uncode_inline_image] partner [uncode_inline_image] your business can count [uncode_inline_image][/vc_custom_heading][vc_empty_space empty_h="2"][vc_button button_color="accent" size="btn-lg" text_skin="yes" border_width="0" scale_mobile="no" link="url:https%3A%2F%2F1.envato.market%2FQ3bJP|target:_blank" button_color_type="uncode-palette" uncode_shortcode_id="189114"]Click the button[/vc_button][/vc_column][/vc_row]
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
