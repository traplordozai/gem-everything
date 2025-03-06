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

$data[ 'name' ]             = esc_html__( 'Accordion Wide Contents', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-Wide-Contents.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="257915" column_width_pixel="1500"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="810542"][vc_accordion history="yes" target="row" typography="advanced" sign="plus" sign_size="md" content_border="yes" title_padding="yes" gutter_simple="1" no_h_padding="yes" titles_size="h2" titles_weight="600" uncode_shortcode_id="129859"][vc_accordion_tab gutter_size="2" column_padding="2" title="Liquid Simulation" tab_id="1671551114-1-916728529840381715765038741" slug="liquid"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="137614" limit_content=""][vc_column_inner width="5/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="alpha-anim" uncode_shortcode_id="208197"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="7/12" uncode_shortcode_id="174253"][vc_column_text text_lead="yes" uncode_shortcode_id="462314"]Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products.</p>
<p>Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric “outside the box” thinking. Completely pursue scalable customer service through sustainable potentialities.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Dynamic Repeaters" tab_id="1671551114-2-9016728529840381715765038741" slug="repeaters"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="161921" limit_content=""][vc_column_inner width="5/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="alpha-anim" uncode_shortcode_id="931007"][/vc_column_inner][vc_column_inner width="7/12"][vc_column_text text_lead="yes" uncode_shortcode_id="409007"]Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
<p>Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Spectacular engage top-line web services vis-a-vis cutting-edge deliverables.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="Fluid Geometries" tab_id="1671551389519-2-716728529840381715765038741" slug="geometries"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="161921" limit_content=""][vc_column_inner width="5/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="alpha-anim" uncode_shortcode_id="185982"][/vc_column_inner][vc_column_inner width="7/12"][vc_column_text text_lead="yes" uncode_shortcode_id="292498"]Collaboratively administrate turnkey channels whereas virtual e-tailers. Objectively seize scalable metrics whereas proactive e-services. Seamlessly empower fully researched growth strategies and interoperable internal or "organic" sources.</p>
<p>Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Spectacular synthesize integrated schemas with optimal networks.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
