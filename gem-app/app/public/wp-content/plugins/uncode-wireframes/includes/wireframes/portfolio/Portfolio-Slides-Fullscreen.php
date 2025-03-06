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

$data[ 'name' ]             = esc_html__( 'Portfolio Slides Fullscreen', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Slides-Fullscreen.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-138684" loop="size:1|order_by:date|post_type:portfolio" style_preset="metro" single_height_viewport="yes" gutter_size="3" post_items="media|featured|onpost|original,date,title,sep-one|reduced,extra,spacer|one,link|circle" portfolio_items="media|featured|onpost|original,title" screen_lg="100" screen_md="100" screen_sm="100" single_text="overlay" single_width="12" single_fluid_height="100" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_v_position="bottom" single_reduced="half" single_padding="2" single_text_lead="yes" single_title_dimension="h2" single_title_semantic="h2" single_title_height="fontheight-578034" single_border="yes" el_class="add-kburns"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-138684" loop="size:1|order_by:date|post_type:portfolio" style_preset="metro" single_height_viewport="yes" gutter_size="3" post_items="media|featured|onpost|original,date,title,sep-one|reduced,extra,spacer|one,link|circle" portfolio_items="media|featured|onpost|original,title" screen_lg="100" screen_md="100" screen_sm="100" single_text="overlay" single_width="12" single_fluid_height="100" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_v_position="bottom" single_reduced="half" single_padding="2" single_text_lead="yes" single_title_dimension="h2" single_title_semantic="h2" single_title_height="fontheight-578034" single_border="yes" el_class="add-kburns" offset="1"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-138684" loop="size:1|order_by:date|post_type:portfolio" style_preset="metro" single_height_viewport="yes" gutter_size="3" post_items="media|featured|onpost|original,date,title,sep-one|reduced,extra,spacer|one,link|circle" portfolio_items="media|featured|onpost|original,title" screen_lg="100" screen_md="100" screen_sm="100" single_text="overlay" single_width="12" single_fluid_height="100" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_v_position="bottom" single_reduced="half" single_padding="2" single_text_lead="yes" single_title_dimension="h2" single_title_semantic="h2" single_title_height="fontheight-578034" single_border="yes" el_class="add-kburns" offset="2"][/vc_column][/vc_row]
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
