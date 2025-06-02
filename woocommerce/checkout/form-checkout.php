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

    <div class="flex flex-wrap -mx-4 container">

        <div class="w-full lg:w-8/12 px-4 mb-24 lg:pr-12">
            <h1 class="text-4xl flex justify-between items-center pb-4 border-b mb-4">
                <?php the_title() ?>
                <div>
                    <a class="uppercase text-lg dsw-primary-site-link inline-block ml-4" href="<?php echo wc_get_cart_url(); ?>">
                    <?php echo dssLang($dssSiteLanguage)->woocommerce_cart->back_link; ?>
                    </a>
                    <?php if (get_option('woocommerce_enable_checkout_login_reminder') == "yes" && !is_user_logged_in()) : ?>
                        <a href="#" class="uppercase text-lg dsw-primary-site-link inline-block ml-4 showlogin">Customer Login</a>
                    <?php endif; ?>
                </div>
            </h1>

            <?php if ($checkout->get_checkout_fields()) : ?>
                <h2 class="text-2xl font-normal mb-4"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->payment_details; ?></h2>
                <?php do_action('woocommerce_checkout_before_customer_details'); ?>


                <?php do_action('woocommerce_checkout_billing'); ?>


                <?php do_action('woocommerce_checkout_shipping'); ?>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <?php endif; ?>
        </div>
        <div class="w-full lg:w-4/12 px-4">
            <div class="border rounded py-4 px-6">
                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <h3 id="order_review_heading" class="text-3xl flex flex-wrap justify-between items-center mb-4 pb-4 border-b "><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->order_summary_title; ?>
                    <?php $item_counter = WC()->cart->cart_contents_count; ?>
                    <span class="text-base uppercase font-semibold">    
                        <?php 
                        if ($item_counter == 1) echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_singular; 
                        else echo $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_plural; 
                        ?>
                    </span>
                </h3>

                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

            </div>
            <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
    </div>
</form>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>