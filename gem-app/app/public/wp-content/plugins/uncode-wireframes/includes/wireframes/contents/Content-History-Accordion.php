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

$data[ 'name' ]             = esc_html__( 'Content History Accordion', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-History-Accordion.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="117715"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="151633"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="152933"]Medium length headline[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="142634"][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="4/12" uncode_shortcode_id="183889"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" uncode_shortcode_id="482959"][vc_column_text uncode_shortcode_id="544715"]Robert MacKenzie[/vc_column_text][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="6" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="8/12" uncode_shortcode_id="196782"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="100746"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more. Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_accordion typography="advanced" sign="plus" label_border="yes" content_border="yes" gutter_simple="0" no_h_padding="yes" titles_ titles_size="h4" titles_weight="600" uncode_shortcode_id="128003" active_tab="0"][vc_accordion_tab gutter_size="3" column_padding="2" title="What can you tell me about shipping costs?" tab_id="efe01523-2776-616726707058391715758053407"][vc_column_text uncode_shortcode_id="175532"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="What is the approximate shipping time?" tab_id="1665420124-2-016726707058391715758053407"][vc_column_text uncode_shortcode_id="160923"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="Do you accept returns, exchanges and cancellations?" tab_id="10314d48-70e0-016726707058391715758053407"][vc_column_text uncode_shortcode_id="170738"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="What happens after I placed an order?" tab_id="1665420124-1-8616726707058391715758053407"][vc_column_text uncode_shortcode_id="146662"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="Is there a possibility to wrap the pottery as a gift?" tab_id="48f28542-59c9-01715758053407"][vc_column_text uncode_shortcode_id="184081"]Objectively innovate empowered manufactured products whereas parallel platforms. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab gutter_size="3" column_padding="2" title="What happens if my pottery arrives broken?" tab_id="6232a039-f9b5-716726707058391715758053407"][vc_column_text uncode_shortcode_id="133897"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
