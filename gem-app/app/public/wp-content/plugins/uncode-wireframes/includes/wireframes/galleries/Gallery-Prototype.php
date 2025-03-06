<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Gallery Prototype', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Prototype.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="2" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="1" uncode_shortcode_id="798722" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="136161"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="5" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" parallax_intensity="1" width="1/3" uncode_shortcode_id="173129"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="65" media_ratio="one-one" alignment="right" shape="img-round" radius="lg" uncode_shortcode_id="190317"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="707093"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="3" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/3" uncode_shortcode_id="475587"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="30" media_ratio="one-one" alignment="center" shape="img-round" radius="lg" uncode_shortcode_id="467600"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="-3" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" parallax_intensity="3" width="2/12" uncode_shortcode_id="179928"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="40" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="208762"][/vc_column_inner][vc_column_inner column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="751079" column_width_pixel="700"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" css_animation="text-reveal" text_reveal_opacity="20" text_reveal_speed="10" text_reveal_top="70" uncode_shortcode_id="134405" heading_custom_size="clamp(30px, 4vw, 50px)"]Long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading text_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="119855" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_button size="btn-lg" border_width="0" scale_mobile="no" uncode_shortcode_id="166091"]Click the Button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="-3" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" parallax_intensity="2" width="2/12" uncode_shortcode_id="201967"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="right" shape="img-round" radius="lg" uncode_shortcode_id="941188"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" parallax_intensity="1" width="1/3" uncode_shortcode_id="131713"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="40" media_ratio="one-one" alignment="center" shape="img-round" radius="lg" uncode_shortcode_id="148652"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="-2" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/3" uncode_shortcode_id="740194"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="65" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="778700"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="-2" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" parallax_intensity="4" width="1/3" uncode_shortcode_id="138691"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="40" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="128740"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
