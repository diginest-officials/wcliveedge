<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-8 col-lg-10 col-12 collection-center mw-100">
                <?php $heading = get_field('heading') ?: get_the_title();
                if ( $heading ) : ?>
                    <h1 class="size-lg-48 size-32 mb-4"><?= $heading; ?></h1>
                <?php endif;

                $paragraph = get_field('paragraph');
                if ( $paragraph ) : ?>
                    <p class="size-18"><?= $paragraph; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
