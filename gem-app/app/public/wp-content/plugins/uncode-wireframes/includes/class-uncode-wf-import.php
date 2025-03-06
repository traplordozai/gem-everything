<?php
/**
 * Import functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'UNCDWF_Import' ) ) :

/**
 * UNCDWF_Import Class
 */
class UNCDWF_Import {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Use this action on upgrades
		// add_action( 'uncode_upgraded', array( $this, 'import_after_upgrade' ) );
	}

	/**
	 * Check if a media file exists
	 */
	public static function media_exists( $media_id ) {
		global $wpdb;

    	return intval( $wpdb->get_var( $wpdb->prepare( "SELECT ID, post_type FROM {$wpdb->posts} WHERE ID = %d AND post_type = 'attachment'", $media_id ) ) );
	}

	/**
	 * Import content for wireframes
	 */
	public static function import() {
		self::import_media();
		self::import_forms();
	}

	/**
	 * Import wireframe thumbnails
	 */
	public static function import_media() {
		// Check if current user can import medias
		if ( ! current_user_can( 'manage_options' ) ) {
			return array();
		}

		// Quote and Team IDs, we need them because the quote media
		// must have the team ID as the poster media
		$quote_id = false;
		$team_id  = false;

		// Get list of medias we need to import
		$placeholders = uncode_wf_get_placeholder_media_to_import();

		// Get already created placeholders (if any)
		$wireframes_placeholders = get_option( 'uncode_wireframes_placeholders', array() );

		// Hold thumbs data
		$new_placeholders = array();

		// Check if all those media exist one by one
		foreach ( $placeholders as $placeholder ) {
			if ( in_array( $placeholder[ 'thumb' ] , array_column( $wireframes_placeholders, 'thumb' ) ) ) {
				// Image found, but check if exists
				$media_key = array_search( $placeholder[ 'thumb' ], array_column( $wireframes_placeholders, 'thumb' ) );
				$media     = $wireframes_placeholders[ $media_key ];
				$exists    = self::media_exists( $media[ 'id' ] );

				if ( $exists ) {
					// Save quote and team IDs for later
					if ( $placeholder[ 'type' ] === 'quote' ) {
						$quote_id = $media[ 'id' ];
					} else if ( $placeholder[ 'type' ] === 'team' ) {
						$team_id = $media[ 'id' ];
					}

					// Append data to our temp array
					$new_placeholders[] = array(
						'id'    => $media[ 'id' ],
						'thumb' => $placeholder[ 'thumb' ],
						'type'  => $placeholder[ 'type' ]
					);

					// Continue with the next media
					continue;
				}
			}

			// Create new media
			if ( apply_filters( 'uncode_wireframes_create_placeholders_medias', true ) ) {
				if ( $placeholder[ 'type' ] === 'quote' ) {
					$placeholder_id = uncode_wf_upload_quote_media();

					// Skip placeholder on errors
					if ( ! $placeholder_id || is_wp_error( $placeholder_id ) ) {
						continue;
					}

					// Save quote ID for later
					$quote_id = $placeholder_id;

				} else {
					require_once( ABSPATH . 'wp-admin/includes/media.php' );
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					require_once( ABSPATH . 'wp-admin/includes/image.php' );

					$placeholder_id = media_sideload_image( $placeholder[ 'url' ], NULL, esc_html__( 'Wireframe placeholder', 'uncode-wireframes' ), 'id' );

					// Skip placeholder on errors
					if ( ! $placeholder_id || is_wp_error( $placeholder_id ) ) {
						continue;
					}

					// Save team ID for later
					if ( $placeholder[ 'type' ] === 'team' ) {
						$team_id = $placeholder_id;

						// Update attachment meta
						$new_team_id = uncode_wf_update_team_placeholder_meta( $team_id );

						// Skip placeholder on errors
						if ( ! $new_team_id || is_wp_error( $new_team_id ) ) {
							continue;
						}
					}
				}

				// Append data to our temp array
				$new_placeholders[] = array(
					'id'    => $placeholder_id,
					'thumb' => $placeholder[ 'thumb' ],
					'type'  => $placeholder[ 'type' ]
				);
			}
		}

		// Update quote poster image, adding the ID of the team placeholder
		if ( $quote_id && $team_id ) {
			update_post_meta( $quote_id, '_uncode_poster_image', $team_id );
		}

		if ( $new_placeholders !== $wireframes_placeholders ) {
			// Update thumbs IDs
			update_option( 'uncode_wireframes_placeholders', $new_placeholders, false );
		}

		return $new_placeholders;
	}

	/**
	 * Import forms
	 */
	public static function import_forms() {
		// Contact form 7 must be installed of course
		if ( ! uncode_wf_check_for_dependency( 'cf7' ) ) {
			return array();
		}

		// Check if current user can import forms
		if ( ! current_user_can( 'wpcf7_edit_contact_form' ) && ! current_user_can( 'wpcf7_edit_contact_forms' ) ) {
			return array();
		}

		$forms = uncode_wf_get_demo_contact_forms();

		// Get already created forms (if any)
		$wireframes_forms = get_option( 'uncode_wireframes_forms', array() );

		// Hold forms data
		$new_forms = array();

		// Check if all those forms exist one by one
		foreach ( $forms as $form_type => $form_data ) {
			if ( in_array( $form_type , array_column( $wireframes_forms, 'type' ) ) ) {
				// Form found, but check if exists
				$form_key = array_search( $form_type, array_column( $wireframes_forms, 'type' ) );
				$form     = $wireframes_forms[ $form_key ];
				$exists   = is_string( get_post_status( $form[ 'id' ] ) );

				if ( $exists ) {
					// Append data to our temp array
					$new_forms[] = array(
						'id'    => $form[ 'id' ],
						'type'  => $form_type
					);

					// Continue with the next form
					continue;
				}
			}

			// Create new form
			if ( apply_filters( 'uncode_wireframes_create_forms', true ) ) {
				$form_id = uncode_wf_create_contact_form( $form_type );

				// Skip form on errors
				if ( ! $form_id || is_wp_error( $form_id ) ) {
					continue;
				}

				// Append data to our temp array
				$new_forms[] = array(
					'id'    => $form_id,
					'type'  => $form_type
				);
			}
		}

		if ( $new_forms !== $wireframes_forms ) {
			// Update forms IDs
			update_option( 'uncode_wireframes_forms', $new_forms, false );
		}

		return $new_forms;
	}
}

endif;

return new UNCDWF_Import();
