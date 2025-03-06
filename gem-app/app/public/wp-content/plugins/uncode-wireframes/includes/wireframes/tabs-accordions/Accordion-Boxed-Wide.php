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

$data[ 'name' ]             = esc_html__( 'Accordion Boxed Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-Boxed-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="154748" el_class="test-three" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="std" width="1/1" uncode_shortcode_id="778803" column_width_pixel="900"][vc_accordion no_toggle="yes" typography="advanced" sign="plus" sign_size="md" content_border="yes" gutter_simple="1" no_h_padding="yes" titles_size="h5" titles_weight="600" uncode_shortcode_id="161232" active_tab="0"][vc_accordion_tab gutter_size="2" column_padding="0" title="Does it work with other popular official WordPress plugins?" tab_id="1671541890-1-6216728529668951715764968962"][vc_column_text uncode_shortcode_id="806295"]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</p>
<p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="Can I still use the plugin when my licence expires?" tab_id="1671541890-2-7416728529668951715764968962"][vc_column_text uncode_shortcode_id="289506"]Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
<p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="Can I edit and customise all the WooCommerce pages?" tab_id="1671542087726-2-116728529668951715764968962"][vc_column_text uncode_shortcode_id="455413"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Spectacular visualize customer directed convergence without revolutionary ROI.</p>
<p>Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Spectacular maintain clicks-and-mortar solutions without functional solutions.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="What’s included with the purchase of the theme?" tab_id="292da2c4-9bc3-616728529668951715764968962"][vc_column_text uncode_shortcode_id="181342"]Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
<p>Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Spectacular engage top-line web services vis-a-vis cutting-edge deliverables.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="What do I need do to start working with the Page Builder?" tab_id="b2da8cd6-4d15-81715764968962"][vc_column_text uncode_shortcode_id="201456"]Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products.</p>
<p>Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
