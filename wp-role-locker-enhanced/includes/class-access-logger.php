<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class AccessLogger {
    use LoggerTrait;

    private static $instance;

    private function __construct() {}

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function log_access($post_id, $user_id) {
        $user = get_userdata($user_id);
        $message = sprintf("User %s (ID %d) accessed restricted post ID %d", $user->user_login ?? 'Unknown', $user_id, $post_id);
        $this->log($message);
    }
}
