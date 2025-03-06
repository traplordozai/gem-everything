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

$data[ 'name' ]             = esc_html__( 'Team Members with Numbers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-with-Numbers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="603880"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="125957"][vc_custom_heading text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="accent" radius="sm" uncode_shortcode_id="145023" text_color_type="uncode-palette" back_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="128136"][vc_column_inner width="8/12"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="111031"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="4/12" uncode_shortcode_id="211907"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="128136"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="2/12" uncode_shortcode_id="173524"][uncode_counter value="150" counter_color="" size="fontsize-155944" weight="600" text="Patients" uncode_shortcode_id="431171" suffix="+"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="2/12" uncode_shortcode_id="193465"][uncode_counter value="96" counter_color="" size="fontsize-155944" weight="600" text="Satisfaction" uncode_shortcode_id="207651" suffix="%"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="5/12" uncode_shortcode_id="162267"][vc_separator sep_color=",Default"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="3/12" uncode_shortcode_id="135423"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="two-one" alignment="right" uncode_shortcode_id="145781" media_width_pixel="180"][/vc_column_inner][/vc_row_inner][vc_empty_space][vc_gallery el_id="gallery-3184678-345" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 84155,84155,84155,84155 ) ) .'" carousel_lg="4" carousel_md="3" carousel_sm="2" thumb_size="four-five" gutter_size="3" media_items="media|nolink|original,title" carousel_interval="3000" carousel_navspeed="400" stage_padding="0" single_text="under" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_title_dimension="h5" single_title_weight="600" single_meta_custom_typo="yes" single_meta_size="default" single_meta_weight="400" single_border="yes" single_css_animation="alpha-anim" single_animation_speed="1000" single_animation_first="yes" carousel_rtl="" single_half_padding="yes" single_title_uppercase="" single_title_serif="" single_no_background="yes" items="eyIxMzc2M19pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc2OV9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc3MF9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc2Nl9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9fQ==" uncode_shortcode_id="138181"][/vc_column][/vc_row]
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
