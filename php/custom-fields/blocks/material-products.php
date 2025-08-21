<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $products = get_field('products');
?>

<section class="sec-spacing-jy">
    <div class="container">
        <?php if( $heading ) : ?>
            <h2 class="size-lg-48 size-32 fw-semibold color-1 text-center mb-4 width-max-660 mx-auto"><?= $heading; ?></h2>
        <?php endif; 

        if( $paragraph ) : ?>
            <p class="size-lg-20 size-18 color-1 text-center mb-4 width-max-660 opacity-85 mx-auto"><?= $paragraph; ?></p>
        <?php endif;

        if( !empty( $products ) ) :
            echo '<div class="d-flex align-items-center justify-content-center flex-wrap mb-5 gap-3">';

            foreach ( $products as $i => $product ) :
                if ( !empty( $product ) ) :
                    $tab = $product['tab']; ?>
                    <span id="material-tab" class="selector-material d-block rounded-pill border border-1 color-border-1 size-18 py-2 px-4 cursor-pointer btn-over-3 <?= ($i != 0) ? 'active' : ''; ?>"><?= $tab; ?></span>
                <?php endif;
            endforeach;

            echo '</div>';

            foreach ( $products as $i => $product ) :
                if ( !empty( $product ) ) :
                    $active = ($i == 0) ? 'active' : '';
                    echo '<div class="' . $active . ' selected-material row flex-nowrap overflow-x-auto pb-4 pb-lg-0 flex-jy-col" id="material-collection">';
                    $cards = $product['cards'];

                    foreach ( $cards as $card ) :
                        if ( !empty( $card ) ) : ?>
                            
                            <div class="col-lg-3 col-sm-6" >
                                <div class="d-flex flex-column">
                                    <img class="img-fluid mb-3 border border-1 rounded-2 object-fit-contain" src="<?= $card['image']['url']; ?>" alt="<?= $card['image']['alt']; ?>" style="height: 250px;">

                                    <?php if( $card['title'] ) : ?>
                                        <h3 class="size-24 fw-semibold my-2 center-text"><?= $card['title']; ?></h3>
                                    <?php endif;

                                    if( $card['size'] ) : ?>
                                        <h4 class="size-16 color-1 opacity-75 my-2 center-text"><?= $card['size']; ?></h4>
                                    <?php endif; 

                                    if( $card['tab'] ) : ?>
                                        <span class="size-16 d-block width-fit rounded-pill py-1 px-3 mx-auto my-3 mt-sm-3 mb-sm-0" style="background-color: #F0F0F0;"><?= $card['tab']; ?></span>
                                    <?php endif; 
                                    
                                    if (  !empty( $card['button'] ) ) : ?>
                                        <a class="py-2 px-3 size-16 fw-semibold text-center color-1 border border-1 color-border-1 rounded-pill text-decoration-none mt-2 mt-sm-4 width-fit btn-over-3 mx-auto" href="<?= $card['button']['url']; ?>" target="<?= $card['button']['target']; ?>"><?= $card['button']['title']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endif;
                    endforeach;

                    echo '</div>';
                endif;
            endforeach;
        endif; ?>
    </div>
</section>
