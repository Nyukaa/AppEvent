
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

    <!-- The latest 3 articles -->
    <section class="latest-articles">
        <h2>Latest Articles</h2>
        <div class="article-grid">
            <?php
            $latest = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3
            ]);
            if ($latest->have_posts()):
                while ($latest->have_posts()): $latest->the_post(); ?>
                    <article class="latest-article-card">
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

<!-- The latest 3 events -->
<section class="latest-events">
  <h2>Latest Events</h2>
  <div class="event-grid">
    <?php
    $latest_events = new WP_Query([
        'post_type'      => 'tourcatalog_tour',
        'posts_per_page' => 3,
        'tax_query'      => [
            [
                'taxonomy' => 'tourcatalog_tour_category',
                'field'    => 'slug',
                'terms'    => 'event', // заміни на slug категорії events
            ],
        ],
    ]);

    if ($latest_events->have_posts()):
        while ($latest_events->have_posts()): $latest_events->the_post();

            // Кастомні поля
            $time     = get_post_meta(get_the_ID(), '_tourcatalog_meta_time', true);
            $place    = get_post_meta(get_the_ID(), '_tourcatalog_meta_place', true);
            $forwhom  = get_post_meta(get_the_ID(), '_tourcatalog_meta_forwhom', true);

            // Отримуємо excerpt або короткий опис
            $content = get_the_excerpt();
            if (!$content) {
                $content = wp_trim_words(get_the_content(), 6, '...');
            }
            ?>
            
            <article class="event-card">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                <h3><?php the_title(); ?></h3>

                <div class="event-meta">
                  <?php if ($time): ?>
                    <p><strong>Date:</strong> <?php echo esc_html($time); ?></p>
                  <?php endif; ?>

                  <?php if ($place): ?>
                    <p><strong>Place:</strong> <?php echo esc_html($place); ?></p>
                  <?php endif; ?>

                  <?php if ($forwhom): ?>
                    <p><strong>Audience:</strong> <?php echo esc_html($forwhom); ?></p>
                  <?php endif; ?>
                </div>

                <p class="event-excerpt"><?php echo esc_html($content); ?></p>
              </a>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else: ?>
        <p>No events found.</p>
    <?php endif; ?>
  </div>
</section>


    
    <!-- The latest 3 communities -->
    <section class="latest-communities">
        <h2>Latest Communities</h2>
        <div class="community-grid">
            <?php
            $latest_communities = new WP_Query([
                'post_type'      => 'tourcatalog_tour',
                'posts_per_page' => 3,
                'tax_query'      => [
                    [
                        'taxonomy' => 'tourcatalog_tour_category',
                        'field'    => 'slug',
                        'terms'    => 'community' // 👈 заміни на slug категорії community
                    ]
                ]
            ]);

            if ($latest_communities->have_posts()):
                while ($latest_communities->have_posts()): $latest_communities->the_post(); ?>
                    <article class="community-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>No communities found.</p>
            <?php endif; ?>
        </div>
</section>


</div>

<?php get_footer(); ?>



