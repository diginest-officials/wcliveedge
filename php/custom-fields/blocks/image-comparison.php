<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $variations = get_field('variations');
    $button = get_field('button');
    $images = get_field('image_comparison');
    $image_1 = $images['image_1'];
    $image_2 = $images['image_2'];
?>

<section class="sec-spacing-jy">
    <div class="container">
        <?php if( $heading ) : ?>
            <h2 class="size-lg-48 size-32 fw-semibold color-1 text-center mb-4 width-max-7700 mx-auto"><?= $heading; ?></h2>
        <?php endif; 

        if( $paragraph ) : ?>
            <p class="size-lg-20 size-18 color-1 text-center mb-4 width-max-660 opacity-85 mx-auto"><?= $paragraph; ?></p>
        <?php endif;

        if( !empty( $variations ) ) :
            echo '<div class="d-flex align-items-center justify-content-center flex-wrap mb-5 gap-3">';

            foreach ( $variations as $i => $single ) :
                if ( !empty( $single ) ) :
                    $tab = $single['tab']; ?>
                    <span id="finish-tab" class="selector-material d-block rounded-pill border border-1 color-border-1 size-18 py-2 px-4 cursor-pointer btn-over-3 <?= ($i != 0) ? 'active' : ''; ?>"><?= $tab; ?></span>
                <?php endif;
            endforeach;

            echo '</div>';
        endif; ?>

        <div class="row align-items-center row-gap-4">
            <div class="col-lg-6 col-12">
                <?php foreach ( $variations as $i => $single ) :
                    if ( !empty( $single ) ) :
                        $active = ($i == 0) ? 'active' : '';
                        echo '<div class="' . $active . ' d-flex gap-3 row-gap-4 overflow-x-auto pb-4 pb-lg-0 selected-material" id="finish-collection">';
                        $variant = $single['variant'];

                        foreach ( $variant as $now ) :
                            if ( !empty( $now ) ) : ?>
                                
                                <div class="d-flex flex-column">
                                    <img src="<?= $now['image']; ?>" alt="<?= $now['text']; ?>" style="width: 94px; height: 95px;">
                                    <span class="mt-2 size-14 text-center"><?= $now['text']; ?></span>
                                </div>

                            <?php endif;
                        endforeach;

                        echo '</div>';
                    endif;
                endforeach; ?>

                <?php if ( !empty( $button ) ) : ?>
                    <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="object-fit-cover mt-5 py-2 px-4 size-18 fw-semibold text-center color-1 border border-1 color-border-1 rounded-pill text-decoration-none mt-4 width-fit d-none d-lg-block btn-over-3"><?= $button['title']; ?></a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-12">
                <?php if ( !empty( $image_1 ) && !empty( $image_2 ) ) :
                    echo do_shortcode(
                        '[twenty20 img1="' . $image_1 . '" img2="' . $image_2 . '" direction="horizontal" offset="0.5" align="right" width="100%" before="Before" after="After" hover="false"]'
                    );
                endif; ?>
            </div>

        </div>
        <?php if ( !empty( $button ) ) : ?>
            <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="object-fit-cover mt-5 py-2 px-4 size-18 fw-semibold text-center color-1 border border-1 color-border-1 rounded-pill text-decoration-none mt-4 width-fit d-block d-lg-none"><?= $button['title']; ?></a>
        <?php endif; ?>
    </div>
</section>
