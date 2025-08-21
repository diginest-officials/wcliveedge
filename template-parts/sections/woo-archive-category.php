<?php $object = get_queried_object(); ?>

<div class="d-flex flex-nowrap align-items-center my-5 gap-sm-4 overflow-hidden">
    <?php $icon_back = get_field('back_icon', 'option');
    $shop_url = wc_get_page_permalink('shop');
    
    // Check if it's not the shop page and if the back icon exists
    if (!is_shop() && !empty($icon_back)): ?>
        <a href="<?php echo esc_url($shop_url); ?>" class="width-fit width-min-42 d-none d-sm-block">
            <img src="<?php echo esc_url($icon_back); ?>" alt="Back icon" class="icon-42">
        </a>
    <?php endif;

    // Get current category ID
    $current_category_id = is_tax('product_cat') ? $object->term_id : 0;
    $get_parent_id = $object->parent ?: '';

    // Get parent categories
    $parent_categories = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'parent'     => 0,
    ]);

    $category_found = false;

    // Display parent categories
    if (!is_wp_error($parent_categories) && !empty($parent_categories)): ?>
        <div class="swiper swiper-category mx-auto width-fit">
            <!-- <div class="swiper-wrapper gap-3 gap-jy-5"> -->
            <div class="swiper-wrapper gap-3">

                <?php 
                foreach ($parent_categories as $category):
                    $category_data = [
                        'name'  => $category->name,
                        'link'  => get_term_link($category->term_id, 'product_cat'),
                        'image' => get_field('category_image', 'product_cat_' . $category->term_id)
                    ]; 
                    
                    if ( ($current_category_id == $category->term_id) || ($get_parent_id == $category->term_id) ): 
                        $category_found = true; ?>

                        <div class="swiper-slide">
                            <a href="<?php echo esc_url($category_data['link']); ?>"
                            class="product-category-link width-min-130 text-center text-decoration-none pb-2 d-none d-sm-block">
                                <img src="<?php echo esc_url($category_data['image']['url']); ?>"
                                alt="<?php echo esc_attr($category_data['name']); ?>"
                                class="height-110 width-130 object-fit-cover">
                                <h3 class="size-16 color-1 pt-2 pb-1">
                                    <?php echo esc_html($category_data['name']); ?>
                                </h3>
                            </a>
                        </div>
                        
                        <?php endif;
                endforeach; 
                
                if (!$category_found):
                    $count = 0;
                    foreach ($parent_categories as $category):
                        $category_data = [
                            'name'  => $category->name,
                            'link'  => get_term_link($category->term_id, 'product_cat'),
                            'image' => get_field('category_image', 'product_cat_' . $category->term_id)
                        ];
                        
                        if ($count > 0):
                            echo '<div class="opacity-25 color-bg-1 height-90 p-0 d-none d-sm-block" style="width: 4px;"></div>';
                        endif; ?>

                        <div class="swiper-slide width-fit">
                            <a href="<?php echo esc_url($category_data['link']); ?>" 
                                class="product-category-link width-min-130 text-center text-decoration-none pb-2">
                                <img src="<?php echo esc_url($category_data['image']['url']); ?>" 
                                alt="<?php echo esc_attr($category_data['name']); ?>" 
                                class="height-110 width-130 object-fit-cover">
                                <h3 class="size-16 color-1 pt-2 pb-1">
                                    <?php echo esc_html($category_data['name']); ?>
                                </h3>
                            </a>
                        </div>

                        <?php
                        $get_child = $get_parent_id ?: $category->term_id;
                        
                        if ($get_child > 0 && $count == 0):
                            $child_categories = get_terms([
                                'taxonomy'   => 'product_cat',
                                'hide_empty' => true,
                                'parent'     => $get_child
                            ]);

                            if ($child_categories):
                                echo '<div class="opacity-25 color-bg-1 height-90 p-0 d-none d-sm-block" style="width: 2px;"></div>';
                            endif;

                            if (!is_wp_error($child_categories) && !empty($child_categories)): ?>
                                <div class="swiper swiper-category-2 mx-0 overflow-x-auto display-none-460">
                                    <div class="swiper-wrapper">
                                        <?php
                                        foreach ($child_categories as $child):
                                            $child_data = [
                                                'name'  => $child->name,
                                                'link'  => get_term_link($child->term_id, 'product_cat'),
                                                'image' => get_field('category_image', 'product_cat_' . $child->term_id)
                                            ]; ?>

                                            <div class="swiper-slide width-fit">
                                                <a href="<?php echo esc_url($child_data['link']); ?>" 
                                                class="text-center width-min-130 text-decoration-none pb-2 <?php echo $object->term_id == $child->term_id ? 'child_active' : ''; ?>">
                                                    <img src="<?php echo esc_url($child_data['image']['url']); ?>" 
                                                    alt="<?php echo esc_attr($child_data['name']); ?>" 
                                                    class="height-110 width-130 object-fit-cover">
                                                    <h3 class="size-16 color-1 pt-2 pb-1">
                                                        <?php echo esc_html($child_data['name']); ?>
                                                    </h3>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="archive-scrollbar-2 mt-4 d-block d-sm-none" style="height: 3px;"></div>
                                </div>
                            <?php endif;
                        endif;
                        $count++;
                        ?>
                    <?php endforeach;
                endif; ?>
            </div>
            <div class="archive-scrollbar mt-4 d-block d-sm-none" style="height: 3px;"></div>
        </div>

        <?php if ($category_found):
            echo '<div class="opacity-25 color-bg-1 height-90 p-0 d-none d-sm-block" style="width: 2px;"></div>';
        endif; ?>

        <?php
        $get_child = $get_parent_id ?: $current_category_id;
        // Display child categories if we're on a parent category page
        if ($get_child > 0):
            $child_categories = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'parent'     => $get_child
            ]);

            if (!is_wp_error($child_categories) && !empty($child_categories)): ?>
                <div class="swiper swiper-category-2 mx-0 overflow-x-auto">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($child_categories as $child):
                            $child_data = [
                                'name'  => $child->name,
                                'link'  => get_term_link($child->term_id, 'product_cat'),
                                'image' => get_field('category_image', 'product_cat_' . $child->term_id)
                            ]; ?>

                            <div class="swiper-slide width-fit">
                                <a href="<?php echo esc_url($child_data['link']); ?>" 
                                class="text-center width-min-130 text-decoration-none pb-2 <?php echo $object->term_id == $child->term_id ? 'child_active' : ''; ?>">
                                    <img src="<?php echo esc_url($child_data['image']['url']); ?>" 
                                    alt="<?php echo esc_attr($child_data['name']); ?>" 
                                    class="height-110 width-130 object-fit-cover">
                                    <h3 class="size-16 color-1 pt-2 pb-1">
                                        <?php echo esc_html($child_data['name']); ?>
                                    </h3>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="archive-scrollbar-2 mt-4 d-block d-sm-none" style="height: 3px;"></div>
                </div>
            <?php endif;
        endif;
    endif; ?>
</div>
