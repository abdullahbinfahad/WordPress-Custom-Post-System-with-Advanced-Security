<?php
// Add Meta Boxes
add_action('add_meta_boxes', 'cps_add_meta_boxes');
function cps_add_meta_boxes() {
    add_meta_box(
        'cps_post_details',
        'Post Details',
        'cps_render_meta_box',
        'custom_post',
        'normal',
        'high'
    );
}

function cps_render_meta_box($post) {
    wp_nonce_field('cps_save_meta', 'cps_meta_nonce');
    
    $subtitle = get_post_meta($post->ID, '_cps_subtitle', true);
    $featured = get_post_meta($post->ID, '_cps_featured', true);
    $priority = get_post_meta($post->ID, '_cps_priority', true) ?: 5;
    
    echo '<div class="cps-meta-field">';
    echo '<label for="cps_subtitle">' . __('Subtitle', 'textdomain') . '</label>';
    echo '<input type="text" id="cps_subtitle" name="cps_subtitle" value="' . esc_attr($subtitle) . '" />';
    echo '</div>';
    
    echo '<div class="cps-meta-field">';
    echo '<label for="cps_featured">';
    echo '<input type="checkbox" id="cps_featured" name="cps_featured" value="1" ' . checked($featured, 1, false) . ' />';
    echo __(' Featured Post', 'textdomain') . '</label>';
    echo '</div>';
    
    echo '<div class="cps-meta-field">';
    echo '<label for="cps_priority">' . __('Priority (1-10)', 'textdomain') . '</label>';
    echo '<input type="number" id="cps_priority" name="cps_priority" min="1" max="10" value="' . esc_attr($priority) . '" />';
    echo '</div>';
}

// Save Meta Data
add_action('save_post', 'cps_save_meta_data');
function cps_save_meta_data($post_id) {
    if (!isset($_POST['cps_meta_nonce']) || 
        !wp_verify_nonce($_POST['cps_meta_nonce'], 'cps_save_meta') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'cps_subtitle' => 'sanitize_text_field',
        'cps_featured' => 'absint',
        'cps_priority' => 'absint'
    ];

    foreach ($fields as $field => $sanitizer) {
        if (isset($_POST[$field])) {
            $value = call_user_func($sanitizer, $_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}