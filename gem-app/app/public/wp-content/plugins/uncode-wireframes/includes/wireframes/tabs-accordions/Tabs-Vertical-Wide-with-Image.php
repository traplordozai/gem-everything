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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical Wide with Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-Wide-with-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="163485"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="188041"][vc_tabs vertical="yes" tab_hover="yes" tab_no_fade="yes" typography="advanced" tab_no_border="yes" valign_middle="yes" tab_custom_size="yes" tab_size="4" tab_gap="5" titles_size="h1" titles_weight="600" gutter_simple="0" uncode_shortcode_id="128874"][vc_tab icon="fa fa-arrow-right2" icon_position="right" icon_size="sm" gutter_size="2" column_padding="0" title="Stores" tab_id="1671537308454-0-516728275756431715765334799"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" shape="img-round" radius="xs" shadow="yes" shadow_weight="lg" css_animation="right-t-left" uncode_shortcode_id="157915"][/vc_tab][vc_tab icon="fa fa-arrow-right2" icon_position="right" icon_size="sm" gutter_size="2" column_padding="0" title="Portfolio" tab_id="1671537308494-0-516728275756431715765334799"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" shape="img-round" radius="xs" shadow="yes" shadow_weight="lg" css_animation="right-t-left" uncode_shortcode_id="365190"][/vc_tab][vc_tab icon="fa fa-arrow-right2" icon_position="right" icon_size="sm" gutter_size="2" column_padding="0" title="Magazine" tab_id="1671537308543-0-016728275756431715765334799"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" shape="img-round" radius="xs" shadow="yes" shadow_weight="lg" css_animation="right-t-left" uncode_shortcode_id="202244"][/vc_tab][vc_tab icon="fa fa-arrow-right2" icon_position="right" icon_size="sm" gutter_size="2" column_padding="0" title="Business" tab_id="1672827828077-3-71715765334799"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" shape="img-round" radius="xs" shadow="yes" shadow_weight="lg" css_animation="right-t-left" uncode_shortcode_id="158864"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
