<?php get_header(); ?>

<main class="site-main">
    <div class="search-header">
        <h1>Search Results for: "<?php echo get_search_query(); ?>"</h1>
    </div>

    <?php if (have_posts()) : ?>
        <div class="recipe-list">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('archive-recipe'); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No recipes found. Try another search.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
