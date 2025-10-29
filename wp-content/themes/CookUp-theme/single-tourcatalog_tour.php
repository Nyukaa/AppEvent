<?php get_header(); ?>

<article class="single-tour">
  <div class="tour-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <h1 class="tour-title"><?php the_title(); ?></h1>

      <?php if (has_post_thumbnail()): ?>
        <div class="tour-thumb">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <?php
        // ✅ Get meta data
        $time     = get_post_meta(get_the_ID(), '_tourcatalog_meta_time', true);
        $place    = get_post_meta(get_the_ID(), '_tourcatalog_meta_place', true);
        $forwhom  = get_post_meta(get_the_ID(), '_tourcatalog_meta_forwhom', true);
        $language = get_post_meta(get_the_ID(), '_tourcatalog_meta_language', true);

        // ✅ Get categories
        $categories = wp_get_post_terms(get_the_ID(), 'tourcatalog_tour_category');
        $main_cat   = $categories ? $categories[0]->name : '';
        $subcategory = (count($categories) > 1) ? $categories[1]->name : '';
      ?>

      <div class="tour-meta">
        <?php if ($main_cat): ?>
          <p><strong>Category:</strong> <?php echo esc_html($main_cat); ?></p>
        <?php endif; ?>
        <?php if ($subcategory): ?>
          <p><strong>Subcategory:</strong> <?php echo esc_html($subcategory); ?></p>
        <?php endif; ?>
        <?php if ($place): ?>
          <p><strong>Place:</strong> <?php echo esc_html($place); ?></p>
        <?php endif; ?>
        <?php if ($time): ?>
          <p><strong>Time:</strong> <?php echo esc_html($time); ?></p>
        <?php endif; ?>
        <?php if ($forwhom): ?>
          <p><strong>For whom:</strong> <?php echo esc_html($forwhom); ?></p>
        <?php endif; ?>
        <?php if ($language): ?>
          <p><strong>Language:</strong> <?php echo esc_html($language); ?></p>
        <?php endif; ?>
      </div>

      <div class="tour-content">
        <?php the_content(); ?>
      </div>

      <div class="tour-cta">
        <a href="/contact" class="btn">Join or Learn More</a>
      </div>

    <?php endwhile; endif; ?>
  </div>
</article>

<?php get_footer(); ?>
