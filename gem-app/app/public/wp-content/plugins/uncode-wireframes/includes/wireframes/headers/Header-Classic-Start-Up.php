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

$data[ 'name' ]             = esc_html__( 'Header Classic Start-Up', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Start-Up.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="70" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" css_animation="zoom-in" animation_speed="600" animation_delay="600" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'"]Long headline to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button border_width="0" css_animation="bottom-t-top" animation_delay="800" link="url:%23|||"]Click the button[/vc_button][vc_empty_space empty_h="4"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="20" override_padding="yes" h_padding="0" top_padding="2" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1548093003763{border-bottom-width: 1px !important;}"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" shift_x="0" shift_y="-5" shift_y_fixed="yes" z_index="0" width="1/1"][vc_gallery el_id="gallery-1" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-two" gutter_size="6" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_dots="yes" carousel_dots_mobile="yes" carousel_pointer_events="yes" stage_padding="45" single_shape="round" radius="xs" single_overlay_opacity="50" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_padding="2" single_shadow="yes" shadow_weight="xs" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" lbox_caption="yes"][/vc_column][/vc_row]
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
