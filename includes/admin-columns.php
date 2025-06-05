<?php
// Admin Columns
add_filter('manage_custom_post_posts_columns', 'cps_custom_columns');
function cps_custom_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, [
        'subtitle' => __('Subtitle'),
        'featured' => __('Featured'),
        'priority' => __('Priority'),
        'date' => __('Date')
    ]);
}

add_action('manage_custom_post_posts_custom_column', 'cps_custom_column_data', 10, 2);
function cps_custom_column_data($column, $post_id) {
    switch ($column) {
        case 'subtitle':
            echo get_post_meta($post_id, '_cps_subtitle', true);
            break;
        case 'featured':
            echo get_post_meta($post_id, '_cps_featured', true) ? '★' : '';
            break;
        case 'priority':
            echo get_post_meta($post_id, '_cps_priority', true);
            break;
    }
}

// Sortable Columns
add_filter('manage_edit-custom_post_sortable_columns', 'cps_sortable_columns');
function cps_sortable_columns($columns) {
    $columns['priority'] = 'priority';
    return $columns;
}

// Category Filter
add_action('restrict_manage_posts', 'cps_category_filter');
function cps_category_filter() {
    global $typenow;
    if ($typenow === 'custom_post') {
        wp_dropdown_categories([
            'show_option_all' => 'All Categories',
            'taxonomy' => 'custom_category',
            'name' => 'custom_category',
            'value_field' => 'slug'
        ]);
    }
}