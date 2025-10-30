<?php get_header(); ?>

<main class="site-main">
    <section class="page-content">
        <h1><?php the_title(); ?></h1>

        <div class="content">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
