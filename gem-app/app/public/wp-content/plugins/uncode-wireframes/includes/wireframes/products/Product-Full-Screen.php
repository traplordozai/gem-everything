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

$data[ 'name' ]             = esc_html__( 'Product Full-Screen', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Full-Screen.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" back_image_auto="yes" kburns="yes" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" medium_visibility="yes" mobile_visibility="yes"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="5/6"][uncode_breadcrumbs text_lead="small" separator="triangle" wc_breadcrumbs="yes"][vc_empty_space empty_h="1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/6"][vc_button dynamic="add-to-cart" quantity="variation" wide="yes" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" desktop_visibility="yes" auto_height_device="yes"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_single_image media="'. uncode_wf_print_single_image( '84636' ) .'" dynamic="yes" media_width_percent="100" media_ratio="four-five"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="5/6"][uncode_breadcrumbs text_lead="small" separator="triangle" wc_breadcrumbs="yes"][vc_empty_space empty_h="1"][vc_custom_heading auto_text="yes" heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button size="link" custom_typo="yes" font_weight="400" text_transform="uppercase" border_width="0" icon="fa fa-heart-o"]Add to Whishlist[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/6"][vc_button dynamic="add-to-cart" quantity="variation" wide="yes" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading auto_text="excerpt" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][uncode_socials size="lead"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][uncode_single_product_meta inline="yes"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="step" inverted_device_order="yes" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading]Related[/vc_custom_heading][uncode_index el_id="index-794770" index_type="carousel" loop="size:6|order_by:date|post_type:product" auto_query="yes" auto_query_type="related" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="one-one" gutter_size="4" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|inline" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="70" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h6" single_shadow="yes" shadow_weight="lg" shadow_darker="yes" single_border="yes"][/vc_column][/vc_row]
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
