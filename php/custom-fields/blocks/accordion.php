<section class="sec-spacing-lg pt-0">
    <div class="container">
        <div
            class="row align-items-center flex-lg-row flex-column-reverse gap-lg-0 gap-5"
        >
            <div class="col-xl-5 col-lg-6 col-12">
                <?php $heading = get_field('heading');
                if ($heading) : ?>
                    <div class="heading heading-black width-max-430 mb-4 mb-lg-5">
                        <?= $heading; ?>
                    </div>
                <?php endif; ?>

                <div class="accordion" id="accordion">
                    <?php $faqs = get_field('faq');
                    if ($faqs) :
                        foreach ($faqs as $i => $faq) :
                            if ($faq) : ?>
                                <div class=" border-bottom border-1 border-top-0 border-start-0 border-end-0 rounded-0" >
                                    <h3 class="size-24 fw-medium">
                                        <button
                                            class="accordion-button bg-transparent ps-0 size-24 fw-medium color-3 outline-none collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#about-<?= $i; ?>"
                                            aria-expanded="false"
                                            aria-controls="about-<?= $i; ?>">
                                            <?=  $faq['title']; ?>
                                        </button>
                                    </h3>
                                    <div
                                        id="about-<?= $i; ?>"
                                        class="accordion-collapse collapse"
                                        data-bs-parent="#accordion"
                                    >
                                        <div class="accordion-body size-18 px-0">
                                            <?= $faq['body']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; 
                        endforeach; 
                    endif; ?>
                </div>

                <?php $button = get_field('button');
                if ($button) : ?>
                    <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"
                        class="text-decoration-none text-white color-bg-3 py-2 px-4 border border-1 rounded-pill btn-over-5 size-18 fw-semibold width-fit text-center mt-5 border-white">
                        <?= $button['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-1 d-xl-block d-none"></div>
            <div class="col-lg-6 col-12">
                <?php $image = get_field('image');
                if ($image) : ?>
                    <img
                        class="height-sm-750 height-350 rounded-md w-100 object-fit-cover"
                        src="<?= $image['url']; ?>"
                        alt="<?= $image['alt']; ?>"/>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>