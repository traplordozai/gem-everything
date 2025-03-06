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

$data[ 'name' ]             = esc_html__( 'Content Images Parallax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Images-Parallax.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="149449" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="138536"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="134335"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="184036" column_width_pixel="600"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="285213"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="582003"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="584301"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="162781"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" advanced="yes" media_items="media|original,title" media_overlay_color="color-prif" media_overlay_coloration="bottom_gradient" media_overlay_opacity="100" media_overlay_visible="yes" media_text_visible="yes" media_h_align="center" media_v_position="bottom" media_h_position="center" media_padding="2" media_title_dimension="h3" media_title_weight="400" css_animation="parallax" parallax_intensity="3" uncode_shortcode_id="302228" media_overlay_color_type="uncode-palette" media_title_custom="Occasions"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="108956"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" advanced="yes" media_items="media|original,title" media_overlay_color="color-prif" media_overlay_coloration="bottom_gradient" media_overlay_opacity="100" media_overlay_visible="yes" media_text_visible="yes" media_h_align="center" media_v_position="bottom" media_h_position="center" media_padding="2" media_title_dimension="h3" media_title_weight="400" uncode_shortcode_id="125646" media_overlay_color_type="uncode-palette" media_title_custom="Restaurant"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="163706"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" advanced="yes" media_items="media|original,title" media_overlay_color="color-prif" media_overlay_coloration="bottom_gradient" media_overlay_opacity="100" media_overlay_visible="yes" media_text_visible="yes" media_h_align="center" media_v_position="bottom" media_h_position="center" media_padding="2" media_title_dimension="h3" media_title_weight="400" css_animation="parallax" parallax_intensity="3" uncode_shortcode_id="138362" media_overlay_color_type="uncode-palette" media_title_custom="Wellness"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
