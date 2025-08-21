<?php
$bg_image = get_field('bg_image');
$heading = get_field('heading');
$paragraph = get_field('paragraph');
$button = get_field('button');
?>

<section class="position-relative">
    <?php if ( $bg_image ) : ?>
    <img src="<?= $bg_image; ?>" alt="<?= $heading ?: ''; ?>" class="object-fit-cover position-absolute top-0 start-0 w-100 h-100">
    <?php endif; ?>

    <div class="container position-relative z-1 height-70vh">
        <div class="pt-4 pb-sm-2"></div>
        <div class="d-flex flex-column align-items-center justify-content-center h-100 width-max-770 mx-auto">
            <h1 class="size-lg-48 size-32 fw-semibold text-white mb-4 text-center"><?= $heading ?: get_the_title(); ?></h1>
            
            <?php if ( $paragraph ) : ?>
                <p class="size-lg-20 size-18 text-white mb-4 text-center"><?= $paragraph; ?></p>
            <?php endif; ?>
                
            <?php if ( !empty( $button ) ) : ?>
                <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="size-18 fw-semibold bg-white color-1 text-center py-3 px-5 rounded-pill text-decoration-none btn-over-3">
                    <?= $button['title']; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
