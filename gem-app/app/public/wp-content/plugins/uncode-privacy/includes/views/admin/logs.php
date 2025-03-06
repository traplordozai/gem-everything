<div class="wrap uncode-privacy-wrap">
	<h1><?php esc_html_e( 'Logs', 'uncode-privacy' ); ?></h1>

	<div class="nav-tab-wrapper">
		<a href="<?php echo admin_url( 'admin.php?page=uncode-privacy-settings#general' ); ?>" class="nav-tab">
			<?php echo esc_html__( 'General', 'uncode-privacy' ); ?>
		</a>
		<a href="<?php echo admin_url( 'admin.php?page=uncode-privacy-settings#consents' ); ?>" class="nav-tab">
			<?php echo esc_html__( 'Consents', 'uncode-privacy' ); ?>
		</a>
		<a href="<?php echo esc_url( UNCODE_TOOLKIT_PRIVACY_LOGS_URL ); ?>" class="nav-tab nav-tab--logs nav-tab-active">
			<?php echo esc_html__( 'Logs', 'uncode-privacy' ); ?>
		</a>
	</div>

	<?php settings_errors(); ?>

	<?php $record_logs = get_option( 'uncode_privacy_record_logs', '' ); ?>

	<?php if ( $record_logs === 'yes' ) : ?>
		<div class="uncode-privacy-tab" data-id="logs">

			<form action="<?php echo esc_url( UNCODE_TOOLKIT_PRIVACY_LOGS_URL ); ?>" method="post" class="uncode-privacy-search-logs-form">

				<?php
				$query_vars    = uncode_toolkit_privacy_personal_data_get_current_search_action_query_vars();
				$selected_type = isset( $query_vars['type'] ) ? $query_vars['type'] : 'username';
				?>

				<div class="uncode-privacy-search-logs-form-field">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row">
									<label for="search_type_for_privacy_request"><?php esc_html_e( 'Search type', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<select id="search_type_for_privacy_request" name="search_type_for_privacy_request">
										<option value="username" <?php selected( $selected_type, 'username' ); ?>><?php esc_html_e( 'Username', 'uncode-privacy' ); ?></option>
										<option value="email" <?php selected( $selected_type, 'email' ); ?>><?php esc_html_e( 'Email Address', 'uncode-privacy' ); ?></option>
										<option value="ip" <?php selected( $selected_type, 'ip' ); ?>><?php esc_html_e( 'IP Address', 'uncode-privacy' ); ?></option>
										<option value="cookie" <?php selected( $selected_type, 'cookie' ); ?>><?php esc_html_e( 'Session Cookie', 'uncode-privacy' ); ?></option>
										<option value="date" <?php selected( $selected_type, 'date' ); ?>><?php esc_html_e( 'Date', 'uncode-privacy' ); ?></option>
									</select>
								</td>
							</tr>
							<tr class="log-search-type" data-row="username">
								<th scope="row">
									<label for="username_for_privacy_request"><?php esc_html_e( 'Username', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'username' && isset( $query_vars['value'] ) ? $query_vars['value'] : '';
									?>
									<input type="text" class="regular-text ltr" id="username_for_privacy_request" name="username_for_privacy_request" value="<?php echo esc_attr( $selected ); ?>">
								</td>
							</tr>
							<tr class="log-search-type" data-row="email">
								<th scope="row">
									<label for="email_for_privacy_request"><?php esc_html_e( 'Email Address', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'email' && isset( $query_vars['value'] ) ? $query_vars['value'] : '';
									?>
									<input type="text" class="regular-text ltr" id="email_for_privacy_request" name="email_for_privacy_request" value="<?php echo esc_attr( $selected ); ?>">
								</td>
							</tr>
							<tr class="log-search-type" data-row="ip">
								<th scope="row">
									<label for="ip_address_for_privacy_request"><?php esc_html_e( 'IP Address', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'ip' && isset( $query_vars['value'] ) ? $query_vars['value'] : '';
									?>
									<input type="text" class="regular-text ltr" id="ip_address_for_privacy_request" name="ip_address_for_privacy_request" value="<?php echo esc_attr( $selected ); ?>">
								</td>
							</tr>
							<tr class="log-search-type" data-row="cookie">
								<th scope="row">
									<label for="session_cookie_for_privacy_request"><?php esc_html_e( 'Session Cookie', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'cookie' && isset( $query_vars['value'] ) ? $query_vars['value'] : '';
									?>
									<textarea class="regular-text ltr" id="session_cookie_for_privacy_request" name="session_cookie_for_privacy_request" cols="53" rows="4"><?php echo esc_html( $selected ); ?></textarea>
								</td>
							</tr>
							<tr class="log-search-type" data-row="date">
								<th scope="row">
									<label for="log_start_date_for_privacy_request"><?php esc_html_e( 'From Date', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'date' && isset( $query_vars['from'] ) ? $query_vars['from'] : '';
									?>
									<input type="text" class="regular-text ltr" id="log_start_date_for_privacy_request" name="log_start_date_for_privacy_request" value="<?php echo esc_attr( $selected ); ?>">
								</td>
							</tr>
							<tr class="log-search-type" data-row="date">
								<th scope="row">
									<label for="log_end_date_for_privacy_request"><?php esc_html_e( 'To Date', 'uncode-privacy' ); ?></label>
								</th>
								<td>
									<?php
									$selected = $selected_type === 'date' && isset( $query_vars['to'] ) ? $query_vars['to'] : '';
									?>
									<input type="text" class="regular-text ltr" id="log_end_date_for_privacy_request" name="log_end_date_for_privacy_request" value="<?php echo esc_attr( $selected ); ?>">
								</td>
								<?php
								?>
							</tr>
						</tbody>
					</table>
					<p class="submit">
						<input type="submit" name="submit" id="submit" class="button" value="<?php esc_html_e( 'Search logs', 'uncode-privacy' ); ?>">
					</p>
				</div>
				<?php wp_nonce_field( 'uncode_privacy_search_logs_request', 'uncode_privacy_search_logs_nonce' ); wp_nonce_field( 'uncode-privacy-search-logs' ); ?>

				<input type="hidden" name="uncode_form_action" value="uncode_privacy_search_logs_request" />
			</form>

			<?php //uncode_toolkit_privacy_personal_data_handle_actions(); ?>

			<form action="<?php echo esc_url( UNCODE_TOOLKIT_PRIVACY_LOGS_URL ); ?>" method="post" class="uncode-privacy-handle-logs-form">
				<?php
				$ex = array(
					array(
						'record_id' => 1,
						'subject_id' => '1',
						'subject_ip' => '192.168.1.18',
						'subject_email' => 'benito.lopez83@gmail.com',
						'subject_username' => 'admin',
						'subject_firstname' => 'Benito',
						'subject_lastname' => 'Lopez',
						'consents' => 'a:6:{s:4:"site";s:3:"yes";s:7:"youtube";s:3:"yes";s:5:"vimeo";s:3:"yes";s:7:"spotify";s:3:"yes";s:9:"instagram";s:3:"yes";s:6:"google";s:3:"yes";}',
						'record_date' => '2021-11-29 15:16:20',
					),
					array(
						'record_id' => 2,
						'subject_id' => 'a2c531baba57dbbe79cae489bd6d6d67',
						'subject_ip' => '192.168.1.18',
						'subject_email' => NULL,
						'subject_username' => NULL,
						'subject_firstname' => NULL,
						'subject_lastname' => NULL,
						'consents' => 'a:6:{s:4:"site";s:3:"yes";s:7:"youtube";s:3:"yes";s:5:"vimeo";s:3:"yes";s:7:"spotify";s:3:"yes";s:9:"instagram";s:3:"yes";s:6:"google";s:3:"yes";}',
						'record_date' => '2021-12-02 11:02:43',
					),
				);
				$current_logs = array();

				if ( is_array( $query_vars ) ) {
					$current_logs = uncode_toolkit_privacy_query_log( $query_vars );
				}

				$logs_List_Table = new Uncode_Toolkit_Privacy_Logs_List_Table();
				$logs_List_Table->get_custom_data( $current_logs );
				$logs_List_Table->prepare_items();
				$logs_List_Table->display();
				?>

				<?php wp_nonce_field( 'uncode_privacy_handle_logs_request', 'uncode_privacy_handle_logs_nonce' ); wp_nonce_field( 'uncode-privacy-handle-logs' ); ?>
				<input type="hidden" name="uncode_form_action" value="uncode_privacy_handle_logs_request" />
			</form>

			<?php uncode_toolkit_privacy_personal_data_handle_actions(); ?>

		</div>
	<?php endif; ?>
</div>
