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

$data[ 'name' ]             = esc_html__( 'Special Coming Soon', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Special-Coming-Soon.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" back_position="center bottom" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" column_width_pixel="830"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="bottom-t-top" animation_delay="600" shadow="xl" radius="xs" width="1/1"][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="0" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" sub_reduced="yes" text_uppercase=""]Medium length display headline[/vc_custom_heading][uncode_countdown size="h3" weight="" bigger="yes" date="2020/09/14"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="600"][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_separator][vc_empty_space empty_h="2"][vc_icon display="inline" icon="fa fa-social-facebook" background_style="fa-rounded" css_animation="zoom-in" animation_delay="200" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-social-twitter" background_style="fa-rounded" css_animation="zoom-in" animation_delay="300" link="url:https%3A%2F%2Ftwitter.com||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-social-dribbble" background_style="fa-rounded" css_animation="zoom-in" animation_delay="400" link="url:https%3A%2F%2Fdribbble.com||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-linkedin" background_style="fa-rounded" css_animation="zoom-in" animation_delay="500" link="url:%23||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-social-vimeo" background_style="fa-rounded" css_animation="zoom-in" animation_delay="600" link="url:%23||target:%20_blank"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
