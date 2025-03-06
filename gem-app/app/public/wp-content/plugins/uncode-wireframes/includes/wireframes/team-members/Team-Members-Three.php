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

$data[ 'name' ]             = esc_html__( 'Team Members Three', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-Three.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" style="inherited" css=".vc_custom_1555675465412{border-bottom-width: 1px !important;}"][vc_column column_width_percent="100" overlay_alpha="100" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-3184563" medias="'. uncode_wf_print_multiple_images( array( 84155,84155,84155 ) ) .'" gutter_size="0" media_items="media|custom_link|original,title,caption,team-social" screen_lg="830" screen_md="600" screen_sm="480" images_size="one-one" single_overlay_opacity="50" single_h_align="center" single_reduced="three_quarter" single_h_position="center" single_padding="2" single_elements_click="yes" single_title_dimension="h5" single_border="yes"  carousel_rtl="" single_half_padding="yes" single_title_uppercase="" single_title_serif="" single_no_background="yes" items="eyIxMzc2M19pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc2OV9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc3MF9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9LCIxMzc2Nl9pIjp7InNpbmdsZV9saW5rIjoidXJsOmh0dHAlM0ElMkYlMkZ3d3cudW5kc2duLmNvbXx8dGFyZ2V0OiUyMF9ibGFuayJ9fQ=="][/vc_column][/vc_row]
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
