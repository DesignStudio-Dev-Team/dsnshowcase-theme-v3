<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$user_id = get_current_user_id();

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

global $dssSiteLanguage;
?>
<style>
	.account-stats {
		display: flex;
		flex-wrap: wrap;
		margin-top: 4em;
	}

	.account-stat {
		text-align: center;
		display: flex;
		justify-content: center;
		text-align: center;
		margin-bottom: 50px;
		padding: 0 15px;
		width: 100%;
	}

	.stat-inner {
		padding: 3em 0;
		border: 1px solid #A0AEC0;
		border-radius: 4px;
		width: 100%;
	}

	.account-stat h2 {
		font-size: 50px;
		color: #222;
		font-family: "Lato", sans-serif;
	}

	.account-stat h3 {
		font-size: 20px;
		color:var(--dsw-main-dealer-color) !important;
		font-family: "Lato", sans-serif;
        text-align:center;
	}
    .woocommerce-message {
        padding-left:50px !important;
    }
	.mobile-spent {
		display: none;
	}

	.mobile-logout {
		display: none;
	}

	@media (max-width: 1024px) {

		.mobile-logout {
			display: block;
		}
		
		.mobile-spent {
			display: block;
			padding-top: 1em;
		}

		.account-stats {
			gap: 1em;
			margin: 0;
		}

		.account-stat {
			width: calc(50% - 0.5em);
			padding: 0;
		}

		.stat-inner {
			padding: 2em 0;
			display: flex;
			flex-direction: column-reverse;
		}

		.account-stat h3 {
			font-size: 16px;
		}
	}

	@media (min-width: 1025px) {
		.account-stat {
			width: 33.333333%;

		}
	}
</style>
<script>
	jQuery(document).ready(function($) {

		$(window).on('load', function() {
			var subUrl = $('.woocommerce-MyAccount-navigation-link--subscriptions > a').attr('href') x;
			//console.log(subUrl);
			$('.subscription-link').attr('href', subUrl);

		});
	});
</script>
<div class="account-header">
	<div class="account-header-inner">
		<div class="content-title">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="welcome-title">
			<p>
				<?php
				// printf(
				// 	/* translators: 1: user display name 2: logout url */
				// 	wp_kses(__('Hi %1$s, Welcome Back!', 'woocommerce'), $allowed_html),
				// 	esc_html($current_user->first_name)
				// );
				?>
				<a href="<?php echo esc_url(wc_logout_url()); ?>" class="mobile-logout right"><?php echo dssLang($dssSiteLanguage)->my_account->menu->sign_out;?></a>
			</p>

			</p>
		</div>
	</div>
</div>
<?php

if($order_id){
$all_orders = wc_get_orders(
	array(
		'customer_id' => get_current_user_id(),
		'type' => 'shop_order', 
		'parent' => $order_id, 
		//'status' => array('wc-processing'),
		'limit' => -1, 
		'return' => 'ids')
);
$order_count = count($all_orders);

$processing_orders = wc_get_orders(
	array(
		'customer_id' => get_current_user_id(),
		'type' => 'shop_order', 
		'parent' => $order_id, 
		'status' => array('wc-processing'),
		'limit' => -1, 
		'return' => 'ids')
);
$processing_order_count = count($processing_orders);
} else {
    $order_count = 0;
    $processing_order_count = 0;
}

$total_spent = wc_price('0');
if ($user_id > 0) {
	$customer = new WC_Customer($user_id); // Get WC_Customer Object

	$total_spent = $customer->get_total_spent(); // Get total spent amount

	$total_spent = wc_price($total_spent); // return formatted total spent amount
}
?>
<?php

if(class_exists('WC_Subscriptions_Manager')) {
$allSubscriptions = WC_Subscriptions_Manager::get_users_subscriptions($user_id);
} else {
    $allSubscriptions = array();
}
$item_quantity = 0;

$pastSubsCount = count($allSubscriptions);
foreach ($allSubscriptions as $subscription) {
	if (($subscription['status'] == 'active' || $subscription['status'] == 'pending-cancel') == false) continue;
	$order = wc_get_order($subscription['order_id']);

	foreach ($order->get_items() as $item_id => $item_data) {
		if ($item_data->get_product()->get_id() != $product_id) continue;
		$item_quantity += $item_data->get_quantity();
	}
}

?>
<?php
$saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());
$saved_methods_count = count($saved_methods);
$customer_id = get_current_user_id();
if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __('Billing address', 'woocommerce'),
			'shipping' => __('Shipping address', 'woocommerce'),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __('Billing address', 'woocommerce'),
		),
		$customer_id
	);
}
$saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());

// var_dump(count($saved_methods));
$ccCount = 0;
if(!empty($saved_methods)){
	$ccCount = count($saved_methods['cc']);
}
?>
<div class="mobile-spent">
	<p class="text-right">
		<?php echo $total_spent; ?> <?php echo dssLang($dssSiteLanguage)->my_account->dashboard->total_spent; ?>
	</p>
</div>
<div class="account-stats">
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="account-stat">
		<div class="stat-inner py-20 ">
			<h2><?php echo $processing_order_count; ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->active_orders; ?></h3>
		</div>
	</a>
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="account-stat">
		<div class="stat-inner">
			<h2><?php echo $order_count; ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->previous_orders; ?></h3>
		</div>
	</a>
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="account-stat" id="total_spent_desktop">
		<div class="stat-inner">
			<h2><?php echo $total_spent; ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->total_spent; ?></h3>
		</div>
	</a>
	<?php 
    if(class_exists('WC_Subscriptions_Manager')) { ?>
    <a href="<?php echo esc_url(wc_get_account_endpoint_url('subscriptions')); ?>" class="account-stat subscription-link">
		<div class="stat-inner">
			<h2><?php echo $pastSubsCount; ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->subscriptions; ?>
			
			<?php echo dssLang($dssSiteLanguage)->my_account->dashboard->subscriptions; ?></h3>
		</div>
	</a>
<?php } ?>
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="account-stat">
		<div class="stat-inner">
			<h2><?php echo count($get_addresses); ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->addresses; ?></h3>
		</div>
	</a>
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('payment-methods')); ?>" class="account-stat">
		<div class="stat-inner">
			<h2><?php echo $ccCount; ?></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->payment_methods; ?></h3>
		</div>
	</a>
	<a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="account-stat" id="account_settings_mobile">
		<div class="stat-inner">
			<h2><i class="fa fa-cog"></i></h2>
			<h3><?php echo dssLang($dssSiteLanguage)->my_account->dashboard->account_settings; ?></h3>
		</div>
	</a>

</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
