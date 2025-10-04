<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); 

global $dssSiteLanguage;

?>

<div class="flex flex-wrap -mx-4 container">
    <div class="w-full lg:w-8/12 px-4 lg:pr-12">
        <div class="py-4 border-b flex justify-between items-center">
            <h1 class="text-3xl"><?php the_title() ?></h1>
            <?php $item_counter = WC()->cart->cart_contents_count; ?>
            <p class="cart-counter text-right uppercase font-semibold">
                <?php 
                if ($item_counter == 1) echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_singular; 
                else echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_plural; 
                ?>
            </p>
        </div>
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                            <tr class="woocommerce-cart-form__cart-item flex items-center <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                <td class="product-thumbnail w-32 h-32 flex-grow-0 flex items-center">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$product_permalink) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                    }
                                    ?>
                                </td>

                                <td class="product-name flex-grow h-32 flex justify-center flex-col" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php
                                    if (!$product_permalink) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    } else {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="text-xl mb-2 inline-block text-gray-600 hover:text-gray-800" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }
                                    ?>
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">' . dssLang($dssSiteLanguage)->woocommerce_cart->delete_link . '</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </td>

                                <!-- <td class="product-price" data-title="<?php //esc_attr_e('Price', 'woocommerce'); 
                                                                            ?>">
                                <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok. 
                                ?>
                                </td> -->

                                <td class="product-quantity flex-grow-0 h-32 flex items-center" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $_product->get_max_purchase_quantity(),
                                                'min_value' => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }

                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-item-price flex-grow-0 w-48 h-32 flex items-center justify-end" data-title="<?php esc_attr_e('Item Price', 'woocommerce'); ?>">
                                    <?php // echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok. 
                                    ?>
                                    <?php echo $_product->get_price_html(); ?>
                                </td>

                                <td class="product-subtotal flex-grow-0 w-24 h-32 flex items-center justify-end text-gray-600 hover:text-gray-800" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                                    <?php echo get_woocommerce_currency_symbol () . number_format($_product->get_price() * $cart_item['quantity'], 2, '.', ''); ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                    <?php do_action('woocommerce_cart_contents'); ?>

                    <tr>
                        <td colspan="6" class="actions">
                            <!-- <?php if (wc_coupons_enabled()) :
                                    ?>
                            <div class="coupon">
                                <label for="coupon_code">
                                    <?php esc_html_e('Coupon:', 'woocommerce');
                                    ?>
                                </label>
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                                    <?php esc_attr_e('Apply coupon', 'woocommerce'); ?>
                                </button>
                                <?php do_action('woocommerce_cart_coupon'); ?>
                            </div>
                            <?php endif; ?> -->

                            <button type="submit" class="button wc_update_cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

                            <?php do_action('woocommerce_cart_actions'); ?>

                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                        </td>
                    </tr>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </tbody>
            </table>
            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

        <?php $arg = array(
            'post_type' => 'product',
            'order' => 'ASC',
            'orderby' => 'rand',
            'posts_per_page' => 12
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <h3 class="text-3xl my-4"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->more_products_for_you;?></h3>
            <div class="w-full slick-slider cart-slider -mx-4 mt-4 md:mt-12 mb-12">
                <?php while ($the_query->have_posts()) :
                    $the_query->the_post(); ?>
                    <div class="w-1/4 cart-slide px-4">
                        <a href="<?php echo get_the_permalink(); ?>" class="text-black hover:text-gray-500">
                            <span class="block w-full relative cart-slide__thumb mb-4">
                                <?php the_post_thumbnail('full', array('class' => 'absolute object-contain p-2')); ?>
                            </span>
                            <span class="block font-bold m-0 text-lg mb-2"><?php the_title(); ?></span>
                            <?php $product = wc_get_product(get_the_ID()); ?>
                            <span class="block space-x-1 text-base">
                                <?php echo $product->get_price_html(); ?>
                            </span>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <script>
               jQuery('.cart-slider').slick({
                    cssEase: 'ease',
                    arrows: true,
                    dots: false,
                    infinite: true,
                    autoplay: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    variableWidth: false,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                })
            </script>
        <?php endif;
        wp_reset_query(); ?>
    </div>

    <?php do_action('woocommerce_before_cart_collaterals'); ?>
    <div class="w-full lg:w-4/12 px-4">
        <div class="cart-collaterals border rounded py-6 px-10">
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
        </div>
    </div>
</div>


<?php do_action('woocommerce_after_cart'); ?>