<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class ContentLocker {
    public function __construct() {
        add_filter('the_content', [$this, 'maybe_lock_content']);
    }

    public function maybe_lock_content($content) {
        global $post;
        if (!is_singular()) return $content;

        $required_role = get_post_meta($post->ID, '_lock_role', true);
        if ($required_role && !current_user_can($required_role)) {
            AccessLogger::get_instance()->log_access($post->ID, get_current_user_id());
            return '<p>' . esc_html(get_option('content_locker_default_message', 'This content is restricted.')) . '</p>';
        }

        return $content;
    }
}
