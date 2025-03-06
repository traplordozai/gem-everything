<?php
/**
 * Checkout functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Load custom checkout JS file
 */
function uncode_woocommerce_enqueue_checkout_script() {
	$scripts_prod_conf = uncode_get_scripts_production_conf();
	$resources_version = $scripts_prod_conf[ 'resources_version' ];
	$suffix            = $scripts_prod_conf[ 'suffix' ];

	wp_enqueue_script( 'uncode-woocommerce-checkout', get_template_directory_uri() . '/library/js/woocommerce-checkout' . $suffix . '.js', array( 'jquery' ) , $resources_version, true );
}

/**
 * Append the hidden login form to the checkout page.
 * Just the original and unmodified WC form wrapped in a div.
 */
function uncode_woocommerce_checkout_login_form() {
	echo '<div class="uncode-wc-hidden-form uncode-wc-hidden-form--login" style="display:none !important">';
	woocommerce_login_form();
	echo '</div>';
}

/**
 * Wrap payment methods in a div in compact mode (start).
 */
function uncode_woocommerce_checkout_payment_methods_wrapper_begin() {
	echo '<div class="woocommerce-checkout-payment-wrapper">';
	echo '<strong>' . esc_html__( 'Payment method', 'uncode' ) . '</strong>';
}

/**
 * Wrap payment methods in a div in compact mode (end).
 */
function uncode_woocommerce_checkout_payment_methods_wrapper_end() {
	echo '</div>';
}

/**
 * Show customer details.
 */
function uncode_woocommerce_show_customer_details_before_table( $order_id ) {
	$order                 = wc_get_order( $order_id );
	$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();

	if ( $show_customer_details ) {
		wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) );
	}
}

/**
 * When the filter 'woocommerce_checkout_redirect_empty_cart' is false
 * if someone visits the checkout page, the checkout form is replaced by
 * a notice via AJAX. This function adds some padding.
 */
function uncode_woocommerce_update_order_review_fragments( $fragments ) {
	if ( isset( $fragments['form.woocommerce-checkout'] ) ) {
		$fragments['form.woocommerce-checkout'] = '<div class="woocommerce-session-expired-wrapper">' . $fragments['form.woocommerce-checkout'] . '</div>';
	}

	return $fragments;
}
add_filter( 'woocommerce_update_order_review_fragments', 'uncode_woocommerce_update_order_review_fragments' );

/**
 * Copy of WC_Shortcode_Checkout::guest_should_verify_email.
 */
function uncode_woocommerce_guest_should_verify_email( WC_Order $order, string $context ): bool {
	$order_email       = $order->get_billing_email();
	$order_customer_id = $order->get_customer_id();

	// If we do not have a billing email for the order (could happen in the order is created manually, or if the
	// requirement for this has been removed from the checkout flow), email verification does not make sense.
	if ( empty( $order_email ) ) {
		return false;
	}

	// No verification step is needed if the user is logged in and is already associated with the order.
	if ( $order_customer_id && get_current_user_id() === $order_customer_id ) {
		return false;
	}

	$email = filter_input( INPUT_POST, 'email' );
	$nonce = filter_input( INPUT_POST, 'check_submission' );
	if ( $email && ! wp_verify_nonce( $nonce, 'wc_verify_email' ) ) {
		return true;
	}

	/**
	 * Controls the grace period within which we do not require any sort of email verification step before rendering
	 * the 'order received' or 'order pay' pages.
	 *
	 * To eliminate the grace period, set to zero (or to a negative value). Note that this filter is not invoked
	 * at all if email verification is deemed to be unnecessary (in other words, it cannot be used to force
	 * verification in *all* cases).
	 *
	 * @since 8.0.0
	 *
	 * @param int      $grace_period Time in seconds after an order is placed before email verification may be required.
	 * @param WC_Order $order        The order for which this grace period is being assessed.
	 * @param string   $context      Indicates the context in which we might verify the email address. Typically 'order-pay' or 'order-received'.
	 */
	$verification_grace_period = (int) apply_filters( 'woocommerce_order_email_verification_grace_period', 10 * MINUTE_IN_SECONDS, $order, $context );
	$date_created              = $order->get_date_created();

	// We do not need to verify the email address if we are within the grace period immediately following order creation.
	if (
		is_a( $date_created, WC_DateTime::class )
		&& time() - $date_created->getTimestamp() <= $verification_grace_period
	) {
		return false;
	}

	$session       = wc()->session;
	$session_email = '';

	if ( is_a( $session, WC_Session::class ) ) {
		$customer      = $session->get( 'customer' );
		$session_email = is_array( $customer ) && isset( $customer['email'] ) ? $customer['email'] : '';
	}

	$session_email_match  = $session_email === $order->get_billing_email();
	$supplied_email_match = isset( $_POST['email'] ) && sanitize_email( wp_unslash( $_POST['email'] ) ?? '' ) === $order->get_billing_email();
	$can_view_orders      = current_user_can( 'read_private_shop_orders' );

	// If we cannot match the order with the current user, the user should verify their email address.
	$email_verification_required = ! $session_email_match && ! $supplied_email_match && ! $can_view_orders;

	/**
	 * Provides an opportunity to override the (potential) requirement for shoppers to verify their email address
	 * before we show information such as the order summary, or order payment page.
	 *
	 * Note that this hook is not always triggered, therefore it is (for example) unsuitable as a way of forcing
	 * email verification across all order confirmation/order payment scenarios. Instead, the filter primarily
	 * exists as a way to *remove* the email verification step.
	 *
	 * @since 7.9.0
	 *
	 * @param bool     $email_verification_required If email verification is required.
	 * @param WC_Order $order                       The relevant order.
	 * @param string   $context                     The context under which we are performing this check.
	 */
	return (bool) apply_filters( 'woocommerce_order_email_verification_required', $email_verification_required, $order, $context );
}

/**
 * Get order recived output.
 */
function uncode_woocommerce_checkout_get_order_received_ouput( $order ) {
	// From WC_Shortcode_Checkout::order_received

	// If the specified order ID was invalid, we still render the default order received page (which will simply
	// state that the order was received, but will not output any other details: this makes it harder to probe for
	// valid order IDs than if we state that the order ID was not recognized).
	if ( ! $order ) {
		ob_start();

		wc_get_template( 'checkout/thankyou.php', array( 'order' => false ) );
		return array(
			'order'   => false,
			'content' => ob_get_clean(),
		);
	}

	/**
	 * Indicates if known (non-guest) shoppers need to be logged in before we let
	 * them access the order received page.
	 *
	 * @param bool $verify_known_shoppers If verification is required.
	 *
	 * @since 8.4.0
	 */
	$verify_known_shoppers = apply_filters( 'woocommerce_order_received_verify_known_shoppers', true );
	$order_customer_id     = $order->get_customer_id();

	// For non-guest orders, require the user to be logged in before showing this page.
	if ( $verify_known_shoppers && $order_customer_id && get_current_user_id() !== $order_customer_id ) {
		ob_start();

		wc_get_template( 'checkout/order-received.php', array( 'order' => false ) );
		wc_print_notice( esc_html__( 'Please log in to your account to view this order.', 'woocommerce' ), 'notice' );
		woocommerce_login_form( array( 'redirect' => $order->get_checkout_order_received_url() ) );
		return array(
			'order'   => false,
			'content' => ob_get_clean(),
		);
	}

	// For guest orders, request they verify their email address (unless we can identify them via the active user session).
	if ( uncode_woocommerce_guest_should_verify_email( $order, 'order-received' ) ) {
		ob_start();

		wc_get_template( 'checkout/order-received.php', array( 'order' => false ) );
		wc_get_template(
			'checkout/form-verify-email.php',
			array(
				'failed_submission' => ! empty( $_POST['email'] ), // phpcs:ignore WordPress.Security.NonceVerification.Missing
				'verify_url'        => $order->get_checkout_order_received_url(),
			)
		);

		return array(
			'order'   => false,
			'content' => ob_get_clean(),
		);

	}

	ob_start();
	// Otherwise, display the thank you (order received) page.
	wc_get_template( 'checkout/thankyou.php', array( 'order' => $order ) );

	return array(
		'order'   => true,
		'content' => ob_get_clean(),
	);
}
