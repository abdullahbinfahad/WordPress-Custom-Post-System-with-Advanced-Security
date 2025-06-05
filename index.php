<?php
/**
 * Plugin Security Index File
 * 
 * This file prevents unauthorized access to plugin directories.
 * It includes advanced security measures and logging capabilities.
 * 
 * @package Custom_Post_System
 * @version 1.0
 * @author Your Name
 * @copyright Copyright (c) 2023, Your Company
 * @license GPL-3.0+
 */

// Prevent direct access
defined('ABSPATH') || die('403 Forbidden - Direct access not allowed.');

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Log access attempts
if (!defined('DOING_CRON') && !defined('XMLRPC_REQUEST') && !defined('WP_CLI')) {
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $remote_addr = $_SERVER['REMOTE_ADDR'] ?? '';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // Ignore legitimate WordPress requests
    if (!str_contains($request_uri, 'wp-admin') && 
        !str_contains($request_uri, 'wp-login') &&
        !str_contains($request_uri, 'wp-cron') &&
        !str_contains($request_uri, 'admin-ajax')) {
        
        // Log suspicious access
        $log_entry = sprintf(
            "[%s] Blocked directory access - IP: %s | URI: %s | Agent: %s\n",
            date('Y-m-d H:i:s'),
            $remote_addr,
            $request_uri,
            $user_agent
        );
        
        // Write to security log
        error_log($log_entry, 3, dirname(__FILE__) . '/security.log');
    }
}

// Return 403 Forbidden response
http_response_code(403);
header('Content-Type: text/plain');
exit('403 Forbidden - Access to this directory is prohibited.');