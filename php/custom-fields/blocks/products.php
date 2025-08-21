<?php
    $button = get_field('button');
    $heading_color = get_field('section')['heading_color'];
    $bg_color = get_field('section')['bg_color']; 
?>

<section class="<?= ($bg_color == 'black') ? 'color-bg-3' : ''; ?> sec-spacing-lg overflow-hidden">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between pb-lg-5 pb-4">
            <?php $heading = get_field('heading');
            if ($heading) : ?>
                <h2 class="<?= ($heading_color == 'black') ? 'color-1' : 'text-white'; ?> size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320 fw-medium">
                    <?= $heading; ?>
                </h2>
            <?php endif; ?>

            <?php if ($button) : ?>
                <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"
                    class="size-18 text-decoration-none fw-semibold py-2 px-5 border border-1 rounded-pill btn-over-3 d-none d-lg-block <?= ($heading_color == 'black') ? 'border-black color-3' : 'border-white text-white'; ?>">
                    <?= $button['title']; ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="row row-gap-5 flex-nowrap flex-lg-wrap overflow-x-auto pb-4">
            <?php $products = get_field('products');

            if ($products) :
                foreach ($products as $id) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                        <!-- <a href="<?= get_the_permalink($id); ?>" class="text-decoration-none card-over w-100"> -->
                        <?php
                        $terms = get_the_terms($id, 'product_cat');
                        if ($terms && !is_wp_error($terms)) {
                            $category = $terms[0];
                            $category_link = get_term_link($category);
                        } else {
                            $category_link = '#';
                        }
                        ?>
                        <a href="<?= esc_url($category_link); ?>" class="text-decoration-none card-over w-100">
                            <div class="overflow-hidden rounded-md">
                                <img
                                    src="<?= get_the_post_thumbnail_url($id); ?>"
                                    alt="<?= get_the_title($id); ?>"
                                    class="height-280 object-fit-cover w-100"
                                />
                            </div>
                            <!-- <h3 class="mt-3 size-28 d-flex align-items-center gap-3 <?= ($heading_color == 'black') ? 'color-3' : 'text-white'; ?>">
                                <?= get_the_title($id); ?>
                            </h3> -->
                            <h3 class="mt-3 size-28 align-items-center gap-3 text-center <?= ($heading_color == 'black') ? 'color-3' : 'text-white'; ?>">
                                <?php
                                $terms = get_the_terms($id, 'product_cat');
                                if ($terms && !is_wp_error($terms)) {
                                    $category = $terms[0]->name;
                                    echo $category;
                                } else {
                                    echo 'Uncategorized';
                                }
                                ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>
