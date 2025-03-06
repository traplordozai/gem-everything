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

$data[ 'name' ]             = esc_html__( 'Ajax Filters Sidebar', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Ajax-Filters-Sidebar.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="167610" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="653596"][uncode_ajax_filter taxonomy="product_cat" type="checkbox" hierarchy="parent_only" show_count="yes" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Categories"][uncode_ajax_filter filter_type="product_sorting" type="checkbox" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" desktop_visibility="yes" medium_visibility="yes" title="Sorting"][uncode_ajax_filter filter_type="product_price" type="checkbox" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Price"][uncode_ajax_filter filter_type="product_ratings" show_count="yes" multiple="yes" use_widget_style="yes" widget_desktop_collapse="click" widget_collapse_tablet="click" widget_collapse="click" widget_style_title_typography="inherit" title="Ratings"][/vc_column][/vc_row]
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
