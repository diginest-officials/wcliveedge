<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $shortcode = get_field('shortcode');
?>
<section class="sec-spacing-lg pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9 col-xl-10 col-lg-11 col-12">
                <?php if ( !empty( $heading ) ) : ?>
                <h2 class="size-lg-48 size-32 color-1 fw-semibold text-center mb-3"><?= $heading; ?></h2>
                <?php endif; ?>

                <?php if ( !empty( $paragraph ) ) : ?>
                    <p class="size-18 color-1 opacity-75 mb-5 text-center widhh-max-770 mx-auto"><?= $paragraph; ?></p>
                <?php endif; ?>

                <?php if ( !empty( $shortcode ) ) :
                    echo do_shortcode( $shortcode );
                endif; ?>
            </div>
        </div>
    </div>
</section>