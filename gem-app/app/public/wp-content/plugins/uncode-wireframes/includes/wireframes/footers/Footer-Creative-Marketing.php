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

$data[ 'name' ]             = esc_html__( 'Footer Creative Marketing', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Marketing.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="110992" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/1" uncode_shortcode_id="210862"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="123462"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="5/12" uncode_shortcode_id="921475"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="155811"]Tagline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="7/12" uncode_shortcode_id="534555"][vc_custom_heading  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="700" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="929775" heading_custom_size="clamp(18px,4vw,50px)"]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][/vc_column][/vc_row][vc_row unlock_row_content="yes" override_padding="yes" h_padding="3" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" row_haeight_percent="0" uncode_shortcode_id="106141" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="3/12" uncode_shortcode_id="183645"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="113252" heading_custom_size="clamp(18px,4vw,20px)"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][uncode_socials size="lead"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="130287"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="7/12" uncode_shortcode_id="123236"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="486579"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="133984"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="939117"]Navigation[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="157459" el_class="footer-links" heading_custom_size="clamp(18px,4vw,20px)"]<a href="#">Home</a><br />
<a href="#">About Us</a><br />
<a href="#">Services</a><br />
<a href="#">Portfolio</a><br />
<a href="#">Latest News</a><br />
<a href="#">FAQ</a><br />
<a href="#">Contact Us</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="802977"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="163690"]Legal[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="919991" el_class="footer-links" heading_custom_size="clamp(18px,4vw,20px)"]<a href="#">Privacy Policy</a><br />
<a href="#">Terms of Use</a><br />
<a href="#">Cookie Policy</a><br />
<a href="#">Accessibility</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="165095"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="178462"]Headquarter[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="694630" el_class="footer-links" heading_custom_size="clamp(18px,4vw,20px)"]Birger Jarlsgatan 58A<br />
114 29 Stockholm, Sweden<br />
+46 8123 4567[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
