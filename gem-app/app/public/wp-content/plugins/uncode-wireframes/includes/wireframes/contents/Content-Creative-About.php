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

$data[ 'name' ]             = esc_html__( 'Content Creative About', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Creative-About.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="578732" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/1" uncode_shortcode_id="576305"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="113572"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="4/12" uncode_shortcode_id="230254"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" alignment="center" uncode_shortcode_id="355986" el_class="unmask-blob-3"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="7/12" uncode_shortcode_id="208241"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" uncode_shortcode_id="556869" el_class="rotate-minus-beta" text_color_type="uncode-palette"]Headline[/vc_custom_heading][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" uncode_shortcode_id="834266" el_class="rotate-plus-beta" text_color_type="uncode-palette"]Headline[/vc_custom_heading][vc_empty_space empty_h="1" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/12" uncode_shortcode_id="167859"][/vc_column_inner][/vc_row_inner][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="493259" heading_custom_size="clamp(20px, 3vw, 30px)"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="201280"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="2/12" uncode_shortcode_id="157416"][uncode_counter value="20" counter_color=""  size="custom" weight="800" height="fontheight-357766" text="Years Experience" uncode_shortcode_id="199073" suffix="y" heading_custom_size="clamp(35px, 8vw, 50px)"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="2/12" uncode_shortcode_id="605051"][uncode_counter value="12" counter_color=""  size="custom" weight="800" height="fontheight-357766" text="Culinary Books" uncode_shortcode_id="711545" heading_custom_size="clamp(35px, 8vw, 50px)"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="2/12" uncode_shortcode_id="392645"][uncode_counter value="50" counter_color=""  size="custom" weight="800" height="fontheight-357766" text="Burger Recipes" uncode_shortcode_id="159327" suffix="+" heading_custom_size="clamp(35px, 8vw, 50px)"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="3/12" uncode_shortcode_id="570379"][vc_separator sep_color=",Default"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="3/12" uncode_shortcode_id="458583"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="two-one" uncode_shortcode_id="623864" media_width_pixel="220"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="1"][/vc_column][/vc_row]
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
