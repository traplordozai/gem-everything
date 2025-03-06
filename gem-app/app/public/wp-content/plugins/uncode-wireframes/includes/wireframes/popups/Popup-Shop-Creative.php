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

$data[ 'name' ]             = esc_html__( 'Popup Shop Creative', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'popups' ];
$data[ 'custom_class' ]     = 'popups';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'popups/Popup-Shop-Creative.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" uncode_shortcode_id="110439" el_class="pp-odd"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" preserve_border="yes" preserve_border_tablet="yes" preserve_border_mobile="yes" border_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" width="1/1" uncode_shortcode_id="112320" css=".vc_custom_1712138033614{border-top-width: 9px !important;border-right-width: 9px !important;border-bottom-width: 9px !important;border-left-width: 9px !important;}" border_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" uncode_shortcode_id="138151" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="114378" mobile_height="27vh"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="113051" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="970776"]Medium length headline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="172036" heading_custom_size="clamp(60px,4vw,70px)"]10$ OFF[/vc_custom_heading][vc_empty_space empty_h="3" mobile_visibility="yes"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="313641"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_column_text uncode_shortcode_id="162175"][pum_sub_form name_field_type="disbaled" privacy_consent_enabled="no" disable_labels="yes" form_alignment="left"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
