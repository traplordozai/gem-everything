<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

$quantity_controller = apply_filters( 'uncode_input_quantity_controller', ot_get_option( '_uncode_product_quantity_input_style' ) === 'variation' );
$quantity_wide = ! apply_filters( 'uncode_input_quantity_wide', false ) ? '' : ' btn-block';
$classes[] = $quantity_wide;

?>
<div class="quantity<?php echo esc_attr( $quantity_wide ); ?>">
	<?php if ( $quantity_controller === true ) { ?>
	<div class="qty-inset<?php echo esc_attr( $quantity_wide ); ?>">
	<?php } ?>
		<?php
		/**
		 * Hook to output something before the quantity input field.
		 *
		 * @since 7.2.0
		 */
		do_action( 'woocommerce_before_quantity_input_field' );
		?>
		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label><?php
				if ( $quantity_controller === true ) {
				?><span class="qty-minus"><i class="fa fa-minus2"></i></span><?php
				}
				?><input
			type="<?php echo uncode_switch_stock_string( $quantity_controller === true ? 'text' : 'number' ); ?>"
			<?php echo uncode_switch_stock_string( $readonly ? 'readonly="readonly"' : '' ); ?>
			id="<?php echo esc_attr( $input_id ); ?>"
			class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
			size="4"
			min="<?php echo esc_attr( $min_value ); ?>"
			max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
			<?php if ( ! $readonly ): ?>
				step="<?php echo esc_attr( $step ); ?>"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>"
				autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
			<?php endif; ?>
		/><?php
		if ( $quantity_controller === true ) {
		?><span class="qty-plus"><i class="fa fa-plus2"></i></span><?php
		}
		?>
	<?php if ( $quantity_controller === true ) { ?>
	</div>
	<?php } ?>
	<?php
	/**
	 * Hook to output something after quantity input field
	 *
	 * @since 3.6.0
	 */
	do_action( 'woocommerce_after_quantity_input_field' );
	?>
</div>
<?php
