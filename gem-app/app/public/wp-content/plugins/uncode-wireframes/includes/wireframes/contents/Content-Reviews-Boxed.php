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

$data[ 'name' ]             = esc_html__( 'Content Reviews Boxed', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Reviews-Boxed.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="200367" back_color_type="uncode-palette" column_width_pixel="1500"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" shadow="lg" width="1/3" uncode_shortcode_id="168537" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="502848"]“ I have been on many workshops with great photographers but non has ever come close to being this great. Selena took into consideration the clouds, the weather, the right times of the day and hit a home run every time. Amazing! ”[/vc_custom_heading][uncode_star_rating rate="5" text_color="accent" uncode_shortcode_id="204498" text_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="247862"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="3" width="3/12" uncode_shortcode_id="902508"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="172781"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="5" width="9/12" uncode_shortcode_id="102660"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_lead="small" sub_reduced="yes" uncode_shortcode_id="172788" subheading="LONDON"]Nathan Watkins[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="100" shadow="lg" width="1/3" uncode_shortcode_id="143426" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="905387"]“ I signed up for my first workshop with Selena with a love of photography, but as a novice of real camera equipment and no experience. Somehow I convinced Selena to take me on, and he promised to help me learn to use the gear. ”[/vc_custom_heading][uncode_star_rating rate="4.5" text_color="accent" uncode_shortcode_id="695159" text_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="247862"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="3" width="3/12" uncode_shortcode_id="677858"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="137267"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="5" width="9/12" uncode_shortcode_id="161071"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_lead="small" sub_reduced="yes" uncode_shortcode_id="206053" subheading="BERLIN"]Elise Brooks[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" shadow="lg" width="1/3" uncode_shortcode_id="121764" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="693549"]“ Selena private workshops were in all respects a highly rewarding experience. Her photographic expertise as well as his extensive knowledge of the street area proved tremendous assets on both the sunset and sunrise street workshops. ”[/vc_custom_heading][uncode_star_rating rate="4" text_color="accent" uncode_shortcode_id="155276" text_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="247862"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="1" mobile_width="3" width="3/12" uncode_shortcode_id="514867"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="121611"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="5" width="9/12" uncode_shortcode_id="209610"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" sub_lead="small" sub_reduced="yes" uncode_shortcode_id="468321" subheading="AMSTERDAM"]Emerson Taylor[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
