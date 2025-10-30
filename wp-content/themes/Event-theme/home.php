<?php get_header(); ?>

<section class="articles-list">
    <h1>All Articles</h1>
    <!-- 🔍 Search form -->
    <form role="search" method="get" class="article-search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <input 
            type="search" 
            class="article-search-input" 
            placeholder="Search articles..." 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
            title="Search for:" 
        />
        <input type="hidden" name="post_type" value="post" /> <!-- або 'articles', якщо CPT -->
        <button type="submit" class="article-search-button">Search</button>
    </form>
    <div class="articles-grid">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <article class="article-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="article-thumb">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    </a>
                </article>
            <?php endwhile;
        else: ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>




