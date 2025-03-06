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

$data[ 'name' ]             = esc_html__( 'Team Members Grid Fullwidth', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-Grid-Fullwidth.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column width="1/1"][vc_gallery el_id="gallery-3377778" medias="'. uncode_wf_print_multiple_images( array( 84155,84155,84155,84155,84155,84155,84155,84155 ) ) .'" style_preset="metro" gallery_back_color="color-wayh" gutter_size="0" media_items="media|lightbox|original,title,caption" screen_lg="1000" screen_md="600" screen_sm="480" single_width="3" single_height="3" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="50" single_text_visible="yes" single_text_anim_type="btt" single_overlay_visible="yes" single_v_position="bottom" single_padding="2" single_text_reduced="yes" single_title_dimension="h4" single_border="yes" carousel_rtl="" single_half_padding="yes" single_title_uppercase="" single_title_serif="" single_no_background="" items="eyIxMzQwOF9pIjp7InNpbmdsZV93aWR0aCI6IjQiLCJzaW5nbGVfaGVpZ2h0IjoiNCJ9LCIxMzQwOV9pIjp7InNpbmdsZV93aWR0aCI6IjQiLCJzaW5nbGVfaGVpZ2h0IjoiNCJ9LCIxMzc2M19pIjp7InNpbmdsZV93aWR0aCI6IjQiLCJzaW5nbGVfaGVpZ2h0IjoiNCJ9LCIxMzc2Nl9pIjp7InNpbmdsZV93aWR0aCI6IjQiLCJzaW5nbGVfaGVpZ2h0IjoiNCJ9fQ=="][/vc_column][/vc_row]
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
