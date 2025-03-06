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

$data[ 'name' ]             = esc_html__( 'Portfolio Titles Essential', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Titles-Essential.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="90" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" overlay_animated="yes" overlay_animated_1_color="color-wvjs" overlay_animated_size="0.7" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="184665" back_color_type="uncode-palette" overlay_animated_1_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="952746"][uncode_index el_id="index-48992" index_type="titles" loop="size:10|order_by:date|post_type:portfolio|taxonomy_count:10" titles_display="inline" gutter_size="2" drop_h_space="lg" drop_image_separator="slash" drop_image_position="row" back_repeat="no-repeat" back_position="center center" drop_image_time="50" drop_image_hover="opacity-inverted" drop_image_extra="yes" drop_image_extra_size="75" single_style="dark" single_title_dimension="h1" single_css_animation="alpha-anim" single_animation_speed="1000" titles_display_mobile="yes" titles_gap_reduced_mobile="yes" titles_hide_meta_mobile="yes" titles_hide_separator_mobile="yes" textual_display="inline" drop_title_hover="outlined-inverted" drop_image_index="yes" uncode_shortcode_id="181569" back_size="30%"][/vc_column][/vc_row]
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
