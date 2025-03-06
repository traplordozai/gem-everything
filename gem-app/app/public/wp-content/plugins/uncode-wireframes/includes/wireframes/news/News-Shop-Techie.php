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

$data[ 'name' ]             = esc_html__( 'News Shop Techie', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Shop-Techie.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="0" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" column_width_pixel="1400" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" width="1/1"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-14701323425678" loop="size:3|order_by:date|post_type:post" style_preset="metro" gutter_size="2" post_items="media|featured|onpost|original,date,title" screen_lg="1200" screen_md="1200" screen_sm="480" single_text="overlay" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_overlay_anim="no" single_v_position="bottom" single_reduced="three_quarter" single_padding="2" single_text_lead="yes" single_title_transform="capitalize" single_title_dimension="h3" single_shadow="yes" shadow_weight="lg" single_border="yes" single_css_animation="zoom-in" post_matrix="matrix" matrix_amount="3" no_double_tap="yes" matrix_items="e30="][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
