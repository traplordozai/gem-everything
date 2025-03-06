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

$data[ 'name' ]             = esc_html__( 'Content Focus with Images', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Focus-with-Images.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="1" bottom_padding="1" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="531120" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" gutter_size="4" override_padding="yes" column_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/2" uncode_shortcode_id="139979" back_color_type="uncode-palette" column_width_pixel="738" border_color_type="uncode-palette" css=".vc_custom_1681978598748{border-top-width: 1px !important;border-right-width: 1px !important;}"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_horizontal="left" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1" uncode_shortcode_id="625996"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="208970"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="929341"][vc_column_inner column_width_percent="100" position_horizontal="left" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="2/3" uncode_shortcode_id="197850"][vc_column_text uncode_shortcode_id="202938"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="167518"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="144539"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="895987"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="300137"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="109032"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" width="1/2" uncode_shortcode_id="459383" back_color_type="uncode-palette" column_width_pixel="480" css=".vc_custom_1681978604172{border-top-width: 1px !important;}" border_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="201564" limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="153081" column_width_pixel="400"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="162255"]Medium length headline[/vc_custom_heading][vc_column_text uncode_shortcode_id="415560"]100% natural and organic[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="201564" limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="912847"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="five-four" uncode_shortcode_id="916776"][uncode_vertical_text vertical_text_h_pos="-2" z_index="0" uncode_shortcode_id="129068"]2023 ⸻ Collection[/uncode_vertical_text][uncode_vertical_text position="right" flip="yes" vertical_text_h_pos="2" z_index="0" uncode_shortcode_id="595928"]2023 ⸻ Collection[/uncode_vertical_text][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="193474" column_width_pixel="500"][vc_button border_width="0" uncode_shortcode_id="100567"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
