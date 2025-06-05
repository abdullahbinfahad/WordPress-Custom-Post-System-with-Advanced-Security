<?php
// Featured Posts Shortcode
add_shortcode('featured_posts', 'cps_featured_posts_shortcode');
function cps_featured_posts_shortcode($atts) {
    $atts = shortcode_atts([
        'count' => 3,
        'category' => ''
    ], $atts);

    $query_args = [
        'post_type' => 'custom_post',
        'posts_per_page' => $atts['count'],
        'meta_key' => '_cps_featured',
        'meta_value' => 1
    ];

    if (!empty($atts['category'])) {
        $query_args['tax_query'] = [
            [
                'taxonomy' => 'custom_category',
                'field' => 'slug',
                'terms' => $atts['category']
            ]
        ];
    }

    $posts = new WP_Query($query_args);

    if (!$posts->have_posts()) {
        return '<p>No featured posts found</p>';
    }

    ob_start();
    echo '<div class="cps-featured-posts">';
    while ($posts->have_posts()) {
        $posts->the_post();
        include plugin_dir_path(__FILE__) . '../templates/parts/featured-post.php';
    }
    echo '</div>';
    wp_reset_postdata();

    return ob_get_clean();
}

// Category List Shortcode
add_shortcode('custom_categories', 'cps_categories_shortcode');
function cps_categories_shortcode() {
    $terms = get_terms(['taxonomy' => 'custom_category']);
    
    if (empty($terms) || is_wp_error($terms)) {
        return '';
    }
    
    ob_start();
    echo '<ul class="cps-category-list">';
    foreach ($terms as $term) {
        echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';
    
    return ob_get_clean();
}