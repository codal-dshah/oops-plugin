<?php
namespace WPRoleLocker;

interface RoleInterface {
    public function user_has_access(array $roles): bool;
}