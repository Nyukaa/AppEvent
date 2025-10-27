<?php
/*
Plugin Name: Tour Catalog
Description: A simple plugin to register a tour post type and generate a shortcode to display tours by category. Includes a widget for featured/random tours.
Author: Anna
*/ 
require_once plugin_dir_path(__FILE__) . 'includes/tour-catalog-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/tour-catalog-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/tour-catalog-widget.php';

function tourcatalog_setup_menu(){
    add_menu_page(
        'Tour Catalog',
        'Tour Catalog',
        'manage_options',
        'tourcatalog',
        'tourcatalog_display_admin_page'
    );
}
function tourcatalog_display_admin_page(){
    echo '<h1>Tour Catalog</h1>';
    echo '<p>Use the shortcode <code>[tour-catalog]</code> to show all tours, or <code>[tour-catalog category="your-category"]</code> to show tours from a specific category.</p>';
    echo '<p>A widget is also available.</p>';
}
add_action('admin_menu', 'tourcatalog_setup_menu');

function tourcatalog_assets() {
    wp_enqueue_style('tourcatalog-css', plugins_url('css/tourcatalog.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'tourcatalog_assets');
//add react
function tourcatalog_enqueue_react() {
    wp_enqueue_script(
        'tourcatalog-react',
        plugins_url('react/dist/assets/index-DxDdA6Hb.js', __FILE__), // путь до сборки
        array(), // зависимости (можно ['wp-element'])
        null,
        true // подключаем в футере
    );
}
add_action('wp_enqueue_scripts', 'tourcatalog_enqueue_react');
?>
