<div class="offcanvas offcanvas-start" tabindex="-1" id="main-menu" aria-labelledby="main-menu-Label">
    <div class="offcanvas-header mb-2">
        <h5 class="offcanvas-title" id="main-menu-Label">
            <?php $offcanvas_image = get_field('offcanvas_image', 'options');

            if ( $offcanvas_image ) : ?>
            <img
                src="<?php echo $offcanvas_image['url']; ?>"
                alt="<?php echo $offcanvas_image['alt']; ?>"
                class="d-block"/>
            <?php else: ?>
                <span>Main Menu</span>
            <?php endif; ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body">
        <div class="position-relative">
            <input type="search" name="site-search-2" id="site-search-2" placeholder="Search..." autocomplete="off" spellcheck="false" class="border border-1 color-border-input rounded-3 py-2 ps-2 pe-5 w-100">
            <?php $search_img = get_field('search', 'options'); 
            if ( $search_img['black_icon'] ) : ?>
                <img src="<?= $search_img['black_icon']; ?>" alt="Search icon" class="icon-24 position-absolute end-0 top-50 translate-middle-y me-2">
            <?php endif; ?>
        </div>

        <div id="search-results-2" class="mx-3 mt-2 mb-4"></div>

        <ul class="d-flex flex-column gap-1 align-items-start list-style-none">
            <?php $main_menu = get_field('main_menu', 'options');
            
            if ( $main_menu['left_menu']) : 
                foreach ( $main_menu['left_menu'] as $menu_item ) : 
                    if ( $menu_item['link']) : ?>
                        <li>
                            <a
                                href="<?php echo $menu_item['link']['url']; ?>"
                                class=" text-decoration-none fw-medium size-18 color-1 py-2 w-100"
                                target="<?php echo $menu_item['link']['target']; ?>">

                                <?php echo $menu_item['link']['title']; ?>
                            </a>
                        </li>
                    <?php endif; 
                endforeach;
            endif; ?>
        </ul>

        <hr style="max-width: 43px; height: 3px; background: #5B5B5B;" class="my-3">

        <ul class="d-flex flex-column gap-1 align-items-start list-style-none">
            <?php $main_menu = get_field('main_menu', 'options');
            
            if ( $main_menu['right_menu']) : 
                foreach ( $main_menu['right_menu'] as $menu_item ) : 
                    if ( $menu_item['link']) : ?>
                        <li>
                            <a
                                href="<?php echo $menu_item['link']['url']; ?>"
                                class=" text-decoration-none fw-medium size-18 color-1 py-2 w-100"
                                target="<?php echo $menu_item['link']['target']; ?>">

                                <?php echo $menu_item['link']['title']; ?>
                            </a>
                        </li>
                    <?php endif; 
                endforeach;
            endif; ?>

            <?php $account = get_field('account', 'options');

            if ($account) : ?>
                <li>
                    <a
                        href="<?php echo 'https://wcliveedge.com/my-account'; ?>"
                        class=" text-decoration-none fw-medium size-18 color-1 py-2 w-100">

                        <?php echo 'My Account'; ?>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
