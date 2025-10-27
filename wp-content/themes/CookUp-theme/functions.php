<?php

// Standard theme functions

function cookup_theme_setup() {
    // Automatic <title> tag
    add_theme_support('title-tag');

    // Featured Image support
    add_theme_support('post-thumbnails');

    // HTML5 markup for the search form
    add_theme_support('html5', array('search-form'));
}
add_action('after_setup_theme', 'cookup_theme_setup');


// Menu

function cookup_register_menus() {
    register_nav_menus([
        'main-menu' => __('Main Menu', 'cookup'),
    ]);
}
add_action('init', 'cookup_register_menus');


// Enqueuing styles and scripts

function cookup_assets() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script(
        'cookup-script',
        get_template_directory_uri() . '/js/cookup.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'cookup_assets');



// Font Awesome for icons

function cookup_load_fontawesome() {
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );
}
add_action('wp_enqueue_scripts', 'cookup_load_fontawesome');
