<?php
$subheading = $subtext_one = $subtext_two = $heading_semantic = $text_size = $text_height = $text_space = $text_font = $text_weight = $text_transform = $text_italic = $text_color = $back_color = $separator = $separator_color = $separator_double = $sub_text = $sub_lead = $sub_reduced = $desktop_visibility = $medium_visibility = $mobile_visibility = $css_animation = $marquee_clone = $animation_delay = $animation_speed = $css_alt_animation = $marquee_clone_alt = $css_alt_animation_speed = $css_alt_animation_delay = $interval_animation = $output = $el_id = $el_class = $skew = $sticky_trigger = $sticky_trigger_option = $sub_class = $is_header = $auto_text = $medias = $media_ratio = $shape = $img_radius = $inline_media_anim = $inline_media_anim_speed = $inline_media_anim_delay = $marquee_speed = $marquee_speed_alt = $marquee_hover = $marquee_hover_alt = $media_height = $media_space = $inline_media = $marquee_space = $marquee_space_alt = $marquee_trigger = $marquee_trigger_alt = $marquee_navbar_alt = $marquee_navbar = $marquee_navbar_mobile = $marquee_navbar_mobile_alt = $heading_custom_size = $text_stroke = $foreword = $text_indent = $color_blend = $marquee_blur = $marquee_blur_alt = '';
extract( shortcode_atts( array(
	'uncode_shortcode_id' => '',
	'subheading' => '',
	'subtext_one' => '',
	'subtext_two' => '',
	'heading_semantic' => 'h2',
	'text_size' => 'h2',
	'text_height' => '',
	'text_space' => '',
	'text_font' => '',
	'text_weight' => '',
	'text_transform' => '',
	'text_italic' => '',
	'text_color' => '',
	'text_color_type' => '',
	'text_color_solid' => '',
	'text_color_gradient' => '',
	'badge_style' => '',
	'radius' => '',
	'back_color' => '',
	'back_color_type' => '',
	'back_color_solid' => '',
	'back_color_gradient' => '',
	'separator' => '',
	'separator_color' => '',
	'separator_double' => '',
	'sub_text' => '',
	'sub_lead' => '',
	'sub_reduced' => '',
	'heading_display' => '',
	'desktop_visibility' => '',
	'medium_visibility' => '',
	'mobile_visibility' => '',
	'css_animation' => '',
	'marquee_clone' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'interval_animation' => '',
	'parallax_intensity' => '',
	'parallax_centered' => '',
	'el_id' => '',
	'el_class' => '',
	'skew' => '',
	'sticky_trigger' => '',
	'sticky_trigger_option' => '',
	'auto_text' => '',
	'is_header' => '',
	'medias' => '',
	'media_ratio' => '',
	'shape' => '',
	'img_radius' => '',
	'css_alt_animation' => '',
	'marquee_clone_alt' => '',
	'css_alt_animation_speed' => '',
	'css_alt_animation_delay' => '',
	'inline_media_anim' => '',
	'inline_media_anim_speed' => '',
	'inline_media_anim_delay' => '',
	'marquee_speed' => '',
	'marquee_speed_alt' => '',
	'marquee_hover' => '',
	'marquee_hover_alt' => '',
	'media_height' => 100,
	'media_space' => '',
	'inline_media' => '',
	'marquee_space' => '',
	'marquee_space_alt' => '',
	'marquee_trigger' => '',
	'marquee_trigger_alt' => '',
	'marquee_navbar' => '',
	'marquee_navbar_alt' => '',
	'marquee_navbar_mobile' => '',
	'marquee_navbar_mobile_alt' => '',
	'heading_custom_size' => '',
	'text_stroke' => '',
	'foreword' => '',
	'text_indent' => '',
	'color_blend' => '',
	'marquee_blur' => '',
	'marquee_blur_alt' => ''
), $atts ) );

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$cont_classes = array('heading-text el-text');
$resp_classes = array();
$classes = array();
$sub_classes = array();
$separator_classes = array();
$div_data = array();
$data_size = array();


$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_custom_heading',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'text_color'          => $text_color,
		'text_color_type'     => $text_color_type,
		'text_color_solid'    => $text_color_solid,
		'text_color_gradient' => $text_color_gradient,
		'back_color'          => $back_color,
		'back_color_type'     => $back_color_type,
		'back_color_solid'    => $back_color_solid,
		'back_color_gradient' => $back_color_gradient,
		'text_stroke' 		  => $text_stroke,
	)
) );

if ( $text_size === 'custom' && $heading_custom_size !== '' ) {
	$inline_style_css .= uncode_get_dynamic_css_font_size_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'font_size'  => $heading_custom_size
	) );
}

if ( $text_indent !== '' ) {
	$inline_style_css .= uncode_get_dynamic_css_text_indent_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'text_indent'  => $text_indent
	) );
}

if ( $text_stroke === 'yes' && $text_color_type === 'uncode-solid' ) {
	$text_color = uncode_get_shortcode_color_attribute_value( 'text_stroke', $uncode_shortcode_id, $text_color_type, $text_color, $text_color_solid, $text_color_gradient );
} else {
	$text_color = uncode_get_shortcode_color_attribute_value( 'text_color', $uncode_shortcode_id, $text_color_type, $text_color, $text_color_solid, $text_color_gradient );
}
$back_color = uncode_get_shortcode_color_attribute_value( 'back_color', $uncode_shortcode_id, $back_color_type, $back_color, $back_color_solid, $back_color_gradient );

$fonts = (function_exists('ot_get_option')) ? ot_get_option('_uncode_font_groups') : array();
$headings_font = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_family') : '';

$heading_font = array(
	$headings_font => ''
);

if (isset($fonts) && is_array($fonts)) {
	foreach ($fonts as $key => $value) {
		$heading_font[$value['_uncode_font_group_unique_id']] = urldecode($value['_uncode_font_group']);
		if ($value['_uncode_font_group'] === 'manual') {
			$heading_font[$value['_uncode_font_group_unique_id']] = $value['_uncode_font_manual'];
		}
	}
}

if ($text_font !== '') {
	$classes[] = $text_font;
}

if ($text_size !== '') {
	$classes[] = $text_size;
	if ($text_size === 'bigtext') {
		$medias = '';
		$cont_classes[] = 'heading-bigtext';
	}
}
if ($text_height !== '') {
	$classes[] = $text_height;
}
if ($text_space !== '') {
	$classes[] = $text_space;
}
if ($text_weight !== '') {
	$classes[] = 'font-weight-' . $text_weight;
}
if ($text_color !== '') {
	$classes[] = 'text-' . $text_color . '-color';
}
if ($text_size === 'custom' && $heading_custom_size !== '') {
	$classes[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
}
if ($text_indent !== '') {
	$cont_classes[] = 'has-text-indent';
	$classes[] = 'text-' . $uncode_shortcode_id . '-indent';
}
if ( $badge_style === 'yes' ) {
	$classes[] = 'badge-style';

	if ( $radius !== '' ) {
		$classes[] = 'unradius-' . $radius;
	}

	if ($back_color !== '') {
		$classes[] = 'style-' . $back_color . '-bg';
	}
}
if ($text_transform !== '') {
	$classes[] = 'text-' . $text_transform;
}

if ($separator !== '') {
	$separator_classes[] = 'separator-break';
	if ($separator_color === 'yes') {
		$separator_classes[] = 'separator-accent';
	}
	if ($separator_double === 'yes') {
		$separator_classes[] = 'separator-double-padding';
	}
}

if ($desktop_visibility === 'yes') {
	$resp_classes[] = 'desktop-hidden';
}
if ($medium_visibility === 'yes') {
	$resp_classes[] = 'tablet-hidden';
}
if ($mobile_visibility === 'yes') {
	$resp_classes[] = 'mobile-hidden';
}

if ( $inline_media !== '' ) {
	$css_animation = $css_alt_animation;
	$animation_speed = $css_alt_animation_speed;
	$animation_delay = $css_alt_animation_delay;
	$marquee_clone = $marquee_clone_alt;
	$marquee_speed = $marquee_speed_alt;
	$marquee_hover = $marquee_hover_alt;
	$marquee_space = $marquee_space_alt;
	$marquee_trigger = $marquee_trigger_alt;
	$marquee_navbar = $marquee_navbar_alt;
	$marquee_navbar_mobile = $marquee_navbar_mobile_alt;
	$marquee_blur = $marquee_blur_alt;
	
	if ( strpos( $content, 'uncode_inline_image') !== false ) {
		$content = preg_replace("/\[uncode_hl_text(.*?)\]/", '', $content);
		$content = preg_replace("/\[\/uncode_hl_text\]/", '', $content);

		if ( strpos( $css_animation, 'marquee') !== false && function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
			$content .= '<span class="uncode_fe_safe">a</a>';
		}
	}
}

if ($css_animation !== '' && uncode_animations_enabled() && strpos( $css_animation, 'marquee') === false) {
	if ( $css_animation === 'curtain' || $css_animation === 'curtain-words' || $css_animation === 'single-slide' ||  $css_animation === 'single-slide-opposite' || $css_animation === 'typewriter' || $css_animation === 'single-curtain' ) {
		$cont_classes[] = $css_animation . ' animate_inner_when_almost_visible el-text-split';
		$classes[] = 'font-obs';
		if ($text_italic !== '') {
			$data_size['data-style'] = 'italic';
		} else {
			$data_size['data-style'] = 'normal';
		}
		if ($text_weight !== '') {
			$data_size['data-weight'] = esc_attr($text_weight);
		} else {
			$data_size['data-weight'] = ot_get_option('_uncode_heading_font_weight');
		}
		if ( isset($heading_font[$text_font]) ) {
			$data_font = wptexturize($heading_font[$text_font]);
		} elseif ( isset($heading_font[$headings_font]) ) {
			$data_font = wptexturize($heading_font[$headings_font]);
		}
		if ( isset($data_font) ) {
			$data_font = preg_replace( '/,\s+/', ',', $data_font );
			$data_font = preg_replace( '/\&\#(.*?);/', '', $data_font );
			$data_size['data-font'] = $data_font;
		}
	} else if ( $css_animation === 'parallax' ) {
		$cont_classes[] = 'parallax-el';
		$div_data = array_merge( $div_data, uncode_get_parallax_div_data( $parallax_intensity, $parallax_centered ) );
	} else {
		$cont_classes[] = $css_animation . ' animate_when_almost_visible';
	}
	if ($animation_delay !== '') {
		$div_data['data-delay'] = $animation_delay;
	}
	if ($animation_speed !== '') {
		$div_data['data-speed'] = $animation_speed;
	}
	if ($interval_animation !== '') {
		$div_data['data-interval'] = $interval_animation;
	}
}

if ( strpos( $css_animation, 'marquee') !== false) {
	$content = str_replace(array("\r", "\n"), ' ', $content);
	$classes[] = 'un-text-marquee';
	$classes[] = 'un-' . $css_animation;
	if ( $marquee_clone === 'yes' ) {
		$classes[] = 'un-marquee-infinite';
		if ( $marquee_space !== '' ) {
			$div_data['data-marquee-space'] = $marquee_space;
		}
	}
	$div_data['data-marquee-speed'] = $marquee_speed;
	if ( $marquee_hover === 'yes' ) {
		$classes[] = 'un-marquee-hover';
	}
	
	if ( strpos( $css_animation, 'marquee-scroll') !== false) {
		$div_data['data-marquee-trigger'] = $marquee_trigger;
		$div_data['data-marquee-navbar'] = $marquee_navbar;
		$div_data['data-marquee-navbar-mobile'] = $marquee_navbar_mobile;
	}

	if ( $marquee_blur === 'yes' ) {
		$cont_classes[] = 'un-marquee-blur';
	}
}

if ( $skew === 'yes' ) {
	$resp_classes[] = 'uncode-skew';
}

if ( $sticky_trigger === 'yes' && ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() )  ) {
	$resp_classes[] = 'sticky-trigger';

	if ( $sticky_trigger_option !== '' ) {
		$resp_classes[] = 'sticky-trigger-absolute';
	}
}

$resp_classes[] = trim($this->getExtraClass( $el_class ));

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

if ( strpos( $content, '[uncode_hl_text') !== false ) {
	$cont_classes[] = 'heading-lines';
}

$wrap_style = $inner_wrap_style = '';
if ( $color_blend !== '' ) {
	$wrap_style .= 'mix-blend-mode: ' . esc_attr( $color_blend ) . ';';
}
if ( $wrap_style !== '' ) {
	$wrap_style = ' style="' . $wrap_style . '"';
}

if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
	$inner_wrap_style = $wrap_style;
	$wrap_style = '';
}

if ( $auto_text !== 'price' && $foreword === 'yes' ) {
	$subheading_check = apply_filters('uncode_vc_custom_heading_subheading', $subheading, $auto_text, $is_header);
	if ($subheading_check !== '') {
		$cont_classes[] = 'has-foreword';
	}
}

$cont_classes = apply_filters( 'uncode_vc_custom_heading_classes', $cont_classes, $atts );

$output .= '<div class="vc_custom_heading_wrap ' . esc_attr( $heading_display === 'inline' ? 'heading-inline ' : '' ) . esc_attr(trim(implode( ' ', $resp_classes ))) . '"' . $wrap_style . '><div class="' . esc_attr(trim(implode( ' ', $cont_classes ))) . '" '.implode(' ', $div_data_attributes). $el_id . $inner_wrap_style . '>';

if ($separator === 'over') {
	$output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
}

if ( $auto_text == 'price' ) {
	global $product;
	if ( ! $product ) {
		$product_object = uncode_populate_post_object();
	} else {
		$product_object = $product;
	}
}

$post_type = uncode_get_current_post_type();
if ( $is_header != 'yes' ) {
	if ( $auto_text == 'yes' ) {
		$content = uncode_custom_dynamic_heading_in_content();
	} elseif ( $auto_text == 'excerpt' && $post_type != 'uncodeblock' && uncode_custom_dynamic_heading_in_content('subtitle') !== '' ) {
		$content = uncode_custom_dynamic_heading_in_content('subtitle');
	} elseif ( class_exists( 'WooCommerce' ) && $auto_text == 'price' && $product_object ) {
		add_filter( 'uncode_woocommerce_price_custom_heading', '__return_false' );
		$content = wp_kses_post($product_object->get_price_html());
		if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
			$classes[] = 'woocommerce';
		}
		add_filter( 'uncode_woocommerce_price_custom_heading', '__return_true' );
	}
}

$content = apply_filters('uncode_vc_custom_heading_content', $content, $auto_text, $is_header);
$content = apply_filters( 'uncode_builder_content', $content, 'vc_custom_heading' );

if ( strpos( $content, '[uncode_hl_text') !== false ) {
	if ( ! isset($data_font) ) {
		$classes[] = 'font-obs';
		if ( isset($heading_font[$text_font]) ) {
			$data_font = wptexturize($heading_font[$text_font]);
		} elseif ( isset($heading_font[$headings_font]) ) {
			$data_font = wptexturize($heading_font[$headings_font]);
		}
		if ( isset($data_font) ) {
			$data_font = preg_replace( '/,\s+/', ',', $data_font );
			$data_font = preg_replace( '/\&\#(.*?);/', '', $data_font );
			$data_size['data-font'] = $data_font;
		}
	}
}

$inline_link_rgx = "/(\<a ([^\<]+)>\[uncode_inline_image(.*?)\]<\/a>|\[\<a ([^\<]+)>uncode_inline_image<\/a>(.*?)\]|\[\<a ([^\<]+)>uncode_inline_image(.*?)<\/a>\])/";
$content = preg_replace_callback(
    $inline_link_rgx, 
    function ($matches) {
		preg_match( "/<a (.*?)>/", $matches[0], $match_link );
		$match_str = str_replace('</a>', '', $matches[0]);
		preg_match( "/uncode_inline_image([^\]]+)\]/", $match_str, $match_params );
		$match_param_1 = isset($match_params[1]) ? $match_params[1] : '';
		$str = '[uncode_inline_image ' . $match_link[1] . $match_param_1 . ']';
		return $str;
    },
    $content
);

preg_match_all("/(?:<h[0-6]>).*?(?:<\/h[0-6]>)/", $content, $tag_matches);
$content_tags = count($tag_matches[0]);

if ($content !== '') {

	$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $data_size, array_keys($data_size));

	if ( !$content_tags ) {
		$output .= '<' . $heading_semantic . ' class="' . esc_attr(trim(implode( ' ', $classes ))) . '" '.implode(' ', $div_data_attributes) . '>';

		if ($text_italic === 'yes') {
			$output .= '<i>';
		}
		if ( strpos($content, '[uncode_hl_text') !== false || ( uncode_animations_enabled() && ( $css_animation === 'curtain' || $css_animation === 'curtain-words' || $css_animation === 'single-slide' ||  $css_animation === 'single-slide-opposite' || $css_animation === 'typewriter' || $css_animation === 'single-curtain' ) ) ) {
			$breaks = array("<br />","<br>","<br/>");
			$content = str_ireplace( $breaks, "\r\n", $content );
			$content = strip_tags( $content, array('span') );
			$span_classes = ' class="heading-text-inner"';
			$split_in_words = preg_split('/(\s+)|(<[^>]*[^\/]>)|(\[|\]+)/i', $content, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			if ( isset($split_in_words) ) {
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
			if ( $css_animation === 'single-curtain' || $css_animation === 'typewriter' ) {
				$content = preg_replace( '/<span class="split-char(.*?)>(.*?)<\/span>/', '$2', do_shortcode( $content ) );
				$split_content = preg_split('/(?<!^)(?!$)(?!&(?!(amp|gt|lt|quot))[^\s]*)/u', $content );
			}
			if ( isset($split_content) ) {
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
		} else {
			$span_classes = '';
		}
		$output .= '<span' . $span_classes . '>';
	}

	// Foreword
	if ( $auto_text !== 'price' && $foreword === 'yes' ) {

		$subheading = apply_filters('uncode_vc_custom_heading_subheading', $subheading, $auto_text, $is_header);
		if ($subheading !== '') {
			$sub_class = ' class="heading-foreword';
			if ($sub_lead === 'yes') {
				$sub_class .= ' text-lead';
			} else if ($sub_lead === 'small') {
				$sub_class .= ' text-small';
			}
			if ($sub_reduced === 'yes') {
				$sub_class .= ' text-top-reduced';
			}

			$sub_class .= '"';

			$output .= '<small'.$sub_class.'>' . uncode_remove_p_tag($subheading, false) . '</small>';
		}
	}
	// end FOREWORD

	$content = trim($content);
	$title_lines = explode("\n", $content);
	$lines_counter = count($title_lines);
	if ($lines_counter > 1 && !$content_tags) {
		foreach ($title_lines as $key => $value) {
			preg_match_all("%\[uncode_hl_text(.*?)\]%i", $value, $match_span_starts);
			preg_match_all("%\[\/uncode_hl_text\]%i", $value, $match_span_ends);
			$value = trim($value);

			if ( count( $match_span_starts[0] ) > count( $match_span_ends[0] ) ) {
				$shortcode_end = '[/uncode_hl_text]';
				$shortcode_start = $match_span_starts[0][ count($match_span_starts[0])-1 ];
			} else {
				$shortcode_end = $shortcode_start = '';
			}
			$output .= $value;
			if ($value !== '' && ($lines_counter - 1 !== $key)) {
				$output .= $shortcode_end . '</span><span' . $span_classes . '>' . $shortcode_start;
			}
		}
	} else {
		if ( $content_tags ) {
			$content = wpautop($content);
		}
		$output .= $content;
	}
	if ( !$content_tags ) {
		$output .= '</span>';
		if ($text_italic === 'yes') {
			$output .= '</i>';
		}
		$output .= '</' . $heading_semantic . '>';
	}
}

$inline_img_rgx = "/\[uncode_inline_image([^\]]*?)\]/";
preg_match_all("/\[uncode_inline_image/", $output, $inline_array);

if ( $inline_media !== '' ) {

	$medias = explode( ',', $medias );

	if ( isset($inline_array[0]) && count($inline_array[0]) > 0 && count($medias) > 0 ) {
		$count_inline_images = count($inline_array[0]);
		$count_inline_medias = count($medias);

		if ( $count_inline_images > count($medias) ) {
			for ($dfci = $count_inline_medias; $dfci <= $count_inline_images; $dfci++) {
				$medias[] = $medias[ $dfci % $count_inline_medias ];
			}
		}

		$media_key = 0;

		$output = preg_replace_callback(
			$inline_img_rgx, 
			function ($matches) use(&$media_key, $medias, $inline_media_anim, $inline_media_anim_delay, $inline_media_anim_speed, $media_ratio, $img_radius, $shape, $media_height, $media_space) {
				if ( !isset($medias[$media_key]) ) {
					return;
				}
				$tmb_data = array();
				if ( $inline_media_anim_delay !== '' ) {
					$tmb_data['data-delay'] = $inline_media_anim_delay;
				}
				if ( $inline_media_anim_speed !== '' ) {
					$tmb_data['data-speed'] = $inline_media_anim_speed;
				}
				$block_data = array(
					'id' => $medias[$media_key],
					'media_id' => $medias[$media_key],
					'template' => 'inline-image',
					'text_padding' => 'no-block-padding',
					'images_size' => $media_ratio,
					'no-control' => true,
					'play_hover' => '',
					'play_pause' => '',
					'mobile_videos' => true,
					'poster' => '',
					'tmb_data' => $tmb_data
				);
				$block_classes = array('un-inline-image', esc_attr($inline_media_anim));
				$rotate_span = $rotate_span_end = '';
				preg_match_all("/\[uncode_inline_image([^\]]+)(rotate([^\]]+)?)\]/", $matches[0], $rotate);
				if ( isset($rotate[2]) && isset($rotate[2][0]) && strpos($rotate[2][0], "rotate") !== false) {
					$rotate_span .= '<span class="inline-rotate uncode-rotate';
					if ( isset($rotate[2][0]) && strpos($rotate[2][0], "scroll") !== false ) {
						$rotate_span .= ' uncode-rotate-scroll';
					}
					$rotate_span .= '">';
					$rotate_span_end = '</span>';
				}
				if ( $inline_media_anim !== '' ) {
					$block_classes[] = 'animate_when_almost_visible';
				}
				if ( $shape !== '' ) {
					$block_classes[] = $shape;
				}
				if ( $img_radius !== '' && $shape === 'img-round' ) {
					$block_classes[] = 'img-round-' . $img_radius;
				} 
						
				if ( $media_space !== '' ) {
					$block_classes[] = 'un-inline-space-' . $media_space;
				} 
						
				$block_data['classes'] = $block_classes;
				if ( isset( $matches[1] ) && strpos( $matches[1], 'href=') !== false ) {
					preg_match_all( "/(.*?)=[\"|'](.*?)[\"|']/", $matches[1], $match_atts );
					foreach ($match_atts[1] as $att_k => $att_val) {
						if ( trim($match_atts[1][$att_k]) !== 'rotate' ) {
							$block_data['inline-img-link'][trim($match_atts[1][$att_k])] = trim($match_atts[2][$att_k]);
						}
					}
					$media_out = uncode_create_single_block($block_data, 'inline-' . $medias[$media_key], 'inline-image', array('media' => array()), array(), '');
				} else {
					$media_out = uncode_create_single_block($block_data, 'inline-' . $medias[$media_key], 'inline-image', array('media' => array()), array(), '');
				}
				$str = preg_replace("/\[uncode_inline_image(.*?)\]/", $media_out, $matches[0]);
				if ( $media_height !== '' && $media_height != 100 ) {
					$str = preg_replace("/<span class=([\"|'])un-inline-image(.*?)<span>/", '<span class=$1un-inline-image$2<span style="height: ' . (floatval($media_height)) . '%; top: ' . (100 - (floatval($media_height))) / 2 . '%; ">', $str);
				}
				$media_key++;
				return $rotate_span . $str . $rotate_span_end;
			},
			$output
		);
	}
}

if ( $auto_text !== 'price' && $foreword !== 'yes' ) {

	if ($separator === 'yes') {
		$output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
	}
	$subheading = apply_filters('uncode_vc_custom_heading_subheading', $subheading, $auto_text, $is_header);
	if ($subheading !== '') {
		if ($sub_lead === 'yes') {
			$sub_lead = ' text-lead';
		} else if ($sub_lead === 'small') {
			$sub_lead = ' text-small';
		}
		if ($sub_reduced === 'yes') {
			$sub_reduced = ' text-top-reduced';
		}
		if ($sub_lead !== '' || $sub_reduced !== '') {
			$sub_class = ' class="'.esc_attr(trim($sub_lead.$sub_reduced)).'"';
		}
		$output .= '<div'.$sub_class.'>' . uncode_remove_p_tag($subheading, true) . '</div>';
	}
	if ($separator === 'under') {
		$output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
	}
}
$output .= '</div>';
$output .= uncode_print_dynamic_inline_style( $inline_style_css );
$output .= '<div class="clear"></div></div>';

if ( class_exists( 'WooCommerce' ) && function_exists('is_product') && is_product() ) {
	if ( $auto_text == 'yes' ) {
		do_action( 'uncode_woocommerce_single_product_summary_1' );
	} elseif ( $auto_text == 'excerpt' ) {
		do_action( 'uncode_woocommerce_single_product_summary_11' );
	} elseif ( $auto_text == 'price' ) {
		do_action( 'uncode_woocommerce_single_product_summary_6' );
	}
}

echo uncode_remove_p_tag($output);

if ( class_exists( 'WooCommerce' ) && function_exists('is_product') && is_product() ) {
	if ( $auto_text == 'yes' ) {
		do_action( 'uncode_woocommerce_single_product_summary_5' );
	} elseif ( $auto_text == 'excerpt' ) {
		do_action( 'uncode_woocommerce_single_product_summary_20' );
	} elseif ( $auto_text == 'price' ) {
		do_action( 'uncode_woocommerce_single_product_summary_10' );
	}
}