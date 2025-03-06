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

$data[ 'name' ]             = esc_html__( 'Tabs with Products Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-with-Products-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="698999"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="603940"][vc_tabs history="yes" target="row" tabs_event="box-resized" no_lazy="yes" tab_no_fade="yes" tab_scrolling="yes" animation_active="yes" typography="advanced" align="left" titles_size="h6" titles_weight="600" gutter_simple="0" uncode_shortcode_id="743544"][vc_tab icon="fa fa-caret-right" icon_size="md" gutter_size="2" column_padding="2" title="Elettronics" tab_id="1671544068364-0-9167282925680116728333209551715766406394" slug="elettronics"][uncode_index el_id="index-15395178945674" index_type="css_grid" loop="size:3|order_by:title|post_type:product|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h5" single_border="yes" single_css_animation="alpha-anim" single_animation_sequential="no" uncode_shortcode_id="198574"][/vc_tab][vc_tab icon="fa fa-caret-right" icon_size="md" gutter_size="2" column_padding="2" title="Apparel" tab_id="1671544068478-0-1167282925680116728333209551715766406394" slug="apparel"][uncode_index el_id="index-15395178945677" index_type="css_grid" loop="size:3|order_by:title|post_type:product|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h5" single_border="yes" single_css_animation="alpha-anim" single_animation_sequential="no" uncode_shortcode_id="198574"][/vc_tab][vc_tab icon="fa fa-caret-right" icon_size="md" gutter_size="2" column_padding="2" title="Accessories" tab_id="1671544068616-0-7167282925680116728333209551715766406394" slug="accessories"][uncode_index el_id="index-1539517894567" index_type="css_grid" loop="size:3|order_by:title|post_type:product|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h5" single_border="yes" single_css_animation="alpha-anim" single_animation_sequential="no" uncode_shortcode_id="198574"][/vc_tab][vc_tab icon="fa fa-caret-right" icon_size="md" gutter_size="2" column_padding="2" title="Bicycles" tab_id="1672830370293-3-216728333209551715766406394" slug="bicycles"][uncode_index el_id="index-15395178945676" index_type="css_grid" loop="size:3|order_by:title|post_type:product|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h5" single_border="yes" single_css_animation="alpha-anim" single_animation_sequential="no" uncode_shortcode_id="198574"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
