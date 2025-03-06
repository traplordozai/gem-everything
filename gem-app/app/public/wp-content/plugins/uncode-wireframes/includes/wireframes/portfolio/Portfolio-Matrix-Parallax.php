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

$data[ 'name' ]             = esc_html__( 'Portfolio Matrix Parallax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Matrix-Parallax.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="608728" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="159292"][uncode_index el_id="index-31209-624" loop="size:9|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" gutter_size="6" portfolio_items="media|featured|onpost|original,title" off_grid="yes" off_grid_val="7" off_grid_all="yes" screen_lg="600" screen_md="600" screen_sm="600" single_width="6" single_height="6" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_title_dimension="h3" single_border="yes" single_css_animation="parallax" single_parallax_intensity="1" post_matrix="matrix" matrix_amount="3" custom_cursor="accent" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiMTIiLCJpbWFnZXNfc2l6ZSI6InNpeHRlZW4tbmluZSIsInNpbmdsZV9oZWlnaHQiOiI5Iiwic2luZ2xlX2Nzc19hbmltYXRpb24iOiIifSwiMV9pIjp7InNpbmdsZV9jc3NfYW5pbWF0aW9uIjoicGFyYWxsYXgiLCJzaW5nbGVfcGFyYWxsYXgiOiJub3JtYWwiLCJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiMyJ9LCIyX2kiOnsic2luZ2xlX2Nzc19hbmltYXRpb24iOiJwYXJhbGxheCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiI2In19" uncode_shortcode_id="678448"][/vc_column][/vc_row]
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
