<?php
function my_tailwind_theme_setup() {
    // Enable featured images
    add_theme_support('post-thumbnails');

    // Enable title tag support
    add_theme_support('title-tag');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dsshowcase-theme'),
        'footer' => __('Footer Menu', 'dsshowcase-theme'),
    ));

    // Enable HTML5 support
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'my_tailwind_theme_setup');


function my_tailwind_theme_enqueue_styles() {
    wp_enqueue_style(
        'tailwindcss',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'my_tailwind_theme_enqueue_styles');


function dsshowcase_get_template($slug, $name = null) {
    get_template_part('templates/' . $slug, $name);
}

?>