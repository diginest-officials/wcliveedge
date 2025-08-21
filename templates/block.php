<?php
/**
 * Template Name: Block
 * 
 * A clean and optimized template for block-based content.
 * This template provides a minimal structure while maintaining
 * proper WordPress template hierarchy.
 *
 * @package HaroonYamin
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();

/**
 * Generate unique class name based on post slug
 * Sanitize the output for security
 */
$page_class = sanitize_html_class(get_post_field('post_name', get_post()));

/**
 * Main content area
 */
?>
<main id="block-page" class="block-page <?php echo esc_attr($page_class); ?>">
    <?php
    // Check if there's content to display
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>

<?php
/**
 * Load footer template
 */
get_footer();