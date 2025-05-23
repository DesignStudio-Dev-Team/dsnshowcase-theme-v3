<?php
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/acfs.php';
require get_template_directory() . '/inc/nav-items.php';
require get_template_directory() . '/inc/other-functions.php';

// Custom debug logger for theme
function dsn_theme_debug_log($message) {
    $log_file = get_template_directory() . '/debug.log';
    $date = date('Y-m-d H:i:s');
    $formatted = "[$date] $message\n";
    file_put_contents($log_file, $formatted, FILE_APPEND | LOCK_EX);
}

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

// Hook theme updater early
function dsn_init_theme_updater() {
    error_log('[Theme Update] Initializing theme updater hooks');
    add_filter('pre_set_site_transient_update_themes', 'dsn_custom_theme_update', 10, 1);
}

// Force theme update check
function dsn_force_theme_update_check() {
    error_log('[Theme Update] Manually forcing theme update check');
    delete_site_transient('update_themes');
    wp_update_themes();
    error_log('[Theme Update] Manual theme update check completed');
}

// Add init hooks
add_action('init', 'dsn_init_theme_updater');
add_action('admin_init', 'dsn_init_theme_updater');

// Add a temporary admin menu item to force update check
function dsn_add_force_update_menu() {
    add_submenu_page(
        'themes.php',
        'Force Theme Update Check',
        'Force Theme Update Check',
        'manage_options',
        'force-theme-update',
        'dsn_force_theme_update_check'
    );
}
add_action('admin_menu', 'dsn_add_force_update_menu');

function dsn_custom_theme_update($transient) {
  
    if (!is_object($transient)) {
        dsn_theme_debug_log('[Theme Update] $transient is not an object: ' . print_r($transient, true));
        return $transient;
    }

    if (empty($transient->checked)) {
        dsn_theme_debug_log('[Theme Update] $transient->checked is empty');
        return $transient;
    }

    $theme_slug = 'dsnshowcase';
    $current_version = wp_get_theme($theme_slug)->get('Version');
  
    // First try GitHub update info
    $github_update_file = 'https://raw.githubusercontent.com/DesignStudio-Dev-Team/dsnshowcase-theme-v3/main/theme-update-info.json';
    dsn_theme_debug_log('[Theme Update] Checking GitHub update file: ' . $github_update_file);
    
    // Use WordPress HTTP API instead of file_get_contents
    $response = wp_safe_remote_get($github_update_file);
    
    if (is_wp_error($response)) {
        dsn_theme_debug_log('[Theme Update] GitHub request failed: ' . $response->get_error_message());
        // Fallback to local file
        $local_update_file = get_theme_root($theme_slug) . '/' . $theme_slug . '/theme-update-info.json';
        dsn_theme_debug_log('[Theme Update] Trying local file: ' . $local_update_file);
        
        if (!file_exists($local_update_file)) {
            dsn_theme_debug_log('[Theme Update] Local update file not found');
            return $transient;
        }
        $response_body = file_get_contents($local_update_file);
    } else {
        dsn_theme_debug_log('[Theme Update] GitHub request successful');
        $response_body = wp_remote_retrieve_body($response);

        if ($response_body === false) {
            dsn_theme_debug_log('[Theme Update] File read error: ' . error_get_last()['message']);
            return $transient;
        }

        // Attempt to decode the local JSON
        $decoded_response = json_decode($response_body, true);
        $json_error = json_last_error();

        // Basic check if decoding resulted in an array
        if ($json_error !== JSON_ERROR_NONE) {
            dsn_theme_debug_log('[Theme Update] JSON decode error: ' . json_last_error_msg());
            return $transient;
        }

        if (is_array($decoded_response) && !empty($decoded_response)) {
            dsn_theme_debug_log('[Theme Update] JSON decoded successfully from local file.');
            dsn_theme_debug_log('[Theme Update] Decoded Response (local): ' . print_r($decoded_response, true));

            $remote_version = isset($decoded_response['version']) ? $decoded_response['version'] : null;
            $details_url = isset($decoded_response['details_url']) ? $decoded_response['details_url'] : null;
            $download_url = isset($decoded_response['download_url']) ? $decoded_response['download_url'] : null;

            // Normalize versions by stripping leading 'v' or 'V'
            $normalized_current = ltrim($current_version, 'vV');
            $normalized_remote = ltrim($remote_version, 'vV');

            if ($remote_version && $details_url && $download_url) {
                dsn_theme_debug_log('[Theme Update] All required version info found');
                dsn_theme_debug_log('[Theme Update] Comparing versions: current=' . $normalized_current . ' remote=' . $normalized_remote);

                if (version_compare($normalized_current, $normalized_remote, '<')) {
                    dsn_theme_debug_log('[Theme Update] Update available! Current: ' . $normalized_current . ', Remote: ' . $normalized_remote);
                    // Use the download_url as-is. The ZIP must contain a folder named dsnshowcase at its root.
                    $package_url = $download_url;
                    dsn_theme_debug_log('[Theme Update] Using package URL: ' . $package_url);
                    $transient->response[$theme_slug] = [
                        'theme'       => $theme_slug,
                        'new_version' => $remote_version,
                        'url'         => $details_url,
                        'package'     => $package_url,
                    ];
                    dsn_theme_debug_log('[Theme Update] Update data added to transient');
                    dsn_theme_debug_log('[Theme Update] Final transient data: ' . print_r($transient->response[$theme_slug], true));
                } else {
                    dsn_theme_debug_log('[Theme Update] No update needed - current version ' . $normalized_current . ' >= ' . $normalized_remote);
                }
            } else {
                dsn_theme_debug_log('[Theme Update] Missing required fields in theme-update-info.json');
            }
        } else {
            dsn_theme_debug_log('[Theme Update] Invalid or empty JSON in theme-update-info.json');
            dsn_theme_debug_log('[Theme Update] Raw file contents: ' . $response_body);
        }
    } 
    return $transient;
}
?>