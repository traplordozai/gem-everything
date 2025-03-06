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

$data[ 'name' ]             = esc_html__( 'Footer Shop Outdoor', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Outdoor.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-jevc" overlay_alpha="50" gutter_size="4" column_width_percent="100" border_color="color-prif" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="701222" back_color_type="uncode-palette" css=".vc_custom_1678269071487{border-bottom-width: 1px !important;}" border_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="127708"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="643156"][vc_column_inner column_width_percent="100" gutter_size="0" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" border_color="color-prif" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="971488" css=".vc_custom_1679044942976{border-right-width: 1px !important;padding-top: 54px !important;padding-bottom: 54px !important;}" border_color_type="uncode-palette" link_to="url:%23"][vc_icon position="left" icon="fa fa-hotairballoon" size="fa-2x" heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="Free Shipping" uncode_shortcode_id="117409"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" border_color="color-prif" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="176949" css=".vc_custom_1679044949087{border-right-width: 1px !important;padding-top: 54px !important;padding-bottom: 54px !important;}" border_color_type="uncode-palette" link_to="url:%23"][vc_icon position="left" icon="fa fa-heart2" size="fa-2x" heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="30 days return" uncode_shortcode_id="980039"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" border_color="color-prif" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="157141" css=".vc_custom_1679044955072{border-right-width: 1px !important;padding-top: 54px !important;padding-bottom: 54px !important;}" border_color_type="uncode-palette" link_to="url:%23"][vc_empty_space empty_h="1" desktop_visibility="yes" mobile_visibility="yes"][vc_icon position="left" icon="fa fa-profile-female" size="fa-2x" heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="Chat Assistance" uncode_shortcode_id="255348"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="115703" css=".vc_custom_1679044961077{padding-top: 54px !important;padding-bottom: 54px !important;}" link_to="url:%23"][vc_empty_space empty_h="1" desktop_visibility="yes" mobile_visibility="yes"][vc_icon position="left" icon="fa fa-wallet" size="fa-2x" heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" title="Secure Shopping" uncode_shortcode_id="283351"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-prif" overlay_alpha="50" equal_height="yes" gutter_size="1" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="196418" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" style="dark"  back_color="color-jevc" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="385760" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="473448"]Newsletter[/vc_custom_heading][vc_column_text uncode_shortcode_id="690911"]Collaboratively administrate empowered markets via plug-and-play networks.[/vc_column_text][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" style="dark" back_color="color-jevc" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="124004" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="197248" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="871397"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="592843"]Company[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="136882" el_class="footer-links"]About Us<br />
Our Story<br />
Environment<br />
Our People<br />
The Club[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="189046"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="160077"]Shop[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="126739" el_class="footer-links"]Snowsport<br />
T-Shirts<br />
Jackets<br />
Rainwear<br />
Hiking<br />
Outdoor<br />
Lifestyle[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="197016"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="120759"]Customers[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="180591" el_class="footer-links"]Find Store<br />
Warranty<br />
Size &amp; Fit<br />
FAQ<br />
Downloads[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="141466"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="144389"]Socials[/vc_custom_heading][uncode_socials][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="0" bottom_padding="0" back_color="color-jevc" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-prif" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="209100" back_color_type="uncode-palette" border_color_type="uncode-palette" css=".vc_custom_1678270460120{border-top-width: 1px !important;padding-top: 18px !important;padding-bottom: 18px !important;}"][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="136367"][uncode_copyright text_lead="small"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="7" width="1/2" uncode_shortcode_id="116272"][vc_column_text text_lead="small" uncode_shortcode_id="119817"]Privacy Policy - Cookie Settings[/vc_column_text][/vc_column][/vc_row]
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
