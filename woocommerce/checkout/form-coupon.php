<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
    return;
}

global $dssSiteLanguage;
?>
<div class="dsn:flex dsn:justify-between dsn:items-center dsn:gap-4 dsn:mb-4">
    <label for="coupon_code" class="dsn:text-base dsn:font-medium dsn:shrink-0 dsn:hidden"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->coupon_code; ?></label>
    
    <form class="checkout_coupon woocommerce-form-coupon dsn:border dsn:border-gray-200 dsn:rounded dsn:w-full" method="post">
        <input type="text" name="coupon_code" class="dsn-woocommerce-checkout-coupon-input input-text dsn:px-3 dsn:py-2 dsn:flex-1 dsn:w-2/3"
               placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" id="coupon_code" value=""/>

        <button type="submit" class="dsn-woocommerce-checkout-coupon-button dsn:px-2 dsn:py-1 dsn:sm:px-4 dsn:sm:py-2 dsn:primary-site-background dsn:text-white dsn:cursor-pointer dsn:rounded-r dsn:w-1/3" name="apply_coupon"
                value="<?php echo esc_attr(dssLang($dssSiteLanguage)->woocommerce_cart->apply_coupon); ?>"><?php echo esc_html(dssLang($dssSiteLanguage)->woocommerce_cart->apply_coupon); ?></button>
    </form>
</div>
