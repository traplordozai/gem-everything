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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="137580" el_class="test-zero"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="134056"][vc_tabs vertical="yes" history="yes" target="row" tab_no_fade="yes" typography="advanced" tab_no_border="yes" tab_h_border="yes" valign_middle="yes" tab_custom_size="yes" tab_size="4" tab_gap="3" custom_padding="yes" gutter_tab="2" active_bg_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="sm" shadow="lg" tab_tablet_bp="yes" accordion_bp="yes" titles_ titles_size="h3" titles_weight="600" gutter_simple="1" uncode_shortcode_id="855236" active_bg_color_type="uncode-palette"][vc_tab icon="fa fa-camera-retro" icon_size="md" gutter_size="2" column_padding="0" title="Adventures for every traveler" tab_id="1671531983-1-9216728214096591715766073488" excerpt="Collaboratively administrate empowered markets via plug-and-play networks, dynamically procrastinate users installed base benefits." slug="adventures" link="url:%23|title:Discover%20More..."][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shape="img-round" radius="xs" css_animation="bottom-t-top" uncode_shortcode_id="167627"][/vc_tab][vc_tab icon="fa fa-anchor" icon_size="md" gutter_size="2" column_padding="0" title="Immersive and unique experience" tab_id="1671535938245-2-116728214096591715766073488" excerpt="Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators." slug="experience" link="url:%23|title:Discover%20More..."][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shape="img-round" radius="xs" css_animation="bottom-t-top" uncode_shortcode_id="105237"][/vc_tab][vc_tab icon="fa fa-binoculars" icon_size="md" gutter_size="2" column_padding="0" title="Personalised trips for every need" tab_id="1671531983-2-8916728214096591715766073488" excerpt="Efficiently unleash cross-media information without cross-media value, quickly maximize timely deliverables for real-time schemas." slug="trips" link="url:%23|title:Discover%20More..."][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" shape="img-round" radius="xs" css_animation="bottom-t-top" uncode_shortcode_id="992346"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
