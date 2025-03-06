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

$data[ 'name' ]             = esc_html__( 'Shop Table Description', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Table-Description.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="196678" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="6" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="199760"][uncode_index el_id="index-7" index_type="table" loop="size:4|order_by:date|post_type:product|taxonomy_count:10" gutter_size="3" table_v_align="middle" table_border="yes" table_click_row="yes" table_hover="opacity" post_table_items="date,col-one|2,title,spacer|two,text|excerpt,col-two|10" product_table_items="col-one|1,media|featured|onpost|original|hide-sale|inherit-atc|inherit-w-atc|atc-typo-default|hide-atc,col-two|8,title,price|inline,text|excerpt|160,col-three|3,add_to_cart|default|default_size" table_images_size="one-one" single_overlay_opacity="50" single_table_last_align="right" single_padding="2" single_title_dimension="h5" table_general_typo="yes" single_border="yes" table_display_tablet="yes" uncode_shortcode_id="166559"][/vc_column][/vc_row]
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
