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

$data[ 'name' ]             = esc_html__( 'Product Off-Grid', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Off-Grid.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step_3_4" shape_top_flip="yes" shape_top_h_use_pixel="true" shape_top_height_percent="70" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" shape_dividers=""][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="3" shift_y="-3" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="top-t-bottom" width="6/12"][uncode_single_product_gallery columns="3" gutter_thumb="3"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="-3" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" css_animation="bottom-t-top" width="6/12"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="1" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_empty_space][vc_separator sep_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" el_height="6px"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="1" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][vc_button dynamic="add-to-cart" quantity="variation" size="btn-lg" radius="btn-square" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="1" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][vc_separator sep_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" el_height="6px"][vc_empty_space][vc_custom_heading auto_text="excerpt" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space][uncode_share layout="multiple" bigger="yes" no_back="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step_3_4" shape_top_h_use_pixel="true" shape_top_height_percent="100" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" inverted_device_order="yes" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="3" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" css_animation="right-t-left" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="10/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Related products[/vc_custom_heading][vc_separator sep_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" el_height="6px"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12"][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-794770" index_type="carousel" loop="size:7|order_by:date|post_type:product" auto_query="yes" auto_query_type="related" carousel_lg="3" carousel_md="2" carousel_sm="2" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|default" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_overflow="yes" carousel_dots="yes" carousel_dot_position="left" stage_padding="0" single_text="lateral" single_image_size="8" single_overlay_opacity="5" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_padding="2" single_text_reduced="yes" single_title_dimension="h3" single_border="yes"][/vc_column][/vc_row]
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
