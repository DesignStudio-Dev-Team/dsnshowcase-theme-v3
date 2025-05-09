<?php 
//WooCommerce Modifications with TailwindCSS
add_filter('woocommerce_shop_loop_item_title', function ($title) {
    return '<h2 class="dsn:text-lg dsn:font-bold dsn:text-gray-800">' . $title . '</h2>';
}, 10, 1);

add_filter('woocommerce_get_price_html', function ($price) {
    return '<span class="dsn:text-xl dsn:text-gray-700">' . $price . '</span>';
}, 10, 1);

add_filter('woocommerce_loop_add_to_cart_link', function ($button, $product) {
    return '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="dsn:bg-blue-500 dsn:text-white dsn:rounded dsn:py-2 dsn:px-4 dsn:hover:bg-blue-600">' . $product->add_to_cart_text() . '</a>';
}, 10, 2);

add_action('woocommerce_before_shop_loop_item', function () {
    echo '<div class="dsn:flex dsn:flex-col dsn:items-center dsn:justify-between">';
}, 5);

add_action('woocommerce_after_shop_loop_item', function () {
    echo '</div>';
}, 15);

add_action('woocommerce_before_shop_loop_item_title', function () {
    echo '<div class="dsn:mb-4 dsn:h-48 dsn:w-full dsn:overflow-hidden dsn:relative">';
}, 10);

add_action('woocommerce_after_shop_loop_item_title', function () {
    echo '</div>';
}, 10);

add_filter('woocommerce_catalog_ordering', function ($output) {
    return str_replace('class="select"', 'class="dsn:bg-gray-100 dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2"', $output);
}, 10, 1);

//WooCommerce Filters for Tailwind
add_filter('woocommerce_loop_add_to_cart_args', function ($args) {
    $args['class'] = 'dsn:bg-blue-500 dsn-hover:bg-blue-600 dsn:text-white dsn:px-4 dsn:py-2 dsn:rounded dsn:transition dsn:duration-300';
    return $args;
});

add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return '<button class="dsn:bg-green-500 dsn-hover:bg-green-600 dsn:text-white dsn:px-6 dsn:py-3 dsn:rounded dsn:shadow-md">Add to Cart</button>';
});

add_filter('woocommerce_form_field', function ($field, $key, $args, $value) {
    // Add TailwindCSS classes to input fields
    $field = str_replace('<input', '<input class="dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:w-full"', $field);

    // Add TailwindCSS classes to select fields
    $field = str_replace('<select', '<select class="dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:w-full"', $field);

    // Add TailwindCSS classes to textarea fields
    $field = str_replace('<textarea', '<textarea class="dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:w-full"', $field);

    return $field;
}, 10, 4);

add_filter('woocommerce_add_to_cart_message_html', function ($message) {
    return '<div class="dsn:bg-green-100 dsn:text-green-800 dsn:border dsn:border-green-300 dsn:rounded dsn:px-4 dsn:py-3">' . $message . '</div>';
});

add_filter('woocommerce_error', function ($error) {
    return '<div class="dsn:bg-red-100 dsn:text-red-800 dsn:border dsn:border-red-300 dsn:rounded dsn:px-4 dsn:py-3">' . $error . '</div>';
});

add_filter('woocommerce_info', function ($info) {
    return '<div class="dsn:bg-blue-100 dsn:text-blue-800 dsn:border dsn:border-blue-300 dsn:rounded dsn:px-4 dsn:py-3">' . $info . '</div>';
});

add_filter('woocommerce_pagination_args', function ($args) {
    $args['prev_text'] = '<span class="dsn:px-3 dsn:py-2 dsn:bg-gray-200 dsn:rounded dsn:cursor-pointer dsn-hover:bg-gray-300">&laquo;</span>';
    $args['next_text'] = '<span class="dsn:px-3 dsn:py-2 dsn:bg-gray-200 dsn:rounded dsn:cursor-pointer dsn-hover:bg-gray-300">&raquo;</span>';
    return $args;
});

add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {
    $defaults['wrap_before'] = '<nav class="dsn:bg-gray-100 dsn:p-4 dsn:rounded dsn:shadow"><ol class="dsn:flex dsn:space-x-2">';
    $defaults['wrap_after'] = '</ol></nav>';
    $defaults['before'] = '<li class="dsn:inline dsn:text-blue-600">';
    $defaults['after'] = '</li>';
    return $defaults;
});

add_action('wp_enqueue_scripts', function () {
    // Add classes for checkout buttons
    echo '<style>
        .woocommerce .button {
            @apply dsn:bg-indigo-500 dsn:text-white dsn:px-4 dsn:py-2 dsn:rounded dsn-hover:bg-indigo-600 dsn:transition;
        }
    </style>';
});

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('woocommerce-inline'); // Remove WooCommerce inline styles
}, 20);

add_action('woocommerce_account_navigation', function () {
    echo '<style>
        .woocommerce-MyAccount-navigation {
            @apply dsn:flex dsn:flex-col dsn:bg-gray-100 dsn:p-4 dsn:rounded dsn:shadow;
        }
        .woocommerce-MyAccount-navigation ul {
            @apply dsn:flex dsn:flex-col dsn:space-y-2;
        }
        .woocommerce-MyAccount-navigation li {
            @apply dsn:list-none;
        }
        .woocommerce-MyAccount-navigation a {
            @apply dsn:text-blue-500 dsn:py-2 dsn:px-3 dsn:rounded dsn-hover:bg-gray-200 dsn:transition;
        }
        .woocommerce-MyAccount-navigation a.is-active {
            @apply dsn:bg-blue-500 dsn:text-white;
        }
    </style>';
});

add_action('woocommerce_account_content', function () {
    echo '<style>
        .woocommerce-MyAccount-content {
            @apply dsn:bg-white dsn:p-6 dsn:rounded dsn:shadow dsn:text-gray-700;
        }
    </style>';
});

add_action('woocommerce_login_form', function () {
    echo '<style>
        .woocommerce-form-login {
            @apply dsn:bg-gray-50 dsn:p-6 dsn:rounded dsn:shadow dsn:max-w-md dsn:mx-auto;
        }
        .woocommerce-form-row {
            @apply dsn:mb-4;
        }
        .woocommerce-Input {
            @apply dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:w-full;
        }
        .woocommerce-Button {
            @apply dsn:bg-indigo-500 dsn:text-white dsn:px-4 dsn:py-2 dsn:rounded dsn-hover:bg-indigo-600 dsn:transition;
        }
        .woocommerce-LostPassword a {
            @apply dsn:text-blue-500 dsn-hover:underline;
        }
    </style>';
});

add_action('woocommerce_register_form', function () {
    echo '<style>
        .woocommerce-form-register {
            @apply dsn:bg-gray-50 dsn:p-6 dsn:rounded dsn:shadow dsn:max-w-md dsn:mx-auto;
        }
        .woocommerce-form-row {
            @apply dsn:mb-4;
        }
        .woocommerce-Input {
            @apply dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:w-full;
        }
        .woocommerce-Button {
            @apply dsn:bg-green-500 dsn:text-white dsn:px-4 dsn:py-2 dsn:rounded dsn-hover:bg-green-600 dsn:transition;
        }
    </style>';
});

add_action('wp_enqueue_scripts', function () {
    echo '<style>
        /* Product Single Page */
        .woocommerce div.product div.images img {
            @apply dsn:rounded-lg dsn:shadow-md;
        }
        .woocommerce div.product div.summary {
            @apply dsn:bg-white dsn:p-6 dsn:rounded-lg dsn:shadow-md;
        }
        .woocommerce div.product .woocommerce-tabs ul.tabs {
            @apply dsn:flex dsn:gap-4 dsn:border-b dsn:border-gray-200 dsn:mb-6;
        }
        .woocommerce div.product .woocommerce-tabs ul.tabs li {
            @apply dsn:px-4 dsn:py-2 dsn:border-b-2 dsn:border-transparent dsn:hover:border-blue-500;
        }
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active {
            @apply dsn:border-blue-500;
        }
        
        /* Cart Page */
        .woocommerce-cart table.cart td.actions .coupon .input-text {
            @apply dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2;
        }
        .woocommerce-cart .cart-collaterals .cart_totals {
            @apply dsn:bg-white dsn:p-6 dsn:rounded-lg dsn:shadow-md;
        }
        
        /* Checkout Page */
        .woocommerce-checkout .col2-set {
            @apply dsn:grid dsn:grid-cols-1 dsn:md:grid-cols-2 dsn:gap-8;
        }
        .woocommerce-checkout #payment {
            @apply dsn:bg-white dsn:rounded-lg dsn:shadow-md;
        }
        .woocommerce-checkout #payment div.payment_box {
            @apply dsn:bg-blue-50 dsn:text-blue-800;
        }
        
        /* Account Pages */
        .woocommerce-account .woocommerce-MyAccount-navigation {
            @apply dsn:bg-white dsn:p-6 dsn:rounded-lg dsn:shadow-md;
        }
        .woocommerce-account .woocommerce-MyAccount-content {
            @apply dsn:bg-white dsn:p-6 dsn:rounded-lg dsn:shadow-md;
        }
        
        /* Notices */
        .woocommerce-message,
        .woocommerce-info,
        .woocommerce-error {
            @apply dsn:rounded-lg dsn:p-4 dsn:mb-4;
        }
        .woocommerce-message {
            @apply dsn:bg-green-50 dsn:text-green-800 dsn:border dsn:border-green-200;
        }
        .woocommerce-info {
            @apply dsn:bg-blue-50 dsn:text-blue-800 dsn:border dsn:border-blue-200;
        }
        .woocommerce-error {
            @apply dsn:bg-red-50 dsn:text-red-800 dsn:border dsn:border-red-200;
        }
    </style>';
});

add_action('wp_enqueue_scripts', function () {
    echo '<style>
        /* Shop Page Buttons and Controls */
        .woocommerce-ordering {
            @apply dsn:mb-8;
        }
        
        .woocommerce-ordering select {
            @apply dsn:border dsn:border-gray-300 dsn:rounded dsn:px-4 dsn:py-2 dsn:bg-white dsn:shadow-sm dsn:focus:outline-none dsn:focus:ring-2 dsn:focus:ring-blue-500;
        }
        
        .woocommerce-result-count {
            @apply dsn:text-gray-600 dsn:mb-8 dsn:block;
        }
        
        /* Product Grid */
        .woocommerce ul.products {
            @apply dsn:grid dsn:grid-cols-1 dsn:sm:grid-cols-2 dsn:md:grid-cols-3 dsn:lg:grid-cols-4 dsn:gap-8 dsn:list-none dsn:p-0;
        }
        
        .woocommerce ul.products li.product {
            @apply dsn:border dsn:border-gray-200 dsn:rounded-lg dsn:shadow-sm dsn:p-4 dsn:transition-all dsn:duration-300 dsn:hover:shadow-md dsn:list-none dsn:m-0;
        }
        
        .woocommerce ul.products li.product .button {
            @apply dsn:bg-blue-600 dsn:text-white dsn:px-4 dsn:py-2 dsn:rounded dsn:inline-block dsn:text-center dsn:w-full dsn:mt-4 dsn:transition-colors dsn:duration-300 dsn:hover:bg-blue-700;
        }
        
        .woocommerce ul.products li.product .price {
            @apply dsn:text-base dsn:font-semibold dsn:text-gray-900 dsn:mt-2 dsn:block;
        }
        
        .woocommerce ul.products li.product .price del {
            @apply dsn:text-gray-500 dsn:font-normal;
        }
        
        .woocommerce ul.products li.product .price ins {
            @apply dsn:text-red-600 dsn:no-underline;
        }
        
        /* Product Title */
        .woocommerce ul.products li.product .woocommerce-loop-product__title {
            @apply dsn:text-base dsn:font-medium dsn:text-gray-900 dsn:mt-4 dsn:mb-2 dsn:line-clamp-2 dsn:h-12;
        }
        
        /* Product Image Container */
        .woocommerce ul.products li.product .attachment-woocommerce_thumbnail {
            @apply dsn:w-full dsn:h-48 dsn:object-cover dsn:rounded-lg;
        }
        
        /* Product Image Wrapper */
        .woocommerce ul.products li.product .woocommerce-loop-product__link {
            @apply dsn:block dsn:mb-4;
        }
        
        /* Star Rating */
        .woocommerce ul.products li.product .star-rating {
            @apply dsn:text-yellow-400 dsn:mb-2 dsn:text-sm;
        }
        
        /* Sale Badge */
        .woocommerce span.onsale {
            @apply dsn:bg-red-600 dsn:text-white dsn:px-2 dsn:py-1 dsn:rounded dsn:text-xs dsn:font-semibold dsn:absolute dsn:top-2 dsn:left-2 dsn:z-10;
        }
        
        /* Pagination */
        .woocommerce nav.woocommerce-pagination {
            @apply dsn:mt-12 dsn:mb-8;
        }
        
        .woocommerce nav.woocommerce-pagination ul {
            @apply dsn:flex dsn:justify-center dsn:gap-2 dsn:border-0 dsn:list-none dsn:p-0;
        }
        
        .woocommerce nav.woocommerce-pagination ul li {
            @apply dsn:border-0 dsn:inline-block dsn:mx-1 dsn:list-none;
        }
        
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span {
            @apply dsn:px-4 dsn:py-2 dsn:border dsn:border-gray-300 dsn:rounded dsn:text-gray-700 dsn:transition-colors dsn:duration-300;
        }
        
        .woocommerce nav.woocommerce-pagination ul li span.current {
            @apply dsn:bg-blue-600 dsn:text-white dsn:border-blue-600;
        }
        
        .woocommerce nav.woocommerce-pagination ul li a:hover {
            @apply dsn:bg-gray-100 dsn:border-gray-400;
        }
    </style>';
});

