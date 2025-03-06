<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$el_id = $el_class = '';
extract(shortcode_atts(array(
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$classes[] = 'uncode-comments';
$classes[] = trim($this->getExtraClass( $el_class ));

$output = '<div class="' . esc_attr(trim(implode( ' ', $classes ))) . '"' . $el_id . '>';

if ( comments_open() || '0' != get_comments_number() ) {
	$output.= '<div data-name="commenta-area">';
		ob_start();
		comments_template();
		$output.= ob_get_clean();
	$output.= '</div>';
}

$output.= '</div>';

echo uncode_remove_p_tag($output);
