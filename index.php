<?php get_header(); ?>

<main id="<?php get_post_field( 'post_name', get_post() ); ?>">
    <div class="index-post-container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="index-post-item">
                <h2 class="index-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="index-post-meta">
                    Published on <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <img class="index-post-thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>
                
                <div class="index-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>

                <a class="index-post-readmore" href="<?php the_permalink(); ?>">Read More</a>
            </div>

        <?php endwhile; else : ?>
            <div class="no-posts-message">No posts found.</div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>