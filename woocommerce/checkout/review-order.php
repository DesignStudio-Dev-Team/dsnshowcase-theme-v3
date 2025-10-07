<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

global $dssSiteLanguage;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <h3 class="dsn:text-xl dsn:font-semibold dsn:flex dsn:flex-wrap dsn:justify-between dsn:items-center dsn:mb-6 dsn:pb-4 dsn:border-b">
        <?php echo dssLang($dssSiteLanguage)->woocommerce_cart->order_summary_title; ?>
        <?php $item_counter = WC()->cart->cart_contents_count; ?>
        <span class="dsn:text-sm dsn:text-gray-600 dsn:font-normal">    
            <?php 
            if ($item_counter == 1) echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_singular; 
            else echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_plural; 
            ?>
        </span>
    </h3>

    <?php
    do_action('woocommerce_review_order_before_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
            ?>
            <div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item dsn:mb-4 dsn:pb-4 dsn:border-b dsn:flex dsn:justify-between dsn:items-center dsn:gap-4', $cart_item, $cart_item_key)); ?>">
                <a href="<?php echo get_permalink($cart_item['product_id']); ?>" class="dsn:flex dsn:text-base dsn:items-center dsn:gap-3 dsn:text-gray-600">
                    <span class="product-thumbnail dsn:w-20 dsn:h-20 dsn:bg-gray-100 dsn:rounded dsn:flex dsn:items-center dsn:justify-center dsn:shrink-0 dsn:overflow-hidden">
                        <?php
                        $thumb_html = $_product->get_image('woocommerce_thumbnail', array('class' => 'dsn:w-full dsn:h-full dsn:object-contain'), true);
                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $thumb_html, $cart_item, $cart_item_key);
                        echo $thumbnail; // PHPCS: XSS ok.
                        ?>
                    </span>

                    <span class="product-name">
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
                        <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity dsn:text-black">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </span>
                </a>
                <div class="product-total">
                    <?php echo $_product->get_price_html(); ?>
                </div>
            </div>
            <?php
        }
    }

    do_action('woocommerce_review_order_after_cart_contents');
    ?>

    <div class="cart-subtotal dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2">
        <div class="dsn:font-medium"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
        <div><?php wc_cart_totals_subtotal_html(); ?></div>
    </div>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
        <div class="dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2 cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
            <div class="dsn:font-medium"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->coupon_discounts;?></div>
            <div class="dsn:text-green-600"><?php wc_cart_totals_coupon_html($coupon); ?></div>
        </div>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
        <?php do_action('woocommerce_review_order_before_shipping'); ?>
        
        <?php foreach ( WC()->shipping()->get_packages() as $i => $package ) : ?>
            <?php $chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : ''; ?>
            <?php $available_methods = $package['rates']; ?>
            
            <?php if ( 1 < count( $available_methods ) ) : ?>
                <div class="dsn:flex dsn:justify-between dsn:items-start dsn:text-base dsn:mb-3 dsn:py-2">
                    <div class="dsn:font-medium">Shipping</div>
                    <div class="dsn:flex dsn:flex-col dsn:gap-2 dsn:text-right">
                        <?php foreach ( $available_methods as $method ) : ?>
                            <label class="dsn:flex dsn:items-center dsn:gap-2 dsn:cursor-pointer dsn:justify-end">
                                <span><?php echo esc_html( $method->get_label() ); ?></span>
                                <input type="radio" name="shipping_method[<?php echo esc_attr( $i ); ?>]" data-index="<?php echo esc_attr( $i ); ?>" id="shipping_method_<?php echo esc_attr( $i ); ?>_<?php echo esc_attr( sanitize_title( $method->id ) ); ?>" value="<?php echo esc_attr( $method->id ); ?>" class="dsn:w-4 dsn:h-4" <?php checked( $method->id, $chosen_method ); ?>>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif ( 1 === count( $available_methods ) ) : ?>
                <?php $method = current( $available_methods ); ?>
                <div class="dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2">
                    <div class="dsn:font-medium">Shipping</div>
                    <div><?php echo esc_html( $method->get_label() ); ?></div>
                </div>
                <input type="hidden" name="shipping_method[<?php echo esc_attr( $i ); ?>]" data-index="<?php echo esc_attr( $i ); ?>" value="<?php echo esc_attr( $method->id ); ?>">
            <?php endif; ?>
        <?php endforeach; ?>
        
        <?php do_action('woocommerce_review_order_after_shipping'); ?>
    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
        <div class="dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2 fee">
            <div class="dsn:font-medium"><?php echo esc_html($fee->name); ?></div>
            <div><?php wc_cart_totals_fee_html($fee); ?></div>
        </div>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
        <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
            <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                <div class="dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2 tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                    <div class="dsn:font-medium"><?php echo esc_html($tax->label); ?></div>
                    <div><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="dsn:flex dsn:justify-between dsn:text-base dsn:mb-3 dsn:py-2 tax-total">
                <div class="dsn:font-medium"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
                <div><?php wc_cart_totals_taxes_total_html(); ?></div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php do_action('woocommerce_review_order_before_order_total'); ?>

    <div class="dsn:flex dsn:justify-between dsn:text-lg dsn:font-semibold dsn:mt-4 dsn:pt-4 dsn:border-t order-total dsn:bg-gray-100 dsn:p-4 dsn:rounded">
        <div><?php esc_html_e('Total', 'woocommerce'); ?></div>
        <div><?php wc_cart_totals_order_total_html(); ?></div>
    </div>

    <?php do_action('woocommerce_review_order_after_order_total'); ?>
</div>
