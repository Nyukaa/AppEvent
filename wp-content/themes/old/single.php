<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>

        <div class="recipe-container">

            <!-- Dish photo -->
            <div class="recipe-image">
                <?php the_post_thumbnail('large'); ?>
            </div>

            <!-- Parameters: serving, time, difficulty, calories -->
            <div class="recipe-meta">
                <?php if (get_field('servings')): ?>
                    <div class="meta-item">
                        <i class="fa-solid fa-utensils"></i>
                        <span><?php the_field('servings'); ?> servings</span>
                    </div>
                <?php endif; ?>

                <?php if (get_field('cooking_time')): ?>
                    <div class="meta-item">
                        <i class="fa-regular fa-clock"></i>
                        <span><?php the_field('cooking_time'); ?> min</span>
                    </div>
                <?php endif; ?>

                <?php if (get_field('difficulty')): ?>
                    <div class="meta-item">
                        <i class="fa-solid fa-signal"></i>
                        <span><?php the_field('difficulty'); ?></span>
                    </div>
                <?php endif; ?>

                <?php if (get_field('calories')): ?>
                    <div class="meta-item">
                        <i class="fa-solid fa-fire-flame-simple"></i>
                        <span><?php the_field('calories'); ?> kcal</span>
                    </div>
                <?php endif; ?>
            </div>


            <!-- Dish name -->
            <h1 class="recipe-title"><?php the_title(); ?></h1>

            <!-- Ingredients and cooking steps -->
            <div class="recipe-details">

                <div class="ingredients">
                    <h2>Ingredients</h2>
                    <?php
                    $ingredients = get_field('ingredients'); // textarea
                    if ($ingredients):
                        $lines = explode("\n", $ingredients); // розбиваємо по рядках
                        echo '<ul>';
                        foreach ($lines as $line) {
                            if (trim($line) != '') echo '<li>' . esc_html($line) . '</li>';
                        }
                        echo '</ul>';
                    endif;
                    ?>
                </div>

                <div class="instructions">
                    <h2>Instructions</h2>
                    <?php if ($instructions = get_field('instructions')): ?>
                        <div class="instruction-text">
                            <ol>
                                <?php
                                // Split by sentences (. ! ? + space)
                                $steps = preg_split('/(?<=[.!?])\s+/', $instructions);

                                foreach ($steps as $step) {
                                    $step = trim($step);
                                    if ($step !== '') {
                                        echo '<li>' . esc_html($step) . '</li>';
                                    }
                                }
                                ?>
                            </ol>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

    <?php endwhile;
endif; ?>

    <?php get_footer(); ?>
