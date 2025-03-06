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

$data[ 'name' ]             = esc_html__( 'Content Justify Wide Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Justify-Wide-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="90" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="2" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="162812" css=".vc_custom_1708589138092{border-top-width: 1px !important;border-bottom-width: 1px !important;padding-right: 18px !important;padding-left: 18px !important;}" border_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" back_image="'. uncode_wf_print_single_image( '84889' ) .'" multiple_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 137987 ) ) .'" parallax="yes" bg_transition="scroll" bg_transition_time="200" bg_transition_threshold="50" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="755027" mobile_height="400" overlay_color_type="uncode-palette"][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="135240" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="142749" heading_custom_size="clamp(30px, 4vw, 50px)"]Medium length headline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="469261" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="6" align_mobile="align_center_mobile" mobile_width="0" width="10/12" uncode_shortcode_id="120404"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="164783" heading_custom_size="clamp(20px, 3vw, 30px)"]Unlock exclusive deals, sign up for our newsletter for access to special prices and offers.[/vc_custom_heading][vc_empty_space][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="501944"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
