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

$data[ 'name' ]             = esc_html__( 'Icon Separators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Separators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" border_color="color-gyho" border_style="solid" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3" css=".vc_custom_1495111159707{border-right-width: 1px !important;}"][vc_icon icon="fa fa-mobile2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature one"][/vc_icon][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" border_color="color-gyho" border_style="solid" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3" css=".vc_custom_1495111165050{border-right-width: 1px !important;}"][vc_icon icon="fa fa-video3" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature two"][/vc_icon][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon icon="fa fa-flag2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature three"][/vc_icon][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" medium_visibility="yes" mobile_visibility="yes" shift_y="0" z_index="0"][vc_column width="1/1"][vc_separator][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" border_color="color-gyho" border_style="solid" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3" css=".vc_custom_1495111176624{border-right-width: 1px !important;}"][vc_icon icon="fa fa-tools-2" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature four"][/vc_icon][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" border_color="color-gyho" border_style="solid" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3" css=".vc_custom_1495111181688{border-right-width: 1px !important;}"][vc_icon icon="fa fa-telescope" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature five"][/vc_icon][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="3" medium_width="3" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_icon icon="fa fa-megaphone" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_lead="yes" title="Feature six"][/vc_icon][/vc_column][/vc_row]
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
