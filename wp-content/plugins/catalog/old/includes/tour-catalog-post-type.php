<?php
function tourcatalog_register_post_type() {
    add_theme_support('post-thumbnails');

    $labels = array(
        'name'               => 'Tours',
        'singular_name'      => 'Tour',
        'add_new'            => 'New Tour',
        'add_new_item'       => 'Add New Tour',
        'edit_item'          => 'Edit Tour',   
        'new_item'           => 'New Tour',
        'view_item'          => 'View Tour',
        'search_items'       => 'Search Tours',
        'not_found'          => 'No Tours Found',
        'not_found_in_trash' => 'No Tours Found in Trash',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'hierarchical'  => false,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-location-alt',
        'supports'      => array('title','editor','excerpt','custom-fields','thumbnail'),
        'rewrite'       => array('slug' => 'tours'),
        'show_in_rest'  => true,
    );

    register_post_type('tourcatalog_tour', $args);
}
add_action('init', 'tourcatalog_register_post_type');

/* Add custom meta boxes */
function tourcatalog_add_custom_boxes() {
    add_meta_box('tourcatalog_price_id', 'Price', 'tourcatalog_price_box_html', 'tourcatalog_tour');
    add_meta_box('tourcatalog_duration_id', 'Duration', 'tourcatalog_duration_box_html', 'tourcatalog_tour');
   add_meta_box('tourcatalog_time_id', 'Time', 'tourcatalog_time_box_html', 'tourcatalog_tour');

    add_meta_box('tourcatalog_place_id', 'Place', 'tourcatalog_place_box_html', 'tourcatalog_tour');
}
add_action('add_meta_boxes', 'tourcatalog_add_custom_boxes');

/* Box HTML functions */
function tourcatalog_price_box_html($post) {
    $value = get_post_meta($post->ID, '_tourcatalog_meta_price', true);
    ?>
    <label for="tourcatalog_price">Price ($): </label>
    <input type="number" name="tourcatalog_price" id="tourcatalog_price" value="<?php echo esc_attr($price); ?>" step="0.01" min="0" />

    <?php
}

function tourcatalog_duration_box_html($post) {
    $value = get_post_meta($post->ID, '_tourcatalog_meta_duration', true);
    ?>
    <label for="tourcatalog_duration">Duration (hours): </label>
    <input type="number" name="tourcatalog_duration" id="tourcatalog_duration" value="<?php echo esc_attr($duration); ?>" step="0.25" min="0" />

    <?php
}

function tourcatalog_time_box_html($post) {
    $value = get_post_meta($post->ID, '_tourcatalog_meta_time', true);
    ?>
    <label for="tourcatalog_time">Time: </label>
    <input type="date" name="tourcatalog_time" id="tourcatalog_time" value="<?php echo esc_attr($value); ?>" />
    <?php
}

function tourcatalog_place_box_html($post) {
    $value = get_post_meta($post->ID, '_tourcatalog_meta_place', true);
    ?>
    <label for="tourcatalog_place">Place: </label>
    <input type="text" name="tourcatalog_place" id="tourcatalog_place" value="<?php echo esc_attr($value); ?>" />
    <?php
}

/* Save all meta fields */
function tourcatalog_save_postdata($post_id) {
    $fields = array(
        'tourcatalog_price'   => '_tourcatalog_meta_price',
        'tourcatalog_duration'=> '_tourcatalog_meta_duration',
        'tourcatalog_time'     => '_tourcatalog_meta_time',
        'tourcatalog_place'   => '_tourcatalog_meta_place',
    );

    foreach ($fields as $field => $meta_key) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta(
                $post_id,
                $meta_key,
                sanitize_text_field($_POST[$field])
            );
        }
    }
}
add_action('save_post', 'tourcatalog_save_postdata');

/* Register taxonomy (tour category) */
function tourcatalog_register_taxonomy() {
    $labels = array(
        'name'              => 'Tour Categories',
        'singular_name'     => 'Tour Category',
        'search_items'      => 'Search Tour Categories',
        'all_items'         => 'All Tour Categories',
        'edit_item'         => 'Edit Tour Category',
        'update_item'       => 'Update Tour Category',
        'add_new_item'      => 'Add New Tour Category',
        'new_item_name'     => 'New Tour Category Name',
        'menu_name'         => 'Tour Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'tour-category'),
        'show_admin_column' => true,
        'show_in_rest'      => true,
    );

    register_taxonomy('tourcatalog_tour_category', array('tourcatalog_tour'), $args);
}
add_action('init', 'tourcatalog_register_taxonomy');
?>
