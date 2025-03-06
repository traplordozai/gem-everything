<?php
/**
 * Logs Table Class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Logs_List_Table' ) ) :

/**
 * Uncode_Toolkit_Privacy_Logs_List_Table Class
 */
class Uncode_Toolkit_Privacy_Logs_List_Table extends WP_List_Table {
	function get_columns(){
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'record_id'         => __( 'ID', 'uncode-privacy' ),
			'subject_id'        => __( 'User ID', 'uncode-privacy' ),
			'subject_ip'        => __( 'IP Address', 'uncode-privacy' ),
			'subject_email'     => __( 'Email Address', 'uncode-privacy' ),
			'subject_username'  => __( 'Username', 'uncode-privacy' ),
			'subject_firstname' => __( 'First Name', 'uncode-privacy' ),
			'subject_lastname'  => __( 'Last Name', 'uncode-privacy' ),
			'consents'          => __( 'Consents', 'uncode-privacy' ),
			'record_date'       => __( 'Date', 'uncode-privacy' ),
		);

		return $columns;
	}

	function get_custom_data( $data ) {
		$items = array();

		if ( is_array( $data ) ) {
			foreach ( $data as $data_value ) {
				$items[] = (array) $data_value;
			}
		}

		$this->items = $items;
	}

	function prepare_items() {
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = array();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		// Pagination
		$per_page     = 5;
		$current_page = $this->get_pagenum();
		$total_items  = count( $this->items );
		$found_data   = array_slice( $this->items, ( ( $current_page - 1 ) * $per_page ), $per_page );

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page
		) );

		$this->items = $found_data;
	}

	function column_default( $item, $column_name ) {
		switch( $column_name ) {
			case 'cb':
			case 'record_id':
			case 'subject_id':
			case 'subject_ip':
			case 'subject_email':
			case 'subject_username':
			case 'subject_firstname':
			case 'subject_lastname':
			case 'record_date':
				return $item[ $column_name ];
			case 'consents':
				$consents = maybe_unserialize( $item[ $column_name ] );
				$text     = '';

				if ( is_array( $consents ) ) {
					foreach ( $consents as $consent_key => $consent_value ) {
						$text .= $consent_key . ': ' . $consent_value . '<br>';
					}
				}
				return $text;
		}
	}

	function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="record_id[]" value="%s" />', $item['record_id']
		);
    }

	function get_bulk_actions() {
		$actions = array(
			'delete' => __( 'Delete', 'uncode-privacy' ),
		);

		return $actions;
	}

	function no_items() {
		_e( 'No logs found.', 'uncode-privacy' );
	}

}

endif;
