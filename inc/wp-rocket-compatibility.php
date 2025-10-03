<?php
/**
 * WP Rocket Compatibility
 * Ensures archive product template scripts work correctly with WP Rocket caching
 * 
 * Reference: https://docs.wp-rocket.me/article/976-exclude-files-from-defer-js
 * 
 * @package dsShowcase Theme
 */

// Only run if WP Rocket is active
if ( ! defined( 'WP_ROCKET_VERSION' ) ) {
  return;
}

/**
 * Exclude archive product template script and jQuery from WP Rocket's Delay JS (lazy load)
 * This prevents the script from being converted to rocketlazyloadscript
 * which would delay execution until user interaction on cached pages
 * 
 * jQuery must also be excluded since our script depends on it
 * 
 * Reference: https://docs.wp-rocket.me/article/1265-delay-javascript-execution
 */
add_filter( 'rocket_delay_js_exclusions', function( $excluded ) {
  if ( ! is_array( $excluded ) ) {
    $excluded = array();
  }
  // Exclude jQuery (dependency)
  $excluded[] = 'jquery-core';
  $excluded[] = 'jquery.min.js';
  $excluded[] = 'jquery.js';
  
  // Exclude our script using theme constant
  $excluded[] = DSN_THEME_PATH . '/assets/js/archive-product-template.js';
  
  return $excluded;
} );

/**
 * Exclude archive product template script from WP Rocket's defer optimization
 * Per WP Rocket docs: use keywords or paths from file URL
 * 
 * Reference: https://docs.wp-rocket.me/article/976-exclude-files-from-defer-js
 */
add_filter( 'rocket_exclude_defer_js', function( $excluded ) {
  if ( ! is_array( $excluded ) ) {
    $excluded = array();
  }
  
  // Exclude our script using theme constant
  $excluded[] = DSN_THEME_PATH . '/assets/js/archive-product-template.js';
  
  return $excluded;
} );

/**
 * Exclude from general JS minification/concatenation
 * Per WP Rocket docs: prevents issues with WooCommerce fragments
 */
add_filter( 'rocket_exclude_js', function( $excluded ) {
  if ( ! is_array( $excluded ) ) {
    $excluded = array();
  }
  
  // Exclude our script using theme constant
  $excluded[] = DSN_THEME_PATH . '/assets/js/archive-product-template.js';
  
  return $excluded;
} );

