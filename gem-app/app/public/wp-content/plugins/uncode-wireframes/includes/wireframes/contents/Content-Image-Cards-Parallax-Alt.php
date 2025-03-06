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

$data[ 'name' ]             = esc_html__( 'Content Image Cards Parallax Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Image-Cards-Parallax-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" inverted_device_order="yes" uncode_shortcode_id="109247" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_horizontal="left" position_vertical="middle" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="910195"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" sub_lead="yes" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more." uncode_shortcode_id="197554"]Long headline to turn your visitors[/vc_custom_heading][vc_button button_color="color-uydo" size="btn-lg" outline="yes" text_skin="yes" border_width="0" link="url:%23||target:%20_blank|" button_color_type="uncode-palette" uncode_shortcode_id="912260"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" el_class="image-card image-card-inverted image-card-triple" uncode_shortcode_id="222494"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="right" shadow="yes" shadow_weight="std" uncode_shortcode_id="192536"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="right" shadow="yes" shadow_weight="std" css_animation="parallax" parallax_intensity="2" uncode_shortcode_id="788844"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="right" shadow="yes" shadow_weight="std" css_animation="parallax" parallax_intensity="3" uncode_shortcode_id="204962"][uncode_vertical_text position="right" flip="yes" vertical_text_h_pos="1" z_index="0" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" medium_visibility="yes" mobile_visibility="yes" uncode_shortcode_id="260218"]TAGLINE[/uncode_vertical_text][/vc_column][/vc_row]
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
