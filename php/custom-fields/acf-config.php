<?php
/*
 * ACF Blocks for Gutenberg
 * Author: Haroon Yamin
 * Author URL: https://www.linkedin.com/in/haroon-webdev/
**/

// ACF Blocks
function register_acf_block($name, $title, $description, $template) {
    acf_register_block(array(
        'name' => 'acf/' . $name,
        'title' => __($title),
        'description' => __($description),
        'render_template' => __DIR__ . '/blocks/' . $template . '.php',
        'category' => 'formatting',
        'icon' => 'testimonial',
        'keywords' => array($name, 'section'),
    ));
}

function blocks_from_json() {
    if (function_exists('acf_register_block')) {
        $json_file = __DIR__ . '/acf-blocks.json';

        // Load and decode JSON
        if (file_exists($json_file)) {
            $blocks = json_decode(file_get_contents($json_file), true);

            // Register each block from the JSON file
            foreach ($blocks as $block) {
                register_acf_block(
                    $block['name'],
                    $block['title'],
                    $block['description'],
                    $block['template']
                );
            }
        }
    }
}
add_action('acf/init', 'blocks_from_json');
// ACF Blocks ended

// Add ACF Options Pages
function add_custom_acf_theme_settings() {
    if (function_exists('acf_add_options_page')) {
        // Add parent page
        $parent = acf_add_options_page(array(
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug'  => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect'   => true
        ));

        // Add child pages
        acf_add_options_sub_page(array(
            'page_title'  => 'General Settings',
            'menu_title'  => 'General',
            'parent_slug' => $parent['menu_slug'],
        ));
        acf_add_options_sub_page(array(
            'page_title'  => 'Header Settings',
            'menu_title'  => 'Header',
            'parent_slug' => $parent['menu_slug'],
        ));
        acf_add_options_sub_page(array(
            'page_title'  => 'Footer Settings',
            'menu_title'  => 'Footer',
            'parent_slug' => $parent['menu_slug'],
        ));
        acf_add_options_sub_page(array(
            'page_title'  => 'Shop Settings',
            'menu_title'  => 'Shop',
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}

// Hook the function to ACF initialization
add_action('acf/init', 'add_custom_acf_theme_settings');