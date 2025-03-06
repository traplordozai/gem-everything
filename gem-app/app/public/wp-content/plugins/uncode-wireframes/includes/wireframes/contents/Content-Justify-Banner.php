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

$data[ 'name' ]             = esc_html__( 'Content Justify Banner', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Justify-Banner.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="214076" column_width_pixel="1500"][vc_column column_width_percent="100" position_vertical="justify" align_horizontal="align_right" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="xl" width="1/2" uncode_shortcode_id="725324" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" uncode_shortcode_id="189949"]Medium length headline[/vc_custom_heading][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1" uncode_shortcode_id="190492"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="178213" heading_custom_size="clamp(16px, 3vw, 26px)"]Unveil your style with our exclusive Black Friday deals, where fashion meets savings, offering the perfect opportunity to elevate your wardrobe with elegance and flair.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="160563"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_transform="uppercase" uncode_shortcode_id="899152" heading_custom_size="clamp(30px, 3vw, 25px)"]Discover Now[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="208739"][vc_icon icon="fa fa-arrow-right2" background_style="fa-rounded" size="fa-2x" uncode_shortcode_id="208807"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" back_image="'. uncode_wf_print_single_image( '80471' ) .'" back_position="center bottom" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="xl" width="1/2" uncode_shortcode_id="120914" mobile_height="33vh"][/vc_column][/vc_row]
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
