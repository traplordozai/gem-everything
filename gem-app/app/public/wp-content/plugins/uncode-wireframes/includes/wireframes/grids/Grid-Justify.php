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

$data[ 'name' ]             = esc_html__( 'Grid Justify', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Justify.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="100" shape_bottom_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="185198" back_color_type="uncode-palette" shape_bottom_color_type="uncode-palette" column_width_pixel="1444"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" radius="lg" shadow="lg" width="4/12" uncode_shortcode_id="192896" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="center" shape="img-round" uncode_shortcode_id="129421" el_class="unmask-blob-4"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="340540"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="105063" subheading="Explore an extensive array of postal and logistics solutions tailored to meet every need, from simple mail dispatches to complex supply chain management, all under one roof for your convenience of an extensive array of postal and logistics solutions." heading_custom_size="clamp(25px,4vw,35px)"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button button_color="accent" size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" button_color_type="uncode-palette" uncode_shortcode_id="197122"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="8/12" uncode_shortcode_id="422932"][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="209226"][vc_column_inner column_width_use_pixel="yes" position_horizontal="left" position_vertical="justify" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" back_position="right center" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="lg" shadow="lg" width="1/1" uncode_shortcode_id="227541" back_color_type="uncode-palette" back_size="53%" column_width_pixel="300" el_class="no-tablet-device-bg-inner"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="793619" subheading="Leverage our intuitive delivery time calculator to get accurate estimates for your shipments, ensuring you can plan with precision and confidence." heading_custom_size="clamp(25px,4vw,35px)"]Medium length headline[/vc_custom_heading][vc_button button_color="accent" size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" button_color_type="uncode-palette" uncode_shortcode_id="891213"]Click the button[/vc_button][vc_single_image media="'. uncode_wf_print_single_image( '133801' ) .'" media_width_percent="100" uncode_shortcode_id="171291" el_class="desktop-hidden"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="50" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="106126"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" radius="lg" shadow="xl" width="1/2" uncode_shortcode_id="109305" back_color_type="uncode-palette" css=".vc_custom_1715592473678{padding-bottom: 0px !important;}"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="161455" subheading="Join our loyalty program to enjoy exclusive offers, discounts, and rewards that get better with shipment." heading_custom_size="clamp(25px,4vw,35px)"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="two-one" uncode_shortcode_id="159604"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" radius="lg" shadow="lg" width="1/2" uncode_shortcode_id="954115" back_color_type="uncode-palette" css=".vc_custom_1710428491667{padding-bottom: 0px !important;}"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="122942" subheading="Experience unparalleled speed with our national fast shipping services, with rapid delivery across the country." heading_custom_size="clamp(25px,4vw,35px)"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="two-one" uncode_shortcode_id="722102"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
