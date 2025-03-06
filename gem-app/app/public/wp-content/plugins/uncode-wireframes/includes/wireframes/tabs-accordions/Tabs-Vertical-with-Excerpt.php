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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical with Excerpt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-with-Excerpt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="112842"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="813482"][vc_tabs vertical="yes" history="yes" target="row" tab_no_fade="yes" typography="advanced" tab_no_border="yes" valign_middle="yes" tabs_align="opposite" tab_custom_size="yes" tab_size="5" tab_gap="3" custom_padding="yes" gutter_tab="1" titles_ titles_size="h4" titles_weight="600" excerpt_text_size="'. uncode_wf_print_font_size( 'yes' ) .'" gutter_simple="1" uncode_shortcode_id="703778"][vc_tab icon="fa fa-chevron-right" icon_size="sm" gutter_size="2" column_padding="0" title="Incredible design" tab_id="1671537737931-0-816728240038961715765414803" excerpt="Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators." slug="design"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" css_animation="zoom-in" uncode_shortcode_id="290487"][/vc_tab][vc_tab icon="fa fa-chevron-right" icon_size="sm" gutter_size="2" column_padding="0" title="Modern look and feel" tab_id="1671537737963-0-216728240038961715765414803" excerpt="Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits." slug="look"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" css_animation="zoom-in" uncode_shortcode_id="851083"][/vc_tab][vc_tab icon="fa fa-chevron-right" icon_size="sm" gutter_size="2" column_padding="0" title="Different trends styles" tab_id="1671537738002-0-1016728240038961715765414803" excerpt="Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas." slug="trends"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" css_animation="zoom-in" uncode_shortcode_id="200767"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
