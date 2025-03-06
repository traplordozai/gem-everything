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

$data[ 'name' ]             = esc_html__( 'Blog Textual', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Textual.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1555423599400{border-bottom-width: 1px !important;}"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="1/1"][uncode_index el_id="index-1" loop="size:8|order_by:date|post_type:post" infinite="yes" infinite_button="yes" infinite_button_color="accent" gutter_size="3" post_items="date,title,spacer|half,text|excerpt|76,sep-one|full,extra" screen_lg="1200" screen_md="1000" screen_sm="480" single_width="3" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" single_overlay_opacity="90" single_image_color_anim="yes" single_h_align_mobile="center" single_padding="3" single_text_lead="yes" single_title_dimension="h3" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" order_ids="20528,20518,20520,4193,4237,4225,4229,4629,4254,4252,4247,4245,4243,4241,4239,4262,4231,4233"][/vc_column][/vc_row]
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
