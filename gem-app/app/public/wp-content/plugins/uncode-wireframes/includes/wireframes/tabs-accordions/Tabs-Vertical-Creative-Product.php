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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical Creative Product', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-Creative-Product.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="5" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="127474"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="182089"][/vc_column][vc_column column_width_percent="100" gutter_size="4" override_padding="yes" column_padding="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="8/12" uncode_shortcode_id="115348"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="183214"][vc_column_inner width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="185151"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="2" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="159478"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="102766" el_class="remove-top-padding"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="123919"][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="right-t-left" animation_speed="1000" width="8/12" uncode_shortcode_id="169095"][vc_tabs vertical="yes" typography="advanced" tab_no_border="yes" tabs_align="opposite" tab_custom_size="yes" tab_size="6" tab_gap="3" custom_padding="yes" gutter_tab="1" no_h_padding="yes" accordion_bp="yes" titles_size="h4" titles_weight="600" excerpt_text_size="'. uncode_wf_print_font_size( 'yes' ) .'" gutter_simple="1" uncode_shortcode_id="825718"][vc_tab gutter_size="2" column_padding="0" title="Medium length headline" tab_id="1671537737963-0-2167282400389616747429632031715675158265" excerpt="Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate users after installed base benefits. Spectacular visualize customer directed convergence without revolutionary with efficiently unleash cross-media information without cross-media value."][vc_empty_space empty_h="0" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="514053"][/vc_tab][vc_tab gutter_size="2" column_padding="0" title="Medium length" tab_id="1671537737931-0-8167282400389616747429632031715675158265" excerpt="Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service, objectively innovate empowered manufactured."][vc_empty_space empty_h="0" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="482495"][/vc_tab][vc_tab gutter_size="2" column_padding="0" title="Medium length headline" tab_id="1671537738002-0-10167282400389616747429632031715675158265" excerpt="Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products, methodologies with web-enabled technology."][vc_empty_space empty_h="0" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="805741"][/vc_tab][vc_tab gutter_size="2" column_padding="0" title="Medium length" tab_id="1674835108884-3-81715675158265" excerpt="Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line podcasting operational."][vc_empty_space empty_h="0" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="593523"][/vc_tab][vc_tab gutter_size="2" column_padding="0" title="Medium length headline" tab_id="1674835127674-4-21715675158265" excerpt="All change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration."][vc_empty_space empty_h="0" desktop_visibility="yes"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="164335"][/vc_tab][/vc_tabs][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="921954"][/vc_column][/vc_row]
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
