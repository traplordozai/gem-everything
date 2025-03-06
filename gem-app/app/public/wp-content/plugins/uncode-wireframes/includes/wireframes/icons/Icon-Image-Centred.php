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

$data[ 'name' ]             = esc_html__( 'Icon Image Centred', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Image-Centred.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" row_name="Features" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full=""][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" overlay_alpha="100" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="600" mobile_width_full=""][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" sub_lead="yes" sub_reduced="yes" text_align="text-center" text_uppercase="" text_serif="" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more."]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" align_medium="align_left_tablet" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_icon icon="fa fa-adjustments" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature one" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][vc_icon icon="fa fa-chat" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature two" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][vc_icon icon="fa fa-layers2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature three" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="0" gutter_size="3" overlay_alpha="50" medium_width="4" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="nine-sixteen" alignment="center" shadow="yes" shadow_weight="lg" image="7846" border_color="grey" img_link_large="" img_link_target="_self" img_size="full" media_half_padding="" media_title_uppercase="" media_title_serif="" media_no_background=""][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_visibility="yes" medium_width="0" mobile_visibility="yes" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/3"][vc_icon icon="fa fa-circle-compass" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature four" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][vc_icon icon="fa fa-mobile2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature five" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][vc_icon icon="fa fa-trophy2" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature six" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
