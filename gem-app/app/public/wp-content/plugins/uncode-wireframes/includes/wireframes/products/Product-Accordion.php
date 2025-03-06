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

$data[ 'name' ]             = esc_html__( 'Product Accordion', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Accordion.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="106825"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="637291"][uncode_breadcrumbs text_lead="small"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="164156" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3"][uncode_single_product_gallery layout="grid" gutter_thumb_grid="3" zoom_mobile="yes" product_badges="" lateral="yes"][/vc_column][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="1/3" uncode_shortcode_id="137460"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="151548"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="7/12" uncode_shortcode_id="211625"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="785529"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" align_mobile="align_left_mobile" mobile_width="0" width="5/12" uncode_shortcode_id="773840"][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="127540"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="1"][vc_column_text auto_text="excerpt" uncode_shortcode_id="175417"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][uncode_single_product_meta text_lead="small" inline="yes"][vc_empty_space empty_h="1"][vc_separator sep_color=",Default"][vc_button dynamic="add-to-cart" quantity="variation" wide="yes" custom_typo="yes" font_weight="500" border_width="0" scale_mobile="no" uncode_shortcode_id="716216"]Text on the button[/vc_button][vc_empty_space empty_h="1"][vc_accordion typography="yes" sign="plus" active_tab="0"][vc_accordion_tab gutter_size="3" column_padding="2" title="Description" tab_id="0481"][vc_column_text auto_text="content" uncode_shortcode_id="802316"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="Reviews" tab_id="0482"][uncode_single_product_reviews][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="Shipping" tab_id="0483"][vc_column_text]Our store processes orders from Monday to Friday (excluding holidays), please, note that we don’t deliver orders on Sundays or holidays.[/vc_column_text][/vc_accordion_tab][/vc_accordion][vc_empty_space][/vc_column][/vc_row]
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
