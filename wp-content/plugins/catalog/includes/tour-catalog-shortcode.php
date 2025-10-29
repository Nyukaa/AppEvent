<?php
function tourcatalog_shortcode($attr) {
    $defaults = array('category' => 'all');
    $cat = shortcode_atts($defaults, $attr);

    if ($cat['category'] == 'all') {
        $args = array(
            'post_type'      => 'tourcatalog_tour',
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
        );
    } else {
        $args = array(
            'post_type'      => 'tourcatalog_tour',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'tourcatalog_tour_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($cat['category']),
                ),
            ),
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
        );
    }

    $loop = new WP_Query($args);

    $text  = '<div class="tour-catalog-wrapper">';
    $text .= '<div class="tour-catalog">';

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();

            // --- Custom meta fields ---
            $time     = get_post_meta(get_the_ID(), '_tourcatalog_meta_time', true);
            $place    = get_post_meta(get_the_ID(), '_tourcatalog_meta_place', true);
            $forwhom  = get_post_meta(get_the_ID(), '_tourcatalog_meta_forwhom', true);
            $language = get_post_meta(get_the_ID(), '_tourcatalog_meta_language', true);

            // --- Get category + subcategory ---
            $categories  = wp_get_post_terms(get_the_ID(), 'tourcatalog_tour_category');
            $main_cat    = $categories ? $categories[0]->slug : 'uncategorized';
            $subcategory = (count($categories) > 1) ? $categories[1]->name : '';

            // --- Build tour block ---
            $text .= '<section class="tour"
                data-category="'   . esc_attr($main_cat)   . '"
                data-subcategory="' . esc_attr($subcategory) . '"
                data-time="'       . esc_attr($time)       . '"
                data-place="'      . esc_attr($place)      . '"
                data-forwhom="'    . esc_attr($forwhom)    . '"
                data-language="'   . esc_attr($language)   . '">';

            $text .= '<h3>' . esc_html(get_the_title()) . '</h3>';

            $text .= '<p class="tour-meta language">' . esc_html($language) . '</p>';
            $text .= '<p class="tour-meta forwhom">'  . esc_html($forwhom)  . '</p>';
            
            // 👇 Only show date if NOT "community"
            if ($main_cat !== 'community' && $cat['category'] !== 'community') {
                $text .= '<p class="tour-meta date">' . esc_html($time) . '</p>';
            }

            $text .= '<p class="tour-meta place">' . esc_html($place) . '</p>';

            $text .= get_the_post_thumbnail();

            if ($subcategory) {
                $text .= '<p class="subcategory"> ' . esc_html($subcategory) . '</p>';
            }

            // --- Show excerpt (or trim content) ---
            $content = get_the_excerpt();
            if (!$content) {
                $content = wp_trim_words(get_the_content(), 10, '...');
            }
            $text .= '<p class="tour-excerpt">' . esc_html($content) . '</p>';

            $permalink = get_permalink();
            $text .= '<a href="' . esc_url($permalink) . '" class="tour-btn">Read more</a>';

            $text .= '</section>';

        endwhile;
    else :
        $text .= '<p>No tours found</p>';
    endif;

    $text .= '</div></div>';

    wp_reset_postdata();

    return $text;
}
add_shortcode('tour-catalog', 'tourcatalog_shortcode');
?>
