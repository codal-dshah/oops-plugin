<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class Plugin_Loader {
    public static function init() {
        require_once __DIR__ . '/trait-logger.php';
        require_once __DIR__ . '/class-access-logger.php';
        require_once __DIR__ . '/class-content-locker.php';
        require_once __DIR__ . '/class-role-access-manager.php';
        require_once __DIR__ . '/class-settings.php';
        require_once __DIR__ . '/class-shortcode-handler.php';
        require_once __DIR__ . '/class-postmeta-handler.php';

        new ContentLocker();
        new RoleAccessManager();
        new ContentLocker_Settings();
        new Shortcode_Handler();
        new PostMeta_Handler();
        AccessLogger::get_instance();
    }
}
