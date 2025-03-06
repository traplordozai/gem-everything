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

$data[ 'name' ]             = esc_html__( 'Content Toggle Button', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Toggle-Button.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="102558" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" gutter_size="0"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="std" shadow="lg" toggle="yes" max_height="0" closed_txt="Click Here - More Info" open_txt="Hide - More Info" icon_open="fa fa-circle-minus" btn_margin_open="lg" toggle_scroll="yes" width="1/1" uncode_shortcode_id="135359" toggle_classes="btn btn-default h5 btn-custom-typo font-280730 font-weight-600 text-initial no-letterspace border-width-0 text-default-color" column_width_pixel="800"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="766466" column_width_pixel="600" back_color_type="uncode-palette"][vc_empty_space empty_h="2"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" sub_lead="yes" sub_reduced="yes" uncode_shortcode_id="699772" subheading="Munich, 23-24-25 October 2024"]Medium length headline[/vc_custom_heading][vc_separator sep_color=",Default"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" uncode_shortcode_id="136684"][vc_column_text uncode_shortcode_id="159675"]Street photography, a captivating art form, immortalizes the candid moments of everyday life. It is a visual narrative that unfolds on the bustling avenues, quiet corners, and vibrant alleys of urban landscapes. With a camera in hand, the street photographer becomes a silent observer, capturing the raw essence of human existence.

In the rhythm of the city, street photographers navigate through a symphony of sights and sounds. They chase the fleeting instances of raw emotion, the interplay of light and shadow, and the serendipitous collisions of life elements. Each click of the shutter freezes a slice of reality, preserving the untold stories embedded in the fabric of the streets.

The streets serve as an open canvas, showcasing the myriad expressions of humanity. From the laughter of children playing in a neighborhood square to the solemn gaze of a stranger lost in thought, street photography immortalizes the emotions and nuances that define our shared human experience.

Timing is the essence of street photography; it is about seizing the perfect moment amidst the chaos. The photographer intuition and anticipation become their allies, allowing them to capture split-second scenes that carry layers of emotion and depth. It is a delicate dance between patience and spontaneity, waiting for that precise instant when the narrative unfolds.

In the frame of street photography, composition reigns supreme. Lines, shapes, patterns, and juxtapositions converge to create visually compelling stories. The photographer eye discerns beauty in the mundane, finding poetry in the ordinary, and transforming the overlooked into striking visual poetry.[/vc_column_text][vc_empty_space empty_h="2"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
