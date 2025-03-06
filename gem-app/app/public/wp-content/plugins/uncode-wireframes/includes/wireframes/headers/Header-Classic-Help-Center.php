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

$data[ 'name' ]             = esc_html__( 'Header Classic Help Center', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Help-Center.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="60" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="accent" overlay_alpha="80" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="step" style="inherited" css=".vc_custom_1556088131305{border-top-width: 0px !important;}" el_class="homepage-search" shape_dividers=""][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="100" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="900"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" sub_lead="yes" sub_reduced="yes" text_align="text-center"]Short headline[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo and more.[/vc_column_text][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" style="light" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_wp_search live_search="yes"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="-4" shift_y_fixed="yes" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" shadow="sm" radius="xs" shadow_hover="yes" shadow_hover_weight="std" width="1/3"][vc_icon icon="fa fa-adjustments" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature one" link="|||"]Change the color to match your brand or vision and more.[/vc_icon][vc_button button_color="accent" size="btn-sm" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" shadow="sm" radius="xs" shadow_hover="yes" shadow_hover_weight="std" width="1/3"][vc_icon icon="fa fa-chat" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature two" link="|||"]Change the color to match your brand or vision and more.[/vc_icon][vc_button button_color="accent" size="btn-sm" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" shadow="sm" radius="xs" shadow_hover="yes" shadow_hover_weight="std" width="1/3" link_to="|||"][vc_icon icon="fa fa-profile-male" icon_color="accent" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_reduced="yes" title="Feature three" link="|||"]Change the color to match your brand or vision and more.[/vc_icon][vc_button button_color="accent" size="btn-sm" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
