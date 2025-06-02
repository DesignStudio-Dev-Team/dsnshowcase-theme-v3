<?php

/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_shipping_calculator'); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

	<?php //printf( '<a href="#" class="shipping-calculator-button text-lg">%s</a>', esc_html( ! empty( $button_text ) ? $button_text : __( 'Calculate shipping', 'woocommerce' ) ) ); 
	?>

	<section class="shipping-calculator-form-new">
		<p class="mb-4 mt-8 text-lg"><?php esc_html_e('Calculate Shipping', 'woocommerce'); ?></p>

		<div class="flex gap-2">
			<?php if (apply_filters('woocommerce_shipping_calculator_enable_country', true)) : ?>
				<p class="form-row form-row-wide w-1/2" id="calc_shipping_country_field">
					<select name="calc_shipping_country" id="calc_shipping_country" class="p-3 border border-gray-200 rounded text-lg text-black h-12" rel="calc_shipping_state">
						<option value="default"><?php esc_html_e('Select a country / region&hellip;', 'woocommerce'); ?></option>
						<?php
						foreach (WC()->countries->get_shipping_countries() as $key => $value) {
							echo '<option value="' . esc_attr($key) . '"' . selected(WC()->customer->get_shipping_country(), esc_attr($key), false) . '>' . esc_html($value) . '</option>';
						}
						?>
					</select>
				</p>
			<?php endif; ?>

			<?php if (apply_filters('woocommerce_shipping_calculator_enable_state', false)) : ?>
				<p class="form-row form-row-wide" id="calc_shipping_state_field">
					<?php
					$current_cc = WC()->customer->get_shipping_country();
					$current_r  = WC()->customer->get_shipping_state();
					$states     = WC()->countries->get_states($current_cc);

					if (is_array($states) && empty($states)) {
					?>
						<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>" />
					<?php
					} elseif (is_array($states)) {
					?>
						<span>
							<select name="calc_shipping_state" class="state_select" id="calc_shipping_state" data-placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>">
								<option value=""><?php esc_html_e('Select an option&hellip;', 'woocommerce'); ?></option>
								<?php
								foreach ($states as $ckey => $cvalue) {
									echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_r, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
								}
								?>
							</select>
						</span>
					<?php
					} else {
					?>
						<input type="text" class="input-text" value="<?php echo esc_attr($current_r); ?>" placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>" name="calc_shipping_state" id="calc_shipping_state" />
					<?php
					}
					?>
				</p>
			<?php endif; ?>

			<?php if (apply_filters('woocommerce_shipping_calculator_enable_city', false)) : ?>
				<p class="form-row form-row-wide" id="calc_shipping_city_field">
					<input type="text" class="input-text" value="<?php echo esc_attr(WC()->customer->get_shipping_city()); ?>" placeholder="<?php esc_attr_e('City', 'woocommerce'); ?>" name="calc_shipping_city" id="calc_shipping_city" />
				</p>
			<?php endif; ?>

			<?php if (apply_filters('woocommerce_shipping_calculator_enable_postcode', true)) : ?>
				<div class="coupon under-proceed border rounded w-1/2 h-12">
					<input type="text" class="input-text text-lg px-3 ml-1 uppercase" name="calc_shipping_postcode" id="calc_shipping_postcode" value="<?php echo esc_attr(WC()->customer->get_shipping_postcode()); ?>" placeholder="<?php esc_attr_e('Zip Code', 'woocommerce'); ?>" style="width: 100%" />
					<button type="submit" class="button" name="calc_shipping" value="1"><?php esc_attr_e('Update', 'woocommerce'); ?></button>
				</div>
			<?php endif; ?>
		</div>

		<?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
	</section>
</form>

<?php do_action('woocommerce_after_shipping_calculator'); ?>