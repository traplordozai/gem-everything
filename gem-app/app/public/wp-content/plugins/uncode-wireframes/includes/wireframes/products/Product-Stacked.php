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

$data[ 'name' ]             = esc_html__( 'Product Stacked', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Stacked.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="50" shape_bottom_index="0"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="7/12"][uncode_single_product_gallery layout="stack" zoom="yes" gutter_size="0"][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="5/12"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_transform="capitalize"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][vc_button dynamic="add-to-cart" quantity="variation" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_accordion sign="plus" active_tab="0"][vc_accordion_tab icon="fa fa-paper" column_padding="2" title="Description" tab_id="e9855732-177a-3"][vc_column_text auto_text="excerpt"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab icon="fa fa-speech-bubble" title="Reviews" tab_id="1589303162-2-70"][uncode_single_product_reviews][/vc_accordion_tab][vc_accordion_tab icon="fa fa-box" title="Shipping" tab_id="e1f2b404-9341-5"][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_accordion_tab][/vc_accordion][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1"][uncode_share layout="multiple" no_back="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="step_2_3" inverted_device_order="yes"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading heading_semantic="h3"]Related[/vc_custom_heading][uncode_index el_id="index-117467" index_type="carousel" loop="size:7|order_by:date|post_type:product" auto_query="yes" carousel_lg="3" carousel_md="2" carousel_sm="1" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|inline" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" stage_padding="0" single_overlay_opacity="10" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h6" single_border="yes"][/vc_column][/vc_row]
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
