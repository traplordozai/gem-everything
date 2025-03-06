<?php
$button_class = '';

if ( uncode_toolkit_privacy_can_record_logs() || get_option( 'uncode_privacy_banner_accept_button_type', '' ) === 'accept_all' ) {
	$button_class .= ' gdpr-submit-consent';
}

if ( get_option( 'uncode_privacy_banner_accept_button_type', '' ) === 'accept_all' ) {
	$button_class .= ' gdpr-submit-accept-all';
}

$has_reject_btutton = get_option( 'uncode_privacy_banner_show_reject', '' ) === 'yes' ? true : false;
?>

<div class="gdpr gdpr-privacy-bar <?php echo $style ? 'limit-width gdpr-privacy-bar--' . $style : 'gdpr-privacy-bar--default'; ?> <?php echo $has_reject_btutton ? 'gdpr-privacy-bar--has-reject' : ''; ?>" style="display:none;" data-nosnippet="true">
	<div class="gdpr-wrapper">
		<div class="gdpr-content">
			<p>
				<?php echo nl2br( wp_kses_post( $content ) ); ?>
			</p>
		</div>
		<div class="gdpr-right <?php echo $has_reject_btutton ? 'gdpr-right--double' : 'gdpr-right--single' ?>">
			<button class="gdpr-preferences" type="button"><?php esc_html_e( 'Privacy Preferences', 'uncode-privacy' ); ?></button>
			<div class="gdpr-bar-buttons">
				<?php if ( $has_reject_btutton ) : ?>
					<button class="gdpr-reject <?php echo $style ? '' . $style : 'btn-accent'; ?> btn-flat" type="button"><?php echo esc_html( $reject_button_text ); ?></button>
				<?php endif; ?>
				<button class="gdpr-agreement <?php echo $style ? '' . $style : 'btn-accent'; ?> btn-flat <?php echo esc_attr( $button_class ); ?>" type="button"><?php echo esc_html( $accept_button_text ); ?></button>
			</div>
		</div>
	</div>
</div>
