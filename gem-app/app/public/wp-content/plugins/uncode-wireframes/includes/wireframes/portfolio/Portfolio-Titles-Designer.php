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

$data[ 'name' ]             = esc_html__( 'Portfolio Titles Designer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Titles-Designer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="132267" back_color_type="uncode-palette" row_name="works"][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="825178"][vc_custom_heading text_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160206' ) .'" css_animation="marquee-scroll" marquee_clone="yes" marquee_speed="0" sticky_trigger="yes" sticky_trigger_option="no-height" uncode_shortcode_id="826606" text_color_type="uncode-palette"]Heading /[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" uncode_shortcode_id="168397"]Heading[/vc_custom_heading][uncode_index el_id="index-207808" index_type="titles" loop="size:13|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="2" drop_width="6" drop_ratio="three-two" drop_anchor="middle-left" drop_image_time="250" drop_radius="" drop_image_hover="opacity" drop_image_extra="yes" drop_image_extra_size="50" single_style="dark" single_title_dimension="fontsize-445851" single_title_weight="700" single_title_space="fontspace-111509" titles_gap_reduced_mobile="yes" drop_image_index="yes" uncode_shortcode_id="152347"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="4/12" uncode_shortcode_id="103128"][/vc_column][/vc_row]
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
