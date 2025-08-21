<?php
/*
 * Register Custom Post Types and Taxonomies from JSON
 * Author: Haroon Yamin
 * Author URI: https://www.linkedin.com/in/haroon-webdev/
**/

 function register_cpts_and_taxonomies_from_json() {
    // Load JSON file
    $json_file = __DIR__ . '/cpt-config.json';

    if (file_exists($json_file)) {
        $cpts = json_decode(file_get_contents($json_file), true);

        foreach ($cpts as $cpt) {
            // Register Custom Taxonomy
            if (!empty($cpt['taxonomy'])) {
                $taxonomy_labels = $cpt['taxonomy']['labels'];
                register_taxonomy($cpt['taxonomy']['name'], array($cpt['post_type']), array(
                    'labels' => $taxonomy_labels,
                    'hierarchical' => true,
                    'public' => true,
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'show_in_nav_menus' => true,
                    'show_tagcloud' => true,
                    'show_in_rest' => true,
                ));
            }

            // Register Custom Post Type
            $post_type_labels = $cpt['labels'];
            register_post_type($cpt['post_type'], array(
                'show_in_rest' => true,
                'supports' => $cpt['supports'],
                'rewrite' => array('slug' => $cpt['slug']),
                'has_archive' => true,
                'public' => true,
                'taxonomies' => array($cpt['taxonomy']['name']),
                'labels' => $post_type_labels,
                'menu_icon' => $cpt['menu_icon']
            ));
        }
    }
}

add_action('init', 'register_cpts_and_taxonomies_from_json');