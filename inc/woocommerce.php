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

function dsn_handle_product_action_buttons() {
    if (class_exists('WooCommerce')) {
        global $product;

        if (!$product) {
            return;
        }

        $product_id = $product->get_id();

        if (dsn_show_reserve_btn($product_id)){
            add_action('woocommerce_single_product_summary', 'dsn_reserve_button');
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }

        if(dsn_show_get_info_btn($product_id)) {
            add_action('woocommerce_single_product_summary', 'dsn_get_info_button', 30);
        }

        if(!dsn_show_add_to_cart($product_id)){
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }
    }
}

add_action('woocommerce_single_product_summary', 'dsn_handle_product_action_buttons', 1);

function dsn_reserve_button() {
    global $product;
    global $dssSiteLanguage;

    if (!$product) {
        return;
    }

    $postID = $product->get_id();

    // Get translated text
    if (empty($dssSiteLanguage)) {
        $dssSiteLanguage = dssGetSiteLanguage();
    }
    $translatedText = dssLang($dssSiteLanguage);

    // Get reserve icon from Syndified settings
    $reserve_icon = function_exists('syndified_get_reserve_icon') ? syndified_get_reserve_icon() : 'reserve';
    $button_title = $translatedText->woocommerce_cart->reserve_button;

    // Check if Syndified modal is available
    $use_modal = function_exists('syndified_is_cta_modal_available') && syndified_is_cta_modal_available();

    if ($use_modal) {
        // Reserve Button - Triggers Syndified CTA Modal
        echo '<button type="button" ';
        echo function_exists('syndified_render_cta_button_attrs') ? syndified_render_cta_button_attrs($postID) : '';
        echo ' class="button alt ds-reserve-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-2 dsn:px-6 dsn:py-3 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded dsn:cursor-pointer"';
        echo ' title="' . esc_attr($button_title) . '">';
        echo '<span class="dsn:flex dsn:items-center">';
        dsn_icon($reserve_icon, 'dsn:w-5 dsn:h-5');
        echo '</span>';
        echo '<span>' . esc_html($button_title) . '</span>';
        echo '</button>';
    } else {
        // Reserve Button - Direct URL (Fallback when Syndified modal is not available)
        $cta_url = dsn_get_cta_url($postID);

        echo '<a href="' . esc_url($cta_url) . '"';
        echo ' class="button alt ds-reserve-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-2 dsn:px-6 dsn:py-3 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded"';
        echo ' title="' . esc_attr($button_title) . '">';
        echo '<span class="dsn:flex dsn:items-center">';
        dsn_icon($reserve_icon, 'dsn:w-5 dsn:h-5');
        echo '</span>';
        echo '<span>' . esc_html($button_title) . '</span>';
        echo '</a>';
    }
}

function dsn_get_info_button() {
    global $product;
    global $dssSiteLanguage;

    if (!$product) {
        return;
    }

    $postID = $product->get_id();

    // Get translated text
    if (empty($dssSiteLanguage)) {
        $dssSiteLanguage = dssGetSiteLanguage();
    }
    $translatedText = dssLang($dssSiteLanguage);

    // Get info icon from Syndified settings
    $get_info_icon = function_exists('syndified_get_info_icon') ? syndified_get_info_icon() : 'info';
    $button_title = $translatedText->woocommerce_cart->info_button;

    // Check if Syndified modal is available
    $use_modal = function_exists('syndified_is_cta_modal_available') && syndified_is_cta_modal_available();

    if ($use_modal) {
        // Get Info Button - Triggers Syndified CTA Modal
        echo '<button type="button" ';
        echo function_exists('syndified_render_cta_button_attrs') ? syndified_render_cta_button_attrs($postID) : '';
        echo ' class="button alt ds-info-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-2 dsn:px-6 dsn:py-3 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded dsn:cursor-pointer"';
        echo ' title="' . esc_attr($button_title) . '">';
        echo '<span class="dsn:flex dsn:items-center">';
        dsn_icon($get_info_icon, 'dsn:w-5 dsn:h-5');
        echo '</span>';
        echo '<span>' . esc_html($button_title) . '</span>';
        echo '</button>';
    } else {
        // Get Info Button - Direct URL (Fallback when Syndified modal is not available)
        $cta_url = dsn_get_cta_url($postID);

        echo '<a href="' . esc_url($cta_url) . '"';
        echo ' class="button alt ds-info-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-2 dsn:px-6 dsn:py-3 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded"';
        echo ' title="' . esc_attr($button_title) . '">';
        echo '<span class="dsn:flex dsn:items-center">';
        dsn_icon($get_info_icon, 'dsn:w-5 dsn:h-5');
        echo '</span>';
        echo '<span>' . esc_html($button_title) . '</span>';
        echo '</a>';
    }
}

// Include Syndified CTA modal on single product pages
function dsn_include_syndified_modal_on_product_pages() {
    if (is_product() && function_exists('syndified_include_cta_modal')) {
        syndified_include_cta_modal();
    }
}
add_action('wp_footer', 'dsn_include_syndified_modal_on_product_pages');

/**
 * Add Hero Image field to product category add form
 */
add_action('product_cat_add_form_fields', 'dsn_add_category_hero_image_field');
function dsn_add_category_hero_image_field() {
    ?>
    <div class="form-field">
        <label><?php _e('Hero Image', 'dsnshowcase'); ?></label>
        <div id="category_hero_image_wrapper">
            <img id="category_hero_image_preview" src="" style="max-width: 300px; display: none;" />
        </div>
        <input type="hidden" id="category_hero_image_id" name="category_hero_image_id" value="" />
        <button type="button" class="button" id="upload_hero_image_button"><?php _e('Upload/Add Image', 'dsnshowcase'); ?></button>
        <button type="button" class="button" id="remove_hero_image_button" style="display: none;"><?php _e('Remove Image', 'dsnshowcase'); ?></button>
        <p class="description"><?php _e('Upload a wide banner image for the category page hero. Recommended size: 1920x500px.', 'dsnshowcase'); ?></p>
    </div>
    <div class="form-field">
        <label><?php _e('Hero Image Position', 'dsnshowcase'); ?></label>
        <select name="hero_image_position_y" id="hero_image_position_y">
            <option value="top"><?php _e('Top', 'dsnshowcase'); ?></option>
            <option value="center" selected><?php _e('Center', 'dsnshowcase'); ?></option>
            <option value="bottom"><?php _e('Bottom', 'dsnshowcase'); ?></option>
        </select>
        <p class="description"><?php _e('Choose which part of the image to focus on vertically.', 'dsnshowcase'); ?></p>
    </div>
    <?php
}

/**
 * Add Hero Image field to product category edit form
 */
add_action('product_cat_edit_form_fields', 'dsn_edit_category_hero_image_field', 10, 1);
function dsn_edit_category_hero_image_field($term) {
    $hero_image_id = get_term_meta($term->term_id, 'category_hero_image_id', true);
    $hero_image_url = $hero_image_id ? wp_get_attachment_url($hero_image_id) : '';
    $position_y = get_term_meta($term->term_id, 'hero_image_position_y', true) ?: 'center';
    ?>
    <tr class="form-field">
        <th scope="row"><label><?php _e('Hero Image', 'dsnshowcase'); ?></label></th>
        <td>
            <div id="category_hero_image_wrapper">
                <img id="category_hero_image_preview" src="<?php echo esc_url($hero_image_url); ?>" style="max-width: 300px; <?php echo $hero_image_url ? '' : 'display: none;'; ?>" />
            </div>
            <input type="hidden" id="category_hero_image_id" name="category_hero_image_id" value="<?php echo esc_attr($hero_image_id); ?>" />
            <button type="button" class="button" id="upload_hero_image_button"><?php _e('Upload/Add Image', 'dsnshowcase'); ?></button>
            <button type="button" class="button" id="remove_hero_image_button" style="<?php echo $hero_image_url ? '' : 'display: none;'; ?>"><?php _e('Remove Image', 'dsnshowcase'); ?></button>
            <p class="description"><?php _e('Upload a wide banner image for the category page hero. Recommended size: 1920x500px.', 'dsnshowcase'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label><?php _e('Hero Image Position', 'dsnshowcase'); ?></label></th>
        <td>
            <select name="hero_image_position_y" id="hero_image_position_y">
                <option value="top" <?php selected($position_y, 'top'); ?>><?php _e('Top', 'dsnshowcase'); ?></option>
                <option value="center" <?php selected($position_y, 'center'); ?>><?php _e('Center', 'dsnshowcase'); ?></option>
                <option value="bottom" <?php selected($position_y, 'bottom'); ?>><?php _e('Bottom', 'dsnshowcase'); ?></option>
            </select>
            <p class="description"><?php _e('Choose which part of the image to focus on vertically.', 'dsnshowcase'); ?></p>
        </td>
    </tr>
    <?php
}

/**
 * Save Hero Image field when category is created
 */
add_action('created_product_cat', 'dsn_save_category_hero_image', 10, 2);
function dsn_save_category_hero_image($term_id, $tt_id) {
    if (isset($_POST['category_hero_image_id'])) {
        update_term_meta($term_id, 'category_hero_image_id', absint($_POST['category_hero_image_id']));
    }
    if (isset($_POST['hero_image_position_y'])) {
        update_term_meta($term_id, 'hero_image_position_y', sanitize_text_field($_POST['hero_image_position_y']));
    }
}

/**
 * Save Hero Image field when category is updated
 */
add_action('edited_product_cat', 'dsn_update_category_hero_image', 10, 2);
function dsn_update_category_hero_image($term_id, $tt_id) {
    if (isset($_POST['category_hero_image_id'])) {
        update_term_meta($term_id, 'category_hero_image_id', absint($_POST['category_hero_image_id']));
    }
    if (isset($_POST['hero_image_position_y'])) {
        update_term_meta($term_id, 'hero_image_position_y', sanitize_text_field($_POST['hero_image_position_y']));
    }
}

/**
 * Enqueue media uploader script for category hero image
 */
add_action('admin_enqueue_scripts', 'dsn_category_hero_image_scripts');
function dsn_category_hero_image_scripts($hook) {
    if ($hook !== 'edit-tags.php' && $hook !== 'term.php') {
        return;
    }
    if (!isset($_GET['taxonomy']) || $_GET['taxonomy'] !== 'product_cat') {
        return;
    }

    wp_enqueue_media();
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($) {
            var mediaUploader;

            $('#upload_hero_image_button').on('click', function(e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Select Hero Image',
                    button: { text: 'Use this image' },
                    multiple: false
                });

                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#category_hero_image_id').val(attachment.id);
                    $('#category_hero_image_preview').attr('src', attachment.url).show();
                    $('#remove_hero_image_button').show();
                });

                mediaUploader.open();
            });

            $('#remove_hero_image_button').on('click', function(e) {
                e.preventDefault();
                $('#category_hero_image_id').val('');
                $('#category_hero_image_preview').attr('src', '').hide();
                $(this).hide();
            });
        });
    ");
}