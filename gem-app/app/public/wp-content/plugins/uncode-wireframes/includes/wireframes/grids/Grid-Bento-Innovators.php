<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Grid Bento Innovators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Bento-Innovators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" equal_height="justify" gutter_size="2" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="399676" css=".vc_custom_1733498716313{border-top-width: 1px !important;}" border_color_type="uncode-palette" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="199660"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="145359"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="193602" back_color_type="uncode-palette"][vc_pie value="92" arc_width="4" bar_color="" uncode_shortcode_id="108850" units="%"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="115020"]Long headline on two lines[/vc_custom_heading][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="188651" heading_custom_size="clamp(22px, 4vw, 28px)"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-out" scale_mobile="no" uncode_shortcode_id="258105" link="url:%23"]Click the Button[/vc_button][/vc_column_inner][/vc_row_inner][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="124479"][/vc_column][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="171767"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="115306"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="169412"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="554049" back_color_type="uncode-palette"][vc_custom_heading text_color="color-prif" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="lg" uncode_shortcode_id="430145" back_color_type="uncode-palette" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="903405"]Long headline on two lines[/vc_custom_heading][vc_progress_bar values="%5B%7B%22label%22%3A%22Medium%20headline%22%2C%22value%22%3A%2290%22%2C%22bar_color_type%22%3A%22uncode-palette%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%2C%22bar_color_solid%22%3A%22%23104f55%22%2C%22back_color_type%22%3A%22uncode-palette%22%2C%22back_color_solid%22%3A%22%23ff0000%22%7D%2C%7B%22label%22%3A%22Medium%20headline%22%2C%22value%22%3A%2280%22%2C%22bar_color_type%22%3A%22uncode-palette%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%2C%22bar_color_solid%22%3A%22%23104f55%22%2C%22back_color_type%22%3A%22uncode-palette%22%2C%22back_color_solid%22%3A%22%23ff0000%22%7D%2C%7B%22label%22%3A%22Medium%20headline%22%2C%22value%22%3A%2295%22%2C%22bar_color_type%22%3A%22uncode-palette%22%2C%22bar_color%22%3A%22'. uncode_wf_print_color( 'color-xsdn' ) .'%22%2C%22bar_color_solid%22%3A%22%23104f55%22%2C%22back_color_type%22%3A%22uncode-palette%22%2C%22back_color_solid%22%3A%22%23ff0000%22%7D%5D" empty_space="yes"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="justify" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="542672"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="145359"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="accent" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="553830" back_color_type="uncode-palette"][vc_custom_heading text_color="color-prif" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h6' ) .'" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" radius="lg" uncode_shortcode_id="857927" back_color_type="uncode-palette" text_color_type="uncode-palette"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h6" uncode_shortcode_id="116381"]“ Change the color to match your brand or vision, add your logo, choose the perfect layout. “[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="two-one" shape="img-round" radius="lg" uncode_shortcode_id="105469"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="169412"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="457316" back_color_type="uncode-palette" el_class="overflow-hidden-uncell"][vc_gallery el_id="gallery-503528" type="linear" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471,80471 ) ) .'" gutter_size="2" linear_width="clamp(80px, 10vw, 100px)" linear_speed="-3" media_items="media|nolink|original" css_grid_images_size="one-one" single_shape="circle" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2" single_border="yes" uncode_shortcode_id="624018"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="547367" heading_custom_size="clamp(22px, 4vw, 28px)"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_custom_heading][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-out" scale_mobile="no" uncode_shortcode_id="691294" link="url:%23"]Click the Button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
