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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical with Images', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-with-Images.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="146932" css=".vc_custom_1672828684143{border-top-width: 1px !important;}" border_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="188041"][vc_tabs vertical="yes" tab_no_fade="yes" typography="advanced" tab_no_border="yes" valign_middle="yes" tabs_align="opposite" tab_custom_size="yes" tab_size="4" tab_gap="3" custom_padding="yes" gutter_tab="1" active_bg_color="color-prif" active_txt_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="sm" titles_size="h3" titles_weight="600" gutter_simple="1" uncode_shortcode_id="162041" active_bg_color_type="uncode-palette" active_txt_color_type="uncode-palette"][vc_tab icon="fa fa-heart2" icon_size="md" gutter_size="2" column_padding="0" title="Instant comfort" tab_id="1671538525849-0-916728286254621715765262244"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shadow="yes" shadow_weight="lg" css_animation="zoom-in" uncode_shortcode_id="582377"][/vc_tab][vc_tab icon="fa fa-pencil2" icon_size="md" gutter_size="2" column_padding="0" title="Minimal design" tab_id="1671538525912-0-616728286254621715765262244"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="zoom-in" uncode_shortcode_id="210304"][/vc_tab][vc_tab icon="fa fa-layers2" icon_size="md" gutter_size="2" column_padding="0" title="Different colors" tab_id="1671538525982-0-916728286254621715765262244"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="zoom-in" uncode_shortcode_id="880315"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
