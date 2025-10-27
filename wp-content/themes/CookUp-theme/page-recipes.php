<?php
/* Template Name: Recipes */
get_header();
?>

<main class="site-main">
    <header class="recipes-header">
        <h1>Recipes</h1>
        <p>A comprehensive collection of dishes to suit every taste and occasion.</p>

        <?php echo do_shortcode('[cooking_tip_block]'); ?>

        <!-- Search form -->
        <div class="recipe-search">
            <?php get_search_form(); ?>
        </div>
    </header>

    <div class="recipes-by-category">
        <?php
        // Get the ID of the main "Recipes" category
        $parent_cat = get_category_by_slug('recipe-category');

        if ($parent_cat) :
            $categories = get_categories(array(
                'taxonomy'   => 'category',
                'hide_empty' => true,
                'parent'     => $parent_cat->term_id, // Only the subcategories of "Recipes"
            ));

            foreach ($categories as $category) :
                // Query for the latest 4 recipes from this category
                $recipes = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'cat'            => $category->term_id,
                ));
        ?>

                <section class="recipe-category-block">
                    <h2><?php echo esc_html($category->name); ?></h2>

                    <?php if ($category->description) : ?>
                        <p class="category-description"><?php echo esc_html($category->description); ?></p>
                    <?php endif; ?>

                    <div class="category-recipes">
                        <?php if ($recipes->have_posts()) : ?>
                            <?php while ($recipes->have_posts()) : $recipes->the_post(); ?>
                                <article <?php post_class('archive-recipe'); ?>>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/recipe-placeholder.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                </article>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        <?php else : ?>
                            <p>No recipes found in this category.</p>
                        <?php endif; ?>
                    </div>

                    <div class="view-all">
                        <a class="btn" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            See all recipes in <?php echo esc_html($category->name); ?>
                        </a>
                    </div>
                </section>

            <?php endforeach; ?>
        <?php else : ?>
            <p>No recipe categories found.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
