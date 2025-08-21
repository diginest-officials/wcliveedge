<?php
/**
 * WooCommerce Archive Loop
 * 
 * @package WestCoastLiveEdge
 * @description Displays the archive loop for WooCommerce products
 */

// Ensure we have a valid product
global $product;
if (!$product || !is_a($product, 'WC_Product')) {
    return;
}
?>

<div class="col-xl-3 col-lg-4 col-sm-6 col-11 col-11-jy product-grid-height">
    <!-- <div class="card-over position-relative d-grid justify-content-between" style="height: 375px !important;"> -->
    <div class="card-over position-relative d-grid product-grid-height justify-self-center">
        <?php
        $thumbnail_url = get_the_post_thumbnail_url();
        $hover_image = get_field('image_hover', get_the_ID());
        $product_title = get_the_title();
        $cart_icon = get_field('add_cart_icon', 'option');
        $side_content = get_field('side_content');
        ?>
          
        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none w-100 rounded-md">
            <?php if ($thumbnail_url) : ?>
                <div class="thumbnail-wrapper position-relative rounded-3">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" 
                        alt="<?php echo esc_attr($product_title); ?>" 
                        class="height-200 object-fit-cover w-100 position-relative z-1">
                    <?php
                    if (isset($side_content['contents']) && is_array($side_content['contents'])) :
                        foreach ($side_content['contents'] as $content) :
                            if (isset($content['button_settings']) && $content['button_settings']['button'] == 'Measurements' && isset($content['offcanvas']['bullets'])) :
                                $bullets = $content['offcanvas']['bullets'];
                                $bottom_height = sizeof($bullets) == 2 ? '80px' : '104px';
                                ?>
                                <div class="measurements-overlay position-relative w-100 d-flex text-white ms-auto p-2" style="bottom: <?php echo $bottom_height; ?>;">
                                    <div class="p-2 rounded-3 bg-dark bg-opacity-75 ms-auto me-0">
                                        <?php foreach ($bullets as $bullet) : ?>
                                            <p><strong><?php echo esc_html($bullet['title']); ?> </strong> <?php echo esc_html($bullet['point']); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php
                                break;
                            endif;
                        endforeach;
                    endif;
                    ?>
                </div>
            <?php endif; ?>

            <h3 class="mt-3 mb-2 color-1 size-28 size-32-jy center-text"><?php echo esc_html($product_title); ?></h3>
            <p class="size-18 color-1 opacity-75 center-text">Inquire for pricing</p>
        </a>

        <div class="d-flex mt-2 align-items-end justify-content-center">
            <!-- Quick View Button -->
            <div class="size-16 color-1 fw-semibold">
                <a href="#" class="fw-semibold border border-1 color-border-1 rounded-pill size-18 color-1 py-2 px-4 text-decoration-none btn-over-3 quick-view-button" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                    <?php echo 'Quick View' ?>
                </a>
            </div>

            <!-- Quick View Modal -->
            <div class="modal fade" id="quickViewModal" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="d-flex align-items-center width-max-430 justify-content-between gap-jy">
                                <h3 class="modal-title" id="quickViewModalLabel"></h3>
                                 <p class="size-24 fw-semibold">Inquire for pricing</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-row align-items-center" id="quickViewBody">
                            <div class="d-flex flex-column" id="quickViewBodyLeft">
                                <div class="swiper-product swiper">
                                    <div class="swiper-wrapper" id="quickViewImages"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <p class="swiper-description ms-auto me-0 width-max-430 overflow-auto mx-jy" id="quickViewDescription"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($cart_icon) : ?>
            <div class="position-relative p-2 z-1 width-fit add-to-cart invisible-over-576">
                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" 
                    class="add-to-cart-button p-2 color-bg-1 d-block width-fit rounded-circle ajax_add_to_cart add-to-cart-ajax"
                    data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                    data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                    data-quantity="1">
                    <img src="<?php echo esc_url($cart_icon); ?>" 
                        alt="<?php esc_attr_e('Add to cart', 'wcliveedge.com'); ?>" 
                        class="icon-24">
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($cart_icon) : ?>
        <div class="position-relative p-2 z-1 width-fit add-to-cart invisible-under-576">
            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" 
                class="add-to-cart-button p-2 color-bg-1 d-block width-fit rounded-circle ajax_add_to_cart add-to-cart-ajax"
                data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                data-quantity="1">
                <img src="<?php echo esc_url($cart_icon); ?>" 
                    alt="<?php esc_attr_e('Add to cart', 'wcliveedge.com'); ?>" 
                    class="icon-24">
            </a>
        </div>
    <?php endif; ?>
</div>
