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

$data[ 'name' ]             = esc_html__( 'Accordion Faq with Text', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-Faq-with-Text.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" uncode_shortcode_id="541429"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="4/12" uncode_shortcode_id="153526"][vc_custom_heading text_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" badge_style="yes" back_color="accent" radius="sm" uncode_shortcode_id="119347" text_color_type="uncode-palette" back_color_type="uncode-palette"]Faq[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="172102"]Headline[/vc_custom_heading][vc_column_text uncode_shortcode_id="116240"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][vc_button border_width="0" scale_mobile="no" uncode_shortcode_id="784307"]Click the button[/vc_button][/vc_column][vc_column width="1/12"][/vc_column][vc_column column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="7/12" uncode_shortcode_id="876318"][vc_accordion typography="advanced" sign="plus" gutter_simple="1" no_h_padding="yes" titles_ titles_size="h4" titles_weight="500" uncode_shortcode_id="118970" active_tab="0"][vc_accordion_tab gutter_size="2" column_padding="2" title="Do I have to register before I can book an appointment?" tab_id="1665420124-1-8616668891879051715610238705"][vc_column_text uncode_shortcode_id="282872"]Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="How much cost Parathyroid Scan?" tab_id="1665420124-2-016668891879051715610238705"][vc_column_text uncode_shortcode_id="128827"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Are you providing face to face consultations?" tab_id="efe01523-2776-616668891879051715610238705"][vc_column_text uncode_shortcode_id="201583"]Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Spectacular maintain clicks-and-mortar solutions without functional solutions.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Does health insurance cover the cost of my appointment?" tab_id="10314d48-70e0-016668891879051715610238705"][vc_column_text uncode_shortcode_id="863916"]Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Spectacular synthesize integrated schemas with optimal networks.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Can I consult about a chronic health condition?" tab_id="6232a039-f9b5-716668891879051715610238705"][vc_column_text uncode_shortcode_id="133434"]Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
