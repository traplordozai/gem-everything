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

$data[ 'name' ]             = esc_html__( 'Portfolio Sticky Scroll Fluid', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Sticky-Scroll-Fluid.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="2" row_horizontal_scroll="yes" uncode_shortcode_id="418771" shape_dividers="" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="right-t-left" animation_speed="800" width="1/1" uncode_shortcode_id="965665"][uncode_index el_id="index-138684" index_type="sticky-scroll" sticky_wrap="column" loop="size:5|order_by:date|post_type:portfolio|taxonomy_count:10" sticky_thumb_size="fluid" sticky_th_grid_lg="1" sticky_th_grid_md="1" sticky_th_grid_sm="1" sticky_th_vh_lg="100" sticky_th_vh_md="75" sticky_th_vh_sm="60" gutter_size="6" post_items="media|featured|onpost|original,date,title,sep-one|reduced,extra,spacer|one,link|circle" portfolio_items="media|featured|onpost|original,title" single_text="overlay" single_overlay_color="color-jevc" single_overlay_opacity="25" single_image_magnetic="yes" single_h_align="center" single_padding="3" single_title_dimension="fontsize-338686" single_title_weight="700" single_shadow="yes" shadow_weight="std" single_border="yes" no_sticky_scroll_tablet="yes" no_sticky_scroll_mobile="yes" uncode_shortcode_id="837980"][/vc_column][/vc_row]
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
