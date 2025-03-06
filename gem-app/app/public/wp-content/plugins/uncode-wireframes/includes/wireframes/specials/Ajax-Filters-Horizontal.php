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

$data[ 'name' ]             = esc_html__( 'Ajax Filters Horizontal', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Ajax-Filters-Horizontal.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="961672" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="175520"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0" uncode_shortcode_id="195613" css=".vc_custom_1659694173920{padding-right: 0px !important;padding-left: 0px !important;}" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="872900" css=".vc_custom_1659604155143{border-right-width: 1px !important;}" border_color_type="uncode-palette"][uncode_ajax_filter taxonomy="product_cat" type="checkbox" hierarchy="parent_only" display="columns" columns_num="2" use_widget_style="yes" widget_style_no_separator="yes" widget_style_title_typography="inherit" title="Categories"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="130295" css=".vc_custom_1659604169824{border-right-width: 1px !important;}" border_color_type="uncode-palette"][uncode_ajax_filter taxonomy="product_tag" type="checkbox" hierarchy="parent_only" display="columns" columns_num="2" use_widget_style="yes" widget_style_no_separator="yes" widget_style_title_typography="inherit" title="Tags"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="177735" border_color_type="uncode-palette" css=".vc_custom_1659604210137{border-right-width: 1px !important;}"][uncode_ajax_filter filter_type="product_price" type="checkbox" display="columns" columns_num="2" use_widget_style="yes" widget_style_no_separator="yes" widget_style_title_typography="inherit" title="Price"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="102242"][uncode_ajax_filter filter_type="product_sorting" type="checkbox" display="columns" columns_num="2" use_widget_style="yes" widget_style_no_separator="yes" widget_style_title_typography="inherit" title="Sorting"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
