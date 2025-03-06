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

$data[ 'name' ]             = esc_html__( 'Blog Sticky Scroll Simple', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Sticky-Scroll-Simple.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="hills" uncode_shortcode_id="202608" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="214596"][uncode_index el_id="index-609966778" index_type="sticky-scroll" sticky_wrap="column" loop="size:7|order_by:date|post_type:post|taxonomy_count:10" sticky_thumb_size="three-two" sticky_th_grid_lg="3" sticky_th_grid_md="2" sticky_th_grid_sm="1" gutter_size="3" sticky_scroll_v_align="middle" post_items="media|featured|onpost|poster,category|colorbg|topright|display-icon,date,title,text|excerpt|70" portfolio_items="media|featured|onpost|original,title" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" radius="xs" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_padding="2" single_title_dimension="h5" single_title_height="fontheight-357766" single_shadow="yes" shadow_weight="std" single_border="yes" horizontal_th_size="grid" uncode_shortcode_id="176294"][/vc_column][/vc_row]
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
