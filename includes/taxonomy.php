<?php
// Register Custom Taxonomy
add_action('init', 'cps_register_taxonomy');
function cps_register_taxonomy() {
    $labels = array(
        'name' => _x('Categories', 'Taxonomy General Name', 'textdomain'),
        'singular_name' => _x('Category', 'Taxonomy Singular Name', 'textdomain')
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'custom-category')
    );
    
    register_taxonomy('custom_category', 'custom_post', $args);
}