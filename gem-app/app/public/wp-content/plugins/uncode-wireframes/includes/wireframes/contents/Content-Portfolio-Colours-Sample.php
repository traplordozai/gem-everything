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

$data[ 'name' ]             = esc_html__( 'Content Portfolio Colours Sample', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Portfolio-Colours-Sample.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="429059" shape_dividers=""][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="831880" back_color_type="uncode-palette"][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_column_text uncode_shortcode_id="470832"]Pantone® 532 C
C71 M65 Y64 K72
#232323[/vc_column_text][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="426020" back_color_type="uncode-palette"][vc_column_text uncode_shortcode_id="557101"]Pantone® 186 C
C6 M100 Y100 K1
#df0015[/vc_column_text][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="123476" back_color_type="uncode-palette"][vc_column_text uncode_shortcode_id="141418"]Pantone® 663 C
C02 M01 Y01 K00
#f7f7f7[/vc_column_text][/vc_column][/vc_row]
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
