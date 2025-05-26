<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class Shortcode_Handler {
    public function __construct() {
        add_shortcode('lock', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts, $content = null) {
        $atts = shortcode_atts(['role' => 'subscriber'], $atts);
        if (current_user_can($atts['role'])) {
            return do_shortcode($content);
        } else {
            AccessLogger::get_instance()->log_access(get_the_ID(), get_current_user_id());
            return '<p>' . esc_html(get_option('content_locker_default_message', 'This content is restricted.')) . '</p>';
        }
    }
}
