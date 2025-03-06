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

$data[ 'name' ]             = esc_html__( 'Accordion Wide with Image', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Accordion-Wide-with-Image.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="5" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="201749" column_width_pixel="1500"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="174409"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="566539"]Medium length headline[/vc_custom_heading][vc_accordion typography="advanced" sign="none" label_border="yes" content_border="yes" title_padding="yes" gutter_simple="0" no_h_padding="yes" titles_ titles_size="h5" titles_weight="600" uncode_shortcode_id="250889"][vc_accordion_tab gutter_size="2" column_padding="2" title="- Over 200 illustrated pages" tab_id="1671546611-1-7816728529972741715764497913"][vc_column_text uncode_shortcode_id="654366"]Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="- Natural and recycled materials" tab_id="1671546611-2-6616728529972741715764497913"][vc_column_text uncode_shortcode_id="127010"]Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="2" column_padding="2" title="- Crafted by artisans in Italy" tab_id="1671546703250-2-1016728529972741715764497913"][vc_column_text uncode_shortcode_id="585207"]Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital.[/vc_column_text][/vc_accordion_tab][/vc_accordion][vc_button border_width="0" scale_mobile="no" uncode_shortcode_id="141011"]Click the button[/vc_button][/vc_column][vc_column width="8/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-three" shape="img-round" uncode_shortcode_id="586448"][/vc_column][/vc_row]
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
