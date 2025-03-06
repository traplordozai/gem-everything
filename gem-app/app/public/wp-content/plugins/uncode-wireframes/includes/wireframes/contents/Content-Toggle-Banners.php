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

$data[ 'name' ]             = esc_html__( 'Content Toggle Banners', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Toggle-Banners.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="115965" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" toggle="yes" max_height="350" closed_txt="Read More" btn_margin="std" open_txt="Read Less" fade="sm" width="1/4" uncode_shortcode_id="140870" toggle_classes="btn btn-default btn-lg btn-custom-typo font-weight-600 border-width-2 btn-outline" back_color_type="uncode-palette"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="698347"][/vc_icon][vc_custom_heading uncode_shortcode_id="177138"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="167486"]Minimal design, an aesthetic marvel, celebrates the art of simplicity and elegance. It is a design philosophy that strips away the extraneous, leaving behind only the essential elements to create a visual language that speaks volumes with subtlety. At its core, minimal design embraces the mantra of "less is more." It thrives on clean lines, uncluttered spaces, and a deliberate reduction of ornamentation. By eliminating the superfluous, minimal design invites focus and appreciation for the purity of form, function, and negative space.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" toggle="yes" max_height="350" closed_txt="Read More" btn_margin="std" open_txt="Read Less" icon_position="right" fade="sm" width="1/4" uncode_shortcode_id="106274" back_color_type="uncode-palette" toggle_classes="btn btn-default btn-lg btn-custom-typo font-weight-600 border-width-2 btn-outline"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="698347"][/vc_icon][vc_custom_heading uncode_shortcode_id="177138"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="134641"]The beauty of minimal design lies in its ability to convey a sense of tranquility and sophistication through understated elements. Whether in architecture, art, fashion, or digital interfaces, it champions a refined aesthetic that captures attention with its restraint and clarity. Within the realm of minimal design, every element serves a purpose, and every detail is meticulously curated. It is a careful balancing act, where simplicity is not mere emptiness but a canvas for deliberate choices that highlight the essence of a design.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" toggle="yes" max_height="350" closed_txt="Read More" btn_margin="std" open_txt="Read Less" fade="sm" width="1/4" uncode_shortcode_id="390140" back_color_type="uncode-palette" toggle_classes="btn btn-default btn-lg btn-custom-typo font-weight-600 border-width-2 btn-outline"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="698347"][/vc_icon][vc_custom_heading uncode_shortcode_id="177138"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="746836"]Within the realm of minimal design, every element serves a purpose, and every detail is meticulously curated. It is a careful balancing act, where simplicity is not mere emptiness but a canvas for deliberate choices that highlight the essence of a design. At its core, minimal design embraces the mantra of "less is more." It thrives on clean lines, uncluttered spaces, and a deliberate reduction of ornamentation. By eliminating the superfluous, minimal design invites focus and appreciation for the purity of form, function, and negative space.[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" toggle="yes" max_height="350" closed_txt="Read More" btn_margin="std" open_txt="Read Less" fade="sm" width="1/4" uncode_shortcode_id="306472" back_color_type="uncode-palette" toggle_classes="btn btn-default btn-lg btn-custom-typo font-weight-600  border-width-2 btn-outline"][vc_icon icon="fa fa-star-o" size="fa-3x" uncode_shortcode_id="698347"][/vc_icon][vc_custom_heading uncode_shortcode_id="177138"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="113959"]At its core, minimal design embraces the mantra of "less is more." It thrives on clean lines, uncluttered spaces, and a deliberate reduction of ornamentation. By eliminating the superfluous, minimal design invites focus and appreciation for the purity of form, function, and negative space. The beauty of minimal design lies in its ability to convey a sense of tranquility and sophistication through understated elements. Whether in architecture, art, fashion, or digital interfaces, it champions a refined aesthetic that captures attention with its restraint and clarity.[/vc_column_text][/vc_column][/vc_row]
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
