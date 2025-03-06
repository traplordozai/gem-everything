<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$layout = $gutter_thumb_grid = $lightbox = $lbox_skin = $zoom = $zoom_mobile = $columns = $carousel = $mobile_grid = $el_id = $el_class = $gutter_thumb = $gutter_thumb_2 = $images_size = $data_gutter = $gutter_size = $inner_padding = $nav = $dots_inside = $product_badges = $css_animation = $animation_delay = $animation_speed = $div_data = '';
extract(shortcode_atts(array(
	'layout' => '',
	'gutter_thumb_grid' => 3,
	'lightbox' => '',
	'lbox_skin' => '',
	'zoom' => '',//filtered with preg_match_all() in uncode/core/inc/compatibility/woocommerce/filters.php
	'zoom_mobile' => '',
	'columns' => '',
	'carousel' => '',//filtered with preg_match_all() in uncode/core/inc/compatibility/woocommerce/filters.php
	'mobile_grid' => '',
	'el_id' => '',
	'el_class' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'gutter_thumb' => '2',
	'gutter_thumb_2' => '2',
	'gutter_size' => '3',
	'inner_padding' => '',
	'nav' => 'thumbs',
	'dots_inside' => '',
	'images_size' => '',
	'product_badges' => 'yes',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}
if ( $layout === 'std-lateral' || $layout === 'stack-lateral' ) {
	$nav = 'lateral';
}

$is_default_product_gallery = ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ? true : false;

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-single-product-gallery', $this->settings['base'], $atts );

if ($css_animation !== '' && uncode_animations_enabled()) {
	if ( $layout === 'stack' || $layout === 'stack-lateral' || $layout === 'grid' ) {
		$vc_animation = 'animate_when_almost_visible ' . $css_animation;
		if ($animation_delay !== '') {
			$vc_delay = esc_attr( $animation_delay );
		}
		if ($animation_speed !== '') {
			$vc_speed = esc_attr( $animation_speed );
		}
	} else {
		$css_class .= ' animate_when_almost_visible ' . $css_animation;
	}
}

$classes = array( $css_class );
$classes[] = trim( $this->getExtraClass( $el_class ) );

if ( ! $is_default_product_gallery ) {
	if ( $inner_padding !== '' ) {
		$classes[] = 'inner-padding';
	}

	switch ($gutter_thumb_2) {
		case 0:
			$vc_padding = 'no-th-padding';
			break;
		case 1:
			$vc_padding = 'one-th-padding';
			break;
		case 3:
			$vc_padding = 'single-th-padding';
			break;
		case 4:
			$vc_padding = 'double-th-padding';
			break;
		case 2:
		default:
			$vc_padding = 'half-th-padding';
			break;
	}

	switch ($gutter_thumb) {
		case 0:
			$classes[] = 'no-dots-gutter';
			$data_gutter = '0';
			break;
		case 1:
			$classes[] = 'one-dots-gutter';
			$data_gutter = '1';
			break;
		case 3:
			$classes[] = 'single-dots-gutter';
			$data_gutter = '18';
			break;
		case 4:
			$classes[] = 'double-dots-gutter';
			$data_gutter = '36';
			break;
		case 2:
		default:
			$classes[] = 'half-dots-gutter';
			$data_gutter = '9';
			break;
	}
}

if ( $is_default_product_gallery ) {
	$div_data .= 'data-gutter-size="' . absint( $gutter_size ) . '"';
} else {
	switch ($gutter_size) {
		case 0:
			$vc_margin = 'no-bottom-margin';
			break;
		case 1:
			$vc_margin = 'one-bottom-margin';
			break;
		case 2:
			$vc_margin = 'half-bottom-margin';
			break;
		case 4:
			$vc_margin = 'double-bottom-margin';
			break;
		case 5:
			$vc_margin = 'triple-bottom-margin';
			break;
		case 6:
			$vc_margin = 'quad-bottom-margin';
			break;
		case 3:
		default:
			$vc_margin = 'single-bottom-margin';
			break;
	}
}

if ( ! $is_default_product_gallery ) {
	if ( $nav === 'dots' ) {
		if ( $dots_inside == 'yes' ) {
			$classes[] = 'owl-dots-inside';
		} else {
			$classes[] = 'owl-dots-outside';
		}
	}
}

$post_type = uncode_get_current_post_type();
if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
	$classes[] = 'woocommerce';
	global $product;
	if ( ! $product ) {
		$product = uncode_populate_post_object();
	}
}

if ( ! $is_default_product_gallery ) {
	if ( $zoom != 'yes' && $zoom_mobile == 'yes' ) {
		$classes[] = 'no-zoom-mobile';
	}
}

if ( ! $is_default_product_gallery ) {
	$div_data .= ' data-gutter="' . esc_attr($data_gutter) . '"';
	$div_data .= ' data-dots="' . esc_attr( $nav == 'dots' ? 'true' : 'false' ) . '"';
}

if ( $is_default_product_gallery ) {
	switch ( $columns ) {
		case 1:
			$columns_callback = 'one';
			break;

		case 2:
			$columns_callback = 'two';
			break;

		case 4:
			$columns_callback = 'four';
			break;

		case 5:
			$columns_callback = 'five';
			break;

		case 6:
			$columns_callback = 'six';
			break;

		default:
			$columns_callback = 'three';
			break;
	}
}

$classes[] = 'uncode-wrapper-layout-' . esc_attr( $layout );
if ( $layout === 'grid' && $mobile_grid === 'yes' ) {
	$classes[] = 'uncode-grid-mobile';
}
if ( $nav === 'lateral' && ! $is_default_product_gallery ) {
	$classes[] = 'uncode-wrapper-lateral';
}

global $uncode_vc_is_product_gallery_module;

$uncode_vc_is_product_gallery_module = true;

$output .= '<div class="uncode-wrapper '.esc_attr( trim( implode( ' ', $classes ) ) ).'" '.$el_id . ' ' . $div_data . '>';
	if ( ! $is_default_product_gallery ) {
		global $uncode_vc_product_gallery_thumb_ratio;
		$uncode_vc_product_gallery_thumb_ratio = isset($images_size) ? $images_size : false;

		$images_arr = array(
			'vc_thumb_layout' => isset($layout) ? $layout : false,
			'vc_columns' => isset($columns) ? $columns : false,
			'vc_nav' => isset($nav) ? $nav : false,
			'vc_lightbox' => isset($lightbox) ? $lightbox : false,
			'vc_lbox_skin' => isset($lbox_skin) ? $lbox_skin : false,
			'vc_ratio' => $uncode_vc_product_gallery_thumb_ratio,
			'vc_padding' => isset($vc_padding) ? $vc_padding : false,
			'vc_animation' => isset($vc_animation) ? $vc_animation : false,
			'vc_delay' => isset($vc_delay) ? $vc_delay : false,
			'vc_speed' => isset($vc_speed) ? $vc_speed : false,
		);
		if ( ( $layout == 'stack' || $layout == 'stack-lateral' ) && isset( $vc_margin) ) {
			$images_arr['vc_margin'] = $vc_margin;
		}
		if ( $layout == 'grid' ) {
			$images_arr['vc_gutter_grid'] = $gutter_thumb_grid;
		}
	} else {
		$images_arr = array();
	}

	$images_arr['product_gallery_shortcode_atts'] = $atts;

	ob_start();
	if ( $product_badges == 'yes' ) {
		if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type !== 'product' ) {
			echo '<span class="product-badge product-badge-w-th"><span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span></span>';
		} else {
			global $product;
			if ( $product ) {
				$gallery_images_ids = apply_filters( 'uncode_product_gallery_thumb_ids', $product->get_gallery_image_ids(), $product->get_id() );
				$class_badge_wrapper = 'product-badge';
				$class_badge_wrapper .= is_array( $gallery_images_ids ) && !empty( $gallery_images_ids ) ? ' product-badge-w-th' : '';
				?><span class="<?php echo esc_attr( $class_badge_wrapper ); ?>"><?php woocommerce_show_product_sale_flash(); ?></span><?php
			}
		}
	}

	wc_get_template( 'single-product/product-image.php', $images_arr );

	$output .= ob_get_clean();
$output .= '</div>';

echo uncode_remove_p_tag($output);
