<?php
/**
 * Admin Menu Integration for GEM App
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Remove the gem_app_admin_menu function and its add_action hook
// Keep only the callback functions that are used by the menu items

/**
 * Admin Dashboard page callback
 */
function gem_app_admin_dashboard() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/dashboard.php';
}

/**
 * Student Management page callback
 */
function gem_app_admin_students() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/students.php';
}

/**
 * Organization Management page callback
 */
function gem_app_admin_organizations() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/organizations.php';
}

/**
 * Faculty Management page callback
 */
function gem_app_admin_faculty() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/faculty.php';
}

/**
 * Matching Process page callback
 */
function gem_app_admin_matching() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/matching.php';
}

/**
 * Grading Interface page callback
 */
function gem_app_admin_grading() {
    require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/grading.php';
}

/**
 * AJAX handlers for admin actions
 */

// Approve student
function gem_app_ajax_approve_student() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check if student ID is provided
    if (!isset($_POST['student_id'])) {
        wp_send_json_error('Student ID is required');
    }
    
    // Approve student via API
    $api = gem_app_api();
    $response = $api->request(
        '/admin/final-acceptance/' . intval($_POST['student_id']),
        'POST'
    );
    
    if ($response['success']) {
        wp_send_json_success();
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to approve student');
    }
}
add_action('wp_ajax_gem_app_approve_student', 'gem_app_ajax_approve_student');

// Start matching process
function gem_app_ajax_start_matching() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Start matching via API
    $api = gem_app_api();
    $response = $api->request('/admin/matching/start', 'POST');
    
    if ($response['success']) {
        wp_send_json_success($response['data']);
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to start matching process');
    }
}
add_action('wp_ajax_gem_app_start_matching', 'gem_app_ajax_start_matching');

// Reset matches
function gem_app_ajax_reset_matches() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Reset matches via API
    $api = gem_app_api();
    $response = $api->request('/admin/matching/reset', 'POST');
    
    if ($response['success']) {
        wp_send_json_success();
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to reset matches');
    }
}
add_action('wp_ajax_gem_app_reset_matches', 'gem_app_ajax_reset_matches');

// Update match
function gem_app_ajax_update_match() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check required parameters
    if (!isset($_POST['match_id'])) {
        wp_send_json_error('Match ID is required');
    }
    
    // Update match via API
    $api = gem_app_api();
    $response = $api->request(
        '/admin/matching/' . intval($_POST['match_id']),
        'PUT',
        array(
            'organization_id' => isset($_POST['organization_id']) ? intval($_POST['organization_id']) : null
        )
    );
    
    if ($response['success']) {
        wp_send_json_success();
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to update match');
    }
}
add_action('wp_ajax_gem_app_update_match', 'gem_app_ajax_update_match');

// Filter grades
function gem_app_ajax_filter_grades() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Get filters
    $filters = isset($_POST['filters']) ? $_POST['filters'] : array();
    
    // Get grades via API
    $api = gem_app_api();
    $response = $api->request('/admin/grades/filter', 'POST', $filters);
    
    if ($response['success']) {
        wp_send_json_success($response['data']);
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to filter grades');
    }
}
add_action('wp_ajax_gem_app_filter_grades', 'gem_app_ajax_filter_grades');

// Reprocess grades
function gem_app_ajax_reprocess_grades() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check student ID
    if (!isset($_POST['student_id'])) {
        wp_send_json_error('Student ID is required');
    }
    
    // Reprocess grades via API
    $api = gem_app_api();
    $response = $api->request(
        '/admin/grades/' . intval($_POST['student_id']) . '/reprocess',
        'POST'
    );
    
    if ($response['success']) {
        wp_send_json_success();
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to reprocess grades');
    }
}
add_action('wp_ajax_gem_app_reprocess_grades', 'gem_app_ajax_reprocess_grades');

// Delete grades
function gem_app_ajax_delete_grades() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check student ID
    if (!isset($_POST['student_id'])) {
        wp_send_json_error('Student ID is required');
    }
    
    // Delete grades via API
    $api = gem_app_api();
    $response = $api->request(
        '/admin/grades/' . intval($_POST['student_id']),
        'DELETE'
    );
    
    if ($response['success']) {
        wp_send_json_success();
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to delete grades');
    }
}
add_action('wp_ajax_gem_app_delete_grades', 'gem_app_ajax_delete_grades');

// Load statements
function gem_app_ajax_load_statements() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Get filter
    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    
    // Get statements via API
    $api = gem_app_api();
    $response = $api->request('/grading/statements' . ($filter === 'ungraded' ? '?ungraded=true' : ''));
    
    if ($response['success']) {
        wp_send_json_success($response['data']);
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to load statements');
    }
}
add_action('wp_ajax_gem_app_load_statements', 'gem_app_ajax_load_statements');

// Upload grades
function gem_app_ajax_upload_grades() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'gem-app-nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check if files were uploaded
    if (empty($_FILES['files'])) {
        wp_send_json_error('No files uploaded');
    }
    
    // Prepare files for API
    $api = gem_app_api();
    
    // Create a temporary directory for the files
    $temp_dir = wp_upload_dir()['basedir'] . '/gem-app-temp';
    if (!file_exists($temp_dir)) {
        mkdir($temp_dir, 0755, true);
    }
    
    $files_data = array();
    $file_count = count($_FILES['files']['name']);
    
    for ($i = 0; $i < $file_count; $i++) {
        // Skip if there was an upload error
        if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) {
            continue;
        }
        
        $temp_file = $temp_dir . '/' . sanitize_file_name($_FILES['files']['name'][$i]);
        
        // Move the uploaded file to the temporary directory
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $temp_file)) {
            $files_data[] = array(
                'name' => $_FILES['files']['name'][$i],
                'path' => $temp_file
            );
        }
    }
    
    // Make API request to upload grades
    $response = $api->request('/admin/upload-grades', 'POST', array(
        'files' => $files_data
    ));
    
    // Clean up temporary files
    foreach ($files_data as $file) {
        if (file_exists($file['path'])) {
            unlink($file['path']);
        }
    }
    
    if ($response['success']) {
        wp_send_json_success($response['data']);
    } else {
        wp_send_json_error($response['message'] ?? 'Failed to upload grades');
    }
}
add_action('wp_ajax_gem_app_upload_grades', 'gem_app_ajax_upload_grades');
