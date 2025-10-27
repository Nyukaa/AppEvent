<?php get_header(); ?>

<section class="hero">
    <canvas id="heroCanvas"></canvas>
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Find your community - grow your network!</h1>
            <div class="hero-buttons">
                <a href="/events" class="hero-cta"> <i class="fa-solid fa-calendar-days"></i> <span>Explore Events</span></a>
                <a href="/communities" class="hero-cta"><i class="fa-solid fa-users"></i> Join Communities</a>
            </div>
            <a class="hero-link" href="http://event.local/what-does-networking-mean/"><span>What does networking mean?</span> <i class="fa-solid fa-arrow-right"></i> </a>
        </div>
    </div>
</section>

<div class="home-sections">

    <!-- The latest 3 aticles -->
    <section class="latest-recipes">
        <h2>Latest Articles</h2>
        <div class="recipe-grid">
            <?php
            $latest = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3
            ]);
            if ($latest->have_posts()):
                while ($latest->have_posts()): $latest->the_post(); ?>
                    <article class="recipe-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): the_post_thumbnail('medium');
                            endif; ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>No recipes found.</p>
            <?php endif; ?>
        </div>
    </section>


</div>

<?php get_footer(); ?>