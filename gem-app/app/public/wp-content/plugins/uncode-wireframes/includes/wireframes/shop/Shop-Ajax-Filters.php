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

$data[ 'name' ]             = esc_html__( 'Shop Ajax Filters', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Ajax-Filters.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="197781" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="127642"][uncode_index el_id="index-145375" index_type="css_grid" loop="size:20|order_by:date|post_type:product|taxonomy_count:10" grid_items="5" screen_lg_items="4" screen_lg_breakpoint="1600" screen_md_items="3" screen_md_breakpoint="1100" screen_sm_items="2" screen_sm_breakpoint="480" filtering="ajax" ajax_filters_content_block_id="86484" gutter_size_ajax_filters="4" column_size_ajax_filters="2" filter_typography="inherit" filtering_toggle_align="right" active_filters="left" show_woo_sorting_ajax="right" show_woo_result_count_ajax="yes" woo_sorting_shadow_ajax="yes" gutter_size="2" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc|atc-typo-default|hide-atc,variations|over|pa_color|all|default|original_title|size_small|mobile,title,price|inline,quick-view-button,wishlist-button,spacer|half" pagination="yes" footer_full_width="yes" pagination_typography="inherit" single_shape="round" single_overlay_opacity="50" single_overlay_anim="no" single_h_align="center" single_padding="1" single_title_dimension="h6" single_title_weight="400" single_border="yes" single_css_animation="bottom-t-top" no_double_tap="yes" pagination_per_page="20" hide_woo_sorting_icon_ajax="yes" uncode_shortcode_id="180349" max_w_ajax_filters="600" min_w_ajax_filters="380"][/vc_column][/vc_row]
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
