<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

if (!class_exists('GEM_App_Settings_Page')):

class GEM_App_Settings_Page {
    private $settings;

    public function __construct() {
        // Remove the add_admin_menu action
        add_action('admin_init', array($this, 'register_settings'));
        
        // Get current settings
        $this->settings = get_option('gem_app_settings', array());
    }

    public function register_settings() {
        register_setting('gem_app_settings', 'gem_app_settings');

        add_settings_section(
            'gem_app_settings_section',
            'API Configuration',
            array($this, 'render_section_description'),
            'gem-app-settings'
        );

        add_settings_field(
            'gem_app_api_key',
            'API Key',
            array($this, 'render_api_key_field'),
            'gem-app-settings',
            'gem_app_settings_section'
        );

        add_settings_field(
            'gem_app_api_secret',
            'API Secret',
            array($this, 'render_api_secret_field'),
            'gem-app-settings',
            'gem_app_settings_section'
        );
    }

    public function render_section_description() {
        echo '<p>Enter your GEM App API credentials below. You can find these in your GEM App dashboard.</p>';
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('gem_app_settings');
                do_settings_sections('gem-app-settings');
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }

    public function render_api_key_field() {
        $value = isset($this->settings['api_key']) ? $this->settings['api_key'] : '';
        ?>
        <input type="text" 
               name="gem_app_settings[api_key]" 
               value="<?php echo esc_attr($value); ?>" 
               class="regular-text">
        <?php
    }

    public function render_api_secret_field() {
        $value = isset($this->settings['api_secret']) ? $this->settings['api_secret'] : '';
        ?>
        <input type="password" 
               name="gem_app_settings[api_secret]" 
               value="<?php echo esc_attr($value); ?>" 
               class="regular-text">
        <?php
    }
}

endif;
