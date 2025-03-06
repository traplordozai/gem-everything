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

$data[ 'name' ]             = esc_html__( 'Portfolio Carousel Dark Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Carousel-Dark-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="138048" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="156650" css=".vc_custom_1715677160989{padding-bottom: 0px !important;}"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="167657"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="707091"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="421820"]Medium length headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="893655"][vc_button button_color="accent" size="btn-lg" border_width="0" icon_position="right" scale_mobile="no" uncode_shortcode_id="149595" icon="fa fa-arrow-right4" button_color_type="uncode-palette" link="url:%23"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_custom_heading text_color="color-wvjs" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="172900" text_color_type="uncode-palette"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][uncode_index el_id="index-90316634" index_type="carousel" loop="size:5|order_by:date|post_type:portfolio|taxonomy_count:10" carousel_lg="2" carousel_md="2" carousel_sm="1" thumb_size="five-four" gutter_size="2" carousel_interval="0" carousel_navspeed="400" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_dot_position="left" carousel_width_percent="100" carousel_pointer_events="yes" stage_padding="0" single_text="overlay" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="85" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_v_position="bottom" single_padding="3"  single_title_dimension="h3" single_title_weight="500" single_shadow="yes" shadow_weight="lg" shadow_darker="yes" single_border="yes" single_css_animation="right-t-left" single_animation_speed="1000" single_animation_first="yes" custom_cursor="accent" cursor_title="yes" hide_title_tooltip="mobile" uncode_shortcode_id="669483" tooltip_class="font-469684 h3 font-weight-500"][/vc_column][/vc_row]
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
