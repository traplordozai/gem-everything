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

$data[ 'name' ]             = esc_html__( 'Portfolio Parallax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Parallax.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="206319" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="164494"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="599113"]Medium Headline[/vc_custom_heading][uncode_index el_id="index-1" loop="size:8|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="6" portfolio_items="media|featured|onpost|original,title" screen_lg="1000" screen_md="600" screen_sm="480" single_width="6" images_size="four-five" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_title_dimension="h3" single_title_height="fontheight-357766" single_border="yes" single_css_animation="parallax" single_parallax_intensity="1" post_matrix="matrix" matrix_amount="4" custom_cursor="diff" matrix_items="eyIxX2kiOnsic2luZ2xlX3BhcmFsbGF4Ijoibm9ybWFsIiwic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjEwIn0sIjJfaSI6eyJzaW5nbGVfcGFyYWxsYXgiOiJub3JtYWwiLCJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiOCJ9LCIzX2kiOnsic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjMifX0=" uncode_shortcode_id="464283"][/vc_column][/vc_row]
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
