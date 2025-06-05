<?php
// Adjust main query for archive pages
add_action('pre_get_posts', 'cps_pre_get_posts');
function cps_pre_get_posts($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // Order by priority on archive pages
    if ($query->is_post_type_archive('custom_post')) {
        $query->set('meta_key', '_cps_priority');
        $query->set('orderby', array(
            'meta_value_num' => 'DESC',
            'date' => 'DESC'
        ));
    }
    
    // Featured posts first
    if ($query->is_post_type_archive('custom_post') || $query->is_tax('custom_category')) {
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key' => '_cps_featured',
                'compare' => 'EXISTS'
            ),
            array(
                'key' => '_cps_featured',
                'compare' => 'NOT EXISTS'
            )
        ));
        
        $query->set('orderby', array(
            'meta_value_num' => 'DESC',
            'date' => 'DESC'
        ));
    }
}

// Add featured posts to the top of archive pages
add_filter('the_posts', 'cps_sort_featured_posts', 10, 2);
function cps_sort_featured_posts($posts, $query) {
    if ($query->is_main_query() && 
        ($query->is_post_type_archive('custom_post') || 
         $query->is_tax('custom_category'))) {
        
        $featured = array();
        $non_featured = array();

        foreach ($posts as $post) {
            if (get_post_meta($post->ID, '_cps_featured', true)) {
                $featured[] = $post;
            } else {
                $non_featured[] = $post;
            }
        }

        return array_merge($featured, $non_featured);
    }

    return $posts;
}