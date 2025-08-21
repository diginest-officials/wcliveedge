<section class="sec-spacing-lg" style="display: none;"> <!-- JY on Feb 12: Hide this section -->
    <div class="container">
        <?php $heading = get_field('heading');
        if ($heading) : ?>
            <div class="mb-4" id="story-editor">
                <?= $heading; ?>
            </div>
        <?php endif; ?>

        <div class="row flex-nowrap overflow-x-auto pb-lg-0 pb-4">
            <?php $members = get_field('members');
            if ($members) :
                foreach ($members as $member) : 
                    if ($member) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-10">
                            <img class="img-fluid" src="<?= $member['image']['url']; ?>" alt="<?= $member['name']; ?>">

                            <h3 class="size-sm-24 mobile-size-20 mt-3 fw-semibold"><?= $member['name']; ?></h3>
                            <h4 class="size-sm-18 size-16 mt-2 fw-medium opacity-75"><?= $member['role']; ?></h4>
                        </div>
                    <?php endif;
                endforeach;
            endif; ?>
        </div>
    </div>
</section>

<style>
    #story-editor h2 {
        font-size: 3rem;
        font-weight: 300;
    }
    @media screen and (max-width: 576px ) {
        #story-editor h2 {
            font-size: 1.75rem;
        }
        .mobile-size-20 {
            font-size: 20px !important;
        }
    }
</style>
