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

$data[ 'name' ]             = esc_html__( 'Accordion Equal Height', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-Equal-Height.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="194860"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="103565" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="202244"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="659167"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="177035"]Medium length headline[/vc_custom_heading][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="158950" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button button_color="accent" size="btn-lg" border_width="0" icon_position="right" scale_mobile="no" uncode_shortcode_id="589322" icon="fa fa-arrow-right4" button_color_type="uncode-palette" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="4"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="931292" back_color_type="uncode-palette"][vc_accordion typography="advanced" sign="plus" content_border="yes" gutter_simple="1" no_h_padding="yes" titles_size="h2" titles_weight="600" uncode_shortcode_id="137491" active_tab="0"][vc_accordion_tab gutter_size="2" column_padding="2" title="How much does it cost to go full solar?" tab_id="559d-7b8a1715677181564"][vc_column_text text_lead="yes" uncode_shortcode_id="146299"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="How do solar panel systems work?" tab_id="d2f8-ab221715677181564"][vc_column_text text_lead="yes" uncode_shortcode_id="427642"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Do I need a power solar battery?" tab_id="91bc-98b51715677181564"][vc_column_text text_lead="yes" uncode_shortcode_id="146299"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="How many solar panels do I need to install?" tab_id="3ea7-814d1715677181564"][vc_column_text text_lead="yes" uncode_shortcode_id="293639"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="How much can you save with solar?" tab_id="5ec8-1a2b1715677181564"][vc_column_text text_lead="yes" uncode_shortcode_id="146299"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
