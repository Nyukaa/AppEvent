<?php
class TourCatalog_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'tourcatalog_widget', // ID
            __('Tour Catalog Widget', 'tourcatalog'), // Name
            array('description' => __('Displays a random or latest tour', 'tourcatalog'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Query random tour
        $query = new WP_Query(array(
            'post_type'      => 'tourcatalog_tour',
            'posts_per_page' => 1,
            'orderby'        => 'rand'
        ));

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
               $place = get_post_meta(get_the_ID(), '_tourcatalog_meta_place', true);

                echo '<div class="tour-widget">';
                echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                if (has_post_thumbnail()) {
                    echo '<div class="tour-thumb">' . get_the_post_thumbnail(get_the_ID(), 'thumbnail') . '</div>';
                }
                echo '<p><strong>Place:</strong> ' . esc_html($place) . '</p>';
                echo '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<p>No tours available.</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Featured Tour', 'tourcatalog');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input 
                class="widefat" 
                id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                type="text" 
                value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Register widget
function register_tourcatalog_widget() {
    register_widget('TourCatalog_Widget');
}
add_action('widgets_init', 'register_tourcatalog_widget');
?>
