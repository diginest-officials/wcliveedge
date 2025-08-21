<?php
/*
 * Single page
 * Author: Haroon Yamin
 * Author URL: https://www.linkedin.com/in/haroon-webdev/
**/
get_header(); ?>

<main id="<?php echo get_post_field( 'post_name', get_post() ); ?>">
    <div class="single-post-container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="single-post-title"><?php the_title(); ?></h1>
            
            <div class="single-post-meta">
                Published on <?php echo get_the_date(); ?> | By <?php the_author(); ?>
            </div>

            <?php if ( has_post_thumbnail() ) : ?>
                <img class="single-post-thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
            
            <div class="single-post-content">
                <?php the_content(); ?>
            </div>

            <div class="single-post-footer">
                <?php comments_template(); ?>
            </div>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>