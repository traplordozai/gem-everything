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

$data[ 'name' ]             = esc_html__( 'Shop Ajax Filters Overlay', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Ajax-Filters-Overlay.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="171127"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="135196"][uncode_index el_id="index-194414" index_type="css_grid" loop="size:12|order_by:ID|post_type:product|taxonomy_count:10" screen_lg_items="3" screen_lg_breakpoint="1400" screen_md_items="2" screen_md_breakpoint="900" screen_sm_items="1" screen_sm_breakpoint="480" filtering="ajax" ajax_filters_content_block_id="86490" ajax_filters_layout="overlay" filter_typography="inherit" filter_all_opposite="yes" active_filters="left" clear_all="show" show_woo_sorting_ajax="right" show_woo_result_count_ajax="short" woo_sorting_shadow_ajax="yes" gutter_size="2" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,price|inline,variations|over|pa_color|all|hover|original_title|size_regular|mobile" infinite="yes" infinite_button="icon" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_image_magnetic="yes" single_h_align="center" single_padding="1" single_title_dimension="h6" single_title_weight="400" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="600" no_double_tap="yes" uncode_shortcode_id="213188" filter_toggle_hide_text="Close Filters" filter_toggle_show_text="Open Filters" max_w_ajax_filters="600"][/vc_column][/vc_row]
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
