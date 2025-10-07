<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

global $dssSiteLanguage;
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <div class="dsn:container dsn:mx-auto dsn:px-4">
        <!-- Page Header -->
        <div class="dsn:py-6 dsn:border-b dsn:flex dsn:justify-between dsn:items-center dsn:mb-8">
            <h1 class="dsn:text-3xl dsn:font-semibold dsn:tracking-tight"><?php the_title() ?></h1>
            <div class="dsn:flex dsn:items-center dsn:gap-4">
                <a class="dsn:uppercase dsn:text-sm dsw-primary-site-link" href="<?php echo wc_get_cart_url(); ?>">
                    <?php echo dssLang($dssSiteLanguage)->woocommerce_cart->back_link; ?>
                </a>
                <?php if (get_option('woocommerce_enable_checkout_login_reminder') === "yes" && !is_user_logged_in()) : ?>
                    <a href="#" class="dsn:uppercase dsn:text-sm dsw-primary-site-link showlogin">Customer Login</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="dsn:flex dsn:flex-col dsn:gap-8 dsn:mb-12 checkout-layout">
            <!-- Checkout Form -->
            <div class="dsn:flex-1 checkout-form-section">
                <?php if ($checkout->get_checkout_fields()) : ?>
                    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                    <?php do_action('woocommerce_checkout_billing'); ?>

                    <?php do_action('woocommerce_checkout_shipping'); ?>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                <?php endif; ?>
            </div>

            <!-- Order Summary -->
            <div class="dsn:w-full dsn:shrink-0 checkout-summary-section">
                <div class="dsn:border dsn:border-gray-200 dsn:rounded-lg dsn:p-6 checkout-summary-box">
                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action('woocommerce_checkout_order_review'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_order_review'); ?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>