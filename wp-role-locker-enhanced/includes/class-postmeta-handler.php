<?php
namespace WPRoleLocker;

if ( ! defined( 'ABSPATH' ) ) exit;

class PostMeta_Handler {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta']);
    }

    public function add_meta_box() {
        add_meta_box(
            'content_lock_meta',
            'Content Lock',
            [$this, 'render_meta_box'],
            ['post', 'page'],
            'side'
        );
    }

    public function render_meta_box($post) {
        $value = get_post_meta($post->ID, '_lock_role', true);
        wp_nonce_field('save_lock_meta', 'lock_meta_nonce');
        ?>
        <p>
            <label for="lock_role">Required Role:</label>
            <select name="lock_role" id="lock_role">
                <option value="">None</option>
                <?php foreach (wp_roles()->roles as $role => $details): ?>
                    <option value="<?= esc_attr($role); ?>" <?= selected($value, $role); ?>><?= esc_html($details['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function save_meta($post_id) {
        if (!isset($_POST['lock_meta_nonce']) || !wp_verify_nonce($_POST['lock_meta_nonce'], 'save_lock_meta')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $role = sanitize_text_field($_POST['lock_role'] ?? '');
        update_post_meta($post_id, '_lock_role', $role);
    }
}
