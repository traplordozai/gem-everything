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

$data[ 'name' ]             = esc_html__( 'Content Creative Designers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Creative-Designers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="4" column_width_percent="100" shift_y="0" z_index="1" top_divider="step_1_2" uncode_shortcode_id="735141" back_color_type="uncode-palette" back_size="initial" shape_dividers=""][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" parallax_intensity="2" width="1/1" uncode_shortcode_id="122516"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="3/12" uncode_shortcode_id="107052"][uncode_counter value="95" counter_color="accent"  size="fontsize-160206" weight="400" height="fontheight-161249" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" css_animation="zoom-in" uncode_shortcode_id="186401" counter_color_type="uncode-palette"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="9/12" uncode_shortcode_id="202189"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" css_animation="curtain-words" animation_speed="800" uncode_shortcode_id="650636"]Long headline to turn your visitors into customers[/vc_custom_heading][/vc_column_inner][/vc_row_inner][uncode_vertical_text text_align="top" vertical_text_h_pos="-4" vertical_text_v_pos="0" z_index="0" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" mobile_visibility="yes" uncode_shortcode_id="167579"]⸻ About[/uncode_vertical_text][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider_inv="step_3_4" shape_bottom_invert="yes" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="100" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0" row_name="Events" uncode_shortcode_id="420226" shape_bottom_color_type="uncode-palette" back_size="initial"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" parallax_intensity="2" width="9/12" uncode_shortcode_id="753437"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="3/12" uncode_shortcode_id="502531"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="142139" text_color_type="uncode-palette"]Discover[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="9/12" uncode_shortcode_id="201005"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="232909" text_color_type="uncode-palette"]Working at the sweet spot between minimalism and sustainability to develop visual solutions that inform and persuade.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="3/12" uncode_shortcode_id="164028"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="804155" text_color_type="uncode-palette"]Prototyping[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="9/12" uncode_shortcode_id="451735"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="279930" text_color_type="uncode-palette"]Performing at the junction of minimalism and mathematics to craft experiences that go beyond design, I prefer clear logic.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="3/12" uncode_shortcode_id="175878"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="959032" text_color_type="uncode-palette"]Creation[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="9/12" uncode_shortcode_id="191854"][vc_custom_heading text_color="color-wvjs" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="144493" text_color_type="uncode-palette"]Doing at the intersection of design and elegance to create great work for living breathing human beings.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_width="0" css_animation="zoom-in" animation_speed="800" parallax_intensity="4" width="3/12" uncode_shortcode_id="488482"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" uncode_shortcode_id="195423"][vc_button size="btn-link" custom_typo="yes" icon_position="right" scale_mobile="no" icon="fa fa-arrow-right2" uncode_shortcode_id="214533" link="url:https%3A%2F%2F1.envato.market%2FQ3bJP%2F|title:Creative%20Event"]Services[/vc_button][/vc_column][/vc_row]
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
