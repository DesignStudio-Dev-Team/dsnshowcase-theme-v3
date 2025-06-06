<?php

/**
 * My Subscriptions section on the My Account page
 *
 * @author   Prospress
 * @category WooCommerce Subscriptions/Templates
 * @version  2.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<div class="woocommerce_account_subscriptions">

	<?php if (!empty($subscriptions)) : ?>

		<script>
			jQuery(document).ready(function($) {
				var expanderID = '';
				$('.card-expander').on('click', function() {
					expanderID = $(this).attr('data-expander-id');
					console.log(expanderID);
					if ($(this).find('.fas').hasClass('fa-plus')) {
						$(this).find('.fas').removeClass('fa-plus');
						$(this).find('.fas').addClass('fa-minus');
						$('.order-content-acc.' + expanderID).slideDown();
					} else {
						$(this).find('.fas').addClass('fa-plus');
						$(this).find('.fas').removeClass('fa-minus');
						$('.order-content-acc.' + expanderID).slideUp();
					}
				});
			});
		</script>

		<style>
			.order-status {

				margin-left: auto;
			}

			.order-status-text {
				color: #fff;
				background: #11A500;
				font-weight: normal;
				font-family: "Lato", sans-serif;
				font-size: 16px;
				width: 130px;
				padding: .25em 0;
				text-align: center;
				border-radius: 20px;
			}

			.gray .order-status-text {
				background: #A0AEC0;

			}

			.woocommerce-orders-table__cell-order-status {
				margin-left: auto;
			}

			.woocommerce-orders-table__cell p {
				margin: 0;
				font-family: "Lato", sans-serif;
				font-size: 18px;

			}

			.woocommerce-orders-table__cell-order-total {
				width: 100%;
			}

			.order-item-content {

				display: flex;
				border: 1px solid #A0AEC0;
				padding: 10px 0px;
				border-radius: 4px;
				flex-wrap: wrap;
				margin-bottom: 1em;
			}

			.woocommerce-orders-table__cell-order-number {
				padding-left: 20px;
			}

			.woocommerce-orders-table__cell-order-status {
				padding-right: 20px;
			}

			.orders {
				margin-top: 2em;
			}

			.order-content-acc {
				display: none;
				margin-top: 1em;
				padding-top: 1em;
				border-top: 1px solid #A0AEC0;
			}

			.order-status {
				display: flex;
				align-items: center;
			}

			.card-expander {
				margin-left: 15px;
				cursor: pointer;
			}

			.order-details {
				padding-left: 20px;
				padding-right: 20px;
			}

			.order-details hr {
				border-color: #DADCDF;
			}

			.order-details-content strong {
				width: 200px;
				display: inline-block;
			}

			.red-cancelled .order-status-text {
				background: #E10000;
			}
		</style>

		<?php
		$subs = $subscriptions;
		$pastSubsCount = count($subs);
		?>

		<div class="account-header">
			<div class="account-header-inner">
				<div class="content-title">
					<h2>Subscriptions</h2>
				</div>
				<div class="welcome-title">
					<p class="right-mobile">
						<?php echo $pastSubsCount; ?>
						<?php if ($pastSubsCount > 1) : ?>
							Subscriptions
						<?php else : ?>
							Subscription
						<?php endif; ?>
					</p>
					<p class="left-mobile">
						<a href="/my-account/">Back</a>
					</p>
				</div>
			</div>
		</div>

		<div class="subscriptions" style="margin-top:15px;">
			<?php $subscount = 0;
			foreach ($subscriptions as $subscription_id => $subscription) { ?>
				<div class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr(wcs_get_subscription_status_name($subscription->get_status())); ?> order">
					<div class="order-item-content">
						<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($subscription_id); ?>" data-title="<?php echo esc_attr($subscription_id); ?>">
							<p style="padding-left:10px;">Subscription <?php echo esc_html(sprintf(_x('#%s', 'hash before order number', 'woocommerce-subscriptions'), $subscription->get_order_number())); ?></p>

							<?php

							$statusClass = "default-status";
							if ($subscription->get_status() == 'cancelled') {
								$statusClass = 'red-cancelled';
							}
							if ($subscription->get_status() == 'on-hold') {
								$statusClass = 'gray';
							}


							?>

						</div>
						<div class="woocommerce-orders-table__cell-order-status">
							<div class="order-status <?php echo $statusClass; ?>">
								<span class="order-status-text">
									<?php echo esc_html(wcs_get_subscription_status_name($subscription->get_status())); ?>
								</span>
								<?php echo '<div class="card-expander" data-expander-id="expander-' . $excount . '"><i class="fas fa-plus"></i></div>'; ?>
							</div>
						</div>
						<div class="woocommerce-orders-table__cell-order-total">
							<div class="order-content-acc expander-<?php echo $excount; ?>" style="display:none;">
								<div class="order-details">
									<h3>Subscription Details</h3>
									<hr>
									<div class="order-details-content">
										<div class="col-2">
											<p><strong>Subscription Number: </strong><span><?php echo esc_html(sprintf(_x('#%s', 'hash before order number', 'woocommerce-subscriptions'), $subscription->get_order_number())); ?></span></p>
											<p><strong>Subscription Total: </strong><span><?php echo wp_kses_post($subscription->get_formatted_order_total()); ?></span></p>
										</div>
										<div class="col-2">
											<p><strong>Status: </strong><span><?php echo esc_attr(wcs_get_subscription_status_name($subscription->get_status())); ?></span></p>
											<p><strong>Next Payment: </strong><span>
													<?php echo esc_attr($subscription->get_date_to_display('next_payment')); ?>
													<?php if (!$subscription->is_manual() && $subscription->has_status('active') && $subscription->get_time('next_payment') > 0) : ?>
														<br /><small><?php echo esc_attr($subscription->get_payment_method_to_display('customer')); ?></small>
													<?php endif; ?></span></p>
											<a href="<?php echo esc_url($subscription->get_view_order_url()) ?>" class="woocommerce-button button view"><?php echo esc_html_x('View', 'view a subscription', 'woocommerce-subscriptions'); ?></a>
											<?php do_action('woocommerce_my_subscriptions_actions', $subscription); ?>

										</div>
									</div>
								</div>

							</div>


						</div>
					</div>
					<?php $excount++; ?>
				</div>
			<?php
			}
			?>

		</div>


		<?php if (1 < $max_num_pages) : ?>
			<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
				<?php if (1 !== $current_page) : ?>
					<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url(wc_get_endpoint_url('subscriptions', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce-subscriptions'); ?></a>
				<?php endif; ?>

				<?php if (intval($max_num_pages) !== $current_page) : ?>
					<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url(wc_get_endpoint_url('subscriptions', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce-subscriptions'); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<p class="no_subscriptions woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
			<?php if (1 < $current_page) :
				printf(esc_html__('You have reached the end of subscriptions. Go to the %sfirst page%s.', 'woocommerce-subscriptions'), '<a href="' . esc_url(wc_get_endpoint_url('subscriptions', 1)) . '">', '</a>');
			else :
				esc_html_e('You have no active subscriptions.', 'woocommerce-subscriptions');
			?>
				<a class="woocommerce-Button button" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
					<?php esc_html_e('Browse products', 'woocommerce-subscriptions'); ?>
				</a>
			<?php
			endif; ?>
		</p>

	<?php endif; ?>

</div>
</div>
</div>