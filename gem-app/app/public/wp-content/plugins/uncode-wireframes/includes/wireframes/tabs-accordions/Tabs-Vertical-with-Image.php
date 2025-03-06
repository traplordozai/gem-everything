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

$data[ 'name' ]             = esc_html__( 'Tabs Vertical with Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-Vertical-with-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="200888"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="192755"][vc_tabs vertical="yes" tab_no_fade="yes" typography="advanced" tab_no_border="yes" tab_h_border="yes" valign_middle="yes" tab_custom_size="yes" tab_size="6" tab_gap="4" custom_padding="yes" gutter_tab="2" active_bg_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="std" shadow="std" tab_tablet_bp="yes" accordion_bp="yes" titles_size="h2" titles_weight="600" excerpt_text_size="'. uncode_wf_print_font_size( 'yes' ) .'" active_shadow="yes" uncode_shortcode_id="142434" active_bg_color_type="uncode-palette"][vc_tab gutter_size="2" column_padding="0" title="Certified bilingual preschool" tab_id="1668424954-1-131715597140670" excerpt="Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric ``outside the box`` thinking, pursue scalable customer service through sustainable potentialities collaboratively." link="url:%23|title:Read%20More..."][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="1/1" uncode_shortcode_id="193972" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" css_animation="bottom-t-top" uncode_shortcode_id="457251" el_class="unmask-blob-2"][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="0" title="Artistic and music activities" tab_id="1668424954-2-401715597140670" excerpt="Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Spectacular engage top-line web services vis-a-vis cutting-edge deliverables proactively envisioned." link="url:%23|title:Read%20More..."][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="1/1" uncode_shortcode_id="180586" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="184265" el_class="unmask-blob-3"][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab gutter_size="2" column_padding="0" tab_id="da15d422-ae87-31715597140670" title="Integrated kids healthcare" excerpt="Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric ``outside the box`` thinking, pursue scalable customer service through sustainable potentialities turnkey channels whereas virtual." link="url:%23|title:Read%20More..."][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="1/1" uncode_shortcode_id="197747" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="178611" el_class="unmask-blob-4"][/vc_column_inner][/vc_row_inner][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
