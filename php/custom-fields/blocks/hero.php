<?php $bg_image = get_field('bg_image'); ?>
<section class="height-100vh bg-top-center bg-size-cover position-relative color-bg-3" style="background-image: url('<?php echo esc_url($bg_image); ?>')">
    
    <div class="bg-overlay position-absolute start-0 top-0 w-100 h-100 z-1 pointer-none"></div>

    <div class="position-absolute top-50 start-50 translate-middle w-100 width-max-850 z-2">
        <div class="container">
            
            <?php $heading = get_field('heading');
            if ($heading) : ?>

                <div class="heading mb-5">
                    <?php echo $heading; ?>
                </div>

            <?php endif; ?>

            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">

                <?php $button_1 = get_field('button_1');
                if ($button_1) : ?>

                    <a href="<?php echo esc_url($button_1['url']); ?>" target="<?php echo esc_attr($button_1['target']); ?>" class="text-decoration-none color-3 bg-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold width-mobile-100 text-center">
                        <?php echo esc_html($button_1['title']); ?>
                    </a>

                <?php endif;
                
                $button_2 = get_field('button_2');
                if ($button_2) : ?>

                    <a href="<?php echo esc_url($button_2['url']); ?>" target="<?php echo esc_attr($button_2['target']); ?>" class="text-decoration-none text-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 btn-blur size-18 fw-semibold width-mobile-100 text-center">
                        <?php echo esc_html($button_2['title']); ?>
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>