<?php $enable = get_field('product_counter');

$products = get_field('products'); ?>
<!-- <section class="pb-5 pt-lg-5 pt-0"> -->
<section class="pb-5 pt-0">
    <div class="container">
        <?php if ($enable) { ?>
            <p class="size-18 color-1"><?= count( $products ) . ' items'; ?></p>
            <!-- <div class="py-5 d-none d-lg-block"></div> -->
        <?php } else { ?>
            <div class="pb-5 d-none d-lg-block"></div>
        <?php } ?>

        <?php if (is_array($products)) : ?>
            <?php foreach ($products as $i => $id) :

                $direction = ( $i % 2 == 0 ) ? 'flex-lg-row flex-column-reverse' : 'flex-lg-row-reverse flex-column-reverse';

                if ($id) : ?>
                    <div class="row align-items-center py-5 row-gap-4 <?= $direction; ?>">
                        <div class="col-lg-5 col-12">
                            <h2 class="size-lg-48 size-32 mb-3"><?= get_the_title( $id ); ?></h2>
                            <p class="size-18 mb-4"><?= get_the_excerpt( $id ); ?></p>

                            <a href="<?= get_the_permalink( $id ); ?>" class="border border-1 color-border-1 py-2 px-3 rounded-pill color-1 text-decoration-none btn-over-3">View Product</a>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-lg-6 col-12">
                            <div class="swiper swiper-feature position-relative">
                                <div class="swiper-wrapper">
                                    <?php $product = wc_get_product($id);
                                    $images = $product->get_gallery_image_ids();

                                    if ( !empty( $images ) ) : 
                                        foreach ( array_slice( $images, 0, 4 ) as $image ) :
                                            if ( $image ) : ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= wp_get_attachment_url( $image ); ?>" alt="<?= get_the_title($id); ?>" class="w-100 object-fit-cover height-470 rounded-4">
                                                </div>
                                            <?php endif;
                                        endforeach;
                                    endif; ?>
                                </div>
                                <div class="feature-pagination custom-pagination z-3 position-absolute start-50 translate-middle-x bottom-0 pb-3 text-center"></div>
                            </div>
                        </div>
                    </div>
                <?php endif;
            endforeach;
        endif;

        $bottom = get_field('bottom');
        if ( $bottom ) : ?>
            <p class="size-18 collection-bottom mw-100"><?= $bottom; ?></p>
        <?php endif; ?>
    </div>
</section>
