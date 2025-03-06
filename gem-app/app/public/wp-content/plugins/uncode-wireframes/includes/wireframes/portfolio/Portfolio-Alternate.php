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

$data[ 'name' ]             = esc_html__( 'Portfolio Alternate', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Alternate.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="175048" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="bottom-t-top" animation_speed="1000" width="1/1" uncode_shortcode_id="199350"][uncode_index el_id="index-41439378-357" isotope_mode="cellsByRow" loop="size:12|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="6" post_items="media|featured|onpost|poster,title,spacer|half" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|default" portfolio_items="media|featured|onpost|original,title" screen_lg="1000" screen_md="800" screen_sm="480" single_width="6" images_size="four-three" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_image_magnetic="yes" single_padding="2" single_text_reduced="yes" single_title_dimension="h2" single_title_space="fontspace-781688" single_border="yes" single_css_animation="parallax" single_parallax_intensity="1" post_matrix="matrix" matrix_amount="4" custom_cursor="accent" skew="yes" matrix_items="eyIwX2kiOnsiaW1hZ2VzX3NpemUiOiJmb3VyLXRocmVlIiwic2luZ2xlX3dpZHRoIjoiNiJ9LCIyX2kiOnsiaW1hZ2VzX3NpemUiOiJmb3VyLXRocmVlIiwic2luZ2xlX3dpZHRoIjoiMyIsInNpbmdsZV9jc3NfYW5pbWF0aW9uIjoicGFyYWxsYXgiLCJzaW5nbGVfcGFyYWxsYXgiOiJtZWRpdW0iLCJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiMTAifSwiM19pIjp7InNpbmdsZV93aWR0aCI6IjYiLCJpbWFnZXNfc2l6ZSI6ImZvdXItdGhyZWUiLCJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4Ijoibm9ybWFsIiwic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjQifSwiMV9pIjp7InNpbmdsZV93aWR0aCI6IjMiLCJpbWFnZXNfc2l6ZSI6ImZvdXItdGhyZWUiLCJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4IjoibWVkaXVtIiwic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjgifX0=" uncode_shortcode_id="629926"][/vc_column][/vc_row]
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
