<?php
/**
 * Plugin Name: Custom Post System
 * Description: Advanced custom post type with taxonomies, meta fields, and templates
 * Version: 2.0
 * Author: Your Name
 */

defined('ABSPATH') or die('No direct access!');

// Load modules
require_once __DIR__ . '/includes/post-type.php';
require_once __DIR__ . '/includes/taxonomy.php';
require_once __DIR__ . '/includes/meta-boxes.php';
require_once __DIR__ . '/includes/shortcodes.php';
require_once __DIR__ . '/includes/admin-columns.php';
require_once __DIR__ . '/includes/template-functions.php';

// Load assets
add_action('wp_enqueue_scripts', 'cps_load_assets');
function cps_load_assets() {
    wp_enqueue_style(
        'cps-frontend',
        plugin_dir_url(__FILE__) . 'assets/css/frontend.css'
    );
    wp_enqueue_script(
        'cps-frontend',
        plugin_dir_url(__FILE__) . 'assets/js/frontend.js',
        array('jquery'),
        '1.0',
        true
    );
}

add_action('admin_enqueue_scripts', 'cps_load_admin_assets');
function cps_load_admin_assets() {
    wp_enqueue_style(
        'cps-admin',
        plugin_dir_url(__FILE__) . 'assets/css/admin.css'
    );
    wp_enqueue_script(
        'cps-admin',
        plugin_dir_url(__FILE__) . 'assets/js/admin.js',
        array('jquery'),
        '1.0',
        true
    );
}