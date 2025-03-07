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

$data[ 'name' ]             = esc_html__( 'Portfolio Marquee', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Marquee.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" back_color="color-wayh" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="925172" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="147172"][uncode_index el_id="index-663620" index_type="linear" loop="size:8|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="2" size_by="height" linear_animation="marquee-scroll" linear_speed="1" marquee_clone="yes" draggable="yes" single_style="dark" single_overlay_color="color-wayh" single_overlay_coloration="bottom_gradient" single_overlay_opacity="20" single_overlay_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_h_align="center" single_padding="1"  single_title_dimension="h5" single_border="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="147926" custom_tooltip="DRAG" tooltip_class="font-955596 font-weight-600 fontsize-160000" linear_height="clamp(260px, 30vw, 600px)"][/vc_column][/vc_row]
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
