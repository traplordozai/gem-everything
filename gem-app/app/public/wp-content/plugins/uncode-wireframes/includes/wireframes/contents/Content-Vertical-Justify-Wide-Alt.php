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

$data[ 'name' ]             = esc_html__( 'Content Vertical Justify Wide Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Vertical-Justify-Wide-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" top_divider="step" inverted_device_order="yes" uncode_shortcode_id="608980"][vc_column column_width_use_pixel="yes" position_horizontal="left" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" overlay_color_blend="overlay" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="984947" back_color_type="uncode-palette" column_width_pixel="544"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="796715"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="332020" heading_custom_size="clamp(28px,4vw,60px)"]Long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="342617" heading_custom_size="clamp(18px,4vw,24px)"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_button size="btn-lg" outline="yes" border_width="0" scale_mobile="no" uncode_shortcode_id="269021"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="166671"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="176666"][/vc_column][/vc_row]
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
