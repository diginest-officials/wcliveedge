<?php
    $heading = get_field( 'heading' );
    $accordion = get_field( 'accordion' );
?>

<section class="pt-0 pb-5">
    <div class="container">
        <div class="mx-auto" style="max-width: 870px">
            <?php if ( $heading ) : ?>
                <h1 class="size-lg-48 size-32 fw-semibold color-1 mb-4"><?= $heading; ?></h1>
            <?php endif; ?>

            <div id="classic">
                <?php $last = array_key_last( $accordion );
                foreach (  $accordion as $i => $item ) :
                    if ( !empty( $item ) ) : ?>
            
                        <div class=" <?= $i == $last ? '' : 'border-bottom border-1'; ?>">
                            <button class="btn p-0 py-4 color-1 fw-medium size-24 border-0 w-100 faq-btn text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'classic-' . $i; ?>" aria-expanded="<?= $i == 0 ? 'true' : 'false'; ?>" aria-controls="<?= 'classic-' . $i; ?>">
                                <span class="d-block"><?= $item['title']; ?></span>
                                <span class="classic-btn color-bg-1 rounded-circle d-block position-relative ms-4"></span>
                            </button>
                            <div id="<?= 'classic-' . $i; ?>" class="accordion-collapse collapse <?= $i == 0 ? 'show' : ''; ?>">
                                <div class="accordion-body pt-1 pb-4 size-16 color-1 opacity-75">
                                    <?= $item['content']; ?>
                                </div>
                            </div>
                        </div>
                        
                    <?php endif;
                endforeach; ?>
            </div>

        </div>
    </div>
</section>