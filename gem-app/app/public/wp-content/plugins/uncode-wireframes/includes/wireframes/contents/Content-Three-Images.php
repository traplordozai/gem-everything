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

$data[ 'name' ]             = esc_html__( 'Content Three Images', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Three-Images.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="210984"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="2"  overlay_alpha="50" preserve_border="yes" preserve_border_tablet="yes" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="130229" css=".vc_custom_1640014321044{border-right-width: 1px !important;padding-top: 0px !important;padding-bottom: 0px !important;}" border_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="80" media_ratio="four-five" alignment="center" advanced="yes" media_items="media|original,title,description" media_text="under" media_overlay_opacity="50" media_overlay_anim="no" media_h_align="center" media_padding="2" media_title_dimension="h2" media_title_height="fontheight-179065" media_title_space="fontspace-781688" uncode_shortcode_id="604513" media_subtitle_custom="Change the color to match your brand" media_title_custom="Medium headline" media_link="url:%23"][vc_empty_space empty_h="2" desktop_visibility="yes" medium_visibility="yes"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="2"  overlay_alpha="50" preserve_border="yes" preserve_border_tablet="yes" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="359491" css=".vc_custom_1640014331163{border-right-width: 1px !important;padding-top: 0px !important;padding-bottom: 0px !important;}" border_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="80" media_ratio="four-five" alignment="center" advanced="yes" media_items="media|original,title,description" media_text="under" media_overlay_opacity="50" media_overlay_anim="no" media_h_align="center" media_padding="2" media_title_dimension="h2" media_title_height="fontheight-179065" media_title_space="fontspace-781688" uncode_shortcode_id="604513" media_subtitle_custom="Change the color to match your brand" media_title_custom="Medium headline" media_link="url:%23"][vc_empty_space empty_h="2" desktop_visibility="yes" medium_visibility="yes"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="155889" css=".vc_custom_1640014338421{padding-top: 0px !important;padding-bottom: 0px !important;}"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="80" media_ratio="four-five" alignment="center" advanced="yes" media_items="media|original,title,description" media_text="under" media_overlay_opacity="50" media_overlay_anim="no" media_h_align="center" media_padding="2" media_title_dimension="h2" media_title_height="fontheight-179065" media_title_space="fontspace-781688" uncode_shortcode_id="604513" media_subtitle_custom="Change the color to match your brand" media_title_custom="Medium headline" media_link="url:%23"][/vc_column][/vc_row]
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
