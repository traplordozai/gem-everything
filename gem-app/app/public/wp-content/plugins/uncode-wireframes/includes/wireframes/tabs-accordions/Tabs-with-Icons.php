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

$data[ 'name' ]             = esc_html__( 'Tabs with Icons', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'tabs-accordions' ];
$data[ 'custom_class' ]     = 'tabs-accordions';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'tabs-accordions/Tabs-with-Icons.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="205724"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="184057"][vc_tabs history="yes" target="row" no_lazy="yes" tab_no_fade="yes" animation_active="yes" typography="advanced" titles_size="h5" titles_weight="600" gutter_simple="0" uncode_shortcode_id="188024"][vc_tab icon="fa fa-video3" icon_position="above" gutter_size="2" column_padding="3" title="Production" tab_id="1671550747626-0-716728332204651715766178617" product_from_builder="yes" slug="production"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="183214"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="129072"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="sixteen-nine" shape="img-round" uncode_shortcode_id="474807"][vc_icon display="absolute-center" icon="fa fa-play" background_style="fa-rounded" size="fa-2x" icon_automatic="yes" uncode_shortcode_id="387178"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab icon="fa fa-mobile2" icon_position="above" gutter_size="2" column_padding="3" title="Development" tab_id="1671550748843-0-716728332204651715766178617" product_from_builder="yes" slug="development"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="183214"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="390432"][vc_custom_heading text_color="color-uydo" text_size="'. uncode_wf_print_font_size( 'fontsize-160206' ) .'"  text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="518613" text_color_type="uncode-palette"]01[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading  uncode_shortcode_id="207365"]Market Analysis[/vc_custom_heading][vc_separator sep_color=",Default"][vc_column_text uncode_shortcode_id="210092"]Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Spectacular maintain clicks-and-mortar solutions without functional solutions.[/vc_column_text][vc_empty_space empty_h="1"][vc_button radius="btn-circle" custom_typo="yes"  border_width="0" uncode_shortcode_id="651200" link="url:%23"]Learn More[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="148627"][vc_custom_heading text_color="color-uydo" text_size="'. uncode_wf_print_font_size( 'fontsize-160206' ) .'"  text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="543509" text_color_type="uncode-palette"]02[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading  uncode_shortcode_id="561956"]Detailed Design[/vc_custom_heading][vc_separator sep_color=",Default"][vc_column_text uncode_shortcode_id="160364"]Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically resource-leveling customer service for state of the art.[/vc_column_text][vc_empty_space empty_h="1"][vc_button radius="btn-circle" custom_typo="yes"  border_width="0" uncode_shortcode_id="651200" link="url:%23"]Learn More[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="166467"][vc_custom_heading text_color="color-uydo" text_size="'. uncode_wf_print_font_size( 'fontsize-160206' ) .'"  text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="678253" text_color_type="uncode-palette"]03[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading  uncode_shortcode_id="948582"]Development[/vc_custom_heading][vc_separator sep_color=",Default"][vc_column_text uncode_shortcode_id="767895"]Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly extensible testing procedures for reliable supply chains. Spectacular engage top-line web services vis-a-vis cutting-edge.[/vc_column_text][vc_empty_space empty_h="1"][vc_button radius="btn-circle" custom_typo="yes"  border_width="0" uncode_shortcode_id="651200" link="url:%23"]Learn More[/vc_button][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab icon="fa fa-piechart" icon_position="above" gutter_size="2" column_padding="3" title="Marketing" tab_id="1671550750888-0-516728332204651715766178617" product_from_builder="yes" slug="marketing"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" uncode_shortcode_id="121123" limit_content=""][vc_column_inner width="5/12"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="four-five" shape="img-round" radius="xs" shadow="yes" shadow_weight="std" uncode_shortcode_id="163907"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="7/12" uncode_shortcode_id="165671"][vc_custom_heading heading_semantic="h3"  text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="114063"]Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Spectacular maintain clicks-and-mortar solutions without functional solutions.[/vc_custom_heading][vc_column_text uncode_shortcode_id="133137"]Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/vc_column_text][vc_column_text text_color="color-rgdb" uncode_shortcode_id="183492" text_color_type="uncode-palette"]⸻ Maxwell Watkins[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
