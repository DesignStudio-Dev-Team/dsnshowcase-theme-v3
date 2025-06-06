<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>
<style>
	.woocommerce-notices-wrapper {
		max-width: 500px;
		margin: 0 auto;
		padding: 20px;
	}

	#lost_reset_password {
		max-width: 500px;
		margin: 0 auto;
		font-family: "Lato", sans-serif;
	}
	.woocommerce form.checkout_coupon,
	.woocommerce form.login,
	.woocommerce form.register {
		border: none;
	}
	.woocommerce form .form-row-first, .woocommerce form .form-row-last, .woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last{
		width: 100%;
	}
	.woocommerce-form-row label {
		text-align: left;
		font-family: "Lato", sans-serif;
	}

	.woocommerce-Button{
		width: 100%;
		float: none !important;
		font-weight: 400 !important;
		font-size: 20px;
		font-family: "Lato", sans-serif;
		margin-top: 20px !important;
	}
	.cancel{
		color: #0054FF !important;
		font-weight: 900;
		cursor: pointer;
	}
	.lost_reset_password h2 {
		text-align: center;
		font-weight: 300;
		font-family: "Lato", sans-serif;
		font-size: 32px;
	}
	.lost_reset_password p {
		text-align: center;
		font-family: "Lato", sans-serif;
		font-size: 18px;
	}
	.toggle-form {
		color: #0054FF;
		font-weight: 900;
		cursor: pointer;
	}
	.woocommerce-form-row label {
		color: #222222;
		font-size: 20px;
		font-weight: 900;
		font-family: "Lato", sans-serif;
	}
	.woocommerce-form-login__submit {
		width: 100%;
		border-radius: 4px !important;
		margin-bottom: 10px !important;
	}
	.woocommerce-LostPassword {
		font-size: 18px;
		font-weight: 900;
		margin-left: 5px;
		margin-bottom: 0;
		font-family: "Lato", sans-serif;
		
	}
	.woocommerce-LostPassword a {
		color: #0054FF !important;
	}
	.woocommerce-form-row input[type="text"],
	.woocommerce-form-row input[type="password"],
	.woocommerce-form-row input[type="email"] {
		padding: 10px 15px !important;
		border:1px solid #A0AEC0 !important;
		border-radius: 4px;
	}
	.lost_reset_password{
		margin-bottom:50px;
	}
</style>


<div class="u-column1 col-1" id="lost_reset_password">
	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<h2><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Forgot your password?', 'woocommerce')); ?></h2><?php // @codingStandardsIgnoreLine 
																																			?>
		<p><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Please enter your email address to request a password reset.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine 
																																												?>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="user_login"><?php esc_html_e('Email', 'woocommerce'); ?></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username"  placeholder="<?php esc_html_e('Email Address', 'woocommerce'); ?>"/>
		</p>

		<div class="clear"></div>

		<?php do_action('woocommerce_lostpassword_form'); ?>

		<p class="woocommerce-form-row form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
			<a href="/my-account//" class="cancel">Cancel</a>
		</p>

		<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

	</form>
</div>

<style>
    .woocommerce a {
        color:var(--dsw-main-dealer-color) !important;
    }
    .woocommerce .woocommerce-form-login button{
        color:#fff !important;
        background-color:var(--dsw-main-dealer-color) !important;
    }
</style>
<?php
do_action('woocommerce_after_lost_password_form');
