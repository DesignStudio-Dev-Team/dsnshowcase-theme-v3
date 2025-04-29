<?php
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/acfs.php';
require get_template_directory() . '/inc/nav-items.php';
require get_template_directory() . '/inc/other-functions.php';

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
		'utility_left' => __('Utility Left Menu', 'dsnshowcase'),
		'utility_right' => __('Utility Right Menu', 'dsnshowcase'),
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
	    wp_enqueue_style(
        'stylesheet',
        get_template_directory_uri() . '/style.css',
        array(),
        filemtime(get_template_directory() . '/style.css')
    );
}
add_action('wp_enqueue_scripts', 'dsnshowcase_enqueue_styles');

function dsnshowcase_get_template($slug, $name = null) {
    get_template_part('templates/' . $slug, $name);
}

//Add mega menu logo and banner using ACF
add_filter('wp_nav_menu_objects', 'dsn_wp_nav_menu_objects', 10, 2);

function dsn_wp_nav_menu_objects( $items, $args ) {
  
  // loop
  foreach( $items as $item ) {
    
    // vars
    $brand_logo_button = get_field('brand_logo', $item);
    $brand_logo = get_field('menu_brand_logo', $item);
    $banner_button = get_field('menu_banner', $item);
    $banner_image = get_field('menu_banner_image', $item);
    
    // append icon
    if( $brand_logo && $brand_logo_button == 'true' ) {
        $item->title .= '<img class="dsn:w-48 dsn:h-20 dsn:object-contain dsn:bg-gray-200 dsn:p-4 dsn:-mt-6 dsn:z-10 dsn:relative" src="'.$brand_logo['url'].'" />';
    } elseif( $banner_image && $banner_button == 'true' ) {
        $item->title .= '<img class="dsn:w-48 dsn:-mt-6 dsn:z-10 dsn:relative" src="'.$banner_image['url'].'" />';
    }
    
  }
  
  // return
  return $items;
  
}

function enqueue_slick_slider_assets() {
    if (is_page()) { // Load only on pages
        // Slick Slider CSS
        wp_enqueue_style('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        // Slick Slider JS
        wp_enqueue_script('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null, true);

        // Custom JS for initializing the slider
        wp_enqueue_script('custom-blocks-slider', get_template_directory_uri() . '/assets/js/custom-blocks-slider.js', ['slick-slider'], null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');

add_shortcode('hello_code', 'custom_shortcode');
function custom_shortcode () {
    echo "Form goes here...";
}

add_filter( 'posts_search_orderby', function( $search_orderby ) {
    global $wpdb;
    
    $orderby = "{$wpdb->posts}.post_type LIKE 'product' DESC";
    
    if ( ! empty( $search_orderby ) ) {
        $orderby .= ", {$search_orderby}";
    }
    
    return $orderby;
});
?>