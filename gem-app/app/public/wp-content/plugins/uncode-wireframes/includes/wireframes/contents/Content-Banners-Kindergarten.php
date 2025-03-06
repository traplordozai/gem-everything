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

$data[ 'name' ]             = esc_html__( 'Content Banners Kindergarten', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Banners-Kindergarten.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="122698" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="105803"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="143841"]Medium length headline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="4" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="156825"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="345584"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="accent" overlay_alpha="50" equal_height="yes" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step" shape_top_h_use_pixel="true" shape_top_height_percent="15" shape_top_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" shape_top_opacity="100" shape_top_index="0" enable_bottom_divider="default" shape_bottom_invert="yes" shape_bottom_h_use_pixel="" shape_bottom_height="72" shape_bottom_opacity="100" shape_bottom_safe="yes" shape_bottom_index="0" uncode_shortcode_id="604706" back_color_type="uncode-palette" shape_top_color_type="uncode-palette" column_width_pixel="1800"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="lg" shadow_darker="yes" width="1/3" uncode_shortcode_id="647734" back_color_type="uncode-palette" column_width_pixel="440"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="109601"][vc_icon icon_image="80471" media_size="64" uncode_shortcode_id="449635"][/vc_icon][vc_empty_space empty_h="2"][vc_custom_heading text_color="accent" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="700" uncode_shortcode_id="940070" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_weight="700" uncode_shortcode_id="910572"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="128357"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_button button_color="accent" size="btn-lg" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="930955" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="lg" shadow_darker="yes" width="1/3" uncode_shortcode_id="681564" back_color_type="uncode-palette" column_width_pixel="440"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="109601"][vc_icon icon_image="80471" media_size="64" uncode_shortcode_id="449635"][/vc_icon][vc_empty_space empty_h="2"][vc_custom_heading text_color="accent" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="700" uncode_shortcode_id="940070" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_weight="700" uncode_shortcode_id="910572"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="128357"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_button button_color="accent" size="btn-lg" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="930955" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="lg" shadow_darker="yes" width="1/3" uncode_shortcode_id="127552" back_color_type="uncode-palette" column_width_pixel="440"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="109601"][vc_icon icon_image="80471" media_size="64" uncode_shortcode_id="449635"][/vc_icon][vc_empty_space empty_h="2"][vc_custom_heading text_color="accent" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="700" uncode_shortcode_id="940070" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_weight="700" uncode_shortcode_id="910572"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="128357"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][vc_empty_space empty_h="2"][vc_button button_color="accent" size="btn-lg" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="930955" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
