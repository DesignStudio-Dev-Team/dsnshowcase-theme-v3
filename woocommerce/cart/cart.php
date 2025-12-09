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
<div class="dsn:container dsn:mx-auto dsn:px-4">
    <!-- Page Header -->
    <div class='dsn:py-6 dsn:border-b dsn:flex dsn:justify-between dsn:items-center dsn:mb-8'>
      <h1><?php the_title() ?></h1>
    </div>

    <div class="dsn:sm:flex dsn:gap-13 dsn:pt-10 dsn:mb-12">
        <div class="cart-page-wrapper-left dsn:md:flex dsn:md:flex-col dsn:gap-13 dsn:md:w-2/3">
          <!-- Cart Wrapper -->
          <div class="dsn-cart-items-wrapper dsn:sm:border dsn:sm:p-10  dsn:sm:border-gray-200">
            <div class="dsn:flex dsn:items-center dsn:gap-4 dsn:pb-4 dsn:justify-between">
              <h4 class="dsn:m-0"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->cart_items; ?></h4>
              
              <?php
              // Display VIP pricing banner inline with heading
              $has_vip_pricing = false;
              
              if (function_exists('syndified_get_product_discount') && WC()->cart) {
                  foreach (WC()->cart->get_cart() as $cart_item) {
                      $product_id = $cart_item['product_id'];
                      $discount_info = syndified_get_product_discount($product_id);
                      
                      if ($discount_info && isset($discount_info['value']) && $discount_info['value'] > 0) {
                          $has_vip_pricing = true;
                          break;
                      }
                  }
              }
              
              if ($has_vip_pricing): ?>
                  <div class="syndified-vip-cart-banner dsn:bg-stihl-orange dsn:text-black dsn:px-4 dsn:py-2 dsn:rounded-full dsn:font-semibold dsn:text-sm dsn:whitespace-nowrap">
                      De onderstaande prijzen zijn uw gereduceerde professionele prijzen.
                  </div>
              <?php endif; ?>
            </div>

            <?php
            $item_counter = WC()->cart->cart_contents_count; ?>
            <p class="cart-counter dsn:text-sm dsn:text-gray-600">
              <?php
              if ($item_counter === 1) {
                echo $item_counter.' '
                  .dssLang($dssSiteLanguage)->woocommerce_cart->item_singular;
              } else {
                echo $item_counter.' '
                  .dssLang($dssSiteLanguage)->woocommerce_cart->item_plural;
              }
              ?>
            </p>
            <form class="woocommerce-cart-form" action="<?php
            echo esc_url(wc_get_cart_url()); ?>" method="post">
              <?php
              do_action('woocommerce_before_cart_table'); ?>

              <table
                class="shop_table shop_table_responsive cart woocommerce-cart-form__contents dsn:w-full"
                cellspacing="0">
                <tbody>
                <?php
                do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
                {
                  $_product = apply_filters('woocommerce_cart_item_product',
                    $cart_item['data'], $cart_item, $cart_item_key);
                  $product_id
                            = apply_filters('woocommerce_cart_item_product_id',
                    $cart_item['product_id'], $cart_item, $cart_item_key);

                  if ($_product && $_product->exists()
                    && $cart_item['quantity'] > 0
                    && apply_filters('woocommerce_cart_item_visible', true,
                      $cart_item, $cart_item_key)
                  ) {
                    $product_permalink
                      = apply_filters('woocommerce_cart_item_permalink',
                      $_product->is_visible()
                        ? $_product->get_permalink($cart_item) : '', $cart_item,
                      $cart_item_key);
                    ?>
                    <tr
                      class="woocommerce-cart-form__cart-item dsn:align-middle dsn:py-4 dsn:border-b <?php
                      echo esc_attr(apply_filters('woocommerce_cart_item_class',
                        'cart_item', $cart_item, $cart_item_key)); ?>">

                      <td
                        class="product-thumbnail dsn:w-[80px] dsn:h-[80px] dsn:bg-gray-100 dsn:rounded dsn:flex dsn:items-center dsn:justify-center dsn:overflow-hidden dsn:align-middle dsn:border-0">
                        <?php
                        $thumbnail_args = [
                          'class' => 'dsn:border-0'
                        ];
                        $thumbnail
                                        = apply_filters('woocommerce_cart_item_thumbnail',
                          $_product->get_image('woocommerce_thumbnail',
                            $thumbnail_args), $cart_item, $cart_item_key);

                        if ( ! $product_permalink) {
                          echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                          printf('<a href="%s">%s</a>',
                            esc_url($product_permalink),
                            $thumbnail); // PHPCS: XSS ok.
                        }
                        ?>
                      </td>

                      <td
                        class="product-name flex-grow dsn:px-4 dsn:leading-snug dsn:align-middle"
                        data-title="<?php
                        esc_attr_e('Product', 'woocommerce'); ?>">
                        <div class='dsn:flex-grow'>
                          <?php
                          if ( ! $product_permalink) {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name',
                                $_product->get_name(), $cart_item,
                                $cart_item_key).'&nbsp;');
                          } else {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name',
                              sprintf('<a class="text-xl inline-block text-gray-600 hover:text-gray-800" href="%s">%s</a>',
                                esc_url($product_permalink),
                                $_product->get_name()), $cart_item,
                              $cart_item_key));
                          }

                          do_action('woocommerce_after_cart_item_name',
                            $cart_item, $cart_item_key);

                          // Meta data.
                          echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                          // Backorder notification.
                          if ($_product->backorders_require_notification()
                            && $_product->is_on_backorder($cart_item['quantity'])
                          ) {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification',
                              '<p class="backorder_notification">'
                              .esc_html__('Available on backorder',
                                'woocommerce').'</p>', $product_id));
                          }
                          ?>
                        </div>
                      </td>

                      <td class="product-quantity dsn:pr-4 dsn:align-middle"
                          data-title="<?php
                          esc_attr_e('Quantity', 'woocommerce'); ?>">
                        <div
                          class="dsn:flex dsn:items-start dsn:justify-end dsn:gap-2">
                          <?php
                          if ($_product->is_sold_individually()) {
                            $product_quantity
                              = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />',
                              $cart_item_key);
                          } else {
                            $product_quantity = woocommerce_quantity_input(
                              [
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => $_product->get_max_purchase_quantity(),
                                'min_value'    => '0',
                                'product_name' => $_product->get_name(),
                              ],
                              $_product,
                              false
                            );
                          }

                          echo apply_filters('woocommerce_cart_item_quantity',
                            $product_quantity, $cart_item_key,
                            $cart_item); // PHPCS: XSS ok.
                          ?>

                          <div
                            class='dsn-woocommerce-delete-item-container dsn:primary-site-background dsn:px-3 dsn:w-10 dsn:h-10 dsn:mb-2 dsn:rounded dsn:flex dsn:items-center'>
                            <?php
                            ob_start();
                            dsn_icon('trash',
                              'dsn:w-4 dsn:h-4 dsn:text-white');
                            $trash_icon = ob_get_clean();

                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                              'woocommerce_cart_item_remove_link',
                              sprintf(
                                '<a href="%s" class="remove dsn:flex dsn:items-center dsn:justify-center dsn:transition-colors dsn:cursor-pointer" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                esc_html__('Remove this item',
                                  'woocommerce'),
                                esc_attr($product_id),
                                esc_attr($_product->get_sku()),
                                $trash_icon
                              ),
                              $cart_item_key
                            );
                            ?>
                          </div>
                      </td>

                      <td
                        class="product-item-price flex-grow-0 dsn:text-right dsn:align-middle"
                        data-title="<?php
                        esc_attr_e('Item Price', 'woocommerce'); ?>">
                        <div
                          class="dsn:flex dsn:flex-row dsn:items-center dsn:justify-end dsn:gap-2">
                          <?php
                          $regular_price = $_product->get_regular_price();
                          $active_price  = $_product->get_price(); // This already has the discount applied in the cart context

                          if ( (float) $active_price < (float) $regular_price ) {
                              echo '<del aria-hidden="true">' . wc_price( $regular_price ) . '</del>';
                              echo '<ins>' . wc_price( $active_price ) . '</ins>';
                          } else {
                              echo wc_price( $active_price );
                          }
                          ?>
                        </div>
                      </td>

                      <td
                        class="product-subtotal flex-grow-0 dsn:text-right text-gray-600 hover:text-gray-800 dsn:align-middle"
                        data-title="<?php
                        esc_attr_e('Subtotal', 'woocommerce'); ?>">
                        <?php
                        echo get_woocommerce_currency_symbol()
                          .number_format($_product->get_price()
                            * $cart_item['quantity'], 2, '.', ''); ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
                ?>

                <?php
                do_action('woocommerce_cart_contents'); ?>

                <tr>
                  <td colspan="6" class="actions">
                    <!-- <?php
                    if (wc_coupons_enabled()) :
                      ?>
                              <div class="coupon">
                                  <label for="coupon_code">
                                      <?php
                      esc_html_e('Coupon:', 'woocommerce');
                      ?>
                                  </label>
                                  <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php
                      esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                                  <button type="submit" class="button" name="apply_coupon" value="<?php
                      esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                                      <?php
                      esc_attr_e('Apply coupon', 'woocommerce'); ?>
                                  </button>
                                  <?php
                      do_action('woocommerce_cart_coupon'); ?>
                              </div>
                              <?php
                    endif; ?> -->

                    <button type="submit" class="button wc_update_cart"
                            name="update_cart" value="<?php
                    esc_attr_e('Update cart', 'woocommerce'); ?>"><?php
                      esc_html_e('Update cart', 'woocommerce'); ?></button>

                    <?php
                    do_action('woocommerce_cart_actions'); ?>

                    <?php
                    wp_nonce_field('woocommerce-cart',
                      'woocommerce-cart-nonce'); ?>
                  </td>
                </tr>

                <?php
                do_action('woocommerce_after_cart_contents'); ?>
                </tbody>
              </table>
              <?php
              do_action('woocommerce_after_cart_table'); ?>
            </form>
            <?php
            do_action('woocommerce_before_cart_collaterals'); ?>
          </div>
          <!-- More Products Section -->
          <div class="dsn-more-products-wrapper dsn:sm:rounded dsn:sm:border dsn:sm:p-10 dsn:sm:border-gray-200">
            <?php $arg = array(
              'post_type' => 'product',
              'order' => 'ASC',
              'orderby' => 'rand',
              'posts_per_page' => 12
            );
            $the_query = new WP_Query($arg);
            if ($the_query->have_posts()) : ?>
              <div class="dsn:mb-12">
                <h4 class=""><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->more_products_for_you;?></h4>
                <div class="w-full slick-slider cart-slider -mx-4" role="region" aria-label="Recommended products">
                  <?php while ($the_query->have_posts()) :
                    $the_query->the_post(); ?>
                    <div class="cart-slide px-4">
                      <a href="<?php echo get_the_permalink(); ?>" class="text-black hover:text-gray-500">
                                <span class="cart-slide__thumb">
                                    <?php the_post_thumbnail('full', array('class' => 'cart-slide__img')); ?>
                                </span>
                        <span class="cart-slide__title block font-bold m-0 text-lg mb-2"><?php the_title(); ?></span>
                        <?php $product = wc_get_product(get_the_ID()); ?>
                        <span class="cart-slide__price block space-x-1 text-base">
                                    <?php echo $product->get_price_html(); ?>
                                </span>
                      </a>
                    </div>
                  <?php endwhile; ?>
                </div>
                <script>
                  jQuery(document).ready(function($) {
                    if (typeof $.fn.slick !== 'undefined') {
                      const $slider = jQuery('.cart-slider');

                      $slider.slick({
                        cssEase: 'ease',
                        arrows: true,
                        dots: false,
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        variableWidth: false,
                        adaptiveHeight: false,
                        responsive: [{
                          breakpoint: 1024,
                          settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            adaptiveHeight: false
                          }
                        },
                          {
                            breakpoint: 480,
                            settings: {
                              slidesToShow: 1,
                              slidesToScroll: 1,
                              adaptiveHeight: false
                            }
                          }
                        ]
                      });
                    } else {
                      console.error('Slick slider is not loaded on cart page');
                    }
                  });
                </script>
              </div>
            <?php endif;
            wp_reset_query(); ?>
          </div>
        </div>

        <div class="cart-page-wrapper-right dsn:md:p-10 dsn:md:rounded dsn:md:border dsn:md:border-gray-200 dsn:md:w-1/3">
          <!-- Order Summary -->
          <div class="dsn-order-summary-wrapper">
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
</div>

<?php do_action('woocommerce_after_cart'); ?>