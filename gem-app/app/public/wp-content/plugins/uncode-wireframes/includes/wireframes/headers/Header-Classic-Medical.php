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

$data[ 'name' ]             = esc_html__( 'Header Classic Medical', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Medical.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="85" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="75" shape_bottom_color="color-jevc" shape_bottom_opacity="30" shape_bottom_index="0" uncode_shortcode_id="137787" back_color_type="uncode-palette" shape_bottom_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="772831"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="593104"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="240896"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="accent" radius="sm" uncode_shortcode_id="206109" back_color_type="uncode-palette"]SINCE 2015[/vc_custom_heading][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="167190"]Medium length headline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="130842"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_button button_color="accent" size="btn-lg" text_skin="yes" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="207074"]Click the button[/vc_button][vc_empty_space empty_h="5"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="643164"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" top_divider="step" uncode_shortcode_id="270810" back_color_type="uncode-palette" column_width_pixel="1512"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="0" override_padding="yes" column_padding="0" style="dark"  back_color="color-gyho" overlay_alpha="50" shift_x="0" shift_y="-5" shift_y_fixed="yes" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="591070" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="663004"][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="296812" back_color_type="uncode-palette"][vc_icon icon="fa fa-star" size="fa-2x" title="Medium length headline" uncode_shortcode_id="135182"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="109330" back_color_type="uncode-palette"][vc_icon icon="fa fa-star" size="fa-2x" title="Medium length headline" uncode_shortcode_id="135182"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="177866" back_color_type="uncode-palette"][vc_icon icon="fa fa-star" size="fa-2x" title="Medium length headline" uncode_shortcode_id="135182"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
