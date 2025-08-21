<?php
/**
 * Asset Management Functions
 * 
 * Handles the efficient loading of CSS and JavaScript files
 * with proper versioning and dependency management.
 *
 * @package HaroonYamin
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define asset paths and configurations
 */
define('THEME_ASSETS', [
    'css' => [
        'THICCCBOI' => [
            'path' => '/assets/fonts/THICCCBOI/stylesheet.css',
            'deps' => []
        ],
        'swiper' => [
            'path' => '/lib/swiper/swiper-bundle.min.css',
            'deps' => []
        ],
        'bootstrap' => [
            'path' => '/lib/bootstrap/css/bootstrap.css',
            'deps' => []
        ],
        'bootstrap-addon' => [
            'path' => '/assets/css/bootstrap-addon.css',
            'deps' => ['bootstrap']
        ],
        'main' => [
            'path' => '/assets/css/main.css',
            'deps' => ['bootstrap', 'swiper']
        ]
    ],
    'js' => [
        'bootstrap' => [
            'path' => '/lib/bootstrap/js/bootstrap.js',
            'deps' => ['jquery']
        ],
        'swiper' => [
            'path' => '/lib/swiper/swiper-bundle.min.js',
            'deps' => ['jquery']
        ],
        'main' => [
            'path' => '/assets/js/main.js',
            'deps' => ['jquery', 'bootstrap', 'swiper']
        ],
        'checkout-ajax' => [
            'path' => '/assets/js/checkout-ajax.js',
            'deps' => ['jquery']
        ]
    ]
]);

/**
 * Enqueue stylesheet with proper version control
 *
 * @param string $handle Asset identifier
 * @param string $path Relative path to asset
 * @param array $deps Dependencies array
 * @return void
 */
function enqueue_theme_style($handle, $path, $deps = []) {
    $full_path = get_template_directory() . $path;
    
    if (!file_exists($full_path)) {
        return;
    }

    wp_enqueue_style(
        $handle,
        get_template_directory_uri() . $path,
        $deps,
        filemtime($full_path)
    );
}

/**
 * Enqueue script with proper version control
 *
 * @param string $handle Asset identifier
 * @param string $path Relative path to asset
 * @param array $deps Dependencies array
 * @return void
 */
function enqueue_theme_script($handle, $path, $deps = []) {
    $full_path = get_template_directory() . $path;
    
    if (!file_exists($full_path)) {
        return;
    }

    wp_enqueue_script(
        $handle,
        get_template_directory_uri() . $path,
        $deps,
        filemtime($full_path),
        true
    );
}

/**
 * Main enqueue function for all theme assets
 *
 * @return void
 */
function enqueue_theme_assets() {
    // Enqueue styles
    foreach (THEME_ASSETS['css'] as $handle => $asset) {
        enqueue_theme_style($handle, $asset['path'], $asset['deps']);
    }

    // Enqueue scripts
    wp_enqueue_script('jquery');  // WordPress core jQuery
    foreach (THEME_ASSETS['js'] as $handle => $asset) {
        enqueue_theme_script($handle, $asset['path'], $asset['deps']);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

// Coupon Form
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'wc_cart_fragments_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'wc_ajax_url' => WC_AJAX::get_endpoint('%%endpoint%%'),
        'cart_hash_key' => 'wc_cart_hash_' . md5(get_current_blog_id() . '_' . get_site_url(get_current_blog_id(), '/') . get_template()),
        'fragment_name' => apply_filters('woocommerce_cart_fragment_name', 'wc_fragments_'),
        'request_timeout' => 5000,
        'apply_coupon_nonce' => wp_create_nonce('apply-coupon')
    ));
});

// AJAX Cart
function custom_enqueue_scripts() {
    if (is_cart()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('cart-ajax', get_template_directory_uri() . '/assets/js/cart-ajax.js', array('jquery'), null, true);
        wp_localize_script('cart-ajax', 'ajax_cart_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

// Add to Cart AJAX
function enqueue_ajax_add_to_cart_script() {
    wp_enqueue_script('ajax-add-to-cart', get_template_directory_uri() . '/assets/js/ajax-add-to-cart.js', array('jquery'), null, true);
    wp_localize_script('ajax-add-to-cart', 'ajax_cart', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('add_to_cart_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_add_to_cart_script');
