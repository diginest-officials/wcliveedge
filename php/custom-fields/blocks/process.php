<section class="sec-spacing-lg">
    <div class="container">
        <?php $heading = get_field('heading');
        if ($heading) : ?>
            <div class="heading heading-black text-center mx-auto text-left text-lg-center width-max-660 width-max-mobile-320 text-center">
                <?= $heading; ?>
            </div>
        <?php endif; ?>

        <div class="row py-lg-5 pt-3 row-gap-5">
            <?php $process = get_field('process');
            if ($process) :
                foreach ($process as $i => $step) :
                    if ($step) : ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <h4 class="size-48 mb-3 opacity-75"><?= sprintf('%02d', $i + 1); ?></h4>
                            <h3 class="size-24 mb-3 fw-medium"><?= $step['title']; ?></h3>
                            <p class="size-20 opacity-85"><?= $step['subtitle']; ?></p>
                        </div>
                    <?php endif;
                endforeach;
            endif; ?>
        </div>

        <?php $button = get_field('button');
        if ($button) : ?>
            <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"
                class="mx-auto mt-5 text-decoration-none color-3 color-bg-7 py-3 px-5 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold d-none d-lg-block text-center width-fit">
                <?= $button['title']; ?>
            </a>
        <?php endif; ?>
    </div>
</section>