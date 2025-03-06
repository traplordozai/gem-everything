<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$el_id = $el_class = '';
extract(shortcode_atts(array(
	'custom_labels' => '',
	'custom_label_cart' => '',
	'custom_label_checkout' => '',
	'custom_label_complete' => '',
	'icon' => '',
	'show_numbers' => '',
	'font_family' => '',
	'font_size' => 'h2',
	'font_weight' => '',
	'text_transform' => '',
	'line_height' => '',
	'letter_spacing' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$font_family    = $font_family ? $font_family : false;
$font_size      = $font_size ? $font_size : false;
$font_weight    = $font_weight ? $font_weight : false;
$text_transform = $text_transform ? $text_transform : false;
$line_height    = $line_height ? $line_height : false;
$letter_spacing = $letter_spacing ? $letter_spacing : false;

$post_type = uncode_get_current_post_type();
if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
	global $product;
	if ( ! $product ) {
		$product = uncode_populate_post_object();
	}
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-checkout-steps', $this->settings['base'], $atts );

$classes = array( $css_class );
$classes[] = trim( $this->getExtraClass( $el_class ) );

$post_type = uncode_get_current_post_type();
if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
	$classes[] = 'woocommerce';
}

if ( $font_family !== '' ) {
	$classes[] = $font_family;
}

if ( $font_size !== '' ) {
	$classes[] = $font_size;
}

if ( $font_weight !== '' ) {
	$classes[] = 'font-weight-' . $font_weight;
}

if ( $text_transform !== '' ) {
	$classes[] = 'text-' . $text_transform;
}

if ( $line_height !== '' ) {
	$classes[] = $line_height;
}

if ( $letter_spacing !== '' ) {
	$classes[] = $letter_spacing;
}

$output = '<div class="uncode-wrapper '.esc_attr( trim( implode( ' ', $classes ) ) ).'" '.$el_id . '>';

$is_thankyou_page = false;

// Active class
global $wp;
$active = '';

if ( is_cart() ) {
	$active = 'cart';
} else if ( ! empty( $wp->query_vars['order-pay'] ) ) {
	$active = 'cart';
} else if ( isset( $wp->query_vars['order-received'] ) ) {
	$active = 'complete';
	$is_thankyou_page = true;
} else if ( is_checkout() ) {
	$active = 'checkout';
}

$active = apply_filters( 'uncode_get_woocommerce_active_step', $active );

// Icon markup
$icon_html = '';
if ( $icon ) {
	$icon_html .= '<i class="checkout-step-icon ' . $icon . '"></i>';
}

// Cart title
$cart_title = '';
if ( $custom_labels && $custom_label_cart ) {
	$cart_title = $custom_label_cart;
} else {
	$cart_page_id = wc_get_page_id( 'cart' );
	if ( $cart_page_id ) {
		$cart_title = get_the_title( $cart_page_id );
	}
}
$cart_title = $cart_title ? $cart_title : esc_html__( 'Cart', 'uncode' );

// Checkout title
$checkout_title = '';
if ( $custom_labels && $custom_label_checkout ) {
	$checkout_title = $custom_label_checkout;
} else {
	$checkout_page_id = wc_get_page_id( 'checkout' );
	if ( $checkout_page_id ) {
		$checkout_title = get_the_title( $checkout_page_id );
	}
}
$checkout_title = $checkout_title ? $checkout_title : esc_html__( 'Checkout', 'uncode' );

// Complete title
$complete_title = '';
if ( $custom_labels && $custom_label_complete ) {
	$complete_title = $custom_label_complete;
}
$complete_title = $complete_title ? $complete_title : esc_html__( 'Order Complete', 'uncode' );

ob_start(); ?>
<ul class="checkout-steps">
	<li class="checkout-step checkout-step--cart <?php echo uncode_switch_stock_string( $active === 'cart' ? 'checkout-step--active' : 'checkout-step--inactive' ); ?>">
		<?php if ( $is_thankyou_page ) : ?>
			<span class="checkout-step-wrapper">
		<?php else : ?>
			<a href="<?php echo esc_url( wc_get_cart_url() ) ?>" class="checkout-step-wrapper">
		<?php endif; ?>
			<?php if ( $show_numbers ) : ?>
				<span class="checkout-step-number">1</span>
			<?php endif; ?>
			<span class="checkout-step-text"><?php echo esc_html( $cart_title ); ?></span>
			<?php echo uncode_switch_stock_string( $icon_html ); ?>
		<?php if ( $is_thankyou_page ) : ?>
			</span>
		<?php else : ?>
			</a>
		<?php endif; ?>
	</li>
	<li class="checkout-step checkout-step--checkout <?php echo uncode_switch_stock_string( $active === 'checkout' ? 'checkout-step--active' : 'checkout-step--inactive' ); ?>">
		<?php if ( $is_thankyou_page ) : ?>
			<span class="checkout-step-wrapper">
		<?php else : ?>
			<a href="<?php echo esc_url( wc_get_checkout_url() ) ?>" class="checkout-step-wrapper">
		<?php endif; ?>
			<?php if ( $show_numbers ) : ?>
				<span class="checkout-step-number">2</span>
			<?php endif; ?>
			<span class="checkout-step-text"><?php echo esc_html( $checkout_title ); ?></span>
			<?php echo uncode_switch_stock_string( $icon_html ); ?>
		<?php if ( $is_thankyou_page ) : ?>
			</span>
		<?php else : ?>
			</a>
		<?php endif; ?>
	</li>
	<li class="checkout-step checkout-step--complete <?php echo uncode_switch_stock_string( $active === 'complete' ? 'checkout-step--active' : 'checkout-step--inactive' ); ?>">
		<span class="checkout-step-wrapper">
			<?php if ( $show_numbers ) : ?>
				<span class="checkout-step-number">3</span>
			<?php endif; ?>
			<span class="checkout-step-text"><?php echo esc_html( $complete_title ); ?></span>
		</span>
	</li>
</ul>
<?php
$output .= ob_get_clean();
$output .= '</div>';

echo uncode_remove_p_tag($output);
