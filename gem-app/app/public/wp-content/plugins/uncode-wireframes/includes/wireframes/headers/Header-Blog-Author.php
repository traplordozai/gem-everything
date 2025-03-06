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

$data[ 'name' ]             = esc_html__( 'Header Blog Author', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Blog-Author.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="60" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" shape_bottom_invert="yes" shape_bottom_h_use_pixel="" shape_bottom_height="140" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="1/1" column_width_pixel="900"][uncode_author_profile avatar_position="top" avatar_size="160" avatar_border="yes" avatar_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" author_name_linked="" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" sub_lead="yes"][uncode_socials size="lead"][vc_empty_space empty_h="3"][/vc_column][/vc_row]
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
