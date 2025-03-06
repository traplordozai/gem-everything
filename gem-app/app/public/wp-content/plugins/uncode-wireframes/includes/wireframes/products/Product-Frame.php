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

$data[ 'name' ]             = esc_html__( 'Product Frame', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Frame.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" inverted_device_order="yes" css=".vc_custom_1591977596715{border-top-width: 1px !important;}"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2" override_padding="yes" column_padding="5" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" css=".vc_custom_1594206497903{border-right-width: 1px !important;}"][uncode_breadcrumbs text_lead="small" separator="pipe" wc_breadcrumbs="yes"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'"]This is a custom heading element.[/vc_custom_heading][uncode_single_product_rating][/vc_column_inner][/vc_row_inner][vc_column_text auto_text="excerpt"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_button dynamic="add-to-cart" quantity="variation" radius="btn-square" hover_fx="full-colored" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2"][uncode_single_product_gallery columns="3" nav="dots" dots_inside="yes"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1589438857824{border-top-width: 1px !important;}"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" css=".vc_custom_1594206552298{border-right-width: 1px !important;}"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Details[/vc_custom_heading][uncode_single_product_meta][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2"][vc_tabs typography="yes" align="left" width_100="yes" product_from_builder="yes"][vc_tab icon="fa fa-paper" gutter_size="2" column_padding="2" title="Description" tab_id="1589279821-1-14" product_from_builder="yes"][vc_column_text auto_text="content"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tab][vc_tab icon="fa fa-speech-bubble" gutter_size="2" column_padding="2" title="Reviews" tab_id="1589279821-2-62" product_from_builder="yes"][uncode_single_product_reviews][/vc_tab][/vc_tabs][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1589302968660{border-top-width: 1px !important;}"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Related[/vc_custom_heading][uncode_index el_id="index-794770" index_type="carousel" loop="size:7|order_by:date|post_type:product" auto_query="yes" auto_query_type="related" carousel_lg="3" carousel_md="2" carousel_sm="1" thumb_size="one-one" gutter_size="4" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|inline" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_dot_position="left" stage_padding="0" single_overlay_opacity="5" single_text_anim="no" single_image_anim="no" single_padding="2" single_title_dimension="h5" single_border="yes"][/vc_column][/vc_row]
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
