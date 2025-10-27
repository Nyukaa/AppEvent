


<?php
function tourcatalog_shortcode($attr) {
    $defaults = array('category' => 'all');
    $cat = shortcode_atts($defaults, $attr);

    if ($cat['category'] == 'all') {
        $args = array(
            'post_type' => 'tourcatalog_tour',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        );
    } else {
        $args = array(
            'post_type' => 'tourcatalog_tour',
            'tax_query' => array(
                array(
                    'taxonomy' => 'tourcatalog_tour_category',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($cat['category'])
                )
            ),
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        );
    }

    $loop = new WP_Query($args);

    // wrapper
    $text = '<div class="tour-catalog-wrapper">';

    // 🔹 Добавляем кнопки фильтра
    $text .= '
    <div class="tour-filter-buttons">
        <button class="tour-filter-btn" data-category="all">All</button>
        <button class="tour-filter-btn" data-category="event">Events</button>
        <button class="tour-filter-btn" data-category="community">Community</button>
    </div>';

    $text .= '<div class="tour-catalog">';

    if ($loop->have_posts()) : 
        while ($loop->have_posts()) : $loop->the_post();
            $price    = get_post_meta(get_the_ID(), '_tourcatalog_meta_price', true);
            $duration = get_post_meta(get_the_ID(), '_tourcatalog_meta_duration', true);
            $time     = get_post_meta(get_the_ID(), '_tourcatalog_meta_time', true);
            $place    = get_post_meta(get_the_ID(), '_tourcatalog_meta_place', true);

            // 🔹 Получаем категории тура
            $categories = wp_get_post_terms(get_the_ID(), 'tourcatalog_tour_category', array('fields' => 'slugs'));
            $category_data = !empty($categories) ? esc_attr($categories[0]) : 'uncategorized';

            // 🔹 Добавляем data-category
            $text .= '<section class="tour" data-category="' . $category_data . '" data-time="' . esc_attr($time) . '" data-place="' . esc_attr($place) . '">';
            $text .= '<h3>' . get_the_title() . '</h3>';
            $text .= '<p class="tour-meta price">' . esc_html($price) . ' €</p>';
            $text .= '<p class="tour-meta duration">' . esc_html($duration) . ' hours</p>';
            $text .= '<p class="tour-meta date">' . esc_html($time) . '</p>';
            $text .= '<p class="tour-meta place">' . esc_html($place) . '</p>';
            $text .= get_the_post_thumbnail();
            $text .= get_the_content();
            $text .= '</section>';
        endwhile;
    else :
        $text .= '<p>No tours found</p>';
    endif;

    $text .= '</div>'; // close .tour-catalog grid
    $text .= '</div>'; // close .tour-catalog-wrapper

    wp_reset_postdata();

    // 🔹 Добавляем JS для фильтрации
    $text .= "
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.tour-filter-btn');
        const tours = document.querySelectorAll('.tour');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.getAttribute('data-category');
                tours.forEach(tour => {
                    if (category === 'all' || tour.dataset.category === category) {
                        tour.style.display = 'block';
                    } else {
                        tour.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
    ";

    return $text;
}
add_shortcode('tour-catalog', 'tourcatalog_shortcode');
?>
