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

$data[ 'name' ]             = esc_html__( 'Popup Creative Software', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'popups' ];
$data[ 'custom_class' ]     = 'popups';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'popups/Popup-Creative-Software.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="538867" el_class="pp-even"][vc_column column_width_percent="100" position_horizontal="left" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" preserve_border="yes" preserve_border_tablet="yes" preserve_border_mobile="yes" border_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" shadow="std" width="1/1" uncode_shortcode_id="624885" back_color_type="uncode-palette" css=".vc_custom_1715770156966{border-top-width: 9px !important;border-right-width: 9px !important;border-bottom-width: 9px !important;border-left-width: 9px !important;}" border_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="672711"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="244222" column_width_pixel="550"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="297334" heading_custom_size="clamp(30px,4vw,50px)"]Long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading text_color="color-prif" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" uncode_shortcode_id="656976" text_color_type="uncode-palette" back_color_type="uncode-palette"]Heading[/vc_custom_heading][vc_empty_space empty_h="3"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="514564"]Change the color to match your brand or vision.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
