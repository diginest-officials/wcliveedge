<?php
    $heading = get_field('heading');
    $paragraph = get_field('paragraph');
    $blocks = get_field('blocks');
?>

<section class="sec-spacing-jy">
    <div class="container">
        <?php if ( !empty( $heading ) ) : ?>
            <h1 class="size-lg-48 size-32 text-center mb-4 fw-semibold"><?= $heading; ?></h1>
        <?php endif; ?>

        <?php if ( !empty( $paragraph) ) : ?>
            <p class="size-18 color-1 opacity-75 width-max-770 mx-auto text-center"><?= $paragraph; ?></p>
        <?php endif; ?>

        <div class="row row-gap-3 mt-5">
            <?php if ( !empty( $blocks ) ) : 
                foreach (  $blocks as $block ) :
                    if ( !empty( $block ) ) : ?>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="d-flex gap-4 p-4 border border-1 rounded-2">
                                <?php if ( !empty( $block['icon'] ) ) : ?>
                                    <img src="<?= $block['icon']; ?>" alt="Icon" class="icon-45 my-2">
                                <?php endif; ?>

                                <div class="ps-1 py-2">
                                    <?php if ( !empty( $block['title'] ) ) : ?>
                                        <h3 class="size-24 color-1 fw-semibold"><?= $block['title']; ?></h3>
                                        <div class="mb-2 pb-1"></div>
                                    <?php endif; ?>

                                    <?php if ( !empty( $block['text'] ) ) : ?>
                                        <p class="size-16 mb-4 opacity-75"><?= $block['text']; ?></p>
                                    <?php endif; ?>

                                    <?php if ( !empty( $block['link'] ) ) : ?>
                                        <a href="<?= $block['link']['url']; ?>" target="<?= $block['link']['target']; ?>" class="py-2 px-3 border border-1 color-border-1 size-18 rounded-1 color-1 text-decoration-none"><?= $block['link']['title']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endif;
                endforeach;
            endif; ?>
        </div>
    </div>
</section>
