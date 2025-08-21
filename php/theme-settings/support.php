<?php
// WordPress Active Support
function wordpress_active() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo' );

	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'main' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'footer' ),
        )
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'wordpress_active' );

// Overwrite WooCommerce Pages
function add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');

// Remove breadcrumbs in WooCommerce
add_action('init', function () {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
});

// Add Colour Class in Body
function add_custom_body_class($classes) {
    $classes[] = 'color-bg-2';
    return $classes;
}
add_filter('body_class', 'add_custom_body_class');

// Enable SVG
function custom_mime_types($mimes) {
    // Add custom MIME types
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');

// Display Product Count
function display_product_count() {
    global $wp_query;

    $product_count = $wp_query->found_posts;

    echo '<p class="woocommerce-product-count">Total Products: ' . esc_html( $product_count ) . '</p>';
}

// Add Product SKU to Cart
add_filter( 'woocommerce_get_breadcrumb', function( $crumbs ) {
    if ( is_cart() ) {
        array_splice( $crumbs, 1, 0, [ [ 'Shop', get_permalink( wc_get_page_id( 'shop' ) ) ] ] );
    }
    return $crumbs;
} );

// Reset the Cart image
add_filter( 'woocommerce_cart_item_thumbnail', function( $thumbnail, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];
    $image_size = 'medium';
    $thumbnail = $product->get_image( $image_size ); 

    return $thumbnail;
}, 10, 3 );

// Move the payment block to the bottom
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'woocommerce_review_order_after_shipping', function() {
    echo '<div id="custom-payment-methods" class="mt-5">';
	echo '<h3 class="size-24 fw-semibold mb-1 color-1">' . esc_html__( 'Payment', 'woocommerce' ) . '</h3>';
	echo '<p class="size-14 fw-medium opacity-75 mb-3 color-1">All transactions are secure and encrypted.</p>';

    woocommerce_checkout_payment();
    echo '</div>';
}, 20 );

// Rename the checkout button
add_filter( 'woocommerce_order_button_text', function( $button_text ) {
    return 'Pay Now';
});

// Add the custom coupon fields in checkout
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// Add custom coupon field to checkout page
add_action('woocommerce_review_order_after_cart_contents', function() {
    ?>
    <div class="my-5">
        <form class="d-flex flex-wrap align-items-center gap-3" id="ajax-coupon-form" method="post">
            <div class="coupon-input">
                <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
                <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
            </div>
            <button type="submit" class="coupon-submit px-4 py-3 color-bg-6 color-1 width-fit fw-semibold rounded-pill size-16 button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
            <div class="clear"></div>
            <div id="coupon-response" class="w-100" style="display: none;"></div>
        </form>
    </div>
    <?php
}, 20);

// Shop default sort
function sort_products_by_category( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() ) ) {
        $query->set('orderby', 'term_order');
    }
}
add_action( 'pre_get_posts', 'sort_products_by_category' );
