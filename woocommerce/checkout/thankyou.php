<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 */

defined('ABSPATH') || exit;

global $dssSiteLanguage;
?>

<div class="woocommerce-order">

    <?php
    if ($order) :

        do_action('woocommerce_before_thankyou', $order->get_id());
        ?>

        <?php if ($order->has_status('failed')) : ?>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
               class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                   class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
            <?php endif; ?>
        </p>

    <?php else : ?>
        <div class="flex flex-wrap -mx-4 container">

            <div class="w-full lg:w-8/12 px-4 mb-8 lg:pr-12">
                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received font-bold text-4xl flex items-center mb-4"><?php echo apply_filters('woocommerce_thankyou_order_received_text', dssLang($dssSiteLanguage)->woocommerce_thank_you->title, $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            
                <p class="text-xl mb-6"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->overview_message; ?></p>

                <div class="flex items-center lg:w-8/12 leading-5 mb-6">
                    <img class="w-16 mr-4" src="<?php echo get_template_directory_uri(); ?>/images/tree.png"
                         alt="Tree">
                    <p class="text-xl"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->save_a_tree; ?></p>
                </div>
                <table class="woocommerce-order-overview woocommerce-thankyou-order-details order_details text-xl w-3/4 inline-block mt-8">

                    <tr class="woocommerce-order-overview__order order">
                        <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->order_number; ?>:</td>
                        <td>
                            <strong class="pl-2 "><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </td>
                    </tr>

                    <tr class="woocommerce-order-overview__date date">
                        <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->order_date; ?>:</td>
                        <td>
                            <strong class="pl-2 "><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </td>
                    </tr>

                    <tr class="woocommerce-order-overview__total total">
                        <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->order_total; ?>:</td>
                        <td>
                            <strong class="pl-2 "><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </td>
                    </tr>

                    <?php if ($order->get_payment_method_title()) : ?>
                        <tr class="woocommerce-order-overview__payment-method method">
                            <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->payment_method; ?>:</td>
                            <td>
                                <strong class="pl-2 "><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
                            </td>
                        </tr>
                    <?php endif;

                    $show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
                    if ($show_shipping) : ?>
                        <tr>
                            <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->shipping_to; ?>:</td>
                            <td>
                                <p class="block pl-2 m-0 leading-relaxed">
                                    <?php echo wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce'))); ?>
                                </p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->shipping_to; ?>:</td>
                            <td>
                                <p class="block pl-2 m-0 leading-relaxed">
                                    <?php echo wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce'))); ?>
                                    <?php if ($order->get_billing_phone()) : ?>
                                        <?php echo esc_html($order->get_billing_phone()); ?>
                                    <?php endif; ?>

                                    <?php if ($order->get_billing_email()) : ?>
                                        <?php echo esc_html($order->get_billing_email()); ?>
                                    <?php endif; ?>
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>


                </table>
                <?php do_action('woocommerce_order_details_after_customer_details', $order); ?>
                <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
                <?php do_action('woocommerce_thankyou', $order->get_id()); ?>
            </div>
            <?php
            $image_switcher = 0;
            $image_options = array();
            $img_caldera = get_field('caldera_image', 'options');
            $img_spring = get_field('spring_image', 'options');
            $img_unmarked = get_field('unmarked_image', 'options');
            $img_default = get_stylesheet_directory_uri() . '/images/unmarked-truck.gif';
            foreach ($order->get_items() as $item) {
                $terms = get_the_terms($item['product_id'], 'product_cat');
                foreach ($terms as $term) {
                    $cat_slug = $term->slug;
                    $cat_name = $term->name;
                    // check if product cat have "caldera" in name/slug
                    if (((strpos($cat_slug, 'caldera') !== false) || ((strpos($cat_name, 'caldera') !== false))) && (!in_array('caldera', $image_options))) {
                        $image_options[] = 'caldera';
                    } // check if product cat have "spring" in name/slug
                    elseif (((strpos($cat_slug, 'spring') !== false) || ((strpos($cat_name, 'spring') !== false))) && (!in_array('spring', $image_options))) {
                        $image_options[] = 'spring';
                    }
                }
            }
            $image_switcher = count($image_options);

            if ($image_switcher == 0 || $image_switcher == 2) {
                $image_url = $img_unmarked ? $img_unmarked['url'] : $img_default;
            } elseif ($image_options[0] == 'caldera') {
                $image_url = $img_caldera ? $img_caldera['url'] : $img_default;
            } elseif ($image_options[0] == 'spring') {
                $image_url = $img_spring ? $img_spring['url'] : $img_default;
            } else {
                $image_url = $img_default;
            }

            $image_url = 'https://dswaves.s3.us-west-1.amazonaws.com/images/wordpress/checkout-truck.gif';
            $acf_truck_image = get_field('delivery_truck_replacement_image', 'options');
            if ($acf_truck_image && $acf_truck_image['url'])
            {
                $image_url = $acf_truck_image['url'];
            }

            $support_number = get_field('order_check_out_support_phone_number', 'options');

            ?>
            <div class="w-full lg:w-4/12 px-4">
                <div class="rounded p-10 bg-gray-100 text-center shadow-lg">
                    <h2 class="text-4xl mb-4"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->right_side_questions; ?></h2>
                    <p>
                        <a href="tel:<?php echo $support_number;?>"
                           class="inline-block text-black font-bold text-semibold text-2xl mb-2"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->right_side_call; ?>
                            <?php echo $support_number;?></a>
                    </p>
                    <p>
                        <a class="default-btn orange mb-4"
                           href="mailto:<?php echo get_option('admin_email'); ?>"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->right_side_email_us; ?></a>
                    </p>
                    <hr class="mb-4">
                    <h2 class="text-4xl mb-4"><?php echo dssLang($dssSiteLanguage)->woocommerce_thank_you->right_side_get_ready_to_be_happy; ?> </h2>
                    <img class="w-3/4 mx-auto" src="<?php echo $image_url; ?>"
                         alt="Shipping">
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received text-4xl flex items-center mb-4"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank You For Your Order!', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

    <?php endif; ?>

</div>
