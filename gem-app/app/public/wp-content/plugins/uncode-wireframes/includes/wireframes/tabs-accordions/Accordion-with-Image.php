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

$data[ 'name' ]             = esc_html__( 'Accordion with Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-with-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="627468"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="zoom-in" animation_speed="1000" width="1/2" uncode_shortcode_id="178743" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="133508" el_class="unmask-blob-1"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" width="1/2" uncode_shortcode_id="411987"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="624855"]Medium length headline[/vc_custom_heading][vc_accordion typography="advanced" sign="none" sign_size="md" content_border="yes" gutter_simple="1" active_bg_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="lg" shadow="lg" titles_size="h3" titles_weight="600" uncode_shortcode_id="143251" active_bg_color_type="uncode-palette"][vc_accordion_tab gutter_size="2" column_padding="0" title="Can it be paid in installments?" tab_id="1666002628-1-6216684390466391715608043606"][vc_column_text text_lead="yes" uncode_shortcode_id="496412"]Objectively innovate empowered manufactured products whereas parallel platforms holisticly predominate extensible testing procedures.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="Is it possible to attend remotely?" tab_id="1666002628-2-5716684390466391715608043606"][vc_column_text text_lead="yes" uncode_shortcode_id="107620"]Proactively envisioned multimedia based expertise objectively products whereas parallel platforms. Holisticly predominate extensible testing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="0" title="How many teachers are there?" tab_id="c35acc00-dc00-116684390466391715608043606"][vc_column_text text_lead="yes" uncode_shortcode_id="138156"]Holisticly predominate extensible testing procedures for reliable supply chains engage top-line web services vis-a-vis deliverables.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
