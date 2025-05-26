<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

trait LoggerTrait {
    public function log($message) {
        if (defined('WP_DEBUG') && WP_DEBUG === true) {
            error_log('[ContentLocker] ' . $message);
        }
    }
}
