<section class="color-bg-3 sec-spacing-lg">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between pb-5">

            <?php $heading = get_field('heading');
            if ($heading) : ?>
                <div class="heading width-max-430 width-max-mobile-320">
                    <?= $heading; ?>
                </div>
            <?php endif; 
            
            $link = get_field('link');
            if ($link) : ?>
                <a href="<?= esc_url($link['url']); ?>" target="<?= esc_attr($link['target']); ?>" class="size-18 text-decoration-none fw-semibold py-2 px-5 text-white border border-1 border-white rounded-pill btn-over-4 d-none d-lg-block">
                    <?= esc_html($link['title']); ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="row pt-3 gap-lg-0 gap-5 justify-content-evenly-jy">
            <?php $args = [
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
            ];

            $collection = get_terms($args);

            if (!empty($collection) && !is_wp_error($collection)) :
                foreach ($collection as $item) :
                    $featured = get_field('featured', 'product_cat_' . $item->term_id);
                    $image = get_field('category_image', 'product_cat_' . $item->term_id);
                    $image_hover = get_field('category_image_hover', 'product_cat_' . $item->term_id);

                    $title = $item->name;
                    $p_link = get_term_link($item);

                    if ($featured) : ?>
                        <div class="col-lg-4 col-12">
                            <a href="<?= esc_url($p_link); ?>" class="text-decoration-none card-over w-100">
                                <div class="overflow-hidden rounded-md position-relative border border-1 rounded-4" style="border-color: #3F3F3F !important">
                                    <?php if ($image) : ?>
                                        <img
                                            src="<?= esc_url($image['url']); ?>"
                                            alt="<?= esc_attr($title); ?>"
                                            class="height-280 w-100 mobile-h-auto object-fit-cover w-100 position-relative z-1 front-img">
                                        <img
                                        src="<?= esc_url($image_hover['url']); ?>"
                                        alt="<?= esc_attr($title); ?>"
                                        class="height-280 w-100 mobile-h-auto object-fit-cover w-100 position-absolute top-50 start-50 translate-middle back-img">
                                    <?php endif; ?>
                                </div>

                                <h3 class="mt-3 text-white size-28 d-flex align-items-center gap-3 justify-content-center">
                                    <?= esc_html($title); ?>
                                </h3>
                            </a>
                        </div>
                    <?php endif;
                endforeach;
            else : ?>
                <p>No featured category found.</p>
            <?php endif; ?>
        </div>


        <?php $link = get_field('link');
        if ($link) : ?>
            <a href="<?= esc_url($link['url']); ?>" target="<?= esc_attr($link['target']); ?>" class="size-18 text-decoration-none fw-semibold mt-5 text-center py-2 px-5 text-white border border-1 border-white rounded-pill btn-over-4 d-block d-lg-none">
                <?= esc_html($link['title']); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
