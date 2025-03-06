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

$data[ 'name' ]             = esc_html__( 'Pricing Table Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'pricing_tables' ];
$data[ 'custom_class' ]     = 'pricing_tables';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'pricing-tables/Pricing-Table-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="1" top_padding="1" bottom_padding="1" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="1" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="214243" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/3" uncode_shortcode_id="143695" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="115388"]Headline[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="150077"]129<small>$</small>[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="947237"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][uncode_list icon="fa fa-check-circle" icon_color="color-prif" uncode_shortcode_id="936146" icon_color_type="uncode-palette"]
<ul>
 	<li>Access to all main conference</li>
 	<li>Entry to the exhibition area</li>
 	<li>Access to keynote speeches</li>
 	<li>Conference program booklet</li>
 	<li>Free Wi-Fi at the venue</li>
 	<li>Refreshments during breaks</li>
</ul>
[/uncode_list][vc_empty_space empty_h="1"][vc_button size="btn-lg" wide="yes" border_width="0" scale_mobile="no" uncode_shortcode_id="203593"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/3" uncode_shortcode_id="926201" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="115388"]Headline[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="116007"]149<small>$</small>[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="947237"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="307765"]
<ul>
 	<li>Includes all Basic Pass features</li>
 	<li>Exclusive access to workshops</li>
 	<li>Admission to networking events</li>
 	<li>Special conference merchandise</li>
 	<li>Priority check-in at the venue</li>
 	<li>Access to a lounge area</li>
</ul>
[/uncode_list][vc_empty_space empty_h="1"][vc_button size="btn-lg" wide="yes" border_width="0" scale_mobile="no" uncode_shortcode_id="203593"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="color-wayh" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/3" uncode_shortcode_id="185146" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="115388"]Headline[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-578034' ) .'" uncode_shortcode_id="746148"]169<small>$</small>[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="947237"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][uncode_list icon="fa fa-check-circle" uncode_shortcode_id="163506"]
<ul>
 	<li>Includes all Special Pass features</li>
 	<li>VIP seating at sessions</li>
 	<li>Behind-the-scenes tours</li>
 	<li>Personalized concierge service</li>
 	<li>Invitations to VIP-only events</li>
 	<li>Complimentary hotel and transfer</li>
</ul>
[/uncode_list][vc_empty_space empty_h="1"][vc_button size="btn-lg" wide="yes" border_width="0" scale_mobile="no" uncode_shortcode_id="203593"]Click the button[/vc_button][/vc_column][/vc_row]
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
