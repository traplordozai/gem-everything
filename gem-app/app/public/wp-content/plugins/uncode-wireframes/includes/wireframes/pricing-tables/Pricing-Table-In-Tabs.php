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

$data[ 'name' ]             = esc_html__( 'Pricing Table in Tabs', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'pricing_tables' ];
$data[ 'custom_class' ]     = 'pricing_tables';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'pricing-tables/Pricing-Table-In-Tabs.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="hills" uncode_shortcode_id="364722" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="527809"][vc_tabs history="yes" target="row" tab_no_fade="yes" tab_switch="yes" animation_active="yes" typography="advanced" tab_no_border="yes" titles_size="h5" titles_weight="600" gutter_simple="0" uncode_shortcode_id="286382"][vc_tab gutter_size="2" column_padding="3" title="Monthly" tab_id="94edbd53-30e1-cl167154146880216728332502101715766138451" slug="monthly" product_from_builder="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="132800"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="538115" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="210762"]Personal[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="168807"]199<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="154719"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="6" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="115922" back_color_type="uncode-palette"][vc_empty_space empty_h="2"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="514687"]Professional[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="824019"]299<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="207249"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][vc_empty_space empty_h="2"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="582043" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="212942"]Agency[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="727628"]399<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="169774"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="3" title="Yearly" tab_id="ebc6b11a-808b-cl167154146880216728332502101715766138451" slug="yearly" product_from_builder="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="232324"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="538115" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="210762"]Personal[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="475175"]149<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="154719"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="6" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="115922" back_color_type="uncode-palette"][vc_empty_space empty_h="2"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="514687"]Professional[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="557987"]249<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="207249"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][vc_empty_space empty_h="2"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="0" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/3" uncode_shortcode_id="582043" back_color_type="uncode-palette"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="212942"]Agency[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="186908"]349<small>$</small>[/vc_custom_heading][vc_empty_space][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="169774"]
<ul>
<li>Global color palette</li>
<li>Related posts module</li>
<li>Trending posts module</li>
<li>Newsletter subscribe</li>
<li>Cookies notice module</li>
</ul>
<p>[/uncode_list][vc_empty_space][vc_button radius="btn-circle" custom_typo="yes" order_width="0" uncode_shortcode_id="163520"]Discover More[/vc_button][/vc_column_inner][/vc_row_inner][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
