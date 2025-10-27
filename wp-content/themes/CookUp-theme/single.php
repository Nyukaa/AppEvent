<?php get_header(); ?>

<article class="single-post">
    <div class="post-container">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <div class="post-meta">
            <span>Published: <?php echo get_the_date(); ?></span>
        </div>
        <?php if (has_post_thumbnail()): ?>
            <div class="post-thumb">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<?php get_footer(); ?>