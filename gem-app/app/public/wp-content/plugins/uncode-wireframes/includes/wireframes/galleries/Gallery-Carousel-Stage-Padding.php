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

$data[ 'name' ]             = esc_html__( 'Gallery Carousel Stage Padding', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Carousel-Stage-Padding.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="0" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" style="inherited" row_name="Gallery"][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="100" gutter_size="4" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full=""][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="100" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="600" mobile_width_full=""][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" sub_lead="yes" sub_reduced="yes" css_animation="bottom-t-top" animation_delay="100" text_align="text-center" text_uppercase="" text_serif="" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more."]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_gallery el_id="gallery-73689423" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471,80471 ) ) .'" carousel_lg="1" carousel_md="2" carousel_sm="1" thumb_size="nine-sixteen" gutter_size="4" media_items="media|lightbox|original,icon|md" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="70" single_shape="round" radius="xs" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_image_anim="no" single_h_align="center" single_padding="2" single_icon="fa fa-plus2" single_shadow="yes" shadow_weight="xl" shadow_darker="yes" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" lbox_no_tmb="yes" carousel_rtl="" single_title_uppercase="" single_half_padding="" single_title_serif="" single_no_background=""][/vc_column][/vc_row]
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
