<?php
// Register Custom Post Type
add_action('init', 'cps_register_post_type');
function cps_register_post_type() {
    $labels = array(
        'name' => _x('Custom Posts', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Custom Post', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Custom Posts', 'textdomain'),
        'all_items' => __('All Posts', 'textdomain'),
        'add_new_item' => __('Add New Post', 'textdomain')
    );

    $args = array(
        'label' => __('custom_post', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-post',
        'rewrite' => array('slug' => 'custom-posts'),
        'has_archive' => true
    );
    
    register_post_type('custom_post', $args);
}