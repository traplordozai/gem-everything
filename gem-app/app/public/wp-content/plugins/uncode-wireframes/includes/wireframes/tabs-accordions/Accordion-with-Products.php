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

$data[ 'name' ]             = esc_html__( 'Accordion with Products', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-with-Products.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="712622" column_width_pixel="1500"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="143750"][vc_accordion history="yes" target="row" panel_event="box-resized" typography="advanced" sign="plus" content_border="yes" title_padding="yes" gutter_simple="1" no_h_padding="yes" titles_size="h5" titles_weight="600" uncode_shortcode_id="655529"][vc_accordion_tab icon="fa fa-mobile2" gutter_size="2" column_padding="2" title="Electronics" tab_id="1672910743-1-81715764726316" slug="electronics"][uncode_index el_id="index-1539517894567" index_type="css_grid" loop="size:3|order_by:price|post_type:product|tax_query:202|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|fluid-w-atc|atc-typo-column|show-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h6" single_title_weight="600" single_border="yes" single_css_animation="alpha-anim" single_animation_sequential="no" uncode_shortcode_id="178147"][vc_empty_space][/vc_accordion_tab][vc_accordion_tab icon="fa fa-profile-male" gutter_size="2" column_padding="2" title="Apparel" tab_id="1672910743-2-211715764726316" slug="apparel"][uncode_index el_id="index-1539517895678" index_type="css_grid" loop="size:3|order_by:price|post_type:product|tax_query:200|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|fluid-w-atc|atc-typo-column|show-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h6" single_border="yes" single_css_animation="alpha-anim" uncode_shortcode_id="158421"][vc_empty_space][/vc_accordion_tab][vc_accordion_tab icon="fa fa-strategy" gutter_size="2" column_padding="2" title="Accessories" tab_id="1672910864621-2-61715764726316" slug="accessories"][uncode_index el_id="index-15456798767" index_type="css_grid" loop="size:3|order_by:price|post_type:product|tax_query:199|taxonomy_count:10" grid_items="3" screen_lg_items="3" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,title,category|nobg|relative|display-icon,date,text|excerpt,sep-one|full,extra" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|fluid-w-atc|atc-typo-column|show-atc,title,price|inline,quick-view-button,wishlist-button" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_image_anim="no" single_secondary="yes" single_h_align="center" single_padding="1" single_title_dimension="h6" single_border="yes" single_css_animation="alpha-anim" uncode_shortcode_id="615330"][vc_empty_space][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
