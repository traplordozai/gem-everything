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

$data[ 'name' ]             = esc_html__( 'Portfolio Creative Designers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Creative-Designers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" align_horizontal="align_right" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" shift_x="5" shift_y="0" shift_y_down="0" z_index="2" width="3/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="single-curtain" animation_delay="400" interval_animation="20"]Medium
headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" shift_x="0" shift_y="0" z_index="0" css_animation="bottom-t-top" animation_delay="800" width="8/12"][uncode_index el_id="index-979605" loop="size:7|order_by:date|post_type:portfolio" filtering="yes" filtering_full_width="yes" filtering_position="right" filtering_uppercase="yes" filter_mobile="yes" gutter_size="4" portfolio_items="icon,media|featured|onpost|original,title" screen_lg="740" screen_md="600" screen_sm="480" single_width="3" images_size="one-one" single_overlay_opacity="35" single_h_align_mobile="center" single_padding="2" single_title_dimension="h4" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="600" single_animation_delay="200" items="eyI0MTU0X2kiOnsiaW1hZ2VzX3NpemUiOiJ0aHJlZS1mb3VyIiwic2luZ2xlX3dpZHRoIjoiNSJ9LCI0MTUxX2kiOnsiaW1hZ2VzX3NpemUiOiJ0aHJlZS1mb3VyIiwic2luZ2xlX3dpZHRoIjoiMyJ9LCI0MTQ2X2kiOnsic2luZ2xlX3dpZHRoIjoiNCJ9LCI0MTQyX2kiOnsic2luZ2xlX3dpZHRoIjoiNCJ9LCI0MDg3X2kiOnsic2luZ2xlX3dpZHRoIjoiMiJ9fQ==" single_icon="fa fa-plus2"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_visibility="yes" medium_width="0" mobile_visibility="yes" shift_x="0" shift_y="0" z_index="0" width="1/12"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
