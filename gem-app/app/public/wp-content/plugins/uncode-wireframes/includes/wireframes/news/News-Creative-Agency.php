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

$data[ 'name' ]             = esc_html__( 'News Creative Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Creative-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" style="dark" overlay_alpha="100" gutter_size="0" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="700"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" sub_lead="yes" sub_reduced="yes" text_align="text-center" text_serif="" subheading="Change the color to match your brand or vision and more."]Short headline[/vc_custom_heading][vc_empty_space empty_h="3"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="0" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" style="inherited" el_class="blog-carousel"][vc_column column_width_percent="100" position_horizontal="left" align_horizontal="align_center" style="dark" overlay_alpha="100" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="0" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="90" align_horizontal="align_center" override_padding="yes" column_padding="1" gutter_size="3" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="-4" shift_y_fixed="yes" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full=""][uncode_index el_id="index-73887447" index_type="carousel" loop="size:9|order_by:date|order:DESC|by_id:-4245" index_back_color="color-gyho" carousel_lg="4" carousel_md="2" carousel_sm="1" thumb_size="sixteen-nine" gutter_size="1" post_items="icon,date,title,text|excerpt|65,sep-one|full,author" carousel_height="equal" carousel_interval="0" carousel_navspeed="400" carousel_dots="yes" carousel_dots_mobile="yes" stage_padding="0" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_color="color-wayh" single_overlay_opacity="80" single_text_anim_type="btt" single_image_anim="no" single_h_align_mobile="center" single_padding="4" single_title_dimension="h3" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" footer_position="left" carousel_rtl="" single_title_serif="" single_no_background="" order_ids="20528,4225,4252,20518,4193,4229,4254" single_icon="fa fa-plus2"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
