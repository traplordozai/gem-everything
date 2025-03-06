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

$data[ 'name' ]             = esc_html__( 'Content Equal Height Justify Light', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Equal-Height-Justify-Light.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="130847" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="4" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" preserve_border="yes" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" shadow="std" width="1/3" uncode_shortcode_id="134657" back_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="380915"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="138612"][/vc_icon][vc_custom_heading uncode_shortcode_id="748293"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="567798"]Minimal design, an aesthetic marvel, celebrates the art of simplicity and elegance. It is a design philosophy that strips away the extraneous, leaving behind only the essential elements to create a visual language that speaks volumes with subtlety.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_button border_width="0" uncode_shortcode_id="127630"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="4" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" shadow="std" width="1/3" uncode_shortcode_id="113010" back_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="119185"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="138612"][/vc_icon][vc_custom_heading uncode_shortcode_id="748293"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="920040"]The beauty of minimal design lies in its ability to convey a sense of tranquility and sophistication through understated elements.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_button border_width="0" uncode_shortcode_id="127630"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="4" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" shadow="std" width="1/3" uncode_shortcode_id="338874" back_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="380915"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="138612"][/vc_icon][vc_custom_heading uncode_shortcode_id="748293"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="115969"]Within the realm of minimal design, every element serves a purpose, and every detail is meticulously curated.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_button border_width="0" uncode_shortcode_id="127630"]Click the button[/vc_button][/vc_column][/vc_row]
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
