<?php
/**
 * Product Cart Actions Template Part
 * Displays add to cart button or quantity controls based on cart status
 *
 * @var int $postID - Product ID
 * @var object $translatedText - Translated text object
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! isset( $postID ) ) {
    return;
}
?>

<div class="ds-product__action_buttons dsn:flex dsn:gap-2">
    <?php if ( dsn_show_other_action_buttons( $postID ) ) : ?>
        <?php if ( dsn_show_reserve_btn( $postID ) ) : ?>
            <!-- Reserve Button -->
            <a href="<?php echo esc_url( dsn_get_cta_url( $postID ) ); ?>"
               class="ds-reserve-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:ml-2 dsn:w-10 dsn:h-9 dsn:px-3 dsn:py-2 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded"
               title="<?php echo esc_attr( $translatedText->woocommerce_cart->reserve_button ); ?>">
                <span class="dsn:flex dsn:items-center">
                    <?php dsn_icon( 'reserve', 'dsn:w-5 dsn:h-5' ); ?>
                </span>
            </a>
        <?php elseif ( dsn_show_get_info_btn( $postID ) ) : ?>
            <!-- Get Info Button -->
            <a href="<?php echo esc_url( dsn_get_cta_url( $postID ) ); ?>"
               class="ds-info-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:ml-2 dsn:w-10 dsn:h-9 dsn:px-3 dsn:py-2 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded"
               title="<?php echo esc_attr( $translatedText->woocommerce_cart->info_button ); ?>">
                <span class="dsn:flex dsn:items-center">
                    <?php dsn_icon( 'info', 'dsn:w-5 dsn:h-5' ); ?>
                </span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ( dsn_show_add_to_cart( $postID ) ) : ?>
        <?php 
            $cart_quantity = dsn_get_cart_product_quantity( $postID );
            $is_in_cart = $cart_quantity > 0;
        ?>
        
        <?php if ( $is_in_cart ) : ?>
            <!-- Quantity Controls (when product is in cart) -->
            <div class="ds-product-quantity-controls dsn:primary-site-background dsn:text-white dsn:flex dsn:items-center dsn:px-3 dsn:py-2 dsn:rounded"
                 data-product-id="<?php echo esc_attr( $postID ); ?>">
                <button type="button"
                        class="ds-quantity-decrease dsn:opacity-5 dsn:w-9 dsn:h-9 dsn:flex dsn:items-center dsn:justify-center dsn:hover:bg-gray-300 dsn:rounded dsn:transition-colors dsn:cursor-pointer"
                        data-product-id="<?php echo esc_attr( $postID ); ?>" 
                        aria-label="<?php esc_attr_e( 'Decrease quantity', 'dsnshowcase-theme-v3' ); ?>">
                    <?php dsn_icon( 'minus', 'dsn:w-4 dsn:h-4' ); ?>
                </button>
                <span class="ds-product-quantity dsn:w-12 dsn:px-2 dsn:text-center dsn:font-semibold dsn:text-base"
                      data-product-id="<?php echo esc_attr( $postID ); ?>">
                    <?php echo esc_html( $cart_quantity ); ?>
                </span>
                <button type="button" 
                        class="ds-quantity-increase dsn:opacity-5 dsn:w-9 dsn:h-9 dsn:flex dsn:items-center dsn:justify-center dsn:hover:bg-gray-300 dsn:rounded dsn:transition-colors dsn:cursor-pointer"
                        data-product-id="<?php echo esc_attr( $postID ); ?>" 
                        aria-label="<?php esc_attr_e( 'Increase quantity', 'dsnshowcase-theme-v3' ); ?>">
                    <?php dsn_icon( 'plus', 'dsn:w-4 dsn:h-4' ); ?>
                </button>
            </div>
        <?php else : ?>
            <!-- Add to Cart Button (when product is not in cart) -->
            <button type="button" 
                    class="ds-add-to-cart-button dsn:primary-site-background dsn:text-white dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:px-3 dsn:py-2 dsn:rounded dsn:transition-colors dsn:cursor-pointer"
                    data-product-id="<?php echo esc_attr( $postID ); ?>" 
                    title="<?php echo esc_attr( $translatedText->woocommerce_cart->add_to_cart_btn ); ?>">
                <span class='dsn:flex dsn:items-center'>
                    <?php dsn_icon( 'plus', 'dsn:w-4 dsn:h-4' ); ?>
                </span>
                <span class="dsn:flex dsn:items-center">
                    <?php dsn_icon( 'shopping-cart', 'dsn:w-5 dsn:h-5' ); ?>
                </span>
            </button>
        <?php endif; ?>
    <?php endif; ?>
</div>

