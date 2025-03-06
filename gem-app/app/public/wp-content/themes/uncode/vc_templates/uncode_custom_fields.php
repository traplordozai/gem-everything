<?php

extract(shortcode_atts(array(
	'post_type' => 'post',
	'field_elements' => '',
	'custom_typo' => '',
	'text_size' => '',
	'text_height' => '',
	'text_space' => '',
	'text_font' => '',
	'text_weight' => '',
	'text_transform' => '',
	'text_italic' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-custom-fields', $this->settings['base'], $atts );

$classes = array( $css_class );
$classes[] = trim( $this->getExtraClass( $el_class ) );

$detail_container_class = array();
$detail_class = array();

if ( $field_elements !== '' ) {
	$detail_container_class[] = 'detail-container--single';
}

if ( $custom_typo === 'yes' ) {
	$detail_class[] = 'headings-color';
}

if ( $custom_typo === 'yes' && $text_size !== '' ) {
	$detail_class[] = $text_size;
}

if ( $custom_typo === 'yes' && $text_weight !== '' ) {
	$detail_class[] = 'font-weight-' . $text_weight;
}

if ( $custom_typo === 'yes' && $text_transform !== '' ) {
	$detail_class[] = 'text-' . $text_transform;
}

if ( $custom_typo === 'yes' && $text_height !== '' ) {
	$detail_class[] = $text_height;
}

if ( $custom_typo === 'yes' && $text_space !== '' ) {
	$detail_class[] = $text_space;
}

if ( $custom_typo === 'yes' && $text_italic === 'yes' ) {
	$detail_class[] = 'text-italic';
}

$detail_content = '';


global $post;

$current_post_type = uncode_get_current_post_type();

$all_custom_fields = function_exists( 'ot_get_option' ) ? ot_get_option( '_uncode_' . $current_post_type . '_custom_fields' ) : array();

if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
	$all_custom_fields = array(
		array(
			'title'                => __( 'Field Title', 'uncode' ),
			'_uncode_cf_unique_id' => 'example-detail-123',
		),
		array(
			'title'                => __( 'Field Title', 'uncode' ),
			'_uncode_cf_unique_id' => 'example-detail-456',
		),
	);
}

if ( is_array( $all_custom_fields ) && ! empty( $all_custom_fields ) ) {
	$specific_field_id = false;

	if ( isset( $atts['custom_fields_single_' . $current_post_type] ) && $atts['custom_fields_single_' . $current_post_type] ) {
		$specific_field_id = $atts['custom_fields_single_' . $current_post_type];
	}

	foreach ( $all_custom_fields as $field_key => $field ) {
		if ( $specific_field_id && $field['_uncode_cf_unique_id'] !== $specific_field_id ) {
			continue;
		}

		if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
			$value = __( 'Field Value Example', 'uncode' );
		} else {
			$value = get_post_meta( $post->ID, $field['_uncode_cf_unique_id'], 1 );
		}

		if ( $value !== '' ) {
			$detail_content .= '<span class="detail-container ' . esc_attr( trim( implode( ' ', $detail_container_class ) ) ) . ' ' . esc_attr( $field['_uncode_cf_unique_id'] ) . '">';
			if ( $field_elements === '' || ( $field_elements && $field_elements === 'label' ) ) {
				$detail_content .= '<span class="detail-label ' . esc_attr( trim( implode( ' ', $detail_class ) ) ) . '">' . esc_html( $field['title'] ) . '</span>';
			}
			if ( $field_elements === '' || ( $field_elements && $field_elements === 'value' ) ) {
				$detail_content .= '<span class="detail-value ' . esc_attr( trim( implode( ' ', $detail_class ) ) ) . '">' . wp_kses_post( $value ) . '</span>';
			}
			$detail_content .= '</span>';
		}
	}
}

$output = '<div class="uncode-wrapper ' . esc_attr( trim( implode( ' ', $classes ) ) ) . '">';
	$output .= '<p>' . $detail_content . '</p>';
$output .= '</div>';

echo uncode_remove_p_tag($output);
