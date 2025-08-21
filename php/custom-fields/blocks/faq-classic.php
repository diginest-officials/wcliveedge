<?php
    $heading = get_field('heading');
    $accordion = get_field('accordion');
    $button = get_field('button');
?>

<section class="sec-spacing-lg pt-0">
    <div class="container">
        <div class="row row-gap-3">
            <div class="col-xxl-4 col-lg-5 col-12">
                <h2 class="size-lg-48 size-32 color-1 fw-semibold pt-lg-4 pt-0"><?= $heading; ?></h2>
            </div>
            <div class="col-1 d-none d-xxl-block"></div>
            <div class="col-lg-7 col-12">
                <div id="classic">
                    <?php $last = array_key_last( $accordion );
                    foreach (  $accordion as $i => $item ) :
                        if ( !empty( $item ) ) : ?>

                            <div class=" <?= $i == $last ? '' : 'border-bottom border-1'; ?>">
                                <button class="btn p-0 py-4 color-1 fw-medium size-24 border-0 w-100 faq-btn text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'classic-' . $i; ?>" aria-expanded="<?= $i == 0 ? 'true' : 'false'; ?>" aria-controls="<?= 'classic-' . $i; ?>">
                                    <span class="d-block"><?= $item['title']; ?></span>
                                    <span class="classic-btn color-bg-1 rounded-circle d-block position-relative ms-4"></span>
                                </button>
                                <div id="<?= 'classic-' . $i; ?>" class="accordion-collapse collapse <?= $i == 0 ? 'show' : ''; ?>" data-bs-parent="#classic">
                                    <p class="accordion-body pt-1 pb-4 size-16 color-1 opacity-75">
                                        <?= $item['content']; ?>
                                    </p>
                                </div>
                            </div>

                        <?php endif;
                    endforeach; ?>
                </div>

                <?php if ( $button ) : ?>
                    <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="fw-semibold mt-3 border border-1 color-border-1 rounded-pill size-18 color-1 py-2 px-4 text-decoration-none btn-over-3"><?= $button['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>