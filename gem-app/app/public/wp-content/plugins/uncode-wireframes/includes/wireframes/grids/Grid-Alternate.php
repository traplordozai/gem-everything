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

$data[ 'name' ]             = esc_html__( 'Grid Alternate', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Alternate.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" override_padding="yes" column_padding="4" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4" mobile_height="280"][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" width="1/4"][vc_custom_heading heading_semantic="h3" text_uppercase="" text_align="text-left"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h3" text_uppercase="" text_align="text-left"]Short headline[/vc_custom_heading][vc_column_text]<strong>Feature one</strong>
Change the color to match your brand or vision and more.

<strong>Feature two</strong>
Change the color to match your brand or vision and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" style="dark" back_color="accent" back_image="'. uncode_wf_print_single_image( '47245' ) .'" parallax="yes" overlay_color="accent" overlay_alpha="98" gutter_size="3" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h3" text_uppercase="" text_align="text-left"]Short headline[/vc_custom_heading][vc_column_text]<strong>Feature one</strong>
Change the color to match your brand or vision and more.

<strong>Feature two</strong>
Change the color to match your brand or vision and more.[/vc_column_text][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h3" text_uppercase="" text_align="text-left"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" style="dark" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" gutter_size="3" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" shift_x="0" shift_y="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h3" text_uppercase="" text_align="text-left"]Short headline[/vc_custom_heading][vc_column_text]<strong>Feature one</strong>
Change the color to match your brand or vision and more.

<strong>Feature two</strong>
Change the color to match your brand or vision and more.[/vc_column_text][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="4" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4" mobile_height="280"][/vc_column][/vc_row]
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
