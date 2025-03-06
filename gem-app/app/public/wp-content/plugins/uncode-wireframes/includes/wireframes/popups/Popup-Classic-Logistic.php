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

$data[ 'name' ]             = esc_html__( 'Popup Classic Logistic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'popups' ];
$data[ 'custom_class' ]     = 'popups';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'popups/Popup-Classic-Logistic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" uncode_shortcode_id="545703" el_class="pp-even"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="lg" shadow="std" width="1/1" uncode_shortcode_id="492699" el_class="overflow-hidden-uncell"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" inverted_device_order="yes" uncode_shortcode_id="872807" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="166136" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" uncode_shortcode_id="180257"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="795063" subheading="Leverage our intuitive delivery time calculator to get accurate estimates for your shipments, ensuring you can plan with precision and confidence." heading_custom_size="clamp(25px,4vw,50px)"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_button border_width="0" uncode_shortcode_id="202221"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="2" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="525778" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" uncode_shortcode_id="142012"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
