<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class ContentLocker_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page() {
        add_options_page(
            'Content Locker Settings',
            'Content Locker',
            'manage_options',
            'content-locker-settings',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {
        register_setting('content_locker_group', 'content_locker_default_message');

        add_settings_section('general', 'General Settings', null, 'content-locker-settings');

        add_settings_field(
            'default_message',
            'Default Lock Message',
            function() {
                $value = get_option('content_locker_default_message', 'This content is restricted.');
                echo '<input type="text" name="content_locker_default_message" value="' . esc_attr($value) . '" class="regular-text" />';
            },
            'content-locker-settings',
            'general'
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Content Locker Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('content_locker_group');
                do_settings_sections('content-locker-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
