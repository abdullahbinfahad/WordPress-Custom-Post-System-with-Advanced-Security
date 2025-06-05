<?php
// Template Loader
add_filter('template_include', 'cps_template_loader');
function cps_template_loader($template) {
    if (is_singular('custom_post')) {
        return locate_template(['single-custom_post.php']) ?: 
            plugin_dir_path(__FILE__) . '../templates/single-custom_post.php';
    }
    
    if (is_post_type_archive('custom_post')) {
        return locate_template(['archive-custom_post.php']) ?: 
            plugin_dir_path(__FILE__) . '../templates/archive-custom_post.php';
    }
    
    if (is_tax('custom_category')) {
        return locate_template(['taxonomy-custom_category.php']) ?: 
            plugin_dir_path(__FILE__) . '../templates/taxonomy-custom_category.php';
    }
    
    return $template;
}

// Featured Post Template Part
function cps_featured_post_template($post = null) {
    if (!$post) {
        global $post;
    }
    
    include plugin_dir_path(__FILE__) . '../templates/parts/featured-post.php';
}