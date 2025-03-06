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

$data[ 'name' ]             = esc_html__( 'Gallery Creative Product', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Creative-Product.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" top_divider="step" uncode_shortcode_id="166007"][vc_column column_width_percent="100" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="bottom-t-top" width="1/1" uncode_shortcode_id="156725"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="1" shift_y="0" z_index="0" uncode_shortcode_id="102237" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="3" width="2/12" uncode_shortcode_id="697986"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="one-one" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="191561"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="5" width="4/12" uncode_shortcode_id="514635"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="one-one" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="111541"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="7" width="4/12" uncode_shortcode_id="475284"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="four-three" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="527064"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="7" width="2/12" uncode_shortcode_id="846048"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="four-three" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="925559"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="1" shift_y="0" z_index="0" uncode_shortcode_id="161864" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="7" width="2/12" uncode_shortcode_id="151451"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="four-three" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="204574"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="7" width="6/12" uncode_shortcode_id="201485"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="four-three" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="194114"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="5" width="3/12" uncode_shortcode_id="638096"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="one-one" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="196269"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="3" width="1/12" uncode_shortcode_id="268439"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_lightbox="'. uncode_wf_print_single_image( 'yes' ) .'" media_width_percent="100" media_ratio="one-one" lbox_skin="white" lbox_title="yes" lbox_connected="yes" uncode_shortcode_id="133110"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
