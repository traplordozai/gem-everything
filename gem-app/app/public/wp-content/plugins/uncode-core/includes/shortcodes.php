<?php
function uncode_hl_text( $atts, $content ) {
	extract( shortcode_atts( array(
		'color' => 'accent',
		'height' => '100',
		'text_color' => '',
		'offset' => '',
		'opacity' => '',
		'animate' => '',
	), $atts ) );

	$parent_style = $atts_output = $parent_output = '';
	$parent_classes = array();
	$span_classes = '';

	if ( $color != 'default' ) {
		if ( substr( $color, 0, 1 ) === "#" ) {
			$span_classes .= '"bg":"' . sanitize_hex_color( $color ) . '",';
		} else {
			$span_classes .= '"bg":"style-' . esc_attr( $color ) . '-bg",';
		}
	} else {
		$span_classes .= '"bg":"headings-bg",';
	}

	if ( $height !== '' ) {
		if ( is_numeric( $height ) ) {
			$height .= '%';
		}
		$span_classes .= '"height":"' . esc_attr( $height ) . '",';
	}

	if ( $offset !== '' ) {
		$span_classes .= '"offset":"' . esc_attr( $offset ) . '",';
	}

	if ( $opacity !== '' ) {
		$span_classes .= '"opacity":"' . floatval( $opacity ) . '",';
	}

	if ( $text_color !== '' ) {
		if ( substr( $text_color, 0, 1 ) === "#" ) {
			$parent_style .= 'color:' . sanitize_hex_color( $text_color ) . ';';
		} else {
			$span_classes .= '"color":"text-' . $text_color . '-color",';
		}
	}

	if ( $animate !== '' && $animate !== false && $animate !== 'false'  ) {
		$span_classes .= '"animated":"yes",';
	}

 	if ( ! empty( $parent_classes ) ) {
		$parent_output = esc_attr(implode( ' ', $parent_classes ));
	}
	$parent_output = ' class="heading-text-highlight ' . $parent_output . '"';

	if ( $parent_style !== '' ) {
		$parent_output .= ' style="' . $parent_style . '"';
	}

	$atts_output = rtrim($span_classes,',');
	$atts_output = ' data-atts=\'{' . $atts_output . '}\'';

   return '<span' . $parent_output . $atts_output . '>' . do_shortcode( $content ) . '</span>';
}
add_shortcode( 'uncode_hl_text', 'uncode_hl_text' );

function uncode_text_icon( $atts, $content ) {
	extract( shortcode_atts( array(
		'text'          => '',
		'icon'          => '',
		'position' => '',
	), $atts ) );

	global $front_background_colors;

	$classes = array(
		'text-icon'
	);

	$pre_el   = '';
	$after_el = '';

	// Icons
	if ( $icon ) {
		if ( $position === 'after' ) {
			$after_el  = '<span class="text-icon__icon"><i class="' . $icon . '"></i></span>';
			$classes[] = 'text-icon--after';
		} else {
			$pre_el    = '<span class="text-icon__icon"><i class="' . $icon . '"></i></span>';
			$classes[] = 'text-icon--before';
		}
	}

	$html = '<span class="' . esc_attr( implode( ' ', $classes ) ) . '">' . $pre_el . '<span class="text-icon__text">' . esc_html( $text ) . '</span>' . $after_el . '</span>';

	return $html;
}
add_shortcode( 'uncode_text_icon', 'uncode_text_icon' );

function uncode_rotating_text( $atts, $content ) {
	extract( shortcode_atts( array(
		'fx' => '',
		'wait' => '',
		'words' => '',
	), $atts ) );

	if ( $words === '' || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		return $content;
	}

	$data = '';
	if ( $fx !== '' ) {
		$data .= ' data-fx="' . esc_html( $fx ) . '"';
	}
	if ( $wait !== '' ) {
		$data .= ' data-wait="' . esc_html( $wait ) . '"';
	}

	$or_content = $content;

	$split_in_words = preg_split('/(\s+)|(<[^>]*[^\/]>)|(\[|\]+)/i', $content, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

	if ( isset($split_in_words) && strpos($content, 'split-word-inner') === false ) {
		$content = '';
		$skip_split = false;
		$skip_tag = false;
		$empty_space = $empty_space_2 = '';
		$counter_word = 0;
		foreach ($split_in_words as $key => $word) {
			if ( $word === '[' || substr( $word, 0, 1 ) === '[' ) {
				$skip_split = true;
			}
			if ( $word === '<' || substr( $word, 0, 1 ) === '<' ) {
				$skip_tag = true;
			}
			if ( $skip_split || $skip_tag ) {
				$content .= $empty_space_2 . $word;
				$empty_space = $empty_space_2 = '';
			} elseif ( strpos($word, "\n") !== false ) {
				$content .= "\n";
			} elseif ( strlen(trim($word)) == 0 && $word !== "\n" ) {
				$empty_space = '<span class="split-word-empty">&nbsp;</span>';
				$empty_space_2 = '<span class="split-word split-word-empty">&nbsp;</span>';
			} else {
				$split_inner_class = 'split-word-inner';
				if ( $word === '&nbsp;' ||  $word === '' || $empty_space !== '' ) {
					$split_inner_class .= ' split-empty-inner';
				}
				$counter_word++;
				$content .= '<span class="split-word word' . $counter_word . '"><span class="split-word-flow"><span class="' . $split_inner_class . '">' . $empty_space . $word . '</span></span></span>';
				$empty_space = $empty_space_2 = '';
			}
			if ( $word === ']' || substr($word, -1) === ']' ) {
				$skip_split = false;
			}
			if ( $word === '>' || substr($word, -1) === '>' ) {
				$skip_tag = false;
			}
		}
	}

	$split_content = preg_split('/(?<!^)(?!$)(?!&(?!(amp|gt|lt|quot))[^\s]*)/u', $content );

	if ( isset($split_content) && strpos($content, 'split-char') === false ) {
		$content = '';
		$skip_split = false;
		$skip_tag = false;
		$skip_ent = false;
		foreach ($split_content as $key => $char) {
			if ( $char === '[' || substr( $char, 0, 1 ) === '[' ) {
				$skip_split = true;
			}
			if ( $char === '<' || substr( $char, 0, 1 ) === '<' ) {
				$skip_tag = true;
			}
			if ( $char === '&' || substr( $char, 0, 1 ) === '&' ) {
				$skip_ent = true;
			}
			if ( $skip_split || $skip_tag || $skip_ent === 'continue' || ctype_space($char) ) {
				$content .= $char;
			} elseif ( $skip_ent  ) {
				$content .= '<span class="split-char char' . $key . '">' . $char;
				$skip_ent = 'continue';
			} else {
				$content .= '<span class="split-char char' . $key . '">' . $char . '</span>';
			}
			if ( $char === ']' || substr($char, -1) === ']' ) {
				$skip_split = false;
			}
			if ( $char === '>' || substr($char, -1) === '>' ) {
				$skip_tag = false;
			}
			if ( $skip_ent == 'continue' && ( $char === ';' || substr($char, -1) === ';' ) ) {
				$skip_ent = false;
				$content .= '</span>';
			}
		}
	}

	return '<span class="split-word uncode-rotating-span uncode-rotating-text-start" data-text="' . wp_kses_post( $words ) . '|' . strip_tags( $or_content ) . '"' . $data . '>&nbsp;</span>' . do_shortcode( $content ) . '<span class="split-word uncode-rotating-span uncode-rotating-text-end">&nbsp;</span>';
}
add_shortcode( 'uncode_rotating_text', 'uncode_rotating_text' );