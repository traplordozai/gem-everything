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

$data[ 'name' ]             = esc_html__( 'Team Members Speakers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-Speakers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" uncode_shortcode_id="925431" back_color_type="uncode-palette" el_class="overflow-hidden"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="5" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="111516"][vc_custom_heading text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" heading_semantic="div" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" css_animation="marquee" marquee_clone="yes" marquee_speed="-1" uncode_shortcode_id="367921" heading_custom_size="clamp(30px,16vw,100px)" text_color_type="uncode-palette"]Medium length headline <span class="text-accent-color">·</span>[/vc_custom_heading][vc_gallery el_id="gallery-171055" type="css_grid" medias="'. uncode_wf_print_multiple_images( array( 84155,84155,84155,84155,84155,84155,84155,84155,84155,84155 ) ) .'" grid_items="5" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="2" screen_sm_breakpoint="480" gutter_size="5" media_items="media|nolink|original,title,caption,team-social" single_text="under" css_grid_images_size="four-three" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="1" single_title_dimension="h4" single_title_weight="800" single_title_space="fontspace-781688" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" shadow_darker="yes" single_border="yes" post_matrix="matrix" uncode_shortcode_id="201602" matrix_items="eyIwX2kiOnsic2luZ2xlX2Nzc19hbmltYXRpb24iOiJwYXJhbGxheCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiIzIn0sIjJfaSI6eyJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjYifX0="][/vc_column][/vc_row]
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
