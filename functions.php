<?php
/**
 * Theme Constants
 * Define paths following WordPress standards
 */
define( 'DSN_THEME_DIR', get_template_directory() );
define( 'DSN_THEME_URI', get_template_directory_uri() );
define( 'DSN_THEME_PATH', str_replace( ABSPATH, '/', DSN_THEME_DIR ) );

require DSN_THEME_DIR . '/inc/acfs.php';
require DSN_THEME_DIR . '/inc/nav-items.php';
require DSN_THEME_DIR . '/inc/other-functions.php';
require DSN_THEME_DIR . '/inc/wp-rocket-compatibility.php';
require DSN_THEME_DIR . '/inc/woocommerce.php';

/**
 * Enqueue Font Awesome for theme icons (only on front-end).
 * Define DSN_DISABLE_FONT_AWESOME to true to skip loading if another plugin or theme provides it.
 */
if (!defined('DSN_DISABLE_FONT_AWESOME') || DSN_DISABLE_FONT_AWESOME !== true) {
    add_action('wp_enqueue_scripts', function() {
        // Use Font Awesome 5 (free) from CDN. Change version if you use a kit or different version.
        wp_enqueue_style('dsn-fontawesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', array(), '5.15.4');
    }, 20);
}


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
    if (is_page() || is_product() || is_cart()) {
        // Slick Slider CSS
        wp_enqueue_style('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        // Slick Slider JS
        wp_enqueue_script('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null, true);

        // Custom JS for initializing the slider
        wp_enqueue_script('custom-blocks-slider', get_template_directory_uri() . '/assets/js/custom-blocks-slider.js', ['slick-slider'], null, true);

        // Product slider initialization
        if (is_product()) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('product-slider', get_template_directory_uri() . '/assets/js/product-slider.js', ['jquery', 'slick-slider'], time(), true);
        }
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




function dss_toggle_admin_bar() {
  if (current_user_can('administrator')) {
    ?>
    <style>
      html {
        margin-top: 0 !important;
      }
      #wpadminbar {
        transform: translateY(-100%);
        transition: all 0.3s ease-in-out !important;
        opacity: 0;
      }
      #wpadminbar.show {
        transform: translateY(0);
        opacity: 1;
      }
      .dss-toggle-admin-bar {
        position: fixed;
        top: 0px;
        right: 0px;
        z-index: 99999;
        background-color: #0e0e0e;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        z-index: 999999999999999;
      }
      #wpadminbar {
        z-index:  999;
      }
      .dss-toggle-admin-bar svg {
        transition: transform 0.3s ease, fill 0.3s ease;
      }

      .dss-toggle-admin-bar:hover {
        background-color: #000;
        transform: scale(1.1);
      }
      .dss-toggle-admin-bar {
        transform: rotate(180deg);
      }
      .dss-toggle-admin-bar.active {
        transform: rotate(0deg);
      }
      .dss-toggle-admin-bar svg {
        width: 16px;
        height: 16px;
        fill: #fff;
      }
      body.admin-bar-visible {
        margin-top: 32px !important;
      }
      @media screen and (max-width: 782px) {
        body.admin-bar-visible {
          margin-top: 46px !important;
        }
      }
    </style>
    <div class="dss-toggle-admin-bar">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
        <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/>
      </svg>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('.dss-toggle-admin-bar');
        const adminBar = document.getElementById('wpadminbar');
        const body = document.body;
        let isVisible = localStorage.getItem('adminBarVisible') === 'true';

        function updateAdminBarState(visible) {
          if (visible) {
            adminBar.classList.add('show');
            toggleButton.classList.add('active');
            body.classList.add('admin-bar-visible');
          } else {
            adminBar.classList.remove('show');
            toggleButton.classList.remove('active');
            body.classList.remove('admin-bar-visible');
          }
        }

        // Initialize state
        updateAdminBarState(isVisible);

        toggleButton.addEventListener('click', function() {
          isVisible = !isVisible;
          updateAdminBarState(isVisible);
          localStorage.setItem('adminBarVisible', isVisible);
        });
      });
    </script>
    <?php
  }
}
add_action('wp_head', 'dss_toggle_admin_bar');


/**
 * Function to safely deactivate and delete plugins
 * 
 * @param string $plugin_slug The plugin slug/path relative to plugins directory
 * @return bool|WP_Error True on success, WP_Error on failure
 */
function dss_deactivate_and_delete_plugin($plugin_slug) {
    // Check if user has sufficient permissions
    if (!current_user_can('delete_plugins')) {
        return new WP_Error('insufficient_permissions', __('You do not have sufficient permissions to delete plugins.'));
    }

    // Validate plugin slug
    if (empty($plugin_slug) || !is_string($plugin_slug)) {
        return new WP_Error('invalid_plugin', __('Invalid plugin slug provided.'));
    }

    // Include required WordPress files if not already included
    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    try {
        // Check if plugin exists
        $all_plugins = get_plugins();
        if (!array_key_exists($plugin_slug, $all_plugins)) {
            // also return good since the plugin doesn't exists anymore so it doesn't keep running
            return true; // Plugin does not exist, nothing to deactivate or delete
        }

        // Deactivate plugin if active
        if (is_plugin_active($plugin_slug)) {
            deactivate_plugins($plugin_slug, true); // Second parameter true means network wide if applicable
            
            // Verify deactivation was successful
            if (is_plugin_active($plugin_slug)) {
                return new WP_Error('deactivation_failed', __('Failed to deactivate plugin.'));
            }
        }

        // Delete plugin
        $deleted = delete_plugins(array($plugin_slug));
        if (is_wp_error($deleted)) {
            return $deleted; // Return the error if deletion failed
        }

        if (!$deleted) {
            return new WP_Error('deletion_failed', __('Failed to delete plugin.'));
        }

        return true;
    } catch (Exception $e) {
        return new WP_Error('unexpected_error', $e->getMessage());
    }
}

// Hook for admin initialization
add_action('admin_init', function() {
    // Only run if we're in the admin area
    if (!is_admin()) {
        return;
    }

    // Deactivate and delete the Admin Bar Toggle plugin
    $result = dss_deactivate_and_delete_plugin('admin-bar-toggle/jck-adminbar-toggle.php');
    
    if (is_wp_error($result)) {
        // Log error or handle it appropriately
        error_log('Plugin deactivation/deletion failed: ' . $result->get_error_message());
    }
});


// Add canonical tag for all pages with query strings
// add_action( 'wp_head', function() {
//     global $wp;

//     // Check if the request has query parameters
//     if ( ! empty( $_GET ) ) {
//         // Get the current URL without query string
//         $base_url = home_url( add_query_arg( array(), $wp->request ) );

//         // Output the canonical tag
//         echo '<link rel="canonical" href="' . esc_url( $base_url ) . '" />' . "\n";
//     }
// });

// For Yoast SEO so the titles are not too long
add_filter('wpseo_title', function($title) {
    if (strlen($title) > 60) {
        $title = substr($title, 0, 57) . '…';
    }
    return $title;
});

// Prevent Google indexing of pages that start with /wp-content/ or /wp-json
add_action( 'template_redirect', function() {
    $request_uri = $_SERVER['REQUEST_URI'];

    if ( strpos( $request_uri, '/wp-content/' ) === 0 || strpos( $request_uri, '/wp-json' ) === 0 ) {
        header( 'X-Robots-Tag: noindex, nofollow', true );
    }
});


// disable xmlrpc
add_filter('xmlrpc_methods', function () {
    return [];
}, PHP_INT_MAX);

add_filter('xmlrpc_enabled', '__return_false');






















// -------------------------
// WP Admin Security: Prevent Session Sharing Across IPs
// -------------------------
function asl_log($msg) {
    // $path = ABSPATH . 'asl_debug.log';
    // $ts = date('Y-m-d H:i:s');
    // if (is_array($msg) || is_object($msg)) $msg = print_r($msg, true);
    // @error_log("[$ts] $msg\n", 3, $path);
}

function asl_get_ip() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) return trim($_SERVER['HTTP_CF_CONNECTING_IP']);
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

add_action('wp_login', function($user_login, $user) {
    if (!user_can($user, 'manage_options')) return;

    $ip = asl_get_ip();
    update_user_meta($user->ID, '_asl_last_ip', $ip);
    asl_log([
        'event' => 'wp_login',
        'user' => $user_login,
        'user_id' => $user->ID,
        'ip' => $ip
    ]);
}, 10, 2);

add_action('admin_init', function() {
    if (!is_user_logged_in()) return;

    $user = wp_get_current_user();
    if (!user_can($user, 'manage_options')) return;

    $current_ip = asl_get_ip();
    $stored_ip = get_user_meta($user->ID, '_asl_last_ip', true);

    asl_log([
        'event' => 'admin_init',
        'user_id' => $user->ID,
        'current_ip' => $current_ip,
        'stored_ip' => $stored_ip
    ]);

    if ($stored_ip && $current_ip !== $stored_ip) {
        asl_log("IP mismatch for user {$user->ID}. Logging out.");
        wp_logout();
        wp_redirect(wp_login_url() . '?asl_ip_mismatch=1');
        exit;
    }
}, 10);

add_action('login_message', function($msg) {
    if (isset($_GET['asl_ip_mismatch'])) {
        $msg = '<p class="message message-error">You were logged out because your login session was used from a different IP address.</p>';
    }
    return $msg;
});

add_action('password_reset', function($user, $new_pass) {
    delete_user_meta($user->ID, '_asl_last_ip');
}, 10, 2);