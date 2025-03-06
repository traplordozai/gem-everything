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

$data[ 'name' ]             = esc_html__( 'Content Reviews Large', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Reviews-Large.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="136827"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1400" width="1/1" uncode_shortcode_id="208884"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="202378"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="2/3" uncode_shortcode_id="143068"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="175003" heading_custom_size="clamp(30px,4vw,50px)"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="432043"][uncode_counter value="4.9" counter_color="accent" size="custom" weight="600" height="fontheight-179065" text="Average rating on 234 reviews" uncode_shortcode_id="351689" counter_color_type="uncode-palette" suffix="+" heading_custom_size="clamp(70px,5vw,100px)"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="596434"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="127841"][uncode_star_rating rate="5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_color="accent" uncode_shortcode_id="182533" text_color_type="uncode-palette"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="635718"]“ Since switching to this delivery service, our operations have become so much smoother and more reliable. The difference in how quickly our products reach our customers is night and day. ”[/vc_custom_heading][vc_empty_space empty_h="0"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="786819" media_width_pixel="65"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_reduced="yes" uncode_shortcode_id="203753" subheading="Business Owner"]Michael Thompson[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="113079"][uncode_star_rating rate="4.5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_color="accent" uncode_shortcode_id="223170" text_color_type="uncode-palette"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="205079"]“ I can not praise this service enough. In the competitive world of online retail, fast and reliable shipping is everything. This team has consistently gone above and beyond, ensuring time optimal delivery times on all days. ”[/vc_custom_heading][vc_empty_space empty_h="0"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="528212" media_width_pixel="65"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_reduced="yes" uncode_shortcode_id="920945" subheading="E-commerce Manager"]Sarah Jennings[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="904524"][uncode_star_rating rate="4" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_color="accent" uncode_shortcode_id="848638" text_color_type="uncode-palette"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="734385"]“ As a freelancer, I rely heavily on shipping services for delivering my work to clients. This service has changed the game for me with their unbeatable rates and exceptional delivery times.  ”[/vc_custom_heading][vc_empty_space empty_h="0"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="119826" media_width_pixel="65"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_lead="small" sub_reduced="yes" uncode_shortcode_id="124697" subheading="Product Designer"]Alex Sebastiano[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
