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

$data[ 'name' ]             = esc_html__( 'Content About Wide Lists', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-About-Wide-Lists.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" inverted_device_order="yes" changer_back_color="yes" uncode_shortcode_id="118990" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="5/12" uncode_shortcode_id="327424"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="5/12" uncode_shortcode_id="184495"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="195699"]Heading[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-minus2" uncode_shortcode_id="125514"]
<ul>
 	<li>UX research</li>
 	<li>Brand strategy</li>
 	<li>Positioning</li>
 	<li>Product design</li>
 	<li>Management</li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="5/12" uncode_shortcode_id="151535"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="214576"]Heading[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-minus2" uncode_shortcode_id="903775"]
<ul>
 	<li>User experience</li>
 	<li>User interface</li>
 	<li>Development</li>
 	<li>Illustration</li>
 	<li>Motion &amp; Video</li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="679800"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="7/12" uncode_shortcode_id="484410"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="114175"]I specialize in modern design systems, user experience, and development. I work to keep solutions simple, both in design and code. While very diverse, my aesthetic approach often involves a distinct sense of play, aiming to make fun functional. My work strategically elevates brand offerings by distilling core messaging down to its most precise and freshest visual form.[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="816260"]Skydiver, ramen eater, ukulelist, Mad Men fan and brand builder. Doing at the intersection of beauty and sustainability to answer design problems with honest solutions. I work with Fortune 500 companies and startups. Making at the sweet spot between aesthetics and purpose to craft an inspiring, compelling and authentic brand narrative. I am fueled by craft beer, hip-hop and tortilla chips. Working at the junction of beauty and elegance to create strong, lasting and remarkable design. Let chat.[/vc_column_text][/vc_column][/vc_row]
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
