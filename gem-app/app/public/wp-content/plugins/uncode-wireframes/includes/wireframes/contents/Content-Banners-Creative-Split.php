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

$data[ 'name' ]             = esc_html__( 'Content Banners Creative Split', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Banners-Creative-Split.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="90" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="431458"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="1" override_padding="yes" column_padding="5" style="dark" back_color="color-jevc" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="left center" kburns="magnetic" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="187635" back_color_type="uncode-palette" column_width_pixel="480" overlay_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="290806"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shadow="yes" shadow_weight="lg" shadow_darker="yes" uncode_shortcode_id="102732" media_link="url:%23"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="1" style="dark" overlay_alpha="50" shift_x="0" shift_y="-2" shift_y_fixed="yes" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="710198"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="196974"]Headline[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="150562"]Shop Collection[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="1" override_padding="yes" column_padding="5" style="dark" back_image="'. uncode_wf_print_single_image( '84889' ) .'" kburns="magnetic" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="205572" column_width_pixel="480" overlay_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="359861"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shadow="yes" shadow_weight="lg" shadow_darker="yes" uncode_shortcode_id="189632" media_link="url:%23"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="1" style="dark" overlay_alpha="50" shift_x="0" shift_y="-2" shift_y_fixed="yes" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="284336"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="580619"]Headline[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="207027"]Shop Collection[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
