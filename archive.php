<?php
/*
 * Archive Page
 * Author: Haroon Yamin
 * Author URL: https://www.linkedin.com/in/haroon-webdev/
**/

get_header(); ?>

<main id="<?php get_post_field( 'post_name', get_post() ); ?>">
    <div class="archive-container">
        <h1 class="archive-title"><?php the_archive_title(); ?></h1>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="archive-post-item">
                <h2 class="archive-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="archive-post-meta">
                    Published on <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <img class="archive-post-thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>
                
                <div class="archive-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>

                <a class="archive-post-readmore" href="<?php the_permalink(); ?>">Read More</a>
            </div>

        <?php endwhile; else : ?>
            <div class="no-posts-message">No posts found in this archive.</div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>