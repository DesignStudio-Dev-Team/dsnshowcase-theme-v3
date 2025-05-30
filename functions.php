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

add_filter('pre_set_site_transient_update_themes', 'dsn_custom_theme_update');

function dsn_custom_theme_update($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }

    $theme_slug = 'dsnshowcase';
    $current_version = wp_get_theme($theme_slug)->get('Version');
    error_log('Current Theme Version: ' . $current_version);

    $local_update_file = get_theme_root( $theme_slug ) . '/' . $theme_slug . '/theme-update-info.json';

    if (file_exists($local_update_file)) {
        $response_body = file_get_contents($local_update_file);

        if ($response_body === false) {
            error_log('Error reading local update file: ' . $local_update_file);
            return $transient;
        }

        // Attempt to decode the local JSON
        $decoded_response = json_decode($response_body, true);

        // Basic check if decoding resulted in an array
        if (is_array($decoded_response) && ! empty($decoded_response)) {
            error_log('JSON decoded successfully from local file.');
            error_log('Decoded Response (local): ' . print_r($decoded_response, true));

            $remote_version = isset($decoded_response['version']) ? $decoded_response['version'] : null;
            $details_url = isset($decoded_response['details_url']) ? $decoded_response['details_url'] : null;
            $download_url = isset($decoded_response['download_url']) ? $decoded_response['download_url'] : null;

            if ($remote_version && $details_url && $download_url) {
                error_log('Remote Theme Version (from local): ' . $remote_version);

                if (version_compare($current_version, $remote_version, '<')) {
                    error_log('Version comparison (local): ' . $current_version . ' < ' . $remote_version . ' is TRUE. Adding update info.');
                    $transient->response[$theme_slug] = [
                        'theme'       => $theme_slug,
                        'new_version' => $remote_version,
                        'url'         => $details_url,
                        'package'     => $download_url,
                    ];
                    error_log('Transient Response after adding update (local): ' . print_r($transient->response, true));
                } else {
                    error_log('Version comparison (local): ' . $current_version . ' < ' . $remote_version . ' is FALSE. No update added.');
                }
            } else {
                error_log('Error: Missing required keys (version, details_url, download_url) in local JSON response.');
            }
        } else {
            error_log('Error: Could not decode JSON or empty response from local file.');
            error_log('Raw Response Body (local): ' . $response_body);
        }

    } else {
        error_log('Local update file not found: ' . $local_update_file);
    }

    return $transient;
}














// add_action('save_post', 'sync_acf_fields_on_default_language_save', 20, 3);

// function sync_acf_fields_on_default_language_save($post_id, $post, $update) {
    
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
//     if (wp_is_post_revision($post_id)) return;
    
//     $default_lang = apply_filters('wpml_default_language', null);

//     // Get language info of the current post, including trid
//     $language_args = [
//         'element_id'   => $post_id,
//         'element_type' => $post->post_type
//     ];
//     $current_lang = apply_filters('wpml_element_language_details', null, $language_args);

//     if (!$current_lang || $current_lang->language_code !== $default_lang) {
//         return;
//     }

    
//     // Now get the trid from language info
//     $trid = $current_lang->trid ?? null;
//     if (!$trid) {
//         return;
//     }

//     // Get all translations for this trid
//     $translations = apply_filters('wpml_get_element_translations', null, $trid, $post->post_type);
//     if (!$translations || !is_array($translations)) {
//         return;
//     }

    
//     foreach ($translations as $lang_code => $translation) {
    
//         if ($lang_code === $default_lang) continue;

//         $translated_post_id = $translation->element_id;
    
//         $fields = get_fields($post_id);
//         if ($fields) {
//             foreach ($fields as $key => $value) {
//                 update_field($key, $value, $translated_post_id);
//             }
//         } 
//     }
// }


// add_action('wpml_pro_translation_completed', 'sync_acf_fields_after_translation', 10, 1);

// function sync_acf_fields_after_translation($translated_post_id) {
    
//     if (!$translated_post_id) {
//         return;
//     }

//     $post_type = get_post_type($translated_post_id);
//     if (!$post_type) {
//         return;
//     }
    
//     // Get language details for the translated post
//     $language_args = [
//         'element_id' => $translated_post_id,
//         'element_type' => $post_type,
//     ];
//     $translated_lang = apply_filters('wpml_element_language_details', null, $language_args);

//     if (!$translated_lang) {
//         return;
//     }
    
//     $default_lang = apply_filters('wpml_default_language', null);
    
//     if ($translated_lang->language_code === $default_lang) {
//         return;
//     }

//     // Find the original post ID in the default language
//     $original_post_id = apply_filters(
//         'wpml_object_id',
//         $translated_post_id,
//         $post_type,
//         true, // must be original (default language)
//         $default_lang
//     );

//     if (!$original_post_id) {
//         return;
//     }
    
//     // Get ACF fields from original post
//     $fields = get_fields($original_post_id);
//     if (!$fields) {
//         return;
//     }

    
//     foreach ($fields as $key => $value) {
//         update_field($key, $value, $translated_post_id);
//     }

// }


?>