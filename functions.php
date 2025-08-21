<?php
/**
 * Theme Functions and Definitions
 *
 * This is the main configuration file for the WordPress theme.
 * It handles all core functionality and file inclusions.
 *
 * @package    HaroonYamin
 * @author     Haroon Yamin
 * @link       https://www.linkedin.com/in/haroon-webdev/
 * @version    1.0.0
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Define theme constants
 */
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());
define('THEME_VERSION', '1.0.0');

/**
 * Required files configuration
 */
$required_files = [
    'security'    => '/php/theme-settings/security.php',
    'support'     => '/php/theme-settings/support.php',
    'enqueue'     => '/php/theme-settings/enqueue.php',
    'acf'         => '/php/custom-fields/acf-config.php',
    'cpt'         => '/php/custom-post-type/cpt-register.php',
    'ajax-calls'  => '/php/woo-ajax-calls.php'
];

/**
 * Load required files with error handling
 *
 * @param array $files Array of files to include
 * @return void
 */
function load_theme_files($files) {
    foreach ($files as $name => $path) {
        $full_path = THEME_DIR . $path;
        
        if (file_exists($full_path)) {
            require_once $full_path;
        } else {
            // Log error if file is missing (only if WP_DEBUG is enabled)
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log(sprintf(
                    'Required theme file missing: %s (%s)',
                    $name,
                    $path
                ));
            }
        }
    }
}

/**
 * Initialize theme setup
 *
 * @return void
 */
function initialize_theme() {
    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }

    // Set theme text domain
    load_theme_textdomain('your-theme-textdomain', THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'initialize_theme');

// Load all required theme files
load_theme_files($required_files);

/**
 * Optional: Performance optimization
 * Disable unnecessary WordPress features
 */
function optimize_wordpress_performance() {
    // Remove Windows Live Writer manifest link
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove Really Simple Discovery link
    remove_action('wp_head', 'rsd_link');
    
    // Remove WordPress version number
    remove_action('wp_head', 'wp_generator');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'optimize_wordpress_performance');

/**
 * Optional: Memory usage optimization
 * Implement on larger themes if needed
 */
function monitor_theme_memory() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $memory_usage = memory_get_usage() / 1024 / 1024;
        error_log(sprintf(
            'Theme Memory Usage: %f MB',
            $memory_usage
        ));
    }
}
add_action('admin_footer', 'monitor_theme_memory');

add_filter('woocommerce_rest_product_schema', function($schema) {
    $schema['properties']['wood_origin'] = [
        'description' => 'Wood origin of the product',
        'type'        => 'string',
        'context'     => ['view', 'edit'],
    ];
    $schema['properties']['epoxy_color'] = [
        'description' => 'Epoxy color of the product',
        'type'        => 'string',
        'context'     => ['view', 'edit'],
    ];
    $schema['properties']['hardware_details'] = [
        'description' => 'Hardware details of the product',
        'type'        => 'string',
        'context'     => ['view', 'edit'],
    ];
    $schema['properties']['lead_time'] = [
        'description' => 'Lead time of the product',
        'type'        => 'string',
        'context'     => ['view', 'edit'],
    ];
    $schema['properties']['manufacturing_date'] = [
        'description' => 'Manufacturing date of the product',
        'type'        => 'string',
        'context'     => ['view', 'edit'],
    ];

    return $schema;
});

add_action('add_meta_boxes', function() {
    add_meta_box(
        'custom_product_options',
        __('Custom Product Fields', 'woocommerce'),
        'display_custom_product_meta',
        'product',
        'normal',
        'default'
    );
});

function display_custom_product_meta($post) {
    $wood_origin = get_post_meta($post->ID, 'wood_origin', true);
    $epoxy_color = get_post_meta($post->ID, 'epoxy_color', true);
    $hardware_details = get_post_meta($post->ID, 'hardware_details', true);
    $lead_time = get_post_meta($post->ID, 'lead_time', true);
    $manufacturing_date = get_post_meta($post->ID, 'manufacturing_date', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="wood_origin"><?php _e('Wood Origin', 'woocommerce'); ?></label></th>
            <td><input type="text" name="wood_origin" id="wood_origin" value="<?php echo esc_attr($wood_origin); ?>" class="widefat" /></td>
        </tr>
        <tr>
            <th><label for="epoxy_color"><?php _e('Epoxy Color', 'woocommerce'); ?></label></th>
            <td><input type="text" name="epoxy_color" id="epoxy_color" value="<?php echo esc_attr($epoxy_color); ?>" class="widefat" /></td>
        </tr>
        <tr>
            <th><label for="hardware_details"><?php _e('Hardware Details', 'woocommerce'); ?></label></th>
            <td><input type="text" name="hardware_details" id="hardware_details" value="<?php echo esc_attr($hardware_details); ?>" class="widefat" /></td>
        </tr>
        <tr>
            <th><label for="lead_time"><?php _e('Lead Time', 'woocommerce'); ?></label></th>
            <td><input type="text" name="lead_time" id="lead_time" value="<?php echo esc_attr($lead_time); ?>" class="widefat" /></td>
        </tr>
        <tr>
            <th><label for="manufacturing_date"><?php _e('Manufacturing Date', 'woocommerce'); ?></label></th>
            <td><input type="text" name="manufacturing_date" id="manufacturing_date" value="<?php echo esc_attr($manufacturing_date); ?>" class="widefat" /></td>
        </tr>
    </table>
    <?php
}

add_action('save_post_product', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['wood_origin'])) {
        update_post_meta($post_id, 'wood_origin', sanitize_text_field($_POST['wood_origin']));
    }
    if (isset($_POST['epoxy_color'])) {
        update_post_meta($post_id, 'epoxy_color', sanitize_text_field($_POST['epoxy_color']));
    }
    if (isset($_POST['hardware_details'])) {
        update_post_meta($post_id, 'hardware_details', sanitize_text_field($_POST['hardware_details']));
    }
    if (isset($_POST['lead_time'])) {
        update_post_meta($post_id, 'lead_time', sanitize_text_field($_POST['lead_time']));
    }
    if (isset($_POST['manufacturing_date'])) {
        update_post_meta($post_id, 'manufacturing_date', sanitize_text_field($_POST['manufacturing_date']));
    }
}, 10, 1);

add_filter('woocommerce_rest_prepare_product', function($response, $product, $request) {
    $response->data['wood_origin'] = get_post_meta($product->get_id(), 'wood_origin', true);
    $response->data['epoxy_color'] = get_post_meta($product->get_id(), 'epoxy_color', true);
    $response->data['hardware_details'] = get_post_meta($product->get_id(), 'hardware_details', true);
    $response->data['lead_time'] = get_post_meta($product->get_id(), 'lead_time', true);
    $response->data['manufacturing_date'] = get_post_meta($product->get_id(), 'manufacturing_date', true);
    
    return $response;
}, 10, 3);

function fetch_product_data() {
    // Check if product ID is passed
    if (!isset($_POST['product_id'])) {
        wp_send_json_error(['message' => 'Product ID is required.']);
        return;
    }

    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error(['message' => 'Product not found.']);
        return;
    }

    $product_data = [
        'name'        => $product->get_name(),
        'slug'        => $product->get_slug(),
        'description' => $product->get_description(),
        'price'       => $product->get_price(),
        'images'      => array_map(function ($image_id) {
            return ['src' => wp_get_attachment_url($image_id)];
        }, $product->get_gallery_image_ids())
    ];

    wp_send_json_success($product_data);
}
add_action('wp_ajax_fetch_product_data', 'fetch_product_data');
add_action('wp_ajax_nopriv_fetch_product_data', 'fetch_product_data');

function enqueue_quick_view_scripts() {
    wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/main.js'), true);

    // Pass AJAX URL to JavaScript
    wp_localize_script('popup-script', 'wpAjax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_quick_view_scripts');
