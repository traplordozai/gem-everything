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

$data[ 'name' ]             = esc_html__( 'Special Vertical Elements Fixed', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Special-Vertical-Elements-Fixed.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="85" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="720513" back_color_type="uncode-palette" row_height_pixel="380"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="760" uncode_shortcode_id="846933"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" sub_lead="yes" sub_reduced="yes" uncode_shortcode_id="162382"]Medium length headline[/vc_custom_heading][uncode_vertical_text fixed="yes" vertical_text_h_pos="2" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="600" difference="yes" hide_header="yes" uncode_shortcode_id="139733"]<a href="#">[uncode_text_icon text="Lets Talk Now" icon="fa fa-comment" position="after"]</a>[/uncode_vertical_text][uncode_vertical_text fixed="yes" position="right" flip="yes" vertical_text_h_pos="-2" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="600" difference="yes" uncode_shortcode_id="222799"]<a href="#">[uncode_text_icon text="Lets Talk Now" icon="fa fa-comment" position="after"]</a>[/uncode_vertical_text][/vc_column][/vc_row]
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
