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

$data[ 'name' ]             = esc_html__( 'Content Equal Height Numbers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Equal-Height-Numbers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="accent" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="124992" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="504915"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/3" uncode_shortcode_id="342240"][vc_custom_heading heading_semantic="h6" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="178477"]01[/vc_custom_heading][vc_custom_heading text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." uncode_shortcode_id="127429"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_button border_width="0" uncode_shortcode_id="116747" link="url:%23"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="5" style="dark" overlay_color="color-jevc" overlay_alpha="5" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" width="1/3" uncode_shortcode_id="107213" overlay_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="199813"]02[/vc_custom_heading][vc_custom_heading text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." uncode_shortcode_id="127429"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_button border_width="0" uncode_shortcode_id="116747" link="url:%23"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="5" style="dark" overlay_color="color-jevc" overlay_alpha="10" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="400" width="1/3" uncode_shortcode_id="518745" overlay_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="194521"]03[/vc_custom_heading][vc_custom_heading text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more." uncode_shortcode_id="127429"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_button border_width="0" uncode_shortcode_id="116747" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
