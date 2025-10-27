<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>
            <div class="excerpt"><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile;
else: ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php get_footer(); ?>
