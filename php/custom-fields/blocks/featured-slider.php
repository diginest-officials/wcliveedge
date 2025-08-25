<section class="color-bg-3">
    <div class="container">
        <div class="swiper swiper-feature position-relative rounded-md overflow-hidden">
            <div class="swiper-wrapper">
                <?php 
                $products = get_field('products');
                if ($products) :
                    foreach ($products as $id) : 
                        $thumbnail_url = get_the_post_thumbnail_url($id) ?: 'default-image.jpg'; // Fallback image
                        $permalink = get_permalink($id);
                        $title = get_the_title($id);
                        $excerpt = get_the_excerpt($id);
                        
                        $categories = get_the_category($id);
                        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
                        $terms = get_the_terms($id, 'product_cat');
                        if ($terms && !is_wp_error($terms)) {
                            $category = $terms[0]->name;
                        } else {
                            $category = $category_name;
                        }
                        ?>
                        
                        <div class="swiper-slide position-relative">
                            <img src="<?= esc_url($thumbnail_url); ?>" 
                                alt="<?= esc_attr($title); ?>" 
                                class="rounded-md w-100 object-fit-jy"
                                style="height: 660px; max-height: 100%;" />

                                <div class="w-100 h-100 position-absolute start-0 top-0 z-1" style="background: #00000050;"></div>

                            <div class="position-absolute start-0 bottom-0 p-4 p-lg-6 z-2 width-max-430 p-4-jy">
                                <div class="d-flex align-items-center gap-4 mb-3 mb-3-jy">
                                    <h4 class="size-24 text-white opacity-85 size-24-jy full-opacity"><?= esc_html($category); ?></h4>
                                </div>

                                <h3 class="size-32 size-lg-40 text-white mb-3 size-32-jy mb-3-jy full-opacity"><?= esc_html($title); ?></h3>
                                
                                <p class="size-16 d-none d-lg-block text-white opacity-75"><?=  wp_trim_words(get_the_excerpt($id), 20, '...'); ?></p>

                                <div class="d-flex align-items-center gap-sm-3 gap-2 mt-4 mb-5 pb-lg-3 my-jy">
                                    <a href="<?= esc_url($permalink); ?>"
                                        class="text-decoration-none text-white py-2 px-sm-3 px-1 border border-1 border-white rounded-pill btn-over-3 btn-blur size-18 fw-semibold text-center size-18-jy full-opacity padding-jy width-min-130">
                                        View Product
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach;
                endif; ?>
            </div>

            <div class="bg-slider-overlay position-absolute start-0 top-0 w-100 h-100 z-1 pointer-none"></div>
            <div class="feature-pagination custom-pagination z-3 position-absolute start-0 bottom-0 pb-lg-6 ps-lg-6 pb-2 ps-4-jy"></div>
        </div>
    </div>
</section>
