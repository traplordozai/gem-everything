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

$data[ 'name' ]             = esc_html__( 'News Creative Designers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Creative-Designers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="step_3_4" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="60" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="180569" shape_bottom_color_type="uncode-palette" back_size="initial" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0" el_class="inverted-device-order" limit_content="" uncode_shortcode_id="364543"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" parallax_intensity="2" width="2/3" uncode_shortcode_id="679459"][vc_custom_heading text_color="accent" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="591926" text_color_type="uncode-palette"]Medium Length Outline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="159470"]Explore our news on merging technologies and the trends affecting the industry[/vc_custom_heading][vc_button size="btn-link" custom_typo="yes" icon_position="right" scale_mobile="no" icon="fa fa-arrow-right2" uncode_shortcode_id="151531" link="url:https%3A%2F%2F1.envato.market%2FQ3bJP%2F|title:Blog%20Media"]Journal[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="186488"][uncode_vertical_text text_align="top" position="right" flip="yes" vertical_text_h_pos="4" vertical_text_v_pos="0" z_index="2" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" mobile_visibility="yes" uncode_shortcode_id="388046"]⸻ Latest[/uncode_vertical_text][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="right-t-left" animation_speed="1000" width="1/1" uncode_shortcode_id="192956"][uncode_index el_id="index-183931" index_type="carousel" loop="size:9|order_by:date|post_type:post|taxonomy_count:10" carousel_lg="4" carousel_md="2" carousel_sm="2" thumb_size="three-two" gutter_size="4" post_items="media|featured|onpost|poster,date,title,spacer|half,text|excerpt|160" portfolio_items="title,media|featured|onpost|poster,date,author|md_size|display_qualification" carousel_v_align="middle" carousel_interval="0" carousel_navspeed="1000" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_dot_position="left" carousel_width_percent="100" carousel_half_opacity="yes" carousel_pointer_events="yes" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_padding="2" single_title_dimension="h4" single_border="yes" single_css_animation="parallax" single_parallax_intensity="2" single_animation_first="yes" post_matrix="matrix" matrix_amount="2" custom_cursor="accent" matrix_items="eyIxX2kiOnsidGV4dF9sZW5ndGgiOiI1MCIsInNpbmdsZV9sYXlvdXRfcG9zdF9pdGVtcyI6Im1lZGlhfGZlYXR1cmVkfG9ucG9zdHxwb3N0ZXIsZGF0ZSx0aXRsZSxzcGFjZXJ8aGFsZix0ZXh0fGV4Y2VycHQsbWVkaWF8ZmVhdHVyZWR8b25wb3N0fHBvc3RlcixkYXRlLHRpdGxlLHNwYWNlcnxoYWxmLHRleHR8ZXhjZXJwdCIsInNpbmdsZV9jc3NfYW5pbWF0aW9uIjoicGFyYWxsYXgiLCJzaW5nbGVfcGFyYWxsYXgiOiJzdWJ0bGUiLCJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiNCJ9LCIwX2kiOnsic2luZ2xlX2Nzc19hbmltYXRpb24iOiIifX0=" uncode_shortcode_id="369393"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
