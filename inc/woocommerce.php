<?php 

//remove the need for a sidebar in products / woocommerce templates
function remove_sidebar() {
    if (class_exists('WooCommerce')) {
        if (function_exists('get_field')) {
            $header_sticky = get_field('sticky_header', 'options');
            if ($header_sticky == "1") {
                if (is_product() || is_product_category() || is_product_tag()) {
                    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
                }
            }
        } else {
            if (is_product() || is_product_category() || is_product_tag()) {
                remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
            }
        }
    }
}
add_action('get_header', 'remove_sidebar');
add_action('wp_head', 'remove_sidebar');
add_action('wp_footer', 'remove_sidebar');  

function woocommerce_endpoint_titles( $title ) {
    $sep = ' - ';
    $sitetitle = get_bloginfo();

    if ( is_wc_endpoint_url( 'view-order' ) ) {
        $title = 'View Order: ' . $sep . $sitetitle;    
    }
    if ( is_wc_endpoint_url( 'edit-account' ) ) {
        $title = 'Edit Account'. $sep . $sitetitle; 
    }
    if ( is_wc_endpoint_url( 'edit-address' ) ) {
        $title = 'Edit Address'. $sep . $sitetitle; 
    }
    if ( is_wc_endpoint_url( 'lost-password' ) ) {
        $title = 'Forgot Password'. $sep . $sitetitle;    
    }
    if ( is_wc_endpoint_url( 'customer-logout' ) ) {
        $title = 'Logout'. $sep . $sitetitle;   
    }
    if ( is_wc_endpoint_url( 'order-pay' ) ) {
        $title = 'Order Payment'. $sep . $sitetitle;    
    }
    if ( is_wc_endpoint_url( 'order-received' ) ) {
        $title = 'Order Received'. $sep . $sitetitle;   
    }
    if ( is_wc_endpoint_url( 'add-payment-method' ) ) {
        $title = 'Add Payment Method'. $sep . $sitetitle;   
    }
    return $title;
}
add_filter( 'wpseo_title','woocommerce_endpoint_titles');

//remove the SKU and Category from the product page
function remove_sku_and_category() {
    if (class_exists('WooCommerce')) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    }
}
add_action('wp_head', 'remove_sku_and_category');
add_action('wp_footer', 'remove_sku_and_category');

/**
 * Rename product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{
    // Remove the description tab
    unset($tabs['description']);

    if (get_field('more_content_content') || get_field('spec_table')) {
        $tabs['additional_information'] = array(
            'title' => __('More Details', 'woocommerce'),
            'priority' => 1,
            'callback' => 'woo_new_product_tab_more'
        );
    }

    if (get_field('custom_block_content')) {
        $title = get_field('custom_block_title') ? get_field('custom_block_title') : __('Custom Block', 'woocommerce');
        // Adds the new tab
        $tabs['custom_block'] = array(
            'title' => $title,
            'priority' => 15,
            'callback' => 'woo_new_product_tab_custom_block'
        );
    }

    return $tabs;
}

function woo_new_product_tab_more()
{
    $more_content = get_field('more_content_content');
    $specs = get_field('spec_table');
    $layout = get_field('layout');
    
    if($layout == 'Content Left & Specs Right') {
        $layoutClass = 'dsn:md:flex-row';
    } else if($layout == 'Specs Left & Content Right') {
        $layoutClass = 'dsn:md:flex-row-reverse';
    }

  
        echo '<div class="dsn:container dsn:flex dsn:flex-col dsn:md:flex-row dsn:gap-4 dsn:justify-center ' . esc_attr($layoutClass) . '">';
        if ($more_content) {
            echo '<div class="more-content dsn:w-full dsn:md:w-1/2">';
            echo apply_filters('the_content', $more_content);
            echo '</div>';
        }

    if ($specs) {
        echo '<div class="spec-table dsn:w-full dsn:md:w-1/2">';
        echo '<h3>' . __('Specifications', 'woocommerce') . '</h3>';
        echo '<table class="woocommerce-product-attributes shop_attributes">';
        foreach ($specs as $spec) {
         /* group specs each one has another title and then repeater of specs that each one has a label and value */
            if (isset($spec['title']) && $spec['title']) {
                echo '<tr class="spec-group">';
                echo '<th colspan="2"><p>' . esc_html($spec['title']) . '</p></th>';
                echo '</tr>';
            }
            if (isset($spec['specs']) && is_array($spec['specs'])) {
                foreach ($spec['specs'] as $single_spec) {
                    if (isset($single_spec['label']) && isset($single_spec['value'])) {
                        echo '<tr class="spec-item">';
                        echo '<th><p>' . esc_html($single_spec['label']) . '</p></th>';
                        echo '<td>' . $single_spec['value'] . '</td>';
                        echo '</tr>';
                    }
                }
            }    
        }
        echo '</table>';
        echo '</div>';
   }
   
        echo '</div>';
 

}

function woo_new_product_tab_custom_block()
{

    $custom_block_content = get_field('custom_block_content');

    if ($custom_block_content) {
        echo '<div class="custom-block-content dsn:container">';
        echo apply_filters('the_content', $custom_block_content);
        echo '</div>';
    }



}

//add description below the add to cart button
function add_description_below_add_to_cart() {
    global $product;
    
    if (is_product() && $product->get_description()) {          
        echo '<div class="woocommerce-product-details__short-description">';
        echo apply_filters('woocommerce_short_description', $product->get_description());
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'add_description_below_add_to_cart', 125);
