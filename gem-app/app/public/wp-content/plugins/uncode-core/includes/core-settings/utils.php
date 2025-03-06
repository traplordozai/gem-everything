<?php
/**
 * Core settings page related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function uncode_core_settings_page_on_off_input( $args ) {
	if ( ! is_array( $args ) ) {
		return;
	}

	$title    = isset( $args['title'] ) ? $args['title'] : false;
	$desc     = isset( $args['desc'] ) ? $args['desc'] : false;
	$id       = isset( $args['id'] ) ? $args['id'] : false;
	$warning  = isset( $args['warning'] ) ? $args['warning'] : '';
	$autoload = isset( $args['autoload'] ) ? $args['autoload'] : false;

	$option_value = get_option( $id );
	$value        = $option_value === 'on' ? 'on' : 'off';

	if ( ! $id ) {
		return;
	}
	?>
	<div class="uncode-core-settings-option-row">
		<div class="uncode-core-settings-option-content">
			<?php if ( $title ) : ?>
				<h3 class="uncode-core-settings-option__title box-card__title"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>

			<?php if ( $desc ) : ?>
				<p class="uncode-core-settings-option__desc"><?php echo wp_kses_post( $desc ); ?></p>
			<?php endif; ?>
		</div>

		<div class="uncode-core-settings-option-input" data-checked-value="<?php echo esc_attr( $value ); ?>" data-option-id="<?php echo esc_attr( $id ); ?>" data-option-autoload="<?php echo esc_attr( $autoload ); ?>">
			<div class="on-off-switch">
				<input type="radio" name="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>-0" value="on" <?php checked( $value, 'on' ); ?> class="radio option-tree-ui-radio uncode-core-settings-option-input__radio uncode-core-settings-option-input__radio--on">
				<label for="<?php echo esc_attr( $id ); ?>-0" onclick=""><?php esc_html_e( 'On', 'uncode-core' ); ?></label>
				<input type="radio" name="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>-1" value="off" <?php checked( $value, 'off' ); ?> class="radio option-tree-ui-radio uncode-core-settings-option-input__radio uncode-core-settings-option-input__radio--off">
				<label for="<?php echo esc_attr( $id ); ?>-1" onclick=""><?php esc_html_e( 'Off', 'uncode-core' ); ?></label><span class="slide-button"></span>
			</div>
		</div>

		<div class="uncode-core-settings-option-warning">
			<span class="uncode-core-setting-warning-title"><strong><i class="fa fa-warning2"></i> <?php esc_html_e( 'This could break things. Please confirm your choice.', 'uncode-core' ); ?></strong></span>

			<p class="uncode-core-setting-warning-message"><?php echo wp_kses_post( $warning ); ?></p>
		</div>
	</div>
	<?php
}
