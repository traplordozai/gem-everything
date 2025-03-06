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

$data[ 'name' ]             = esc_html__( 'Portfolio Creative Designers New', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Creative-Designers-New.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step_2_3" shape_top_h_use_pixel="true" shape_top_height_percent="100" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" bottom_divider="step" uncode_shortcode_id="722495" back_color_type="uncode-palette" shape_top_color_type="uncode-palette" row_name="works" back_size="initial"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="294422"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="176712"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_width="4" mobile_width="0" width="6/12" uncode_shortcode_id="128458"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" css_animation="curtain" animation_speed="800" uncode_shortcode_id="160525"]Medium
Heading[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="3/12" uncode_shortcode_id="315870"][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_left_mobile" mobile_width="0" parallax_intensity="2" width="3/12" uncode_shortcode_id="188571"][vc_empty_space empty_h="2" mobile_visibility="yes"][vc_button size="btn-link" custom_typo="yes" icon_position="right" scale_mobile="no" icon="fa fa-arrow-right2" uncode_shortcode_id="839805" link="url:https%3A%2F%2F1.envato.market%2FQ3bJP%2F|title:About%20Alternative"]What we do[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="-4" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" parallax_intensity="4" width="1/1" uncode_shortcode_id="305825"][uncode_index el_id="index-864773418" index_type="carousel" loop="size:5|order_by:date|post_type:portfolio|taxonomy_count:10" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-two" gutter_size="4" post_items="media|featured|onpost|poster,date,title,text|excerpt|90,category|bordered|topright|hide-icon" portfolio_items="media|featured|onpost|original,title" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_dot_position="left" carousel_width_percent="100" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_padding="2" single_title_dimension="h4" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="800" single_animation_delay="400" single_animation_first="yes" custom_cursor="accent" uncode_shortcode_id="194163"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
