<section class="sec-spacing-lg pt-0">
    <div class="container">
        <div class="position-relative">
            <?php $image = get_field('image');
            if ( $image ) : ?>
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="img-fluid object-fit-cover rounded-4 height-660">
            <?php endif; ?>
            <div class="bg-overlay-2 position-absolute z-1 top-0 start-0 w-100 h-100 rounded-4"></div>

            <div class="position-absolute z-2 top-50 translate-middle-y start-0 ps-lg-5 ps-sm-4 ps-3 pb-lg-5 pb-sm-4 pb-3">
                <?php $title = get_field('title');
                if ( $title ) : ?>
                    <h2 class="size-lg-48 size-32 text-white width-max-660 width-max-mobile-320 mb-4 width-max-430"><?= $title; ?></h2>
                <?php endif; 

                $text = get_field('text');
                if ( $text ) : ?>
                    <p class="size-sm-20 size-16 text-white opacity-85 width-max-340"><?= $text; ?></p>
                <?php endif;

                $button = get_field('button');
                if ( $button ) : ?>
                    <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" 
                        class="text-decoration-none width-fit color-3 bg-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 size-sm-18 size-16 fw-semibold text-center  mt-4">
                            <?= $button['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>