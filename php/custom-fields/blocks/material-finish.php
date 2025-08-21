<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $variations = get_field('variations');
    $products = get_field('products');
    $button = get_field('button');
?>

<section class="sec-spacing-jy">
    <div class="container">
        <?php if( $heading ) : ?>
            <h2 class="size-lg-48 size-32 fw-semibold color-1 text-center mb-4 mx-auto"><?= $heading; ?></h2>
        <?php endif; 

        if( $paragraph ) : ?>
            <p class="size-lg-20 size-18 color-1 text-center mb-4 width-max-660 opacity-85 mx-auto"><?= $paragraph; ?></p>
        <?php endif;

        if( !empty( $variations ) ) :
            echo '<div class="d-flex align-items-center justify-content-center flex-wrap mb-5 gap-3">';

            foreach ( $variations as $i => $single ) :
                if ( !empty( $single ) ) :
                    $tab = $single['tab']; ?>
                    <span id="variation-tab" class="selector-material d-block rounded-pill border border-1 color-border-1 size-18 py-2 px-4 cursor-pointer btn-over-3 <?= ($i != 0) ? '' : 'active'; ?>"><?= $tab; ?></span>
                <?php endif;
            endforeach;

            echo '</div>';
        endif; ?>

        <!-- Dashboard에서 Pages -> Materials -> Products -->
        <?php if ( $products ) : ?>
            <div class="row flex-nowrap overflow-x-auto pb-4 pb-lg-0 mb-5">
                <?php foreach ( $products as $product ) :
                    if ( !empty( $product ) ) : ?>
                        <div class="col-lg-3 col-sm-6 col-11">
                            <img class="w-100 height-280 object-fit-cover border border-1 rounded-2" src="<?= $product['image']['url']; ?>" alt="<?= $product['image']['alt']; ?>">
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        <?php endif; ?>

        <?php foreach ( $variations as $i => $single ) :
            if ( !empty( $single ) ) :
                $active = ($i == 0) ? 'active' : '';
                echo '<div class="' . $active . ' d-flex justify-content-center flex-wrap gap-5 row-gap-4 overflow-x-auto pb-lg-0 selected-material" id="variation-collection">';
                $materials = $single['materials'];

                foreach ( $materials as $now ) :
                    if ( !empty( $now ) ) : ?>
                        
                        <div class="d-flex flex-column">
                            <img src="<?= $now['image']; ?>" alt="<?= $now['text']; ?>" class="icon-32 mx-auto">
                            <span class="mt-2 size-14 text-center"><?= $now['text']; ?></span>
                        </div>

                    <?php endif;
                endforeach;

                echo '</div>';
            endif;
        endforeach; ?>

        <?php if ( !empty( $button ) ) : ?>
            <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="object-fit-cover mt-sm-5 mt-4 py-2 px-4 size-18 fw-semibold text-center color-1 border border-1 color-border-1 rounded-pill text-decoration-none mt-4 width-fit mx-auto d-block btn-over-3"><?= $button['title']; ?></a>
        <?php endif; ?>

    </div>
</section>
