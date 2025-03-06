<?php
/**
 * Add exporters and erasers to the legacy (default) WP Privacy Tool.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Legacy_Tools' ) ) :

/**
 * Uncode_Toolkit_Privacy_Legacy_Tools Class
 */
class Uncode_Toolkit_Privacy_Legacy_Tools {

	/**
	 * List of exporters.
	 *
	 * @var array
	 */
	protected $exporters = array();

	/**
	 * List of erasers.
	 *
	 * @var array
	 */
	protected $erasers = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		// Include supporting classes.
		include_once 'class-uncode-toolkit-privacy-legacy-tools-erasers.php';
		include_once 'class-uncode-toolkit-privacy-legacy-tools-exporters.php';

		$this->init();
	}

	/**
	 * Hook in events.
	 */
	protected function init() {
		add_filter( 'wp_privacy_personal_data_exporters', array( $this, 'register_exporters' ), 5 );
		add_filter( 'wp_privacy_personal_data_erasers', array( $this, 'register_erasers' ) );

		$this->add_exporter( 'uncode-toolkit-privacy-user-cookie-preferences', __( 'User Cookie Preferences', 'uncode-privacy' ), array( 'Uncode_Toolkit_Privacy_Legacy_Tools_Exporters', 'cookie_preferences_data_exporter' ) );
		$this->add_eraser( 'uncode-toolkit-privacy-user-cookie-preferences', __( 'User Cookie Preferences', 'uncode-privacy' ), array( 'Uncode_Toolkit_Privacy_Legacy_Tools_Erasers', 'cookie_preferences_data_eraser' ) );
	}

	/**
	 * Integrate this exporter implementation within the WordPress core exporters.
	 *
	 * @param array $exporters List of exporter callbacks.
	 * @return array
	 */
	public function register_exporters( $exporters = array() ) {
		foreach ( $this->exporters as $id => $exporter ) {
			$exporters[ $id ] = $exporter;
		}

		return $exporters;
	}

	/**
	 * Integrate this eraser implementation within the WordPress core erasers.
	 *
	 * @param array $erasers List of eraser callbacks.
	 * @return array
	 */
	public function register_erasers( $erasers = array() ) {
		foreach ( $this->erasers as $id => $eraser ) {
			$erasers[ $id ] = $eraser;
		}

		return $erasers;
	}

	/**
	 * Add exporter to list of exporters.
	 *
	 * @param string $id       ID of the Exporter.
	 * @param string $name     Exporter name.
	 * @param string $callback Exporter callback.
	 */
	public function add_exporter( $id, $name, $callback ) {
		$this->exporters[ $id ] = array(
			'exporter_friendly_name' => $name,
			'callback'               => $callback,
		);

		return $this->exporters;
	}

	/**
	 * Add eraser to list of erasers.
	 *
	 * @param string $id       ID of the Eraser.
	 * @param string $name     Exporter name.
	 * @param string $callback Exporter callback.
	 */
	public function add_eraser( $id, $name, $callback ) {
		$this->erasers[ $id ] = array(
			'eraser_friendly_name' => $name,
			'callback'             => $callback,
		);

		return $this->erasers;
	}
}

endif;

new Uncode_Toolkit_Privacy_Legacy_Tools();
