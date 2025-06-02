<?php
/**
 * Single Product Page Customizations
 */
// Remove default WooCommerce wrapper
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Add custom wrapper
add_action('woocommerce_before_main_content', function() {
    echo '<div class="dsn:container dsn:mx-auto dsn:px-4 dsn:py-8">';
}, 10);

add_action('woocommerce_after_main_content', function() {
    echo '</div>';
}, 10);

// --- Improved: Output product image and summary in two columns, tighter spacing ---
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('woocommerce_before_single_product_summary', function() {
    echo '<div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:items-start dsn:mb-6">'; // Removed dsn:gap-4
    echo '<div class="dsn:w-full dsn:lg:w-1/2 dsn:mb-4 dsn:lg:mb-0">';
    woocommerce_show_product_images();
    echo '</div><div class="dsn:w-full dsn:lg:w-1/2 dsn:flex dsn:flex-col dsn:justify-center dsn:gap-4">';
}, 5);

add_action('woocommerce_after_single_product_summary', function() {
    echo '</div></div>';
}, 5);

// Customize add to cart button
add_filter('woocommerce_single_product_add_to_cart_text', function() {
    return __('Add to Cart', 'dsnshowcase');
});

// Customize product tabs
add_filter('woocommerce_product_tabs', function($tabs) {
    // Rename Description tab
    if (isset($tabs['description'])) {
        $tabs['description']['title'] = __('Product Details', 'dsnshowcase');
    }
    return $tabs;
});


// Remove SKU and category/meta from single product summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Move product description to appear after add to cart button
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', function() {
    global $product;
    if ($product && $product->get_description()) {
        echo '<div class="product-description dsn:mt-6 dsn:border-t dsn:border-gray-200 dsn:pt-6">';
        echo '<div class="dsn:prose dsn:prose-sm">' . wpautop($product->get_description()) . '</div>';
        echo '</div>';
    }
}, 40); // Priority 40 places it after add to cart button (which is at 30)


// Enhance stock status display
add_filter('woocommerce_get_availability_text', function($availability, $product) {
    if ($product->is_in_stock()) {
        return '<span class="dsn:text-green-600">' . __('In Stock', 'dsnshowcase') . '</span>';
    } else {
        return '<span class="dsn:text-red-600">' . __('Out of Stock', 'dsnshowcase') . '</span>';
    }
}, 10, 2);