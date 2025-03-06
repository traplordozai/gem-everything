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

$data[ 'name' ]             = esc_html__( 'Header Creative Company', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Company.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="4" top_padding="4" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" uncode_shortcode_id="133309" back_color_type="uncode-palette" el_class="overflow-hidden" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="112102"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="171274"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="898854"][vc_empty_space empty_h="5"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" css_animation="curtain" animation_speed="1000" animation_delay="400" uncode_shortcode_id="106785"]Medium length headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="137179"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="2/12" uncode_shortcode_id="127463"][vc_icon icon="fa fa-star-o" size="fa-2x" uncode_shortcode_id="138264"][/vc_icon][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="173155"]Energy Awards 2024[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="134686"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/4" uncode_shortcode_id="104577" css=".vc_custom_1680601715767{padding-top: 0px !important;}"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="405774"]⸺ Headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/4" uncode_shortcode_id="468325" css=".vc_custom_1680601734366{padding-top: 0px !important;}"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="405774"]⸺ Headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12" uncode_shortcode_id="557331"][vc_empty_space empty_h="4" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" mobile_visibility="yes" limit_content="" uncode_shortcode_id="134015"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="5/12" uncode_shortcode_id="166118"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" back_color="accent" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_width="0" css_animation="bottom-t-top" animation_speed="1000" animation_delay="400" width="2/12" uncode_shortcode_id="178893" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="174761"]News[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark"  back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="bottom-t-top" animation_speed="1000" animation_delay="400" width="5/12" uncode_shortcode_id="185035" back_color_type="uncode-palette" link_to="url:%23"][uncode_index el_id="index-930574" index_type="carousel" loop="size:3|order_by:date|post_type:post|taxonomy_count:10" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="five-four" gutter_size="3" post_items="media|featured|onpost|original,date,title,text|excerpt|60" carousel_interval="5000" carousel_navspeed="1000" carousel_loop="yes" stage_padding="0" single_text="lateral" single_image_size="2" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_text_reduced="yes" single_title_dimension="h5" single_title_height="fontheight-357766" single_text_lead="small" single_meta_custom_typo="yes" single_meta_weight="600" single_border="yes" uncode_shortcode_id="490467"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
