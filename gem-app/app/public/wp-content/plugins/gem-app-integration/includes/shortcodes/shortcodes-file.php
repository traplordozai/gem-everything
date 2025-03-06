<?php
/**
 * Shortcodes for GEM App
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register all shortcodes
 */
function gem_app_register_shortcodes() {
    add_shortcode('gem_dashboard', 'gem_app_dashboard_shortcode');
    add_shortcode('gem_student_profile', 'gem_app_student_profile_shortcode');
    add_shortcode('gem_faculty_profile', 'gem_app_faculty_profile_shortcode');
    add_shortcode('gem_organization_profile', 'gem_app_organization_profile_shortcode');
    add_shortcode('gem_matching_interface', 'gem_app_matching_interface_shortcode');
    add_shortcode('gem_document_management', 'gem_app_document_management_shortcode');
    add_shortcode('gem_support_system', 'gem_app_support_system_shortcode');
}
add_action('init', 'gem_app_register_shortcodes');

/**
 * Dashboard shortcode
 */
function gem_app_dashboard_shortcode($atts) {
    // Ensure user is logged in
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to access the dashboard.</p>';
    }
    
    // Get current user
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    
    // Determine which dashboard to show based on role
    $dashboard_type = 'student';
    if (in_array('faculty', $roles)) {
        $dashboard_type = 'faculty';
    } elseif (in_array('organization', $roles)) {
        $dashboard_type = 'organization';
    } elseif (in_array('administrator', $roles)) {
        $dashboard_type = 'admin';
    }
    
    // Get dashboard data from API
    $api = gem_app_api();
    $response = $api->get_dashboard_data();
    
    ob_start();
    
    if (!$response['success']) {
        echo '<div class="gem-app-error-message">';
        echo '<p>Error fetching dashboard data: ' . esc_html($response['message'] ?? 'Unknown error') . '</p>';
        echo '<button class="gem-app-authenticate-button">Authenticate with GEM App</button>';
        echo '</div>';
        
        // Add authentication script
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.gem-app-authenticate-button').on('click', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_authenticate',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert('Authentication failed: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
        
        return ob_get_clean();
    }
    
    // Display dashboard based on user role
    echo '<div class="gem-app-dashboard gem-app-' . esc_attr($dashboard_type) . '-dashboard">';
    
    echo '<h2>Welcome, ' . esc_html($user->display_name) . '</h2>';
    
    switch ($dashboard_type) {
        case 'admin':
            // Admin dashboard
            if (isset($response['data']['stats'])) {
                $stats = $response['data']['stats'];
                
                echo '<div class="gem-app-stats-grid">';
                
                echo '<div class="gem-app-stat-card">';
                echo '<h3>Total Students</h3>';
                echo '<div class="gem-app-stat-value">' . esc_html($stats['total_students'] ?? 0) . '</div>';
                echo '</div>';
                
                echo '<div class="gem-app-stat-card">';
                echo '<h3>Matched Students</h3>';
                echo '<div class="gem-app-stat-value">' . esc_html($stats['matched_students'] ?? 0) . '</div>';
                echo '</div>';
                
                echo '<div class="gem-app-stat-card">';
                echo '<h3>Pending Matches</h3>';
                echo '<div class="gem-app-stat-value">' . esc_html($stats['pending_matches'] ?? 0) . '</div>';
                echo '</div>';
                
                echo '</div>'; // .gem-app-stats-grid
                
                // Students awaiting final approval
                if (!empty($response['data']['final_approval_list'])) {
                    echo '<h3>Students Awaiting Final Approval</h3>';
                    echo '<table class="gem-app-table">';
                    echo '<thead><tr><th>Student</th><th>Status</th><th>Actions</th></tr></thead>';
                    echo '<tbody>';
                    
                    foreach ($response['data']['final_approval_list'] as $student) {
                        echo '<tr>';
                        echo '<td>' . esc_html($student['name']) . '</td>';
                        echo '<td>' . esc_html($student['status']) . '</td>';
                        echo '<td>';
                        echo '<button class="button gem-app-approve-student" data-student-id="' . esc_attr($student['id']) . '">Approve</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                }
            }
            
            // Add quick links
            echo '<div class="gem-app-dashboard-links">';
            echo '<h3>Quick Links</h3>';
            echo '<ul>';
            echo '<li><a href="' . admin_url('admin.php?page=gem-app-admin') . '">Admin Dashboard</a></li>';
            echo '<li><a href="' . admin_url('admin.php?page=gem-app-students') . '">Student Management</a></li>';
            echo '<li><a href="' . admin_url('admin.php?page=gem-app-matching') . '">Matching Process</a></li>';
            echo '<li><a href="' . admin_url('admin.php?page=gem-app-grading') . '">Grading Interface</a></li>';
            echo '</ul>';
            echo '</div>';
            
            break;
        
        case 'student':
            // Student dashboard
            if (isset($response['data'])) {
                $data = $response['data'];
                
                // Display any late message
                if (!empty($data['late_message'])) {
                    echo '<div class="gem-app-notice gem-app-notice-warning">';
                    echo '<p>' . esc_html($data['late_message']) . '</p>';
                    echo '</div>';
                }
                
                // Display match information
                if (!empty($data['match'])) {
                    $match = $data['match'];
                    
                    echo '<div class="gem-app-match-info">';
                    echo '<h3>Your Match</h3>';
                    
                    echo '<div class="gem-app-match-details">';
                    if (!empty($match['organization_name'])) {
                        echo '<p><strong>Organization:</strong> ' . esc_html($match['organization_name']) . '</p>';
                    }
                    
                    if (!empty($match['faculty_name'])) {
                        echo '<p><strong>Faculty Mentor:</strong> ' . esc_html($match['faculty_name']) . '</p>';
                    }
                    
                    if (!empty($match['matched_date'])) {
                        echo '<p><strong>Match Date:</strong> ' . esc_html(date('F j, Y', strtotime($match['matched_date']))) . '</p>';
                    }
                    echo '</div>';
                    
                    echo '</div>'; // .gem-app-match-info
                }
                
                // Document status
                if (isset($data['documents'])) {
                    $documents = $data['documents'];
                    $approvals = $data['approvals'] ?? array();
                    
                    echo '<div class="gem-app-document-status">';
                    echo '<h3>Document Status</h3>';
                    
                    echo '<table class="gem-app-table">';
                    echo '<thead><tr><th>Document</th><th>Status</th><th>Approval</th></tr></thead>';
                    echo '<tbody>';
                    
                    // Learning Plan
                    echo '<tr>';
                    echo '<td>Learning Plan</td>';
                    echo '<td>' . ($documents['learning_plan'] ? '<span class="gem-app-status-complete">Submitted</span>' : '<span class="gem-app-status-incomplete">Not Submitted</span>') . '</td>';
                    echo '<td>' . ($approvals['learning_plan'] ? '<span class="gem-app-status-approved">Approved</span>' : '<span class="gem-app-status-pending">Pending</span>') . '</td>';
                    echo '</tr>';
                    
                    // Midpoint Check-in
                    echo '<tr>';
                    echo '<td>Midpoint Check-in</td>';
                    echo '<td>' . ($documents['midpoint_checkin'] ? '<span class="gem-app-status-complete">Submitted</span>' : '<span class="gem-app-status-incomplete">Not Submitted</span>') . '</td>';
                    echo '<td>' . ($approvals['midpoint'] ? '<span class="gem-app-status-approved">Approved</span>' : '<span class="gem-app-status-pending">Pending</span>') . '</td>';
                    echo '</tr>';
                    
                    // Final Reflection
                    echo '<tr>';
                    echo '<td>Final Reflection</td>';
                    echo '<td>' . ($documents['final_reflection'] ? '<span class="gem-app-status-complete">Submitted</span>' : '<span class="gem-app-status-incomplete">Not Submitted</span>') . '</td>';
                    echo '<td>' . ($approvals['final_reflection'] ? '<span class="gem-app-status-approved">Approved</span>' : '<span class="gem-app-status-pending">Pending</span>') . '</td>';
                    echo '</tr>';
                    
                    // Resume
                    echo '<tr>';
                    echo '<td>Resume</td>';
                    echo '<td>' . ($documents['resume'] ? '<span class="gem-app-status-complete">Submitted</span>' : '<span class="gem-app-status-incomplete">Not Submitted</span>') . '</td>';
                    echo '<td>N/A</td>';
                    echo '</tr>';
                    
                    // Cover Letter
                    echo '<tr>';
                    echo '<td>Cover Letter</td>';
                    echo '<td>' . ($documents['cover_letter'] ? '<span class="gem-app-status-complete">Submitted</span>' : '<span class="gem-app-status-incomplete">Not Submitted</span>') . '</td>';
                    echo '<td>N/A</td>';
                    echo '</tr>';
                    
                    echo '</tbody>';
                    echo '</table>';
                    
                    // Final approval status
                    if (isset($approvals['admin_acceptance'])) {
                        echo '<div class="gem-app-final-approval">';
                        echo '<h4>Final Acceptance</h4>';
                        echo '<p>' . ($approvals['admin_acceptance'] ? '<span class="gem-app-status-approved">Approved</span>' : '<span class="gem-app-status-pending">Pending</span>') . '</p>';
                        echo '</div>';
                    }
                    
                    echo '</div>'; // .gem-app-document-status
                }
                
                // Quick links
                echo '<div class="gem-app-dashboard-links">';
                echo '<h3>Quick Links</h3>';
                echo '<ul>';
                echo '<li><a href="' . get_permalink(get_page_by_path('student-profile')) . '">My Profile</a></li>';
                echo '<li><a href="' . get_permalink(get_page_by_path('document-management')) . '">Document Management</a></li>';
                echo '<li><a href="' . get_permalink(get_page_by_path('support-system')) . '">Support System</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            
            break;
        
        case 'faculty':
            // Faculty dashboard
            if (isset($response['data'])) {
                $data = $response['data'];
                
                // Research projects
                if (isset($data['research_projects'])) {
                    echo '<div class="gem-app-research-projects">';
                    echo '<h3>Research Projects</h3>';
                    
                    if (empty($data['research_projects'])) {
                        echo '<p>You have no research projects.</p>';
                    } else {
                        echo '<table class="gem-app-table">';
                        echo '<thead><tr><th>Title</th><th>Area of Law</th><th>Status</th></tr></thead>';
                        echo '<tbody>';
                        
                        foreach ($data['research_projects'] as $project) {
                            echo '<tr>';
                            echo '<td>' . esc_html($project['title']) . '</td>';
                            echo '<td>' . esc_html($project['area_of_law']) . '</td>';
                            echo '<td>' . ($project['is_active'] ? '<span class="gem-app-status-active">Active</span>' : '<span class="gem-app-status-inactive">Inactive</span>') . '</td>';
                            echo '</tr>';
                        }
                        
                        echo '</tbody>';
                        echo '</table>';
                    }
                    
                    echo '</div>'; // .gem-app-research-projects
                }
                
                // Matched students
                if (isset($data['matches'])) {
                    echo '<div class="gem-app-matched-students">';
                    echo '<h3>Matched Students</h3>';
                    
                    if (empty($data['matches'])) {
                        echo '<p>You have no matched students.</p>';
                    } else {
                        echo '<table class="gem-app-table">';
                        echo '<thead><tr><th>Student</th><th>Status</th><th>Actions</th></tr></thead>';
                        echo '<tbody>';
                        
                        foreach ($data['matches'] as $match) {
                            echo '<tr>';
                            echo '<td>' . esc_html($match['student_name']) . '</td>';
                            echo '<td>' . esc_html($match['status']) . '</td>';
                            echo '<td>';
                            echo '<a href="?action=view-student&id=' . esc_attr($match['student_id']) . '" class="button">View</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        
                        echo '</tbody>';
                        echo '</table>';
                    }
                    
                    echo '</div>'; // .gem-app-matched-students
                }
                
                // Quick links
                echo '<div class="gem-app-dashboard-links">';
                echo '<h3>Quick Links</h3>';
                echo '<ul>';
                echo '<li><a href="' . get_permalink(get_page_by_path('faculty-profile')) . '">My Profile</a></li>';
                echo '<li><a href="' . get_permalink(get_page_by_path('document-management')) . '">Document Management</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            
            break;
        
        case 'organization':
            // Organization dashboard
            if (isset($response['data'])) {
                $data = $response['data'];
                
                // Organization details
                if (isset($data['organization'])) {
                    $org = $data['organization'];
                    
                    echo '<div class="gem-app-org-details">';
                    echo '<h3>Organization Details</h3>';
                    
                    echo '<div class="gem-app-org-info">';
                    echo '<p><strong>Name:</strong> ' . esc_html($org['name']) . '</p>';
                    echo '<p><strong>Area of Law:</strong> ' . esc_html($org['area_of_law']) . '</p>';
                    echo '<p><strong>Location:</strong> ' . esc_html($org['location']) . '</p>';
                    echo '<p><strong>Work Mode:</strong> ' . esc_html($org['work_mode']) . '</p>';
                    echo '<p><strong>Positions:</strong> ' . esc_html($org['filled_positions']) . ' / ' . esc_html($org['available_positions']) . '</p>';
                    echo '</div>';
                    
                    echo '</div>'; // .gem-app-org-details
                }
                
                // Matched students
                if (isset($data['matches'])) {
                    echo '<div class="gem-app-matched-students">';
                    echo '<h3>Matched Students</h3>';
                    
                    if (empty($data['matches'])) {
                        echo '<p>You have no matched students.</p>';
                    } else {
                        echo '<table class="gem-app-table">';
                        echo '<thead><tr><th>Student</th><th>Status</th><th>Actions</th></tr></thead>';
                        echo '<tbody>';
                        
                        foreach ($data['matches'] as $match) {
                            echo '<tr>';
                            echo '<td>' . esc_html($match['student_name']) . '</td>';
                            echo '<td>' . esc_html($match['status']) . '</td>';
                            echo '<td>';
                            echo '<a href="?action=view-student&id=' . esc_attr($match['student_id']) . '" class="button">View</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        
                        echo '</tbody>';
                        echo '</table>';
                    }
                    
                    echo '</div>'; // .gem-app-matched-students
                }
                
                // Quick links
                echo '<div class="gem-app-dashboard-links">';
                echo '<h3>Quick Links</h3>';
                echo '<ul>';
                echo '<li><a href="' . get_permalink(get_page_by_path('organization-profile')) . '">My Profile</a></li>';
                echo '<li><a href="' . get_permalink(get_page_by_path('document-management')) . '">Document Management</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            
            break;
    }
    
    echo '</div>'; // .gem-app-dashboard
    
    return ob_get_clean();
}

/**
 * Student Profile shortcode
 */
function gem_app_student_profile_shortcode($atts) {
    // Ensure user is logged in and is a student
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to access your profile.</p>';
    }
    
    $user = wp_get_current_user();
    if (!in_array('student', (array) $user->roles) && !in_array('administrator', (array) $user->roles)) {
        return '<p>You do not have permission to access this page.</p>';
    }
    
    // Get profile data from API
    $api = gem_app_api();
    $response = $api->request('/student/profile');
    
    ob_start();
    
    if (!$response['success']) {
        echo '<div class="gem-app-error-message">';
        echo '<p>Error fetching profile data: ' . esc_html($response['message'] ?? 'Unknown error') . '</p>';
        echo '<button class="gem-app-authenticate-button">Authenticate with GEM App</button>';
        echo '</div>';
        
        // Add authentication script
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.gem-app-authenticate-button').on('click', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_authenticate',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert('Authentication failed: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
        
        return ob_get_clean();
    }
    
    // Display profile
    echo '<div class="gem-app-student-profile">';
    
    echo '<h2>Student Profile</h2>';
    
    // Check if this is an edit or view
    $edit_mode = isset($_GET['action']) && $_GET['action'] === 'edit';
    
    if ($edit_mode) {
        // Edit form
        ?>
        <form class="gem-app-profile-form" id="student-profile-form">
            <h3>Personal Information</h3>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($response['data']['first_name'] ?? ''); ?>" required>
                </div>
                
                <div class="gem-app-form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($response['data']['last_name'] ?? ''); ?>" required>
                </div>
            </div>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo esc_attr($response['data']['email'] ?? ''); ?>" required>
                </div>
                
                <div class="gem-app-form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" id="student_id" name="student_id" value="<?php echo esc_attr($response['data']['student_id'] ?? ''); ?>" required>
                </div>
            </div>
            
            <h3>Area of Law Preferences</h3>
            
            <p class="gem-app-form-instructions">Rank your areas of interest from 1 (most interested) to 5 (least interested):</p>
            
            <?php
            $areas_of_law = array(
                'Public Interest' => 'PublicInterest',
                'Social Justice' => 'SocialJustice',
                'Private/Civil' => 'PrivateCivil',
                'International Law' => 'InternationalLaw',
                'Environment' => 'Environment',
                'Labour' => 'Labour',
                'Family' => 'Family',
                'Business Law' => 'BusinessLaw',
                'IP' => 'IP'
            );
            
            $rankings = $response['data']['rankings'] ?? array();
            
            echo '<div class="gem-app-rankings-grid">';
            
            foreach ($areas_of_law as $label => $field) {
                $current_rank = $rankings[$field] ?? '';
                
                echo '<div class="gem-app-form-group">';
                echo '<label for="' . esc_attr($field) . '">' . esc_html($label) . '</label>';
                echo '<select id="' . esc_attr($field) . '" name="rankings[' . esc_attr($field) . ']">';
                echo '<option value="">-- Select Rank --</option>';
                
                for ($i = 1; $i <= 5; $i++) {
                    echo '<option value="' . $i . '"' . selected($current_rank, $i, false) . '>' . $i . '</option>';
                }
                
                echo '</select>';
                echo '</div>';
            }
            
            echo '</div>'; // .gem-app-rankings-grid
            ?>
            
            <h3>Location and Work Mode Preferences</h3>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="location_preferences">Location Preferences</label>
                    <select id="location_preferences" name="location_preferences[]" multiple>
                        <?php
                        $locations = array(
                            'New York',
                            'Los Angeles',
                            'Chicago',
                            'San Francisco',
                            'Washington DC',
                            'Boston',
                            'Seattle',
                            'Austin',
                            'Remote'
                        );
                        
                        $current_locations = $response['data']['location_preferences'] ?? array();
                        foreach ($locations as $location) {
                            $selected = in_array($location, $current_locations) ? 'selected' : '';
                            echo '<option value="' . esc_attr($location) . '" ' . $selected . '>' . esc_html($location) . '</option>';
                        }
                        ?>
                    </select>
                    <p class="description">Hold Ctrl/Cmd to select multiple locations</p>
                </div>
                
                <div class="gem-app-form-group">
                    <label>Work Mode Preferences</label>
                    
                    <?php
                    $work_modes = array(
                        'in-person' => 'In-Person',
                        'hybrid' => 'Hybrid',
                        'remote' => 'Remote'
                    );
                    
                    $current_work_mode = $response['data']['work_mode'] ?? '';
                    
                    foreach ($work_modes as $value => $label) {
                        $checked = ($current_work_mode === $value) ? 'checked' : '';
                        
                        echo '<div class="gem-app-checkbox-group">';
                        echo '<input type="radio" id="work_mode_' . esc_attr($value) . '" name="work_mode" value="' . esc_attr($value) . '" ' . $checked . '>';
                        echo '<label for="work_mode_' . esc_attr($value) . '">' . esc_html($label) . '</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="gem-app-form-actions">
                <button type="submit" class="button button-primary">Save Profile</button>
                <a href="?action=view" class="button">Cancel</a>
            </div>
        </form>
        
        <script>
        jQuery(document).ready(function($) {
            $('#student-profile-form').on('submit', function(e) {
                e.preventDefault();
                
                const formData = $(this).serializeArray();
                const data = {};
                
                // Process form data
                $.each(formData, function(i, field) {
                    if (field.name.includes('[') && field.name.includes(']')) {
                        // Handle array-like fields (rankings, etc.)
                        const matches = field.name.match(/([^\[]+)\[([^\]]+)\]/);
                        if (matches && matches.length === 3) {
                            const key = matches[1];
                            const subKey = matches[2];
                            
                            if (!data[key]) {
                                data[key] = {};
                            }
                            
                            data[key][subKey] = field.value;
                        }
                    } else {
                        data[field.name] = field.value;
                    }
                });
                
                // Handle multiple select fields
                if ($('#location_preferences').length) {
                    data.location_preferences = $('#location_preferences').val() || [];
                }
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_update_student_profile',
                        profile_data: data,
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '?action=view&updated=1';
                        } else {
                            alert('Failed to update profile: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
    } else {
        // View mode
        // Show success message if profile was updated
        if (isset($_GET['updated']) && $_GET['updated'] === '1') {
            echo '<div class="gem-app-notice gem-app-notice-success">';
            echo '<p>Profile updated successfully.</p>';
            echo '</div>';
        }
        
        // Personal Information
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Personal Information</h3>';
        
        echo '<div class="gem-app-profile-info">';
        echo '<p><strong>Name:</strong> ' . esc_html(($response['data']['first_name'] ?? '') . ' ' . ($response['data']['last_name'] ?? '')) . '</p>';
        echo '<p><strong>Email:</strong> ' . esc_html($response['data']['email'] ?? '') . '</p>';
        echo '<p><strong>Student ID:</strong> ' . esc_html($response['data']['student_id'] ?? '') . '</p>';
        echo '<p><strong>Status:</strong> ' . esc_html($response['data']['status'] ?? '') . '</p>';
        
        if (isset($response['data']['overall_grade'])) {
            echo '<p><strong>Overall Grade:</strong> ' . esc_html($response['data']['overall_grade']) . '</p>';
        }
        
        echo '</div>'; // .gem-app-profile-info
        
        echo '</div>'; // .gem-app-profile-section
        
        // Area of Law Rankings
        if (isset($response['data']['rankings']) && !empty($response['data']['rankings'])) {
            echo '<div class="gem-app-profile-section">';
            echo '<h3>Area of Law Preferences</h3>';
            
            echo '<div class="gem-app-rankings-list">';
            
            // Sort rankings by value
            $rankings = $response['data']['rankings'];
            asort($rankings);
            
            echo '<ol>';
            foreach ($rankings as $area => $rank) {
                // Convert camelCase to readable format
                $readable_area = preg_replace('/(?<!^)[A-Z]/', ' $0', $area);
                
                echo '<li>' . esc_html($readable_area) . '</li>';
            }
            echo '</ol>';
            
            echo '</div>'; // .gem-app-rankings-list
            
            echo '</div>'; // .gem-app-profile-section
        }
        
        // Location and Work Mode Preferences
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Location and Work Mode Preferences</h3>';
        
        echo '<div class="gem-app-profile-info">';
        
        // Location Preferences
        echo '<p><strong>Location Preferences:</strong> ';
        if (isset($response['data']['location_preferences']) && !empty($response['data']['location_preferences'])) {
            echo esc_html(implode(', ', $response['data']['location_preferences']));
        } else {
            echo 'None specified';
        }
        echo '</p>';
        
        // Work Mode
        echo '<p><strong>Work Mode Preference:</strong> ';
        if (isset($response['data']['work_mode']) && !empty($response['data']['work_mode'])) {
            // Convert to title case
            echo esc_html(ucfirst($response['data']['work_mode']));
        } else {
            echo 'None specified';
        }
        echo '</p>';
        
        echo '</div>'; // .gem-app-profile-info
        
        echo '</div>'; // .gem-app-profile-section
        
        // Edit button
        echo '<div class="gem-app-profile-actions">';
        echo '<a href="?action=edit" class="button button-primary">Edit Profile</a>';
        echo '</div>';
    }
    
    echo '</div>'; // .gem-app-student-profile
    
    return ob_get_clean();
}

/**
 * Faculty Profile shortcode
 */
function gem_app_faculty_profile_shortcode($atts) {
    // Ensure user is logged in and is faculty
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to access your profile.</p>';
    }
    
    $user = wp_get_current_user();
    if (!in_array('faculty', (array) $user->roles) && !in_array('administrator', (array) $user->roles)) {
        return '<p>You do not have permission to access this page.</p>';
    }
    
    // Get profile data from API
    $api = gem_app_api();
    $response = $api->request('/faculty/profile');
    
    ob_start();
    
    if (!$response['success']) {
        echo '<div class="gem-app-error-message">';
        echo '<p>Error fetching profile data: ' . esc_html($response['message'] ?? 'Unknown error') . '</p>';
        echo '<button class="gem-app-authenticate-button">Authenticate with GEM App</button>';
        echo '</div>';
        
        // Add authentication script
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.gem-app-authenticate-button').on('click', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_authenticate',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert('Authentication failed: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
        
        return ob_get_clean();
    }
    
    // Display profile
    echo '<div class="gem-app-faculty-profile">';
    
    echo '<h2>Faculty Profile</h2>';
    
    // Check if this is an edit or view
    $edit_mode = isset($_GET['action']) && $_GET['action'] === 'edit';
    
    if ($edit_mode) {
        // Edit form
        ?>
        <form class="gem-app-profile-form" id="faculty-profile-form">
            <h3>Faculty Information</h3>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="department">Department</label>
                    <input type="text" id="department" name="department" value="<?php echo esc_attr($response['data']['department'] ?? ''); ?>" required>
                </div>
                
                <div class="gem-app-form-group">
                    <label for="office_location">Office Location</label>
                    <input type="text" id="office_location" name="office_location" value="<?php echo esc_attr($response['data']['office_location'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="gem-app-form-group">
                <label for="research_areas">Research Areas</label>
                <textarea id="research_areas" name="research_areas" rows="4"><?php echo esc_textarea($response['data']['research_areas'] ?? ''); ?></textarea>
            </div>
            
            <div class="gem-app-form-group">
                <label for="available_positions">Available Positions</label>
                <input type="number" id="available_positions" name="available_positions" value="<?php echo esc_attr($response['data']['available_positions'] ?? 1); ?>" min="1" max="10">
                <p class="description">Number of student positions you can supervise</p>
            </div>
            
            <div class="gem-app-form-actions">
                <button type="submit" class="button button-primary">Save Profile</button>
                <a href="?action=view" class="button">Cancel</a>
            </div>
        </form>
        
        <script>
        jQuery(document).ready(function($) {
            $('#faculty-profile-form').on('submit', function(e) {
                e.preventDefault();
                
                const formData = $(this).serialize();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_update_faculty_profile',
                        profile_data: formData,
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '?action=view&updated=1';
                        } else {
                            alert('Failed to update profile: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
    } else {
        // View mode
        // Show success message if profile was updated
        if (isset($_GET['updated']) && $_GET['updated'] === '1') {
            echo '<div class="gem-app-notice gem-app-notice-success">';
            echo '<p>Profile updated successfully.</p>';
            echo '</div>';
        }
        
        // Faculty Information
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Faculty Information</h3>';
        
        echo '<div class="gem-app-profile-info">';
        echo '<p><strong>Department:</strong> ' . esc_html($response['data']['department'] ?? '') . '</p>';
        echo '<p><strong>Office Location:</strong> ' . esc_html($response['data']['office_location'] ?? '') . '</p>';
        echo '<p><strong>Research Areas:</strong> ' . nl2br(esc_html($response['data']['research_areas'] ?? '')) . '</p>';
        echo '<p><strong>Available Positions:</strong> ' . esc_html($response['data']['available_positions'] ?? '0') . '</p>';
        echo '<p><strong>Filled Positions:</strong> ' . esc_html($response['data']['filled_positions'] ?? '0') . '</p>';
        echo '</div>'; // .gem-app-profile-info
        
        echo '</div>'; // .gem-app-profile-section
        
        // Research Projects
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Research Projects</h3>';
        
        echo '<div class="gem-app-projects-container" id="research-projects-container">';
        echo '<p>Loading research projects...</p>';
        echo '</div>';
        
        echo '<div class="gem-app-profile-actions">';
        echo '<button class="button" id="add-research-project">Add New Project</button>';
        echo '</div>';
        
        echo '</div>'; // .gem-app-profile-section
        
        // Edit profile button
        echo '<div class="gem-app-profile-actions">';
        echo '<a href="?action=edit" class="button button-primary">Edit Profile</a>';
        echo '</div>';
        
        // Load projects via AJAX
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Load research projects
            function loadResearchProjects() {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_load_research_projects',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.data.projects.length === 0) {
                                $('#research-projects-container').html('<p>You have no research projects.</p>');
                                return;
                            }
                            
                            let html = '<div class="gem-app-projects-list">';
                            
                            response.data.projects.forEach(function(project) {
                                html += '<div class="gem-app-project-card">';
                                html += '<div class="gem-app-project-header">';
                                html += '<h4>' + project.title + '</h4>';
                                html += '<span class="gem-app-project-status ' + (project.is_active ? 'active' : 'inactive') + '">';
                                html += project.is_active ? 'Active' : 'Inactive';
                                html += '</span>';
                                html += '</div>';
                                
                                html += '<div class="gem-app-project-info">';
                                html += '<p><strong>Area of Law:</strong> ' + project.area_of_law + '</p>';
                                
                                if (project.description) {
                                    html += '<p><strong>Description:</strong> ' + project.description + '</p>';
                                }
                                
                                if (project.required_skills) {
                                    html += '<p><strong>Required Skills:</strong> ' + project.required_skills + '</p>';
                                }
                                html += '</div>';
                                
                                html += '<div class="gem-app-project-actions">';
                                html += '<button class="button gem-app-edit-project" data-project-id="' + project.id + '">Edit</button> ';
                                html += '<button class="button gem-app-delete-project" data-project-id="' + project.id + '">Delete</button>';
                                html += '</div>';
                                
                                html += '</div>'; // .gem-app-project-card
                            });
                            
                            html += '</div>'; // .gem-app-projects-list
                            
                            $('#research-projects-container').html(html);
                            
                            // Attach event handlers for project cards
                            $('.gem-app-edit-project').on('click', function() {
                                const projectId = $(this).data('project-id');
                                editProject(projectId);
                            });
                            
                            $('.gem-app-delete-project').on('click', function() {
                                const projectId = $(this).data('project-id');
                                deleteProject(projectId);
                            });
                        } else {
                            $('#research-projects-container').html('<p>Error loading projects: ' + response.data + '</p>');
                        }
                    }
                });
            }
            
            // Load projects on page load
            loadResearchProjects();
            
            // Edit project
            function editProject(projectId) {
                // Redirect to edit page
                window.location.href = '?action=edit-project&id=' + projectId;
            }
            
            // Delete project
            function deleteProject(projectId) {
                if (!confirm('Are you sure you want to delete this project?')) {
                    return;
                }
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_delete_research_project',
                        project_id: projectId,
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Project deleted successfully.');
                            loadResearchProjects();
                        } else {
                            alert('Failed to delete project: ' + response.data);
                        }
                    }
                });
            }
            
            // Add new project
            $('#add-research-project').on('click', function() {
                window.location.href = '?action=add-project';
            });
        });
        </script>
        <?php
    }
    
    echo '</div>'; // .gem-app-faculty-profile
    
    return ob_get_clean();
}

/**
 * Organization Profile shortcode
 */
function gem_app_organization_profile_shortcode($atts) {
    // Ensure user is logged in and is an organization
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to access your profile.</p>';
    }
    
    $user = wp_get_current_user();
    if (!in_array('organization', (array) $user->roles) && !in_array('administrator', (array) $user->roles)) {
        return '<p>You do not have permission to access this page.</p>';
    }
    
    // Get profile data from API
    $api = gem_app_api();
    $response = $api->request('/organization/profile/' . $user->ID);
    
    ob_start();
    
    if (!$response['success']) {
        echo '<div class="gem-app-error-message">';
        echo '<p>Error fetching profile data: ' . esc_html($response['message'] ?? 'Unknown error') . '</p>';
        echo '<button class="gem-app-authenticate-button">Authenticate with GEM App</button>';
        echo '</div>';
        
        // Add authentication script
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.gem-app-authenticate-button').on('click', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_authenticate',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert('Authentication failed: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
        
        return ob_get_clean();
    }
    
    // Display profile
    echo '<div class="gem-app-organization-profile">';
    
    echo '<h2>Organization Profile</h2>';
    
    // Check if this is an edit or view
    $edit_mode = isset($_GET['action']) && $_GET['action'] === 'edit';
    
    if ($edit_mode) {
        // Edit form
        ?>
        <form class="gem-app-profile-form" id="organization-profile-form">
            <h3>Organization Information</h3>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="name">Organization Name</label>
                    <input type="text" id="name" name="name" value="<?php echo esc_attr($response['data']['name'] ?? ''); ?>" required>
                </div>
                
                <div class="gem-app-form-group">
                    <label for="area_of_law">Area of Law</label>
                    <select id="area_of_law" name="area_of_law" required>
                        <option value="">-- Select Area of Law --</option>
                        <?php
                        $areas_of_law = array(
                            'Public Interest',
                            'Social Justice',
                            'Private/Civil',
                            'International Law',
                            'Environment',
                            'Labour',
                            'Family',
                            'Business Law',
                            'IP'
                        );
                        
                        $current_area = $response['data']['area_of_law'] ?? '';
                        
                        foreach ($areas_of_law as $area) {
                            $selected = ($current_area === $area) ? 'selected' : '';
                            echo '<option value="' . esc_attr($area) . '" ' . $selected . '>' . esc_html($area) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="gem-app-form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo esc_textarea($response['data']['description'] ?? ''); ?></textarea>
            </div>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website" value="<?php echo esc_attr($response['data']['website'] ?? ''); ?>">
                </div>
                
                <div class="gem-app-form-group">
                    <label for="location">Location</label>
                    <select id="location" name="location" required>
                        <option value="">-- Select Location --</option>
                        <?php
                        $locations = array(
                            'New York',
                            'Los Angeles',
                            'Chicago',
                            'San Francisco',
                            'Washington DC',
                            'Boston',
                            'Seattle',
                            'Austin',
                            'Remote'
                        );
                        
                        $current_location = $response['data']['location'] ?? '';
                        
                        foreach ($locations as $location) {
                            $selected = ($current_location === $location) ? 'selected' : '';
                            echo '<option value="' . esc_attr($location) . '" ' . $selected . '>' . esc_html($location) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="gem-app-form-row">
                <div class="gem-app-form-group">
                    <label>Work Mode</label>
                    
                    <?php
                    $work_modes = array(
                        'in-person' => 'In-Person',
                        'hybrid' => 'Hybrid',
                        'remote' => 'Remote'
                    );
                    
                    $current_work_mode = $response['data']['work_mode'] ?? '';
                    
                    foreach ($work_modes as $value => $label) {
                        $checked = ($current_work_mode === $value) ? 'checked' : '';
                        
                        echo '<div class="gem-app-radio-group">';
                        echo '<input type="radio" id="work_mode_' . esc_attr($value) . '" name="work_mode" value="' . esc_attr($value) . '" ' . $checked . ' required>';
                        echo '<label for="work_mode_' . esc_attr($value) . '">' . esc_html($label) . '</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
                
                <div class="gem-app-form-group">
                    <label for="available_positions">Available Positions</label>
                    <input type="number" id="available_positions" name="available_positions" value="<?php echo esc_attr($response['data']['available_positions'] ?? 1); ?>" min="1" max="10" required>
                </div>
            </div>
            
            <div class="gem-app-form-actions">
                <button type="submit" class="button button-primary">Save Profile</button>
                <a href="?action=view" class="button">Cancel</a>
            </div>
        </form>
        
        <script>
        jQuery(document).ready(function($) {
            $('#organization-profile-form').on('submit', function(e) {
                e.preventDefault();
                
                const formData = $(this).serialize();
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_update_organization_profile',
                        profile_data: formData,
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '?action=view&updated=1';
                        } else {
                            alert('Failed to update profile: ' + response.data);
                        }
                    }
                });
            });
        });
        </script>
        <?php
    } else {
        // View mode
        // Show success message if profile was updated
        if (isset($_GET['updated']) && $_GET['updated'] === '1') {
            echo '<div class="gem-app-notice gem-app-notice-success">';
            echo '<p>Profile updated successfully.</p>';
            echo '</div>';
        }
        
        // Organization Information
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Organization Information</h3>';
        
        echo '<div class="gem-app-profile-info">';
        echo '<p><strong>Name:</strong> ' . esc_html($response['data']['name'] ?? '') . '</p>';
        echo '<p><strong>Area of Law:</strong> ' . esc_html($response['data']['area_of_law'] ?? '') . '</p>';
        echo '<p><strong>Description:</strong> ' . nl2br(esc_html($response['data']['description'] ?? '')) . '</p>';
        echo '<p><strong>Website:</strong> ';
        if (!empty($response['data']['website'])) {
            echo '<a href="' . esc_url($response['data']['website']) . '" target="_blank">' . esc_html($response['data']['website']) . '</a>';
        } else {
            echo 'N/A';
        }
        echo '</p>';
        echo '<p><strong>Location:</strong> ' . esc_html($response['data']['location'] ?? '') . '</p>';
        echo '<p><strong>Work Mode:</strong> ' . esc_html(ucfirst($response['data']['work_mode'] ?? '')) . '</p>';
        echo '<p><strong>Available Positions:</strong> ' . esc_html($response['data']['available_positions'] ?? '0') . '</p>';
        echo '<p><strong>Filled Positions:</strong> ' . esc_html($response['data']['filled_positions'] ?? '0') . '</p>';
        echo '</div>'; // .gem-app-profile-info
        
        echo '</div>'; // .gem-app-profile-section
        
        // Requirements
        echo '<div class="gem-app-profile-section">';
        echo '<h3>Requirements</h3>';
        
        echo '<div class="gem-app-requirements-container" id="requirements-container">';
        echo '<p>Loading requirements...</p>';
        echo '</div>';
        
        echo '<div class="gem-app-profile-actions">';
        echo '<button class="button" id="add-requirement">Add Requirement</button>';
        echo '</div>';
        
        echo '</div>'; // .gem-app-profile-section
        
        // Edit profile button
        echo '<div class="gem-app-profile-actions">';
        echo '<a href="?action=edit" class="button button-primary">Edit Profile</a>';
        echo '</div>';
        
        // Load requirements via AJAX
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Load requirements
            function loadRequirements() {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_load_requirements',
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.data.requirements.length === 0) {
                                $('#requirements-container').html('<p>No requirements defined.</p>');
                                return;
                            }
                            
                            let html = '<table class="gem-app-table">';
                            html += '<thead><tr><th>Type</th><th>Value</th><th>Mandatory</th><th>Actions</th></tr></thead>';
                            html += '<tbody>';
                            response.data.requirements.forEach(function(req) {
                                html += '<tr>';
                                html += '<td>' + req.requirement_type + '</td>';
                                html += '<td>' + req.value + '</td>';
                                html += '<td>' + (req.is_mandatory ? 'Yes' : 'No') + '</td>';
                                html += '<td>';
                                html += '<button class="button button-small gem-app-edit-requirement" data-req-id="' + req.id + '">Edit</button> ';
                                html += '<button class="button button-small gem-app-delete-requirement" data-req-id="' + req.id + '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            });
                            
                            html += '</tbody></table>';
                            $('#requirements-container').html(html);
                            
                            // Attach event handlers for requirement actions
                            $('.gem-app-edit-requirement').on('click', function() {
                                const reqId = $(this).data('req-id');
                                editRequirement(reqId);
                            });
                            
                            $('.gem-app-delete-requirement').on('click', function() {
                                const reqId = $(this).data('req-id');
                                deleteRequirement(reqId);
                            });
                        } else {
                            $('#requirements-container').html('<p>Error loading requirements: ' + response.data + '</p>');
                        }
                    }
                });
            }
            
            // Load requirements on page load
            loadRequirements();
            
            // Edit requirement
            function editRequirement(reqId) {
                // Redirect to edit page
                window.location.href = '?action=edit-requirement&id=' + reqId;
            }
            
            // Delete requirement
            function deleteRequirement(reqId) {
                if (!confirm('Are you sure you want to delete this requirement?')) {
                    return;
                }
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'gem_app_delete_requirement',
                        req_id: reqId,
                        nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Requirement deleted successfully.');
                            loadRequirements();
                        } else {
                            alert('Failed to delete requirement: ' + response.data);
                        }
                    }
                });
            }
            
            // Add new requirement
            $('#add-requirement').on('click', function() {
                window.location.href = '?action=add-requirement';
            });
        });
        </script>
        <?php
    }
    
    echo '</div>'; // .gem-app-organization-profile
    
    return ob_get_clean();
}

/**
 * Document Management shortcode
 */
function gem_app_document_management_shortcode($atts) {
    // Ensure user is logged in
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to access document management.</p>';
    }
    
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    
    // Determine which document management interface to show based on role
    $user_type = 'student';
    if (in_array('faculty', $roles)) {
        $user_type = 'faculty';
    } elseif (in_array('organization', $roles)) {
        $user_type = 'organization';
    } elseif (in_array('administrator', $roles)) {
        $user_type = 'admin';
    }
    
    ob_start();
    
    echo '<div class="gem-app-document-management gem-app-' . esc_attr($user_type) . '-documents">';
    
    echo '<h2>Document Management</h2>';
    
    // Different interface based on user role
    switch ($user_type) {
        case 'student':
            // Student documents
            ?>
            <div class="gem-app-document-tabs">
                <button class="gem-app-document-tab active" data-tab="upload">Upload Documents</button>
                <button class="gem-app-document-tab" data-tab="learning-plan">Learning Plan</button>
                <button class="gem-app-document-tab" data-tab="midpoint">Midpoint Check-in</button>
                <button class="gem-app-document-tab" data-tab="final">Final Reflection</button>
            </div>
            
            <div class="gem-app-document-content" id="upload-tab">
                <h3>Upload Documents</h3>
                <p>Upload your resume, cover letter, and transcript.</p>
                
                <form class="gem-app-document-form" id="upload-document-form" enctype="multipart/form-data">
                    <div class="gem-app-form-group">
                        <label for="document-type">Document Type</label>
                        <select id="document-type" name="type" required>
                            <option value="">-- Select Document Type --</option>
                            <option value="resume">Resume</option>
                            <option value="cover_letter">Cover Letter</option>
                            <option value="transcript">Transcript</option>
                        </select>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="document-file">File (PDF only)</label>
                        <input type="file" id="document-file" name="file" accept=".pdf" required>
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Upload Document</button>
                    </div>
                </form>
                
                <div id="upload-status" style="display: none;"></div>
                
                <h3>Uploaded Documents</h3>
                <div id="document-list">
                    <p>Loading documents...</p>
                </div>
            </div>
            
            <div class="gem-app-document-content" id="learning-plan-tab" style="display: none;">
                <h3>Learning Plan</h3>
                <p>Submit your learning plan with goals for your placement.</p>
                
                <form class="gem-app-document-form" id="learning-plan-form">
                    <div class="gem-app-form-row">
                        <div class="gem-app-form-group">
                            <label for="lp-student-name">Student Name</label>
                            <input type="text" id="lp-student-name" name="student_name" required>
                        </div>
                        
                        <div class="gem-app-form-group">
                            <label for="lp-mentor-name">Mentor Name</label>
                            <input type="text" id="lp-mentor-name" name="mentor_name" required>
                        </div>
                    </div>
                    
                    <div class="gem-app-form-row">
                        <div class="gem-app-form-group">
                            <label for="lp-organization">Organization</label>
                            <input type="text" id="lp-organization" name="organization" required>
                        </div>
                        
                        <div class="gem-app-form-group">
                            <label for="lp-plan-date">Date</label>
                            <input type="date" id="lp-plan-date" name="plan_date" required>
                        </div>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label>Learning Goals (at least 3)</label>
                        
                        <div id="goals-container">
                            <div class="gem-app-goal-item">
                                <input type="text" name="goals[]" placeholder="Enter a learning goal" required>
                                <button type="button" class="button remove-goal" style="display: none;">Remove</button>
                            </div>
                            <div class="gem-app-goal-item">
                                <input type="text" name="goals[]" placeholder="Enter a learning goal" required>
                                <button type="button" class="button remove-goal" style="display: none;">Remove</button>
                            </div>
                            <div class="gem-app-goal-item">
                                <input type="text" name="goals[]" placeholder="Enter a learning goal" required>
                                <button type="button" class="button remove-goal" style="display: none;">Remove</button>
                            </div>
                        </div>
                        
                        <button type="button" class="button" id="add-goal">Add Another Goal</button>
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Submit Learning Plan</button>
                    </div>
                </form>
                
                <div id="learning-plan-status" style="display: none;"></div>
                
                <h3>OR Upload Learning Plan Document</h3>
                <form class="gem-app-document-form" id="upload-learning-plan-form" enctype="multipart/form-data">
                    <div class="gem-app-form-group">
                        <label for="learning-plan-file">File (PDF only)</label>
                        <input type="file" id="learning-plan-file" name="file" accept=".pdf" required>
                        <input type="hidden" name="type" value="learning_plan">
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Upload Document</button>
                    </div>
                </form>
            </div>
            
            <div class="gem-app-document-content" id="midpoint-tab" style="display: none;">
                <h3>Midpoint Check-in</h3>
                <p>Submit your midpoint check-in to reflect on your progress.</p>
                
                <form class="gem-app-document-form" id="midpoint-form">
                    <div class="gem-app-form-row">
                        <div class="gem-app-form-group">
                            <label for="mp-student-name">Student Name</label>
                            <input type="text" id="mp-student-name" name="student_name" required>
                        </div>
                        
                        <div class="gem-app-form-group">
                            <label for="mp-mentor-name">Mentor Name</label>
                            <input type="text" id="mp-mentor-name" name="mentor_name" required>
                        </div>
                    </div>
                    
                    <div class="gem-app-form-row">
                        <div class="gem-app-form-group">
                            <label for="mp-organization">Organization</label>
                            <input type="text" id="mp-organization" name="organization" required>
                        </div>
                        
                        <div class="gem-app-form-group">
                            <label for="mp-checkin-date">Date</label>
                            <input type="date" id="mp-checkin-date" name="checkin_date" required>
                        </div>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q1">1. What tasks have you been working on?</label>
                        <textarea id="mp-q1" name="q1" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q2">2. What are your key learning experiences so far?</label>
                        <textarea id="mp-q2" name="q2" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q3">3. Are you making progress toward your learning goals?</label>
                        <textarea id="mp-q3" name="q3" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q4">4. What challenges are you facing?</label>
                        <textarea id="mp-q4" name="q4" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q5">5. What support do you need?</label>
                        <textarea id="mp-q5" name="q5" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-group">
                        <label for="mp-q6">6. Are there any adjustments needed to your learning plan?</label>
                        <textarea id="mp-q6" name="q6" rows="3" required></textarea>
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Submit Midpoint Check-in</button>
                    </div>
                </form>
                
                <div id="midpoint-status" style="display: none;"></div>
                
                <h3>OR Upload Midpoint Check-in Document</h3>
                <form class="gem-app-document-form" id="upload-midpoint-form" enctype="multipart/form-data">
                    <div class="gem-app-form-group">
                        <label for="midpoint-file">File (PDF only)</label>
                        <input type="file" id="midpoint-file" name="file" accept=".pdf" required>
                        <input type="hidden" name="type" value="midpoint_checkin">
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Upload Document</button>
                    </div>
                </form>
            </div>
            
            <div class="gem-app-document-content" id="final-tab" style="display: none;">
                <h3>Final Reflection</h3>
                <p>Submit your final reflection on your placement experience (200-1000 words).</p>
                
                <form class="gem-app-document-form" id="final-reflection-form">
                    <div class="gem-app-form-group">
                        <label for="reflection-text">Reflection (200-1000 words)</label>
                        <textarea id="reflection-text" name="reflection_text" rows="10" required></textarea>
                        <p class="word-count">Word count: <span id="word-count">0</span> (min: 200, max: 1000)</p>
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Submit Final Reflection</button>
                    </div>
                </form>
                
                <div id="final-reflection-status" style="display: none;"></div>
                
                <h3>OR Upload Final Reflection Document</h3>
                <form class="gem-app-document-form" id="upload-final-form" enctype="multipart/form-data">
                    <div class="gem-app-form-group">
                        <label for="final-file">File (PDF only)</label>
                        <input type="file" id="final-file" name="file" accept=".pdf" required>
                        <input type="hidden" name="type" value="final_reflection">
                    </div>
                    
                    <div class="gem-app-form-actions">
                        <button type="submit" class="button button-primary">Upload Document</button>
                    </div>
                </form>
            </div>
            
            <script>
            jQuery(document).ready(function($) {
                // Tab switching
                $('.gem-app-document-tab').on('click', function() {
                    $('.gem-app-document-tab').removeClass('active');
                    $(this).addClass('active');
                    
                    const tab = $(this).data('tab');
                    $('.gem-app-document-content').hide();
                    $(`#${tab}-tab`).show();
                });
                
                // Load document list
                function loadDocuments() {
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_get_student_documents',
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                if (Object.keys(response.data.documents).length === 0) {
                                    $('#document-list').html('<p>No documents uploaded yet.</p>');
                                    return;
                                }
                                
                                let html = '<table class="gem-app-table">';
                                html += '<thead><tr><th>Document Type</th><th>Status</th><th>Uploaded On</th></tr></thead>';
                                html += '<tbody>';
                                
                                const docs = response.data.documents;
                                
                                // Resume
                                html += '<tr>';
                                html += '<td>Resume</td>';
                                html += '<td>' + (docs.resume ? 'Uploaded' : 'Not Uploaded') + '</td>';
                                html += '<td>' + (docs.resume_date || '-') + '</td>';
                                html += '</tr>';
                                
                                // Cover Letter
                                html += '<tr>';
                                html += '<td>Cover Letter</td>';
                                html += '<td>' + (docs.cover_letter ? 'Uploaded' : 'Not Uploaded') + '</td>';
                                html += '<td>' + (docs.cover_letter_date || '-') + '</td>';
                                html += '</tr>';
                                
                                // Transcript
                                html += '<tr>';
                                html += '<td>Transcript</td>';
                                html += '<td>' + (docs.transcript ? 'Uploaded' : 'Not Uploaded') + '</td>';
                                html += '<td>' + (docs.transcript_date || '-') + '</td>';
                                html += '</tr>';
                                
                                html += '</tbody></table>';
                                $('#document-list').html(html);
                            } else {
                                $('#document-list').html('<p>Error loading documents: ' + response.data + '</p>');
                            }
                        }
                    });
                }
                
                // Load documents on page load
                loadDocuments();
                
                // Document upload form
                $('#upload-document-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    formData.append('action', 'gem_app_upload_document');
                    formData.append('nonce', '<?php echo wp_create_nonce('gem-app-nonce'); ?>');
                    
                    $('#upload-status').html('<p>Uploading document...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#upload-status').html('<p class="gem-app-success-message">Document uploaded successfully.</p>');
                                $('#upload-document-form')[0].reset();
                                loadDocuments();
                            } else {
                                $('#upload-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Upload learning plan document form
                $('#upload-learning-plan-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    formData.append('action', 'gem_app_upload_document');
                    formData.append('nonce', '<?php echo wp_create_nonce('gem-app-nonce'); ?>');
                    
                    $('#learning-plan-status').html('<p>Uploading document...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#learning-plan-status').html('<p class="gem-app-success-message">Learning plan document uploaded successfully.</p>');
                                $('#upload-learning-plan-form')[0].reset();
                            } else {
                                $('#learning-plan-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Upload midpoint document form
                $('#upload-midpoint-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    formData.append('action', 'gem_app_upload_document');
                    formData.append('nonce', '<?php echo wp_create_nonce('gem-app-nonce'); ?>');
                    
                    $('#midpoint-status').html('<p>Uploading document...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#midpoint-status').html('<p class="gem-app-success-message">Midpoint check-in document uploaded successfully.</p>');
                                $('#upload-midpoint-form')[0].reset();
                            } else {
                                $('#midpoint-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Upload final reflection document form
                $('#upload-final-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    formData.append('action', 'gem_app_upload_document');
                    formData.append('nonce', '<?php echo wp_create_nonce('gem-app-nonce'); ?>');
                    
                    $('#final-reflection-status').html('<p>Uploading document...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#final-reflection-status').html('<p class="gem-app-success-message">Final reflection document uploaded successfully.</p>');
                                $('#upload-final-form')[0].reset();
                            } else {
                                $('#final-reflection-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Learning plan form
                $('#learning-plan-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = $(this).serializeArray();
                    const data = {};
                    const goals = [];
                    
                    // Process form data
                    $.each(formData, function(i, field) {
                        if (field.name === 'goals[]') {
                            goals.push(field.value);
                        } else {
                            data[field.name] = field.value;
                        }
                    });
                    
                    data.goals = goals;
                    
                    $('#learning-plan-status').html('<p>Submitting learning plan...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_submit_learning_plan',
                            plan_data: data,
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#learning-plan-status').html('<p class="gem-app-success-message">Learning plan submitted successfully.</p>');
                                $('#learning-plan-form')[0].reset();
                            } else {
                                $('#learning-plan-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Add learning goal
                $('#add-goal').on('click', function() {
                    const newGoal = `
                        <div class="gem-app-goal-item">
                            <input type="text" name="goals[]" placeholder="Enter a learning goal" required>
                            <button type="button" class="button remove-goal">Remove</button>
                        </div>
                    `;
                    
                    $('#goals-container').append(newGoal);
                    
                    // Show all remove buttons if there are more than 3 goals
                    if ($('.gem-app-goal-item').length > 3) {
                        $('.remove-goal').show();
                    }
                });
                
                // Remove learning goal
                $(document).on('click', '.remove-goal', function() {
                    $(this).closest('.gem-app-goal-item').remove();
                    
                    // Hide remove button if there are 3 or fewer goals
                    if ($('.gem-app-goal-item').length <= 3) {
                        $('.remove-goal').hide();
                    }
                });
            });
            </script>
            <?php
            break;
        case 'faculty':
            // Faculty documents
            ?>
            <div class="gem-app-document-tabs">
                <button class="gem-app-document-tab active" data-tab="upload">Upload Documents</button>
                <button class="gem-app-document-tab" data-tab="learning-plan">Learning Plan</button>
                <button class="gem-app-document-tab" data-tab="midpoint">Midpoint Check-in</button>
                <button class="gem-app-document-tab" data-tab="final
                    $(this).closest('.gem-app-goal-item').remove();
                    
                    // Hide remove buttons if there are only 3 goals left
                    if ($('.gem-app-goal-item').length <= 3) {
                        $('.remove-goal').hide();
                    }
                });
                
                // Midpoint check-in form
                $('#midpoint-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = $(this).serialize();
                    
                    $('#midpoint-status').html('<p>Submitting midpoint check-in...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_submit_midpoint',
                            checkin_data: formData,
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#midpoint-status').html('<p class="gem-app-success-message">Midpoint check-in submitted successfully.</p>');
                                $('#midpoint-form')[0].reset();
                            } else {
                                $('#midpoint-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Final reflection form
                $('#final-reflection-form').on('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = $(this).serialize();
                    
                    // Check word count
                    const wordCount = $('#word-count').text();
                    if (parseInt(wordCount) < 200 || parseInt(wordCount) > 1000) {
                        $('#final-reflection-status').html('<p class="gem-app-error-message">Your reflection must be between 200 and 1000 words.</p>').show();
                        return;
                    }
                    
                    $('#final-reflection-status').html('<p>Submitting final reflection...</p>').show();
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_submit_final_reflection',
                            reflection_data: formData,
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#final-reflection-status').html('<p class="gem-app-success-message">Final reflection submitted successfully.</p>');
                                $('#final-reflection-form')[0].reset();
                            } else {
                                $('#final-reflection-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
            });
            </script>
            <?php
            break;
        case 'faculty':
            // Faculty documents
            ?>
            <div class="gem-app-document-tabs">
                <button class="gem-app-document-tab active" data-tab="upload">Upload Documents</button>
                <button class="gem-app-document-tab" data-tab="learning-plan">Learning Plan</button>
                <button class="gem-app-document-tab" data-tab="midpoint">Midpoint Check-in</button>
                <button class="gem-app-document-tab" data-tab="final">Final Reflection</button>
            </div>
            
            <div class="gem-app-document-content" id="upload-tab">
                <h3>Upload Documents</h3>
                <p>Upload your resume, cover letter, and transcript.</p>
                
                <form class="gem-app-document-form" id="upload-document-form" enctype="multipart/form-data">
                    <div class="gem-app-form-group">
                        <label
                                $('#word-count').text('0');
                            } else {
                                $('#final-reflection-status').html('<p class="gem-app-error-message">Error: ' + response.data + '</p>');
                            }
                        }
                    });
                });
                
                // Word counter for final reflection
                $('#reflection-text').on('input', function() {
                    const text = $(this).val();
                    const words = text.split(/\s+/).filter(word => word.length > 0);
                    $('#word-count').text(words.length);
                    
                    // Visual feedback for word count
                    const wordCount = words.length;
                    if (wordCount < 200) {
                        $('#word-count').css('color', 'red');
                    } else if (wordCount > 1000) {
                        $('#word-count').css('color', 'red');
                    } else {
                        $('#word-count').css('color', 'green');
                    }
                });
            });
            </script>
            <?php
            break;
        
        case 'faculty':
            // Faculty documents
            ?>
            <h3>Student Documents</h3>
            <p>View and approve student documents for students you supervise.</p>
            
            <div id="supervised-students">
                <p>Loading students...</p>
            </div>
            
            <script>
            jQuery(document).ready(function($) {
                // Load supervised students
                function loadSupervisedStudents() {
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_get_supervised_students',
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                if (response.data.students.length === 0) {
                                    $('#supervised-students').html('<p>You are not supervising any students yet.</p>');
                                    return;
                                }
                                
                                let html = '';
                                
                                response.data.students.forEach(function(student) {
                                    html += '<div class="gem-app-student-card">';
                                    html += '<h4>' + student.name + '</h4>';
                                    
                                    html += '<table class="gem-app-table">';
                                    html += '<thead><tr><th>Document</th><th>Status</th><th>Actions</th></tr></thead>';
                                    html += '<tbody>';
                                    
                                    // Learning Plan
                                    html += '<tr>';
                                    html += '<td>Learning Plan</td>';
                                    html += '<td>' + (student.documents.learning_plan ? 'Submitted' : 'Not Submitted') + '</td>';
                                    html += '<td>';
                                    if (student.documents.learning_plan) {
                                        html += '<a href="#" class="approve-learning-plan" data-student-id="' + student.id + '">Approve</a>';
                                    } else {
                                        html += '<a href="#" class="view-learning-plan" data-student-id="' + student.id + '">View</a>';
                                    }
                                    html += '</td>';
                                    html += '</tr>';
                                    
                                    // Midpoint Check-in
                                    html += '<tr>';
                                    html += '<td>Midpoint Check-in</td>';
                                    html += '<td>' + (student.documents.midpoint_checkin ? 'Submitted' : 'Not Submitted') + '</td>';
                                    html += '<td>';
                                    if (student.documents.midpoint_checkin) {
                                        html += '<a href="#" class="approve-midpoint-checkin" data-student-id="' + student.id + '">Approve</a>';
                                    } else {
                                        html += '<a href="#" class="view-midpoint-checkin" data-student-id="' + student.id + '">View</a>';
                                    }
                                    html += '</td>';
                                    html += '</tr>';
                                    
                                    // Final Reflection
                                    html += '<tr>';
                                    html += '<td>Final Reflection</td>';
                                    html += '<td>' + (student.documents.final_reflection ? 'Submitted' : 'Not Submitted') + '</td>';
                                    html += '<td>';
                                    if (student.documents.final_reflection) {
                                        html += '<a href="#" class="approve-final-reflection" data-student-id="' + student.id + '">Approve</a>';
                                    } else {
                                        html += '<a href="#" class="view-final-reflection" data-student-id="' + student.id + '">View</a>';
                                    }
                                    html += '</td>';
                                    html += '</tr>';
                                    
                                    html += '</tbody></table>';
                                    html += '</div>';
                                });
                                
                                $('#supervised-students').html(html);
                            } else {
                                $('#supervised-students').html('<p>Error loading students: ' + response.data + '</p>');
                            }
                        }
                    });
                }
                
                // Load supervised students on page load
                loadSupervisedStudents();
                
                // Handle document approval
                function handleDocumentApproval(event, documentType) {
                    event.preventDefault();
                    
                    const studentId = $(this).data('student-id');
                    const $status = $(this).closest('td').find('.approval-status');
                    
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'gem_app_approve_document',
                            student_id: studentId,
                            document_type: documentType,
                            nonce: '<?php echo wp_create_nonce('gem-app-nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                $status.html('<span class="gem-app-success-message">Approved</span>');
                                $(this).remove();
                            } else {
                                $status.html('<span class="gem-app-error-message">Error: ' + response.data + '</span>');
                            }
                        }
                    });
                }
                
                // Approve Learning Plan
                $(document).on('click', '.approve-learning-plan', function() {
                    handleDocumentApproval.call(this, event, 'learning_plan');
                });
                
                // Approve Midpoint Check-in
                $(document).on('click', '.approve-midpoint-checkin', function() {
                    handleDocumentApproval.call(this, event, 'midpoint_checkin');
                });
                
                // Approve Final Reflection
                $(document).on('click', '.approve-final-reflection', function() {
                    handleDocumentApproval.call(this, event, 'final_reflection');
                });
            });
            </script>
            <?php
            break;
    }
}
