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

$data[ 'name' ]             = esc_html__( 'Content Author Grid', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Author-Grid.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="938548"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="5" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="213920" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_transform="uppercase" badge_style="yes" radius="sm" uncode_shortcode_id="308313" back_color_type="uncode-solid" back_color_solid="rgba(255,255,255,0.2)"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="319404"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="179195"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="0" override_padding="yes" column_padding="0" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="156921" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="sixteen-nine" alignment="center" uncode_shortcode_id="436063"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="103052"][vc_button border_width="0" scale_mobile="no" uncode_shortcode_id="106808" link="url:%23"]Follow me @youraccount[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
