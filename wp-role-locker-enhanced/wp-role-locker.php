<?php
/**
 * Plugin Name: WP Role-Based Content Locker
 * Description: Lock post content based on user roles with OOP architecture.
 * Version: 1.0.0
 * Author: Dhruvi Shah
 * Text Domain: wp-role-locker
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-loader.php';

use WPRoleLocker\Plugin_Loader;

Plugin_Loader::init();
