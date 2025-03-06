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

$data[ 'name' ]             = esc_html__( 'Content Shape Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Shape-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="141751"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="188283"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="698693" heading_custom_size="clamp(28px,4vw,50px)"]Long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="111039"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2"][vc_icon position="left" space_reduced="yes" icon="fa fa-minus2" icon_color="accent" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="164095" title="Change the color to match your brand or vision." icon_color_type="uncode-palette"][/vc_icon][vc_icon position="left" space_reduced="yes" icon="fa fa-minus2" icon_color="accent" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="164095" title="Change the color to match your brand or vision." icon_color_type="uncode-palette"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2"][vc_icon position="left" space_reduced="yes" icon="fa fa-minus2" icon_color="accent" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="164095" title="Change the color to match your brand or vision." icon_color_type="uncode-palette"][/vc_icon][vc_icon position="left" space_reduced="yes" icon="fa fa-minus2" icon_color="accent" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="164095" title="Change the color to match your brand or vision." icon_color_type="uncode-palette"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="496051" css=".vc_custom_1715591065832{padding-bottom: 0px !important;}" el_class="overflow-hidden"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="797811" el_class="unmask-blob-2"][/vc_column][/vc_row]
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
