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

$data[ 'name' ]             = esc_html__( 'Tabs with Gallery', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-with-Gallery.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="657137"][vc_column width="1/1"][vc_tabs tabs_event="box-resized" no_lazy="yes" tab_no_fade="yes" tab_scrolling="yes" animation_active="yes" typography="advanced" width_100="yes" titles_size="h5" titles_weight="600" gutter_simple="0" uncode_shortcode_id="180762"][vc_tab gutter_size="2" column_padding="3" title="Travel" tab_id="1671543245961-2-816728503101981715766335157" slug="travel"][vc_gallery el_id="gallery-1916041" type="css_grid" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471 ) ) .'" grid_items="5" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" css_grid_images_size="two-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_border="yes" uncode_shortcode_id="146259"][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Graphic" tab_id="1671543045-1-016728503101971715766335157" slug="graphic"][vc_gallery el_id="gallery-19160412" type="css_grid" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471 ) ) .'" grid_items="5" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" css_grid_images_size="two-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_border="yes" uncode_shortcode_id="739273"][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Trends" tab_id="1671543045-2-7816728503101981715766335157" slug="trends"][vc_gallery el_id="gallery-1916043" type="css_grid" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471 ) ) .'" grid_items="5" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" css_grid_images_size="two-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_border="yes" uncode_shortcode_id="895154"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
