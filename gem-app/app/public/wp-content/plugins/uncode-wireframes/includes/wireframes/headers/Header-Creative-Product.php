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

$data[ 'name' ]             = esc_html__( 'Header Creative Product', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Creative-Product.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="6" bottom_padding="6" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="504011" back_color_type="uncode-palette"][vc_column width="1/1"][vc_row_inner limit_content=""][vc_column_inner width="2/12"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="8/12" uncode_shortcode_id="876389"][vc_empty_space empty_h="0"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" css_animation="typewriter" interval_animation="40" uncode_shortcode_id="195089" heading_custom_size="clamp(40px,5vw,105px)"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][vc_column_inner width="2/12"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" top_divider="step" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_color="accent" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="189483" shape_bottom_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="10" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="2/12" uncode_shortcode_id="163376"][vc_icon icon="fa fa-play" icon_color="accent" background_style="fa-squared" size="fa-2x" icon_automatic="yes" uncode_shortcode_id="168432" icon_color_type="uncode-palette"][/vc_icon][uncode_vertical_text text_align="bottom" vertical_text_h_pos="3" vertical_text_v_pos="0" z_index="0" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="500" text_transform="uppercase" text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" medium_visibility="yes" mobile_visibility="yes" uncode_shortcode_id="214056" text_color_type="uncode-palette"]55°51′N 4°16′W ⸻[/uncode_vertical_text][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0" back_color="color-rgdb" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="10/12" uncode_shortcode_id="981801" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="sixteen-nine" advanced_videos="yes" css_animation="alpha-anim" animation_speed="1000" mobile_videos="autoplay" uncode_shortcode_id="428361"][/vc_column][/vc_row]
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
