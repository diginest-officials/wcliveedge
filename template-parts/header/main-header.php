<?php
    $page_header = get_field('black_header') ?: false;
    $page_header_spacing = get_field('top_spacing') ? 'pt-5' : '';

    $product_header = get_field('product_black_header', 'options');
    $shop_header = get_field('shop_black_header', 'options');
    $site_logos = get_field('site_logos', 'options');
    $account = get_field('account', 'options');
    $search = get_field('search', 'options');
    $cart = get_field('cart', 'options');
    $menu = get_field('burger_menu', 'options');

    $option = $shop_header && is_shop() || $product_header && is_product() || $product_header && is_product_category() || is_cart() || is_checkout() || is_account_page() || $page_header;

    $header = $option ? 'position-relative' : 'position-absolute top-0 start-0';
    $text = $option ? 'color-1 btn-over-6' : 'text-white btn-over';
    $logo = $option ? $site_logos['black_logo'] : $site_logos['white_logo'];
    $logo_sm = $option ? $site_logos['black_logo_mobile'] : $site_logos['white_logo_mobile'];
    $account_img = $option ? $account['black_icon'] : $account['white_icon'];
    $search_img = $option ? $search['black_icon'] : $search['white_icon'];
    $cart_img = $option ? $cart['black_icon'] : $cart['white_icon'];
    $cart_border = $option ? 'color-border-1 btn-over-7' : 'border-white btn-over-2';
    $menu_img = $option ? $menu['black_icon'] : $menu['white_icon'];
?>
<header class="header-spacing-xxl w-100 <?php echo esc_attr($header); ?>  z-3">
    <div class="container-fluid py-3">
        <div class="row align-items-center py-1">
            <div class="col-5 d-none d-lg-block">
                <ul class="d-flex gap-4 align-items-center list-style-none">
                    <?php $main_menu = get_field('main_menu', 'options');
                    
                    if ( $main_menu['left_menu']) : 
                        foreach ( $main_menu['left_menu'] as $menu_item ) : 
                            if ( $menu_item['link']) : ?>
                                <li>
                                    <a
                                        href="<?php echo $menu_item['link']['url']; ?>"
                                        class="<?php echo esc_attr($text); ?> text-decoration-none fw-medium size-xxl-18 size-lg-16"
                                        target="<?php echo $menu_item['link']['target']; ?>">

                                        <?php echo $menu_item['link']['title']; ?>
                                    </a>
                                </li>
                            <?php endif; 
                        endforeach;
                    endif; ?>
                </ul>
            </div>
            <div class="col-lg-2 col text-lg-center">
                <a href="/">
                    <img
                        src="<?php echo $logo['url']; ?>"
                        alt="<?php echo $logo['alt']; ?>"
                        class="d-sm-block d-none"
                    />
                    <img
                        src="<?php echo $logo_sm['url']; ?>"
                        alt="<?php echo $logo_sm['alt']; ?>"
                        class="d-sm-none d-block"
                    />
                </a>
            </div>
            <div class="col-lg-5 col">
                <div class="d-flex align-items-center justify-content-end">
                    <ul class="d-none d-lg-flex gap-4 align-items-center list-style-none pe-4">
                        <?php $main_menu = get_field('main_menu', 'options');
                        
                        if ( $main_menu['right_menu']) : 
                            foreach ( $main_menu['right_menu'] as $menu_item ) : 
                                if ( $menu_item['link']) : ?>
                                    <li>
                                        <a
                                            href="<?php echo $menu_item['link']['url']; ?>"
                                            class="<?php echo esc_attr($text); ?> text-decoration-none fw-medium size-xxl-18 size-lg-16"
                                            target="<?php echo $menu_item['link']['target']; ?>">

                                            <?php echo $menu_item['link']['title']; ?>
                                        </a>
                                    </li>
                                <?php endif; 
                            endforeach;
                        endif; ?>
                    </ul>

                    <div class="d-flex align-items-center gap-2 gap-lg-3 gap-sm-4 gap-xl-4 ps-0 ps-lg-4 border-start border-3 color-border-6 tablet-border-none">
                        <?php $search_option = $search['search_option'];
                        
                        if ( $search_option ) : ?>
                            <button class="btn border-0 p-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#searchbar" aria-expanded="false" aria-controls="searchbar">
                                <img
                                    src="<?php echo esc_attr($search_img); ?>"
                                    alt="Search icon"
                                    class="icon-32 d-none d-lg-block"
                                />
                            </button>
                        <?php endif; 
                        
                        $account_link = $account['link'];
                        if ( $account_link ) : ?>
                            <a href="<?= $account_link;; ?>" class="btn border-0 p-0 d-none d-lg-block">
                                <img
                                    src="<?php echo esc_attr($account_img); ?>"
                                    alt="User icon"
                                    class="icon-32"/>
                            </a>
                        <?php endif;

                        $cart_link = $cart['cart_page'];
                        $cart_count = WC()->cart->get_cart_contents_count(); // Get total cart item count

                        if ($cart_link): ?>
                            <a href="<?php echo esc_url($cart_link); ?>"
                                class="text-decoration-none d-flex align-items-center gap-3 py-2 px-4 border border-1 <?php echo esc_attr($cart_border); ?> rounded-pill size-xxl-18 size-lg-16">
                                
                                <img src="<?php echo esc_url($cart_img); ?>" alt="Cart icon" class="icon-24"/>
                                
                                <?php if ($cart['enable_count']): ?>
                                    <span class="<?php echo esc_attr($text); ?> fw-semibold no-hover cart-count no-hover"><?php echo $cart_count; ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif;

                        $account_link = $account['link'];
                        if ( $menu_img ) : ?>
                            <button class="btn border-0 p-0 d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu">
                                <img
                                    src="<?= $menu_img; ?>"
                                    alt="Menu icon"
                                    class="icon-32"/>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if ( $search_option ) : ?>
        <div class="position-relative">
            <div class="position-absolute top-0 end-0 width-max-430 w-100 rounded-2 color-bg-1 collapse" id="searchbar">
                <button type="button" class="btn-close p-3 float-end position-relative z-1" style="filter: invert(1); box-shadow: none;" id="searchbar-close"></button>
                <div class="position-relative mx-3">
                    <input type="search" name="site-search" id="site-search" placeholder="Search..." autocomplete="off" spellcheck="false" class="border border-1 color-border-input rounded-3 py-2 ps-2 pe-5 w-100">
                    <img src="https://wcliveedge.com/wp-content/uploads/2025/01/icon-search-black.svg" alt="Search icon" class="icon-24 position-absolute end-0 bottom-0 mb-2 me-2">
                </div>

                <div id="search-results" class="mx-3 mt-4 mb-3"></div>
            </div>
        </div>
    <?php endif; 

    get_template_part('template-parts/header/offcanvas'); ?>
    
</header>

<div class="<?= $page_header_spacing; ?>"></div>