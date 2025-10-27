<?php get_header(); ?>

<main class="category-recipes-container">

    <!-- Header -->
    <header class="category-header">
        <h1><?php single_cat_title(); ?></h1>
        <?php if (category_description()) : ?>
            <p class="category-description"><?php echo category_description(); ?></p>
        <?php endif; ?>

        <?php echo do_shortcode('[cooking_tip_block]'); ?>

        <!-- Search -->
        <div class="recipe-search">
            <?php get_search_form(); ?>
        </div>
    </header>

    <!-- Recipes Grid -->
    <?php if (have_posts()) : ?>
        <div class="recipes-container">
            <div class="category-recipes">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('archive-recipe'); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    <?php else : ?>
        <p>No recipes found in this category.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
