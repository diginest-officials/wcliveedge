<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
?>

<section class="sec-spacing-md pt-4">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="mb-lg-5 mb-4 custom-breadcrumb">
            <?php if (function_exists('woocommerce_breadcrumb')) {
                woocommerce_breadcrumb();
            } ?>
        </div>

        <!-- Archive Header -->
        <div class="size-lg-48 size-32 my-lg-5 my-4">
            <?php do_action('woocommerce_shop_loop_header'); ?>
        </div>

        <!-- Categories Section -->
        <?php get_template_part('template-parts/sections/woo-archive-category'); ?>

        <!-- Product Loop -->
        <?php if (woocommerce_product_loop()) :
            /**
             * Hook: woocommerce_before_shop_loop.
             */
            do_action('woocommerce_before_shop_loop');

            woocommerce_product_loop_start(); ?>

			<div class="woocommerce-products-grid">
				<?php if (wc_get_loop_prop('total')) : ?>
					<div class="mt-5 row row-gap-4 row-gap-sm-5">

						<?php while (have_posts()) : the_post();
							do_action('woocommerce_shop_loop');
							get_template_part('template-parts/sections/woo-archive-loop');
						endwhile; ?>

					</div>
				<?php endif; ?>
			</div>

			<?php woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             */
            do_action('woocommerce_after_shop_loop');
        else :
            /**
             * Hook: woocommerce_no_products_found.
             */
            do_action('woocommerce_no_products_found');
        endif;

        /**
         * Hook: woocommerce_after_main_content.
         */
        do_action('woocommerce_after_main_content');
        ?>

    </div>
</section>

<?php $enable = get_field('archive_focus_slider', 'options')['disable_shop_slider'];

if ( !$enable ) :

$section = get_field('archive_focus_slider', 'options')['section'];

if (is_array($section)) {
    $top = in_array('top', $section) ? '' : 'pt-0';
    $bottom = in_array('bottom', $section) ? '' : 'pb-0';
    $arrows = in_array('arrows', $section) ? false : true;
} ?>

<section class="pt-4 <?php echo $top . $bottom; ?>">
    <div class="container-fluid px-0">

        <?php $heading = get_field('archive_focus_slider', 'options')['heading'];
        if ($heading) : ?>
            <div class="heading heading-black text-center mx-auto width-max-660 width-max-mobile-320 mb-2 mb-lg-5 color-1">
                <?=  $heading; ?>
            </div>
        <?php endif; ?>

        <div class="swiper swiper-focus">
            <div class="swiper-wrapper swiper-padding">
                <?php $slider_data = get_field('archive_focus_slider', 'options');
                $slides = $slider_data['products'] ?? [];

                if (!empty($slides)) :
                    foreach ($slides as $slide) :
                        if ($slide) : ?>
                            <div class="swiper-slide position-relative">
                                <div class="position-relative">
                                    <img
                                        src="<?= esc_url(get_the_post_thumbnail_url($slide)); ?>"
                                        alt="<?= esc_attr(get_the_title($slide)); ?>"
                                        class="w-100 height-350 height-lg-470 object-fit-cover rounded-md"/>

                                    <div class="d-flex flex-column flex-lg-row align-items-lg-end gap-3 justify-content-between position-absolute start-0 bottom-0 w-100 z-2 swiper-disable">
                                        <h3 class="size-24 size-lg-40 text-white width-max-lg-340 width-max-200">
                                            <?= esc_html(get_the_title($slide)); ?>
                                        </h3>

                                        <a href="<?= esc_url(get_the_permalink($slide)); ?>"
                                        class="text-decoration-none width-fit color-3 bg-white py-lg-2 py-1 px-lg-4 px-2 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold text-center">
                                            Order Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endforeach;
                endif; ?>
            </div>

            <?php if ( $arrows ) : ?>
                <div class="d-flex align-items-center gap-4 mt-1 mt-sm-3 mt-lg-5 justify-content-center">
                    <button class="focus-prev btn border-0 p-0 rounded-circle overflow-hidden icon-45 icon-lg-60">
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-prev.svg"
                            alt="Arrow icon"
                            class="img-fluid"/>
                    </button>
                    <button class="focus-next btn border-0 p-0 rounded-circle overflow-hidden icon-45 icon-lg-60">
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-next.svg"
                            alt="Arrow icon"
                            class="img-fluid"/>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php endif; ?>

<?php $archive_banner = get_field('archive_banner', 'options');
if ( $archive_banner['image'] ) : ?>

    <section class="sec-spacing-lg">
        <div class="container">
            <div class="position-relative">
                <img src="<?= $archive_banner['image']['url']; ?>" alt="<?= $archive_banner['image']['alt']; ?>" class="w-100 img-fluid object-fit-cover rounded-4 height-660">

                <div class="bg-overlay-2 position-absolute z-1 top-0 start-0 w-100 h-100 rounded-4"></div>

                <div class="position-absolute z-2 top-50 translate-middle-y start-0 ps-lg-5 ps-sm-4 ps-3 pb-lg-5 pb-sm-4 pb-3">
                    <h2 class="size-lg-48 size-32 text-white width-max-660 width-max-mobile-320 mb-4 width-max-430"><?= $archive_banner['heading']; ?></h2>
                    <p class="size-sm-20 size-16 text-white opacity-85 width-max-340"><?= $archive_banner['paragraph']; ?></p>
                    
                    <?php $button = $archive_banner['button'];
                    if ( $button ) : ?>

                        <!-- <a href="<?= $button['link']; ?>" target="<?= $button['target']; ?>" class="text-decoration-none width-fit color-3 bg-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 size-sm-18 size-16 fw-semibold text-center  mt-4"><?= $button['title']; ?></a> -->
                        <a href="https://wcliveedge.com/custom-order/" target="<?= $button['target']; ?>" class="text-decoration-none width-fit color-3 bg-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 size-sm-18 size-16 fw-semibold text-center  mt-4"><?= $button['title']; ?></a>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<!-- Related Products Section -->
<section class="sec-spacing-lg pt-0">
    <div class="container">
        <?php
        $related_products = get_field('archive_related_products', 'options');
        
        if (!empty($related_products['heading'])) : ?>
            <div class="d-flex align-items-end justify-content-between pb-lg-5 pb-4">
                <h2 class="color-3 size-32 size-lg-48 fw-light lh-sm fw-medium">
                    <?php echo esc_html($related_products['heading']); ?>
                </h2>
            </div>
        <?php endif; ?>

        <div class="row flex-nowrap flex-lg-wrap row-gap-5 overflow-x-auto pb-4">
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'orderby'        => 'rand'
            );

            $random_products = new WP_Query($args);

            if ($random_products->have_posts()) :
                while ($random_products->have_posts()) : $random_products->the_post();
                    $product = wc_get_product(get_the_ID()); ?>

                    <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none card-over w-100">
                            <div class="overflow-hidden rounded-md">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'height-280 object-fit-cover w-100')); ?>
                                <?php endif; ?>
                            </div>
                            <h3 class="mt-3 color-3 size-28 d-flex align-items-center gap-3">
                                <?php echo esc_html(get_the_title()); ?>
                            </h3>
                        </a>
                    </div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<?php get_footer( 'shop' );
