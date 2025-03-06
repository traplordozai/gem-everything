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

$data[ 'name' ]             = esc_html__( 'Blog Journal', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Journal.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="3" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" css=".vc_custom_1556117697562{border-top-width: 0px !important;}" shape_dividers=""][vc_column column_width_percent="100" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="4" border_color="color-gyho" border_style="solid" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="200" width="1/2" css=".vc_custom_1536877301923{border-right-width: 1px !important;}"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-1" isotope_mode="fitRows" loop="size:2|order_by:date|post_type:post" gutter_size="3" post_items="media|featured|onpost|poster,date,title,text|excerpt|200,icon" screen_lg="480" screen_md="480" screen_sm="480" single_width="6" images_size="three-two" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_padding="2" single_title_dimension="h4" single_border="yes" single_icon="fa fa-plus2"][/vc_column][vc_column column_width_percent="100" override_padding="yes" column_padding="3" overlay_alpha="50" gutter_size="4" border_color="color-gyho" border_style="solid" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="200" width="1/2" css=".vc_custom_1536877306643{border-right-width: 1px !important;}"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Short headline[/vc_custom_heading][uncode_index el_id="index-2" isotope_mode="fitRows" loop="size:8|order_by:date|post_type:post" gutter_size="3" post_items="media|featured|onpost|original,title,date,icon" screen_lg="480" screen_md="480" screen_sm="480" single_text="lateral" single_width="6" images_size="one-one" single_image_size="3" single_lateral_responsive="" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_padding="1" single_title_dimension="h5" single_border="yes" single_icon="fa fa-plus2"][/vc_column][/vc_row]
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
