<?php $video = get_field('video');
if ($video) : ?>
    <section class="bg-top-center bg-size-cover position-relative color-bg-3 d-grid">
        <video
            src="<?= $video; ?>"
            class="height-85vh w-100 object-fit-cover"
            autoplay
            muted
            loop>
        </video>
        <div class="position-absolute start-0 top-0 w-100 h-100 z-1 pointer-none"style="background: #00000033"></div>
        <div class="bg-video-overlay position-absolute start-0 top-0 w-100 h-100 z-2 pointer-none"></div>

        <div class="position-absolute top-50 start-50 translate-middle w-100 width-max-430 z-3">
            <div class="container">
                <?php $title = get_field('title');
                if ($title) : ?>
                    <h1 class="text-white size-32 size-sm-48 text-center fw-light lh-sm mb-4">
                        <strong class="fw-semibold">Create Your Bespoke Furniture</strong>
                    </h1>
                <?php endif;

                $subtitle = get_field('subtitle');
                if ($subtitle) : ?>
                    <p class="text-white opacity-75 text-center mb-4">
                        <?= $subtitle; ?>
                    </p>
                <?php endif;

                $button = get_field('button');
                if ($button) : ?>
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                        <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"
                            class="text-decoration-none color-3 bg-white py-2 px-4 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold text-center">
                            <?= $button['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>