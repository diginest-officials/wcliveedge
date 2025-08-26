<?php
/**
 * Enhanced WordPress Security Implementation
 * 
 * Implements comprehensive security measures for WordPress while maintaining
 * compatibility with core features and common plugins.
 */

// Security Headers Configuration
function configure_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    }
}
add_action('send_headers', 'configure_security_headers');

// Core Security Constants
function define_security_constants() {
    if (!defined('DISALLOW_FILE_EDIT')) define('DISALLOW_FILE_EDIT', true);
    if (!defined('DISALLOW_UNFILTERED_HTML')) define('DISALLOW_UNFILTERED_HTML', true);
    if (!defined('FORCE_SSL_ADMIN')) define('FORCE_SSL_ADMIN', true);
}
add_action('init', 'define_security_constants');

// Advanced REST API Protection
function secure_rest_api($result) {
    if (!empty($result)) {
        return $result;
    }

    if (!is_user_logged_in()) {
        $current_route = $GLOBALS['wp']->query_vars['rest_route'];
        
        // Allow specific endpoints while protecting sensitive ones
        $allowed_routes = array(
            '/wp/v2/posts',
            '/wp/v2/pages',
            '/wp/v2/categories',
            '/contact-form-7/v1/contact-forms'
        );

        foreach ($allowed_routes as $route) {
            if (strpos($current_route, $route) === 0) {
                return true;
            }
        }

        return new WP_Error(
            'rest_not_logged_in',
            'You must be logged in to access this endpoint.',
            array('status' => rest_authorization_required_code())
        );
    }
    return true;
}
add_filter('rest_authentication_errors', 'secure_rest_api');

// Enhanced Asset Protection
function secure_assets() {
    // Remove version info from various sources
    // add_filter('script_loader_src', 'remove_asset_versions', 15, 1);
    // add_filter('style_loader_src', 'remove_asset_versions', 15, 1);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Disable XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Remove REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('init', 'secure_assets');

function remove_asset_versions($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

// Prevent User Enumeration
function prevent_user_enumeration() {
    if (is_admin()) return;
    
    if (isset($_REQUEST['author']) || 
        (isset($_GET['rest_route']) && strpos($_GET['rest_route'], 'users') !== false)) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('init', 'prevent_user_enumeration');

// File System Security
function secure_file_system() {
    // Prevent direct file access
    if (defined('ABSPATH')) {
        if (isset($_SERVER['REQUEST_URI']) && 
            strpos($_SERVER['REQUEST_URI'], '/wp-content/uploads/') !== false) {
            
            $file = basename($_SERVER['REQUEST_URI']);
            $blocked_extensions = array('php', 'phtml', 'php3', 'php4', 'php5', 'phps');
            
            $file_parts = explode('.', $file);
            $extension = strtolower(end($file_parts));
            
            if (in_array($extension, $blocked_extensions)) {
                wp_die('Direct access to PHP files is not allowed.', 'Security Error', 
                       array('response' => 403));
            }
        }
    }
}
add_action('init', 'secure_file_system');

// CORS Access Control
add_action('init', 'add_cors_headers');
function add_cors_headers() {
    header("Access-Control-Allow-Origin: https://wcliveedge.wpenginepowered.com");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    
    // Handle preflight requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        status_header(200);
        exit();
    }
}
