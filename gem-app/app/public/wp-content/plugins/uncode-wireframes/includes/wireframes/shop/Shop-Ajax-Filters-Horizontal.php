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

$data[ 'name' ]             = esc_html__( 'Shop Ajax Filters Horizontal', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Ajax-Filters-Horizontal.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="213810" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="171616"][uncode_index el_id="index-145375-5" index_type="css_grid" loop="size:10|order_by:title|post_type:product|taxonomy_count:10" grid_items="5" screen_lg_items="4" screen_lg_breakpoint="1400" screen_md_items="3" screen_md_breakpoint="900" screen_sm_items="2" screen_sm_breakpoint="480" filtering="ajax" ajax_filters_content_block_id="86497" ajax_filters_layout="horizontal" filters_widgets="hidden" filter_typography="inherit" gutter_size="0" css_grid_equal_height="yes" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc|atc-typo-default|hide-atc,stars,title,price|default,text|excerpt|70,spacer|half,variations|under|pa_color|all|hover|original_title|size_regular|mobile,quick-view-button,wishlist-button" pagination="yes" footer_full_width="yes" pagination_typography="inherit" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_padding="2" single_title_dimension="h5" single_title_weight="500" no_double_tap="yes" pagination_per_page="0" uncode_shortcode_id="100912"][/vc_column][/vc_row]
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
