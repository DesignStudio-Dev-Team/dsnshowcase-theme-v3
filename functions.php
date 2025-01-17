<?php
require get_template_directory() . '/inc/woocommerce.php';

function dsnshowcase_setup() {
    // Enable featured images
    add_theme_support('post-thumbnails');

    // Enable title tag support
    add_theme_support('title-tag');

    // Add Woocommerce support
    add_theme_support('woocommerce');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dsnshowcase'),
        'footer' => __('Footer Menu', 'dsnshowcase'),
    ));

    // Enable HTML5 support
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'dsnshowcase_setup');


function dsnshowcase_enqueue_styles() {
    wp_enqueue_style(
        'tailwindcss',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'dsnshowcase_enqueue_styles');


function dsnshowcase_get_template($slug, $name = null) {
    get_template_part('templates/' . $slug, $name);
}


?>