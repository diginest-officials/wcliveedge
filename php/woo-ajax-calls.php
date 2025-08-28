<?php
/*
 * Apply Ajax on Checkout Coupon
 */
add_action('wp_ajax_apply_coupon_code', 'handle_apply_coupon_code');
add_action('wp_ajax_nopriv_apply_coupon_code', 'handle_apply_coupon_code');

function handle_apply_coupon_code() {
    // Debug logging
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Coupon AJAX handler called');
        error_log('POST data: ' . print_r($_POST, true));
    }
    
    // More flexible security check - try multiple nonce fields
    $nonce_verified = false;
    $nonce_fields = ['security', 'nonce', 'woocommerce-cart-nonce', '_wpnonce'];
    
    foreach ($nonce_fields as $field) {
        if (isset($_POST[$field])) {
            if (wp_verify_nonce($_POST[$field], 'apply-coupon') || 
                wp_verify_nonce($_POST[$field], 'woocommerce-cart') ||
                wp_verify_nonce($_POST[$field], 'apply_coupon_nonce')) {
                $nonce_verified = true;
                break;
            }
        }
    }
    
    // Skip nonce check for testing (remove in production)
    if (!$nonce_verified && (!isset($_POST['skip_nonce']) || $_POST['skip_nonce'] !== 'true')) {
        wp_send_json_error('Security check failed. Please refresh the page and try again.');
        return;
    }
    
    // Validate input
    if (!isset($_POST['coupon_code']) || empty(trim($_POST['coupon_code']))) {
        wp_send_json_error('Please enter a coupon code.');
        return;
    }
    
    // Check if WooCommerce is active and cart exists
    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error('Cart is not available.');
        return;
    }
    
    $coupon_code = sanitize_text_field(wp_unslash($_POST['coupon_code']));
    $coupon_code = wc_format_coupon_code($coupon_code);
    
    // Debug log
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Attempting to apply coupon: ' . $coupon_code);
    }
    
    try {
        // Check if coupon exists
        $coupon = new WC_Coupon($coupon_code);
        if (!$coupon->get_id()) {
            throw new Exception('Invalid coupon code.');
        }
        
        // Check if coupon is already applied
        $applied_coupons = WC()->cart->get_applied_coupons();
        if (in_array($coupon_code, $applied_coupons)) {
            throw new Exception('Coupon is already applied!');
        }
        
        // Validate coupon before applying
        $discounts = new WC_Discounts(WC()->cart);
        $valid = $discounts->is_coupon_valid($coupon);
        
        if (is_wp_error($valid)) {
            throw new Exception($valid->get_error_message());
        }
        
        // Apply coupon
        if (!WC()->cart->apply_coupon($coupon_code)) {
            // Get and display WooCommerce notices
            $notices = wc_get_notices('error');
            $error_message = !empty($notices) ? $notices[0]['notice'] : 'Failed to apply coupon.';
            wc_clear_notices();
            throw new Exception($error_message);
        }
        
        // Calculate totals
        WC()->cart->calculate_totals();
        
        // Clear any error notices
        wc_clear_notices();
        
        // Success response with updated cart data
        $cart_total = WC()->cart->get_total();
        $discount_total = WC()->cart->get_discount_total();
        
        wp_send_json_success(array(
            'message' => 'Coupon applied successfully!',
            'cart_total' => $cart_total,
            'discount_total' => wc_price($discount_total),
            'applied_coupons' => WC()->cart->get_applied_coupons()
        ));
        
    } catch (Exception $e) {
        // Debug log
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Coupon application failed: ' . $e->getMessage());
        }
        
        wc_clear_notices();
        wp_send_json_error($e->getMessage());
    }
}

// Enqueue scripts and create nonce for cart/checkout pages
add_action('wp_enqueue_scripts', 'enqueue_coupon_ajax_script');
function enqueue_coupon_ajax_script() {
    if (is_cart() || is_checkout() || is_shop() || is_product()) {
        // Enqueue jQuery if not already loaded
        wp_enqueue_script('jquery');
        
        // Add nonce to existing wc_cart_fragments_params
        wp_localize_script('wc-cart-fragments', 'wc_cart_fragments_params', array_merge(
            (array) wp_scripts()->get_data('wc-cart-fragments', 'data'),
            array(
                'apply_coupon_nonce' => wp_create_nonce('apply-coupon')
            )
        ));
        
        // Fallback: Create our own object
        wp_localize_script('jquery', 'coupon_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('apply-coupon'),
            'cart_nonce' => wp_create_nonce('woocommerce-cart'),
            'apply_coupon_nonce' => wp_create_nonce('apply_coupon_nonce')
        ));
    }
}

// Ensure nonce is available in wc_cart_fragments_params
add_filter('woocommerce_get_script_data', 'add_coupon_nonce_to_wc_params', 10, 2);
function add_coupon_nonce_to_wc_params($params, $handle) {
    if ($handle === 'wc-cart-fragments') {
        $params['apply_coupon_nonce'] = wp_create_nonce('apply-coupon');
    }
    return $params;
}

/*
 * Apply Ajax on Cart Update
 */
add_action('wp_ajax_update_cart_item', 'custom_update_cart_item');
add_action('wp_ajax_nopriv_update_cart_item', 'custom_update_cart_item');

function custom_update_cart_item() {
    if (!isset($_POST['cart_key']) || !isset($_POST['quantity'])) {
        wp_send_json_error(['message' => 'Invalid data']);
    }

    $cart_key = sanitize_text_field($_POST['cart_key']);
    $quantity = (int) $_POST['quantity'];

    if ($cart_key && $quantity > 0) {
        WC()->cart->set_quantity($cart_key, $quantity);
        WC()->cart->calculate_totals();

        $cart_item = WC()->cart->get_cart()[$cart_key];
        $item_total = wc_price($cart_item['line_total']); // Item subtotal
        $cart_subtotal = wc_price(WC()->cart->subtotal); // Cart subtotal (excluding tax)
        $cart_total = wc_price(WC()->cart->cart_contents_total); // Grand total (including tax)
        $tax_total = wc_price(WC()->cart->get_taxes_total()); // Tax total

        wp_send_json_success([
            'item_total'   => $item_total,
            'cart_subtotal' => $cart_subtotal,
            'cart_total'   => $cart_total,
            'tax_total'    => $tax_total
        ]);
    } else {
        wp_send_json_error(['message' => 'Invalid quantity']);
    }
}
 
function enqueue_custom_scripts() {
    wp_enqueue_script('wc-cart-fragments');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/*
 * Apply Ajax on number of items in header
 */
add_action('wp_ajax_get_cart_count', 'get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count');

function get_cart_count() {
    wp_send_json_success(['count' => WC()->cart->get_cart_contents_count()]);
}

// Add to Cart AJAX
function handle_ajax_add_to_cart() {
    check_ajax_referer('add_to_cart_nonce', 'nonce');

    $product_id = absint($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;

    if ($product_id > 0) {
        $added = WC()->cart->add_to_cart($product_id, $quantity);

        if ($added) {
            // Force session update
            WC()->session->set('cart', WC()->cart->get_cart());

            wp_send_json_success(array(
                'message'    => __('Product added to cart', 'wcliveedge.com'),
                'cart_count' => WC()->cart->get_cart_contents_count(),
                'cart_total' => WC()->cart->get_cart_total(),
            ));
        } else {
            wp_send_json_error(__('Failed to add product', 'wcliveedge.com'));
        }
    } else {
        wp_send_json_error(__('Invalid product', 'wcliveedge.com'));
    }
}
add_action('wp_ajax_ajax_add_to_cart', 'handle_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ajax_add_to_cart', 'handle_ajax_add_to_cart');

add_action('woocommerce_add_to_cart', function() {
    WC()->session->set('cart', WC()->cart->get_cart());
    WC()->session->set_customer_session_cookie(true);
}, 20);

/*
 * Apply Ajax on Add to Cart in Single Pages
 */
function custom_ajax_add_to_cart() {
    if ( ! isset($_POST['product_id']) ) {
        wp_send_json_error(["message" => "Product ID is missing."]);
    }

    $product_id = absint($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;

    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);

    if ($cart_item_key) {
        wp_send_json_success([
            'message' => 'Product added successfully!',
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_url' => wc_get_cart_url(), // Dynamically get the cart URL
        ]);
    } else {
        wp_send_json_error(["message" => "Failed to add product to cart."]);
    }
}
add_action("wp_ajax_custom_ajax_add_to_cart", "custom_ajax_add_to_cart");
add_action("wp_ajax_nopriv_custom_ajax_add_to_cart", "custom_ajax_add_to_cart");

/*
 * Search Products
 */
function wc_ajax_search() {
    if (!isset($_POST['keyword'])) {
        wp_send_json_error('No search term provided.');
    }

    $keyword = sanitize_text_field($_POST['keyword']);

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => 3,
        's'              => $keyword,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            ?>
            <div class="pb-3 pt-3">
                <a href="<?= get_permalink(); ?>" class="d-flex gap-3 text-decoration-none">
                    <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="object-fit-cover rounded-1" style="height: 100px; width: 120px;">

                    <div>
                        <h3 class="size-20 text-white fw-semibold"><?= get_the_title(); ?></h3>
                        <p class="size-14 text-white opacity-75 mt-1 limit-words"><?= get_the_excerpt(); ?></p>
                        <p class="size-16 text-white mt-2"><?= $product->get_price_html(); ?></p>
                    </div>
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p class="text-white">No products found.</p>';
    }

    wp_die();
}

add_action('wp_ajax_wc_ajax_search', 'wc_ajax_search');
add_action('wp_ajax_nopriv_wc_ajax_search', 'wc_ajax_search');

function wc_ajax_search_mobile() {
    if (!isset($_POST['keyword'])) {
        wp_send_json_error('No search term provided.');
    }

    $keyword = sanitize_text_field($_POST['keyword']);

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => 3,
        's'              => $keyword,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            ?>
            <div class="pb-3 pt-3">
                <a href="<?= get_permalink(); ?>" class="d-flex gap-3 text-decoration-none">
                    <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="object-fit-cover rounded-1" style="height: 100px; width: 120px;">

                    <div>
                        <h3 class="size-20 color-1 fw-semibold"><?= get_the_title(); ?></h3>
                        <p class="size-14 color-1 opacity-75 mt-1 limit-words"><?= get_the_excerpt(); ?></p>
                        <p class="size-16 color-1 mt-2"><?= $product->get_price_html(); ?></p>
                    </div>
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p class="color-1">No products found.</p>';
    }

    wp_die();
}

add_action('wp_ajax_wc_ajax_search_mobile', 'wc_ajax_search_mobile');
add_action('wp_ajax_nopriv_wc_ajax_search_mobile', 'wc_ajax_search_mobile');
