<?php
/**
 * Import functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Gets our placeholder medias we need to import
 *
 *    - url: external URL of the image
 *    - thumb: an unique identifier for the placeholder type (image1, image2, logo, etc)
 */
function uncode_wf_get_placeholder_media_to_import() {
	$placeholders = array(
		array(
			'type'  => 'generic',
			'thumb' => 'image1',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-1-min.jpg'
		),
		array(
			'type'  => 'generic',
			'thumb' => 'image2',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-2-min.jpg'
		),
		array(
			'type'  => 'generic',
			'thumb' => 'image3',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-3-min.jpg'
		),
		array(
			'type'  => 'generic',
			'thumb' => 'image4',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-4-min.jpg'
		),
		array(
			'type'  => 'generic',
			'thumb' => 'image5',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-5-min.jpg'
		),
		array(
			'type'  => 'generic',
			'thumb' => 'image6',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/image-placeholder-6-min.jpg'
		),
		array(
			'type'  => 'team',
			'thumb' => 'team1',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/team-member-placeholder-1-min.jpg'
		),
		array(
			'type'  => 'logo',
			'thumb' => 'logo1',
			'url'   => 'http://static.undsgn.com/uncode/wireframes/undsgn-logo.png'
		),
		array(
			'type'  => 'quote',
			'thumb' => 'quote1',
			'url'   => ''
		),
	);

	return $placeholders;
}

/**
 * Uploads an oembed/html media (for quotes)
 */
function uncode_wf_upload_quote_media() {
	$args = array(
		'post_title'     => 'Quote Sample',
		'post_content'   => 'Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.',
		'post_excerpt'   => 'Marc Scott, Executive Officer',
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'oembed/html',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);

	$media_id = wp_insert_post( $args );

	return $media_id;
}

/**
 * Gets needed demo contact forms
 */
function uncode_wf_get_demo_contact_forms() {
	$forms_dir = UNCDWF_PLUGIN_DIR . 'includes/forms/';

	$forms = array(
		'agency' => array(
			'title'     => 'Wireframe - Form Agency',
			'content'   => file_get_contents( $forms_dir . 'agency/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'agency/form.txt' ),
		),
		'basic' => array(
			'title'     => 'Wireframe - Form Basic',
			'content'   => file_get_contents( $forms_dir . 'basic/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'basic/form.txt' ),
		),
		'classic' => array(
			'title'     => 'Wireframe - Form Classic',
			'content'   => file_get_contents( $forms_dir . 'classic/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'classic/form.txt' ),
		),
		'contact-simple' => array(
			'title'     => 'Wireframe - Form Contact Simple',
			'content'   => file_get_contents( $forms_dir . 'contact-simple/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'contact-simple/form.txt' ),
		),
		'corporate' => array(
			'title'     => 'Wireframe - Form Corporate',
			'content'   => file_get_contents( $forms_dir . 'corporate/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'corporate/form.txt' ),
		),
		'newsletter-agency' => array(
			'title'     => 'Wireframe - Form Newsletter Agency',
			'content'   => file_get_contents( $forms_dir . 'newsletter-agency/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'newsletter-agency/form.txt' ),
		),
		'simple' => array(
			'title'     => 'Wireframe - Form Simple',
			'content'   => file_get_contents( $forms_dir . 'simple/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'simple/form.txt' ),
		),
		'newsletter' => array(
			'title'     => 'Wireframe - Newsletter',
			'content'   => file_get_contents( $forms_dir . 'newsletter/content.txt' ),
			'form'      => file_get_contents( $forms_dir . 'newsletter/form.txt' ),
		),
	);

	return $forms;
}

/**
 * Creates a contact form for CF7
 */
function uncode_wf_create_demo_forms() {
	$forms    = uncode_wf_get_demo_contact_forms();
	$form_ids = array();

	foreach ( $forms as $form_type => $form ) {
		$form_id    = uncode_wf_create_contact_form( $form_type );
		$form_ids[] = $form_id;;
	}

	return $form_ids;
}

/**
 * Creates a contact form for CF7
 */
function uncode_wf_create_contact_form( $id ) {
	$forms = uncode_wf_get_demo_contact_forms();
	$form  = isset( $forms[ $id ] ) ? $forms[ $id ] : false;

	if ( $form  ) {
		$args = array(
			'post_title'     => $form[ 'title' ],
			'post_content'   => $form[ 'content' ],
			'post_status'    => 'publish',
			'post_type'      => 'wpcf7_contact_form',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		);

		$form_id = wp_insert_post( $args );

		// Update form meta
		if ( $form_id && ! is_wp_error( $form_id ) ) {
			$meta = uncode_wf_get_contact_form_meta();

			foreach ( $meta as $meta_id => $meta_value ) {
				update_post_meta( $form_id, $meta_id, $meta_value );
			}

			update_post_meta( $form_id, '_form', $form[ 'form' ] );
		}

		return $form_id;
	}
}

/**
 * Add attachment meta to team placeholder
 */
function uncode_wf_update_team_placeholder_meta( $attachment_id ) {
	$social_links = '
https://www.facebook.com
https://twitter.com
https://www.linkedin.com
https://www.pinterest.com
https://www.tumblr.com/
info@yoursite.com';

	$data = array(
		'ID'           => $attachment_id,
		'post_title'   => 'Marc Scott',
		'post_content' => 'Problem solver. Total tv expert. Professional food nerd. Social media buff. Incurable beer geek.',
		'post_excerpt' => 'Executive Officer',
		'meta_input'   => array(
			'_uncode_team_member'        => true,
			'_uncode_team_member_social' => $social_links,
		)
	);

	$attachment_id = wp_update_post( $data );

	return $attachment_id;
}

/**
 * Gets contact form meta
 */
function uncode_wf_get_contact_form_meta() {
	$meta = array(
		'_mail' => array(
			'active'             => true,
			'subject'            => '',
			'sender'             => '',
			'recipient'          => '',
			'body'               => '',
			'additional_headers' => '',
			'attachments'        => '',
			'use_html'           => false,
			'exclude_blank'      => false,
		),
		'_mail_2' => array(
			'active'             => false,
			'subject'            => '',
			'sender'             => '',
			'recipient'          => '',
			'body'               => '',
			'additional_headers' => '',
			'attachments'        => '',
			'use_html'           => false,
			'exclude_blank'      => false,
		),
		'_messages' => array(
			'mail_sent_ok'             => 'Your message was sent successfully. Thanks.',
			'mail_sent_ng'             => 'Failed to send your message. Please try later or contact the administrator by another method.',
			'validation_error'         => 'Validation errors occurred. Please confirm the fields and submit it again.',
			'spam'                     => 'Failed to send your message. Please try later or contact the administrator by another method.',
			'accept_terms'             => 'Please accept the terms to proceed.',
			'invalid_required'         => 'Please fill the required field.',
			'invalid_too_long'         => 'This input is too long.',
			'invalid_too_short'        => 'This input is too short.',
			'invalid_date'             => 'Date format seems invalid.',
			'date_too_early'           => 'This date is too early.',
			'date_too_late'            => 'This date is too late.',
			'upload_failed'            => 'Failed to upload file.',
			'upload_file_type_invalid' => 'This file type is not allowed.',
			'upload_file_too_large'    => 'This file is too large.',
			'upload_failed_php_error'  => 'Failed to upload file. Error occurred.',
			'invalid_number'           => 'Number format seems invalid.',
			'number_too_small'         => 'This number is too small.',
			'number_too_large'         => 'This number is too large.',
			'quiz_answer_not_correct'  => 'Your answer is not correct.',
			'captcha_not_match'        => 'Your entered code is incorrect.',
			'invalid_email'            => 'Email address seems invalid.',
			'invalid_url'              => 'URL seems invalid.',
			'invalid_tel'              => 'Telephone number seems invalid.',
		),
		'_locale' => 'en_US',
		'_config_errors' => array(
			'mail.subject' => array(
				0 => array(
					'code' => 101,
					'args' => array(
						'message' => '',
						'params'  => array(),
						'link'    => 'https://contactform7.com/configuration-errors/maybe-empty',
					),
				),
			),
			'mail.sender' => array(
					0 => array(
						'code' => 102,
						'args' => array(
							'message' => '',
							'params'  => array(),
							'link'    => 'https://contactform7.com/configuration-errors/invalid-mailbox-syntax',
						),
					),
			),
			'mail.recipient' => array(
				0 => array(
					'code' => 102,
					'args' => array(
						'message' => '',
						'params'  => array(),
						'link'    => 'https://contactform7.com/configuration-errors/invalid-mailbox-syntax',
					),
				),
			),
			'mail.body' => array(
				0 => array(
					'code' => 101,
					'args' => array(
						'message' => '',
						'params'  => array(),
						'link'    => 'https://contactform7.com/configuration-errors/maybe-empty',
					),
				),
			),
		),
	);

	return $meta;
}
