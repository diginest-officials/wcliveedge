<?php $editor = get_field('editor');
if ($editor) : ?>

    <section class="sec-spacing-lg pb-5 position-relative" id="story-editor">
        <?php $top_image = get_field('top_image');
        if ( $top_image ) : 
            echo '<img class="img-fluid position-absolute top-0 end-0 d-none d-xl-block" src="' . $top_image . '" alt="Story Image">';
        endif;

        $bottom_image = get_field('bottom_image');
        if ( $bottom_image ) : 
            echo '<img class="img-fluid position-absolute top-50 start-0 translate-middle-y d-none d-xl-block" src="' . $bottom_image . '" alt="Story Image">';
        endif; ?>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <?= $editor; ?>
                </div>
            </div>
        </div>
    </section>

    <style>
        #story-editor h1 {
            font-size: 3rem;
            margin-bottom: 3rem;
            font-weight: 300;
        }
        #story-editor strong {
            font-weight: 600;
        }
        #story-editor p {
            font-size: 1.75rem;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }
        @media screen and (max-width: 576px) {
            #story-editor h1 {
                font-size: 2rem;
            }
            #story-editor p {
                font-size: 1.25rem;
            }
        }
    </style>

<?php endif; ?>