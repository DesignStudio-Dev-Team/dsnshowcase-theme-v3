<?php

/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.9.0
 */

defined('ABSPATH') || exit;

$saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

do_action('woocommerce_before_account_payment_methods', $has_methods); ?>
<style>
	.cardbtn.save {
		display: none !important;
	}

	.cardlist {
		margin-left: 0 !important;
	}

	.cardlist li {
		border: 1px solid #A0AEC0;
		border-radius: 4px;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		margin-bottom: 1em;
		padding: 5px 0;
	}

	.cardlist p {
		margin: 0;
		font-size: 18px;
		color: #4A5568;
		font-family: "Lato", sans-serif;
	}

	.cardlist .card-label {
		display: flex;
		width: 100%;
		padding: 5px 0;
	}

	.cardlist .card-label img {
		margin-right: 15px;
	}

	.woocommerce-PaymentMethod--method {
		width: 50%;
		padding-left: 20px;
	}

	.woocommerce-PaymentMethod--actions {

		border-top: 1px solid #A0AEC0;
		width: 100%;

	}

	.expander-content {
		width: 100%;
	}

	.expander-content hr {
		border-color: #DADCDF;
	}

	.expires-wrap {
		display: flex;
		align-items: center;
		padding-right: 20px;
	}

	.expires {
		font-family: "Lato", sans-serif;
	}

	.cardbtn {
		margin: 0 10px;
	}

	.expires strong {
		font-weight: 900 !important;
	}

	.card-expander {
		margin-left: auto;
		padding-right: 20px;
		cursor: pointer;
	}

	.woocommerce-PaymentMethod--expires {
		width: 50%;
	}

	.payment-method-actions {
		display: none;
	}

	.card-details {
		padding: 20px 20px;
	}

	.edit-card {
		display: flex;
		align-items: center;
	}

	.edit-card h4 {
		font-family: "Lato", sans-serif;
		font-size: 28px;
	}

	.edit-card a {
		color: #0054FF !important;
		font-family: "Lato", sans-serif;
		font-weight: 900;
		font-size: 20px;
	}

	.card-methods {
		margin-left: auto;
	}

	.card-methods {
		display: flex;
		align-items: center;
	}

	.card-methods span {
		font-size: 24px;
		color: #4A5568;
		font-weight: 900;
		font-family: "Lato", sans-serif;
	}

	.card-methods span:last-child {
		display: none;
	}

	.edit-card hr {
		margin-top: 15px;
	}

	.payment-details p {
		font-family: "Lato", sans-serif;
		font-size: 20px;
		color: #222;
		font-weight: normal;
	}

	.payment-details p strong {
		width: 150px;
		display: inline-block;
		font-weight: 900;
	}

	.card-title {
		font-family: "Lato", sans-serif;
		font-size: 20px;
		color: #222;
		margin-top: 2em;
		margin-bottom: 1em;
	}

	a.add-payment-btn {
		padding: 0;
		color: #0054FF !important;
		font-family: "Lato", sans-serif;
		font-size: 20px;
		display: flex;
		align-items: center;
		margin-top: 2em;
	}

	a.add-payment-btn svg {

		margin-right: 10px;
	}
</style>
<script>
	jQuery(document).ready(function($) {
		var expanderID = '';
		$('.card-expander').on('click', function() {
			expanderID = $(this).attr('data-expander-id');
			console.log(expanderID);
			if ($(this).find('.svg-inline--fa').hasClass('fa-plus')) {
				$(this).find('.svg-inline--fa').removeClass('fa-plus');
				$(this).find('.svg-inline--fa').addClass('fa-minus');
				$('.payment-method-actions.' + expanderID).slideDown();
			} else {
				$(this).find('.svg-inline--fa').addClass('fa-plus');
				$(this).find('.svg-inline--fa').removeClass('fa-minus');
				$('.payment-method-actions.' + expanderID).slideUp();
			}
		});
	});
</script>
<?php if ($has_methods) : ?>

	<?php $methodCount = count($saved_methods['cc']); ?>
	<div class="account-header">
		<div class="account-header-inner">
			<div class="content-title">
				<h2>Stored Payment Methods</h2>
			</div>
			<div class="welcome-title">
				<p class="right-mobile">

					<?php echo $methodCount; ?>
					Payment
					<?php if ($methodCount > 1) : ?>
						Methods
					<?php else : ?>
						Method
					<?php endif; ?>
				</p>
				<p class="left-mobile">
					<a href="/my-account/">Back</a>
				</p>
			</div>
		</div>
	</div>
	<h3 class="card-title">Credit or Debit Card</h3>
	<ul class="cardlist">
		<?php $excount = 0; ?>
		<?php foreach ($saved_methods as $type => $methods) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
		?>
			<?php foreach ($methods as $method) : ?>

				<li class="payment-method<?php echo !empty($method['is_default']) ? ' default-payment-method' : ''; ?>">

					<?php foreach (wc_get_account_payment_methods_columns() as $column_id => $column_name) : ?>

						<div class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr($column_id); ?> payment-method-<?php echo esc_attr($column_id); ?> expander-<?php echo $excount; ?>" data-title="<?php echo esc_attr($column_name); ?>">
							<?php
							if (has_action('woocommerce_account_payment_methods_column_' . $column_id)) {
								// do_action( 'woocommerce_account_payment_methods_column_' . $column_id, $method );
							} elseif ('method' === $column_id) {
								if (!empty($method['method']['last4'])) {
									/* translators: 1: credit card type 2: last 4 digits */
									echo '<div class="card-label">';
									echo '<img width="40" height="25" src="' . site_url() . '/wp-content/themes/syndified-theme-main/images/card-' . strtolower($method['method']['brand']) . '.svg">';
									// echo esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) );
									echo '<p>';
									echo $method['method']['brand'];
									echo ' ending in ';
									echo '<strong>' . $method['method']['last4'] . '</strong>';
									echo '</p>';
									echo '</div>';
									// echo sprintf( esc_html__( '%1$s ending in %2$s', 'woocommerce' ), esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ), esc_html( $method['method']['last4'] ) );
								} else {
									echo esc_html(wc_get_credit_card_type_label($method['method']['brand']));
								}
							} elseif ('expires' === $column_id) {
								echo '<div class="expires-wrap">';
								echo '<div class="expires">Good Thru: <strong>';
								echo esc_html($method['expires']);
								echo '</strong></div>';
								echo '<div class="card-expander" data-expander-id="expander-' . $excount . '"><i class="fas fa-plus"></i></div>';
								echo '</div>';
							} elseif ('actions' === $column_id) {
								$count = 1;
								$methodCount = count($method['actions']);
								echo '<div class="expander-content expander-' . $excount . '">';
								echo '<div class="card-details">';
								echo '<div class="edit-card">';
								echo '<h4>Card Details</h4>';
								echo '<div class="card-methods">';
								foreach ($method['actions'] as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
									if ($action['name'] == 'Edit') {
										continue;
									}
									echo '<a href="' . esc_url($action['url']) . '" class="cardbtn ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>&nbsp;';

									if (($methodCount > $count) && ($action['name'] != 'Save')) {
										echo '<span>|</span>';
									}
									$count++;
								}
								echo '</div>';
								echo '</div>';
								echo '<hr>';
								echo '<div class="method-info">';
								echo '<div class="col-2 payment-details">';
								echo '<p><strong>Card Number: </strong> **** **** **** ' . $method['method']['last4'] . '</p>';
								echo '<p><strong>Expiration Date: </strong> ' . esc_html($method['expires']) . '</p>';
								echo '</div>';
								echo '<div class="col-2">';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
							}
							?>
						</div>

					<?php endforeach; ?>

				</li>
				<?php $excount++; ?>
			<?php endforeach; ?>

		<?php endforeach; ?>
	</ul>


<?php else : ?>

	<p class="woocommerce-Message woocommerce-Message--info woocommerce-info"><?php esc_html_e('No saved methods found.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_account_payment_methods', $has_methods); ?>

<?php if (WC()->payment_gateways->get_available_payment_gateways()) : ?>
	<a class="add-payment-btn" href="<?php echo esc_url(wc_get_endpoint_url('add-payment-method')); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
			<g id="Icon_feather-plus-circle" data-name="Icon feather-plus-circle" transform="translate(-2 -2)">
				<path id="Path_6156" data-name="Path 6156" d="M33,18A15,15,0,1,1,18,3,15,15,0,0,1,33,18Z" fill="none" stroke="#0054ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
				<path id="Path_6157" data-name="Path 6157" d="M18,12V24" fill="none" stroke="#0054ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
				<path id="Path_6158" data-name="Path 6158" d="M12,18H24" fill="none" stroke="#0054ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
			</g>
		</svg>

		<?php esc_html_e('Add Card', 'woocommerce'); ?></a>
<?php endif; ?>