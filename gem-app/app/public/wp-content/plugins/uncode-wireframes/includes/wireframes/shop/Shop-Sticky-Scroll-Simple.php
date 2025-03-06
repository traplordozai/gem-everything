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

$data[ 'name' ]             = esc_html__( 'Shop Sticky Scroll Simple', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Sticky-Scroll-Simple.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="132380" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="205823"][uncode_index el_id="index-60996387" index_type="sticky-scroll" sticky_wrap="column" loop="size:7|order_by:date|post_type:product|taxonomy_count:10" sticky_thumb_size="two-three" sticky_th_grid_lg="4" sticky_th_grid_md="3" sticky_th_grid_sm="1" gutter_size="3" sticky_scroll_v_align="middle" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc|atc-typo-default|hide-atc,price|inline,stars,quick-view-button,wishlist-button" portfolio_items="media|featured|onpost|original,title" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="1" single_title_dimension="h6" single_border="yes" horizontal_th_size="grid" uncode_shortcode_id="156449"][/vc_column][/vc_row]
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
