<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); 

global $dssSiteLanguage;

?>

<?php if ($has_orders) : ?>
	<script>
		jQuery(document).ready(function($) {
			var expanderID = '';
			$('.card-expander').on('click', function() {
              
				expanderID = $(this).attr('data-expander-id');
				//console.log(expanderID);
				if ($(this).find('.svg-inline--fa').hasClass('fa-plus')) {
					$(this).find('.svg-inline--fa').removeClass('fa-plus');
					$(this).find('.svg-inline--fa').addClass('fa-minus');
                    $('.order-content-acc.' + expanderID).slideDown();
                    $('.order-content-acc.' + expanderID).show();

				} else {
					$(this).find('.svg-inline--fa').addClass('fa-plus');
					$(this).find('.svg-inline--fa').removeClass('fa-minus');
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

        .woocommerce-orders-table__row {
            margin: 20px 0px;
        }

		.left-mobile
		{
			display: none;
			float: left;
		}

		@media (max-width: 754px) {
			.left-mobile
			{
				display: block;
			}
		}
	</style>
	<?php
	$orders = $customer_orders->orders;
	$pastOrdersCount = count($orders);

	?>
	<div class="account-header">
		<div class="account-header-inner">
			<div class="content-title">
				<h2><?php echo dssLang($dssSiteLanguage)->my_account->menu->order_history; ?> (<?php echo $pastOrdersCount; ?>)</h2>
				<div class="left-mobile">
					<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) );?>"><?php echo dssLang($dssSiteLanguage)->my_account->menu->back; ?></a>
				</div>
				
			</div>
			

			<!--<div class="welcome-title">
				 <p class="right-mobile">
					<?php echo $pastOrdersCount; ?>

					Past
					<?php if ($pastOrdersCount > 1) : ?>
						Orders
					<?php else : ?>
						Order
					<?php endif; ?>
				</p> 
				
			</div>-->
		</div>
	</div>
	<div class="orders">
		<?php $excount = 0; ?>
		<?php
		foreach ($customer_orders->orders as $customer_order) {
			$order      = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>
			<div class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr($order->get_status()); ?> order">
				<?php $current_date = ''; ?>
				<?php $previous = ''; ?>
				<?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>



					<?php if ('order-number' === $column_id) : ?>
						<?php $current_date = esc_html(wc_format_datetime($order->get_date_created())); ?>
						<?php if ($current_date != $previous_date) : ?>
							<?php $current_date = esc_html(wc_format_datetime($order->get_date_created())); ?>
						<?php else : ?>
							<?php $current_date = $previous_date; ?>
						<?php endif; ?>
						<?php $previous_date = esc_html(wc_format_datetime($order->get_date_created())); ?>


						<p><time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><strong><?php echo $current_date; ?></strong></time></p>
						<div class="order-item-content">
						<?php endif; ?>
						<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">


							<?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
								<?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

							<?php elseif ('order-number' === $column_id) : ?>
								<p><?php echo dssLang($dssSiteLanguage)->my_account->orders->order_number; ?> <?php echo $order->get_order_number(); ?></p>


							<?php elseif ('order-status' === $column_id) : ?>
								<?php $orderStatus = $order->get_status(); ?>
								<?php $statusClass = 'default-status'; ?>
								<?php if ($orderStatus == 'refunded') {
									$statusClass = 'gray';
								} ?>
								<div class="order-status <?php echo $statusClass; ?>">
									<span class="order-status-text">
										<?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
									</span>
									<?php echo '<div class="card-expander" data-expander-id="expander-' . $excount . '"><i class="fas fa-plus"></i></div>'; ?>
								</div>


							<?php elseif ('order-total' === $column_id) : ?>
								<?php $date_copmleted = esc_html(wc_format_datetime($order->get_date_completed())); 
                                $tracking = get_field('tracking_shipping', $order->get_id());
                                $trackingNum = $tracking['tracking_number'];
                                $provider = $tracking['shipping_provider'];
                                switch ($provider) {
                                    case 'usps':
                                        $providerURL = 'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=';
                                        break;
                                    case 'ups':
                                        $providerURL = 'https://www.ups.com/track?loc=en_US&tracknum=';
                                        break;
                                    case 'fedex':
                                        $providerURL = 'https://www.fedex.com/apps/fedextrack/?action=track&tracknumbers=';
                                        break;
                                    default:
                                        $providerURL = '#';
                                    break;
                                }
                                $trackingUrl = $providerURL . $trackingNum;

                                
                                ?>
								<div class="order-content-acc expander-<?php echo $excount; ?>" style="display:none;">
									<div class="order-details">
										<h3><?php echo dssLang($dssSiteLanguage)->my_account->orders->order_details; ?></h3>
										<hr>
										<div class="order-details-content">
											<div class="col-2">
												<p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->order_number; ?>: </strong><span><?php echo $order->get_order_number(); ?></span></p>
												<p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->order_date; ?>: </strong><span><?php echo $current_date; ?></span></p>
												<p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->order_total; ?>: </strong><span><?php echo $order->get_formatted_order_total(); ?></span></p>
											</div>
											<div class="col-2">
												<p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->status; ?>: </strong><span><?php echo esc_html(wc_get_order_status_name($order->get_status())); ?></span></p>
												<?php if ($date_copmleted) { ?>
													<p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->date_shipped; ?>: </strong><span><?php echo $date_copmleted; ?></span></p>
												<?php } ?>
                                                <p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->shipping_total; ?>:</strong><span><?php echo get_woocommerce_currency_symbol() . number_format($order->get_shipping_total(), 2, '.', '');  ?></span></p>
                                                <?php if($trackingNum): ?>
                                                <p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->tracking_number; ?>: </strong><span><a href="<?php echo $trackingUrl; ?>" target="_blank"><?php echo $trackingNum; ?></a></span></p>
                                                <?php endif; ?>
											</div>
										</div>
										<?php // do_action( 'woocommerce_view_order', $order->get_order_number() ); 
										?>

                                        <?php 
                                            //get the order items
                                            $order_items = $order->get_items();
                                            //get product id
                                            $product_id = $order_items[0]['product_id'];
                                            echo $product_id;
                                                    // var_dump($order_items);
                                        ?>
                                        <!-- display order items -->
                                        <div class="order-items">
                                            <br /><h3><?php echo dssLang($dssSiteLanguage)->my_account->orders->items_ordered; ?></h3>
                                            <hr>
                                            <div class="order-items-content">
                                                <div class="col-2">
                                                    <?php foreach($order_items as $item_id => $item ): ?>
                                                    <?php 
                                                     $product_id = $item->get_product_id();
                                                     $variation_id = $item->get_variation_id();
                                                     $product = $item->get_product();
                                                     $product_name = $item->get_name();
                                                     $quantity = $item->get_quantity();
                                                     $subtotal = $item->get_subtotal();
                                                     $total = $item->get_total();
                                                     $tax = $item->get_subtotal_tax();
                                                     $taxclass = $item->get_tax_class();
                                                     $taxstat = $item->get_tax_status();
                                                     $allmeta = $item->get_meta_data();
                                                     $somemeta = $item->get_meta( '_whatever', true );
                                                     $product_type = $item->get_type();
                                                     //get product image
                                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );

                                                    //format the totla price with .00
                                                    $total = number_format($total, 2, '.', '');
                                                
                                                    ?>
                                                    
                                                    <div class="order-item">
                                                    
                                                        <div class="order-item-details">
                                                            <p><strong><?php echo $product_name; ?></strong></p>
                                                            <p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->quantity; ?>: </strong><span><?php echo $quantity; ?></span></p>
                                                            <p><strong><?php echo dssLang($dssSiteLanguage)->my_account->orders->total; ?>: </strong><span><?php echo get_woocommerce_currency_symbol() .$total; ?></span></p>
                                                        </div>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    
									            </div>
                                                    </div>
                                                    </div>
                                    </div>

									<?php
									/* translators: 1: formatted order total 2: total order items */
									// echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
									?>
									<?php
									$actions = wc_get_account_orders_actions($order);

									// if ( ! empty( $actions ) ) {
									// 	foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
									// 		echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									// 	}
									// }
									?>
								</div>
							<?php elseif ('order-actions' === $column_id) : ?>



							<?php endif; ?>
						</div>

					<?php endforeach; ?>
					<?php $excount++; ?>
						</div>
					<?php
				}
					?>
			</div>
			<?php do_action('woocommerce_before_account_orders_pagination'); ?>

			<?php if (1 < $customer_orders->max_num_pages) : ?>
				<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
					<?php if (1 !== $current_page) : ?>
						<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce'); ?></a>
					<?php endif; ?>

					<?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
						<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce'); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
				<a class="woocommerce-Button button" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>"><?php esc_html_e('Browse products', 'woocommerce'); ?></a>
				<?php esc_html_e('No order has been made yet.', 'woocommerce'); ?>
			</div>
		<?php endif; ?>

		<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
	</div>
	</div>