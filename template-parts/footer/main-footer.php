<footer class="pt-5 border-top border-1 pt-5-jy">
    <div class="container py-4">
        <div class="row row-gap-5 justify-content-between">
            <div class="col-lg-2 col-12 text-center order-1">
                <?php $footer_site_logo = get_field('footer_site_logo', 'option');
                if ( $footer_site_logo ) : ?>
                <img src="<?= $footer_site_logo['url']; ?>" alt="<?= $footer_site_logo['alt']; ?>" class="img-fluid" />
                <?php endif; ?>
            </div>
            <div class="col-1 d-none d-xxl-block order-2"></div>
            <div class="flex-jy">
                <div class="col order-3 reduce-padding-jy">
                    <?php $heading_menu_1 = get_field('heading_menu_1', 'option');
                    if ( $heading_menu_1 ) : ?>
                        <h3 class="size-20 text-black fw-semibold mb-4 size-20-jy"><?= $heading_menu_1; ?></h3>
                    <?php endif; ?>

                    <ul class="list-style-none d-flex flex-column gap-3">
                        <?php $footer_menu_1 = get_field('footer_menu_1', 'option');
                        if (  $footer_menu_1 ) : 
                            foreach ( $footer_menu_1 as $item ) : 
                                if ( !empty( $item ) ) : ?>
                                    <li>
                                        <a class="py-1 w-100 color-3 link-underline link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover link-dark"
                                            href="<?= $item['link']['url']; ?>" target="<?= $item['link']['target']; ?>">
                                            <?= $item['link']['title']; ?>
                                        </a>
                                    </li>
                                <?php endif;
                            endforeach;
                        endif; ?>
                    </ul>
                </div>
                <div class="col order-4">
                    <?php $heading_menu_2 = get_field('heading_menu_2', 'option');
                    if ( $heading_menu_2 ) : ?>
                        <h3 class="size-20 text-black fw-semibold mb-4 size-20-jy"><?= $heading_menu_2; ?></h3>
                    <?php endif; ?>

                    <ul class="list-style-none d-flex flex-column gap-3">
                        <?php $footer_menu_2 = get_field('footer_menu_2', 'option');
                        if (  $footer_menu_2 ) : 
                            foreach ( $footer_menu_2 as $item ) : 
                                if ( !empty( $item ) ) : ?>
                                    <li>
                                        <a class="py-1 w-100 color-3 link-underline link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover link-dark"
                                            href="<?= $item['link']['url']; ?>" target="<?= $item['link']['target']; ?>">
                                            <?= $item['link']['title']; ?>
                                        </a>
                                    </li>
                                <?php endif;
                            endforeach;
                        endif; ?>
                    </ul>
                </div>
                <div class="col-xxl-3 col-lg-4 col-12 order-5 contact-us reduce-padding-jy">
                    <?php $contact = get_field('contact', 'option');
                    if ( $contact ) :
                        foreach ( $contact as $single ) :
                            if ( !empty( $single ) ) : ?>
                                <div class="mb-4">
                                    <?php

                                    ?>
                                    <h4 class="size-20 opacity-75 size-20-jy"><?= $single['label']; ?></h4>
                                    <?php
                                        $address = $single['address'];
                                        $disable_url = $single['disable_url'];
                                        $url = (!$disable_url) ? ('href="' . $address['url'] . '"') : '';
                                        $formatted_title = str_replace(',', ',<br>', $address['title']);
                                    ?>

                                    <a <?= $url; ?> target="<?= $address['target']; ?>"
                                        class="size-20 py-1 w-100 color-3 link-underline link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover link-dark fw-semibold size-20-jy">
                                        <?= $formatted_title; ?>
                                    </a>
                                </div>
                            <?php endif;
                        endforeach;
                    endif; ?>
                </div>
            </div>
            <!-- Hide the social media section until they're ready -->
            <!-- <div class="col-lg-2 order-lg-6 order-2">
                <h3 class="size-20 text-black fw-semibold mb-4">Follow Us</h3>
                <div class="d-flex flex-wrap align-items-center gap-4">
                    <a href="#">
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-facebook.svg"
                            alt="Icon Facebook"
                            class="icon-32"
                        />
                    </a>
                    <a href="#">
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-youtube.svg"
                            alt="Icon Youtube"
                            class="icon-32"
                        />
                    </a>
                    <a href="#">
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-instagram.svg"
                            alt="Icon Instagram"
                            class="icon-32"
                        />
                    </a>
                </div>
            </div> -->
        </div>
    </div>
    <div class="border-top border-1 d-flex justify-content-center all-rights-reserved">
        <div class="container d-flex">
            <div
                class="d-flex margin-footer-jy"
            >
                <?php $copyright = get_field('copyright', 'option');
                if ( $copyright ) : ?>
                    <p class="d-flex size-16 opacity-85 text-center size-16-jy margin-footer-jy">
                        <?= $copyright; ?>
                    </p>
                <?php endif; 
                
                $payment_methods = get_field('payment_methods', 'option');
                if ( $payment_methods ) : ?>
                    <div class="d-flex align-items-center gap-3 py-3 flex-wrap py-3-jy gap-3-jy" style="display: none !important;">
                        <?php foreach (  $payment_methods as $image ) :
                            if ( !empty( $image ) ) : ?>
                                <img src="<?= $image['url']; ?>" alt="Payment" class="payment-method-img" />
                            <?php endif;
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
