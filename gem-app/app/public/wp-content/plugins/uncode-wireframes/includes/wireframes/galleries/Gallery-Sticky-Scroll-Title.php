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

$data[ 'name' ]             = esc_html__( 'Gallery Sticky Scroll Title', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'galleries' ];
$data[ 'custom_class' ]     = 'galleries';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'galleries/Gallery-Sticky-Scroll-Title.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="841474" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="163093"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_weight="500" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="212747"]Short Heading[/vc_custom_heading][vc_gallery el_id="gallery-185343" type="sticky-scroll" sticky_wrap="column" medias="'. uncode_wf_print_multiple_images( array( 80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462,83463,80471,83462 ) ) .'" sticky_th_grid_lg="2.5" sticky_th_grid_md="2.5" sticky_th_grid_sm="1" gutter_size="5" media_items="media|lightbox|original" sticky_scroll_v_align="middle" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_title_dimension="h3" single_border="yes" single_css_animation="alpha-anim" single_animation_speed="1000" lbox_title="yes" lbox_caption="yes" lbox_social="yes" lbox_deep="yes" lbox_no_tmb="yes" horizontal_th_size="vh" uncode_shortcode_id="120893"][vc_empty_space][/vc_column][/vc_row]
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
