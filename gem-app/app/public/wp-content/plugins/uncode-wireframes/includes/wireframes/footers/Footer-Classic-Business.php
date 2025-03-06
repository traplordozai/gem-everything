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

$data[ 'name' ]             = esc_html__( 'Footer Classic Business', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Business.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="accent" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="646396" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="500" uncode_shortcode_id="155125"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="181879"]Stay in the loop[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="default-underline"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="6" bottom_padding="6" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="191163" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12"][vc_single_image media="'. uncode_wf_print_single_image( '85259' ) .'" media_width_use_pixel="yes" media_width_pixel="74" uncode_shortcode_id="108576"][/vc_column][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="125982"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="206029"][vc_custom_heading text_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" uncode_shortcode_id="159211" text_color_type="uncode-palette"]Business[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="127617"]General Inquiries[/vc_custom_heading][vc_column_text uncode_shortcode_id="560484"]<a href="mailto:info@yourwebsite.com">info@yourwebsite.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="146594"][vc_custom_heading text_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" uncode_shortcode_id="537958" text_color_type="uncode-palette"]Support[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="196871"]Help Center[/vc_custom_heading][vc_column_text uncode_shortcode_id="157045"]<a href="mailto:info@yourwebsite.com">info@yourwebsite.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="208342"][vc_custom_heading text_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" uncode_shortcode_id="123703" text_color_type="uncode-palette"]Meet us[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="158354"]Social Profiles[/vc_custom_heading][uncode_socials][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-prif" uncode_shortcode_id="104766" sep_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="206327"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="204995"]Milan[/vc_custom_heading][vc_column_text uncode_shortcode_id="294929"]Via Santa Lucia 17<br />
Corsico Milanese<br />
Milan, Italy<br />
06010</p>
<p>+39 0351 0596547[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="200169"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="187878"]Amsterdam[/vc_custom_heading][vc_column_text uncode_shortcode_id="603217"]Hortensiastraat 181<br />
Delancey Street<br />
Amsterdam, Holland<br />
68320</p>
<p>+31 0690443177[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="113143"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="540770"]Barcelona[/vc_custom_heading][vc_column_text uncode_shortcode_id="106971"]Calle Carril de la Fuente 87<br />
El Cuervo De Sevilla<br />
Barcelona, Spain<br />
02694</p>
<p>+34 6384971780[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="772442"][vc_column width="1/1"][uncode_vertical_text element_type="social" fixed="yes" position="right" vertical_text_h_pos="-2" show_after_scroll="yes" hide_on_bottom="yes" medium_visibility="yes" mobile_visibility="yes" uncode_shortcode_id="142442"]Vertical text.[/uncode_vertical_text][/vc_column][/vc_row]
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
