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

$data[ 'name' ]             = esc_html__( 'Portfolio Single Parallax Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Single-Parallax-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" inverted_device_order="yes" uncode_shortcode_id="414204" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="3" shift_y_down="0" z_index="3" medium_width="0" mobile_width="0" parallax_intensity="10" width="5/12" uncode_shortcode_id="206476"][uncode_index el_id="index-1" index_type="css_grid" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="480" screen_md_items="1" screen_md_breakpoint="480" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="title" portfolio_items="title,text|excerpt|120,spacer|one,link|circle|default_size" single_style="dark" single_overlay_opacity="50" single_padding="0" single_title_dimension="fontsize-338686" single_text_lead="yes" uncode_shortcode_id="173735" offset="1"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="7/12" uncode_shortcode_id="178745"][uncode_index el_id="index-11" index_type="css_grid" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="480" screen_md_items="1" screen_md_breakpoint="480" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="0" portfolio_items="media|featured|onpost|original" css_grid_images_size="five-four" single_style="dark" single_shape="round" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_padding="0" single_title_dimension="fontsize-155944" single_text_lead="yes" single_shadow="yes" shadow_weight="lg" shadow_darker="yes" single_border="yes" uncode_shortcode_id="647131" offset="1"][uncode_vertical_text text_align="top" position="right" flip="yes" vertical_text_h_pos="2" vertical_text_v_pos="0" z_index="0"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="202344"]Case 02[/uncode_vertical_text][/vc_column][/vc_row]
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
