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

$data[ 'name' ]             = esc_html__( 'Content Three Banners', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Three-Banners.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="2" top_divider="gradient" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_color="accent" shape_bottom_opacity="100" shape_bottom_index="0" column_width_pixel="1444" uncode_shortcode_id="214237" shape_bottom_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="532565"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="770" el_class="demo-center-section" uncode_shortcode_id="639131"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" sub_lead="yes" sub_reduced="yes" el_class="demo-heading" uncode_shortcode_id="751556" heading_custom_size="clamp(30px,4vw,50px)"]Medium length headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="878063"][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" radius="lg" shadow="lg" shadow_hover="yes" shadow_hover_weight="std" width="1/3" uncode_shortcode_id="582422" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="180310" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." heading_custom_size="clamp(25px,4vw,28px)"]Medium length headline[/vc_custom_heading][vc_button button_color="accent" size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" button_color_type="uncode-palette" uncode_shortcode_id="172447"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" radius="lg" shadow="lg" shadow_hover="yes" shadow_hover_weight="std" width="1/3" uncode_shortcode_id="367044" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="180310" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." heading_custom_size="clamp(25px,4vw,28px)"]Medium length headline[/vc_custom_heading][vc_button button_color="accent" size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" button_color_type="uncode-palette" uncode_shortcode_id="172447"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" radius="lg" shadow="lg" shadow_hover="yes" shadow_hover_weight="std" width="1/3" link_to="|||" uncode_shortcode_id="998901" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="180310" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." heading_custom_size="clamp(25px,4vw,28px)"]Medium length headline[/vc_custom_heading][vc_button button_color="accent" size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" button_color_type="uncode-palette" uncode_shortcode_id="172447"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
