<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $button = get_field('button');

    $variations = get_field('variations');
    $data = [
        'titles' => [],
        'edges' => [],
        'shapes' => []
    ];

    foreach ($variations as $i => $single) {
        if (!empty($single)) {
            $varient = $single['varient'];

            if (!empty($varient)) {
                // Store text
                if (!empty($varient['title'])) {
                    $data['titles'][] = $varient['title'];
                    $data['edges'][] = $varient['edge'];
                    $data['shapes'][] = $varient['shapes'];
                }
            }
        }
    }
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
                    <span id="table-tab" class="selector-material d-block rounded-pill border border-1 color-border-1 size-18 py-2 px-4 cursor-pointer btn-over-3 <?= ($i != 0) ? '' : 'active'; ?>"><?= $tab; ?></span>
                <?php endif;
            endforeach;

            echo '</div>';
        endif; ?>

        <div class="row">
            <div class="col-lg-4 col-12">
                <h3 class="size-16 fw-semibold border border-1 p-2 text-center">Thickness</h3>
                <div class="d-flex flex-column align-items-center justify-content-center w-100 h-100 p-2 position-relative">
                    <?php foreach ( $data['titles'] as $i => $value) :
                        if ( !empty( $value ) ) : ?>
                            <h4 class="<?= ($i == 0) ? 'active' : ''; ?> size-14 fw-semibold text-center selected-material" id="table-collection"><?= $value; ?></h4>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <h3 class="size-16 fw-semibold border border-1 p-2 text-center">Edges</h3>

                <div class="d-flex flex-column align-items-center justify-content-center w-100 h-100 py-4 px-2">
                    <?php foreach ( $data['edges'] as $i => $values) :
                        if ( !empty( $value ) ) : ?>

                            <div class="<?= ($i == 0) ? 'active' : ''; ?> d-flex justify-content-center gap-4  selected-material" id="table-collection2">
                                <?php foreach ( $values as $single ) :
                                    if ( !empty( $single ) ) : ?>

                                        <div class="d-flex flex-column" >
                                            <img decoding="async" src="<?= $single['image']; ?>" alt="<?= $single['text']; ?>" class="icon-32 mx-auto">
                                            <span class="mt-2 size-14 text-center"><?= $single['text']; ?></span>
                                        </div>

                                    <?php endif;
                                endforeach; ?>
                            </div>

                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <h3 class="size-16 fw-semibold border border-1 p-2 text-center">Shapes</h3>

                <div class="d-flex flex-column align-items-center justify-content-center w-100 h-100 py-4 px-2">
                    <?php foreach ( $data['shapes'] as $i => $values) :
                        if ( !empty( $value ) ) : ?>

                            <div class="<?= ($i == 0) ? 'active' : ''; ?> d-flex justify-content-center gap-4 selected-material" id="table-collection3">
                                <?php foreach ( $values as $single ) :
                                    if ( !empty( $single ) ) : ?>

                                        <div class="d-flex flex-column">
                                            <img decoding="async" src="<?= $single['image']; ?>" alt="<?= $single['text']; ?>" class="icon-32 mx-auto">
                                            <span class="mt-2 size-14 text-center"><?= $single['text']; ?></span>
                                        </div>

                                    <?php endif;
                                endforeach; ?>
                            </div>

                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>

        <?php if ( !empty( $button ) ) : ?>
            <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="object-fit-cover mt-sm-5 mt-4 py-2 px-4 size-18 fw-semibold text-center color-1 border border-1 color-border-1 rounded-pill text-decoration-none mt-4 width-fit mx-auto d-block btn-over-3"><?= $button['title']; ?></a>
        <?php endif; ?>

    </div>
</section>
