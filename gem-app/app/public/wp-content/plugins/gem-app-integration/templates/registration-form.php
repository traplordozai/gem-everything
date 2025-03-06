<?php
defined('ABSPATH') || exit;

$type = get_query_var('gem_registration_type');
$type_label = ucfirst($type);
?>

<div class="gem-app-registration-form">
    <h2>Register as <?php echo esc_html($type_label); ?></h2>
    
    <form id="gem-registration-form" method="post">
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" required>
            <small>Password must be at least 8 characters long</small>
        </div>

        <?php if ($type === 'student'): ?>
            <div class="form-group">
                <label for="university">University *</label>
                <input type="text" id="university" name="meta[university]" required>
            </div>
            
            <div class="form-group">
                <label for="major">Major *</label>
                <input type="text" id="major" name="meta[major]" required>
            </div>
            
            <div class="form-group">
                <label for="graduation_year">Expected Graduation Year *</label>
                <select id="graduation_year" name="meta[graduation_year]" required>
                    <?php
                    $current_year = date('Y');
                    for ($i = 0; $i <= 6; $i++) {
                        $year = $current_year + $i;
                        echo '<option value="' . esc_attr($year) . '">' . esc_html($year) . '</option>';
                    }
                    ?>
                </select>
            </div>
        <?php elseif ($type === 'faculty'): ?>
            <div class="form-group">
                <label for="department">Department *</label>
                <input type="text" id="department" name="meta[department]" required>
            </div>
            
            <div class="form-group">
                <label for="institution">Institution *</label>
                <input type="text" id="institution" name="meta[institution]" required>
            </div>
        <?php elseif ($type === 'organization'): ?>
            <div class="form-group">
                <label for="org_name">Organization Name *</label>
                <input type="text" id="org_name" name="meta[org_name]" required>
            </div>
            
            <div class="form-group">
                <label for="org_type">Organization Type *</label>
                <select id="org_type" name="meta[org_type]" required>
                    <option value="nonprofit">Non-Profit</option>
                    <option value="business">Business</option>
                    <option value="government">Government</option>
                    <option value="other">Other</option>
                </select>
            </div>
        <?php endif; ?>

        <input type="hidden" name="type" value="<?php echo esc_attr($type); ?>">
        <input type="hidden" name="action" value="gem_app_register">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('gem-app-registration-nonce'); ?>">

        <div class="form-group">
            <button type="submit" class="gem-app-submit">Register</button>
        </div>

        <div class="form-messages"></div>
    </form>
</div>