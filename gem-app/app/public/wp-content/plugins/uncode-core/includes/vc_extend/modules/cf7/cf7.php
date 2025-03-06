<?php
/**
 * VC CF7 config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( class_exists( 'WPCF7' ) ) {
	global $wpdb;
	$cf7 = $wpdb->get_results("
		SELECT ID, post_title
		FROM $wpdb->posts
		WHERE post_type = 'wpcf7_contact_form'
		ORDER BY post_title
	");
	$contact_forms = array(esc_html__('Select a form…','uncode-core') => 0);
	if ($cf7) {
		foreach ($cf7 as $cform)
		{
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms[esc_html__('No contact forms found', 'uncode-core') ] = 0;
	}
	vc_map(array(
		'base' => 'contact-form-7',
		'name' => esc_html__('Contact Form 7', 'uncode-core') ,
		'weight' => 9550,
		'icon' => 'fa fa-envelope',
		'category' => array(
			esc_html__('Essentials', 'uncode-core') ,
		),
		'description' => esc_html__('CF7', 'uncode-core') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Form title', 'uncode-core') ,
				'param_name' => 'title',
				'admin_label' => true,
				'description' => esc_html__('What text use as form title. Leave blank if no title is needed.', 'uncode-core')
			) ,
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Specify contact form', 'uncode-core') ,
				'param_name' => 'id',
				'value' => $contact_forms,
				'description' => esc_html__('Choose previously created contact form from the drop down list.', 'uncode-core')
			),
			array(
				"type" => 'dropdown',
				"heading" => esc_html__("Form style", 'uncode-core') ,
				"param_name" => "html_class",
				"description" => esc_html__('Specify the style of the form.', 'uncode-core') ,
				"value" => array(
					esc_html__('Inherit', 'uncode-core') => '',
					esc_html__('Default Background', 'uncode-core') => 'default-background',
					esc_html__('Default Underline', 'uncode-core') => 'default-underline',
					esc_html__('No Label Default', 'uncode-core') => 'no-labels-default',
					esc_html__('No Label Background', 'uncode-core') => 'no-labels-background',
					esc_html__('No Label Underline', 'uncode-core') => 'no-labels-underline',
				) ,
			) ,
		)
	));
}
