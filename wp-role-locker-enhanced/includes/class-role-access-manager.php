<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class RoleAccessManager {
    public function user_has_access(array $roles): bool {
        foreach ($roles as $role) {
            if (current_user_can($role)) return true;
        }
        return false;
    }
}
