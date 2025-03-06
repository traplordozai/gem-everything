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

$data[ 'name' ]             = esc_html__( 'Shop Ajax Filters Classic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Ajax-Filters-Classic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="537118" el_class="ajax-filters"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" width="1/1" uncode_shortcode_id="380216"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="939836"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12"][uncode_index el_id="index-121107" index_type="css_grid" loop="size:12|order_by:title|post_type:product|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="900" screen_sm_items="2" screen_sm_breakpoint="480" gutter_size="3" css_grid_equal_height="yes" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-default|hide-atc,variations|over|pa_color|all|default|original_title|size_small|mobile,title,price|default,text|excerpt|70,stars,spacer|half,wishlist-button,quick-view-button" pagination="yes" css_grid_images_size="one-one" single_shape="round" radius="xs" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_padding="1" single_title_dimension="h5" single_title_weight="500" single_title_transform="capitalize" single_text_lead="small" single_border="yes" uncode_shortcode_id="123941"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="3/12" uncode_shortcode_id="144283"][uncode_ajax_filter filter_type="search" use_widget_style="yes" widget_style_title_typography="inherit"][uncode_ajax_filter taxonomy="product_cat" type="checkbox" show_count="yes" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Categories"][uncode_ajax_filter filter_type="product_sorting" type="checkbox" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" desktop_visibility="yes" medium_visibility="yes" title="Sorting"][uncode_ajax_filter filter_type="product_price" type="checkbox" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Price"][uncode_ajax_filter filter_type="product_ratings" show_count="yes" multiple="yes" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Ratings"][vc_empty_space empty_h="3" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
