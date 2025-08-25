<?php $section = get_field('section');

if (is_array($section)) {
    $top = in_array('top', $section) ? '' : 'pt-0';
    $bottom = in_array('bottom', $section) ? '' : 'pb-0';
    $arrows = in_array('arrows', $section) ? false : true;
} ?>

<section class="sec-spacing-lg <?php echo $top . ' ' . $bottom; ?>">
    <div class="container-fluid px-0">

        <?php $heading = get_field('heading');
        if ($heading) : 
        
            $heading_color = get_field('heading_color');
            $color = ($heading_color == 'black') ? 'heading-black' : ''; ?>

            <div class="heading <?= $color; ?> text-center mx-auto width-max-660 width-max-mobile-320 mb-2 mb-lg-5">
                <?=  $heading; ?>
            </div>

        <?php endif; ?>

        <div class="swiper swiper-focus">
            <div class="swiper-wrapper swiper-padding">
                <?php $products = get_field('products');
                if ($products) : 
                    foreach ($products as $id) : 
                        if ($id) : ?>
                            <div class="swiper-slide position-relative">
                                <div class="position-relative">
                                    <img
                                        src="<?= get_the_post_thumbnail_url($id); ?>"
                                        alt="<?= get_the_title($id); ?>"
                                        class="w-100 height-350 height-lg-470 object-fit-cover rounded-md"/>

                                    <div class="w-100 h-100 position-absolute start-0 top-0 z-1" style="background: #00000050;"></div>

                                    <div class="d-flex flex-column flex-lg-row align-items-lg-end gap-3 justify-content-between position-absolute start-0 bottom-0 w-100 z-2 swiper-disable">
                                        <h3 class="size-24 size-lg-40 text-white width-max-lg-340 width-max-200">
                                            <?= get_the_title($id); ?>
                                        </h3>

                                        <a href="<?= get_the_permalink($id); ?>"
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