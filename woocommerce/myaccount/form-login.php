<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php 

?>
<style>
	.woocommerce-notices-wrapper{
		max-width: 500px; 
		margin: 0 auto;
		padding: 20px;
	}
	.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register {
		border: none;
	}
	#customer_login h2 {
		text-align: center;
		font-weight: 300;
		font-family: "Lato", sans-serif;
	}
	.woocommerce-form {
		
	}
	#customer_login {
		max-width: 500px;
		margin: 0 auto;
	}
	.toggle-form {
		color: #193d94;
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
	.login-extras,{
		display: flex;
	}
	.login-extras {
		align-items: self-start;
	}
	.register-extras {
		align-items: center;
	}
	.login-show,
	.woocommerce-form-register__submit {
		margin-bottom: 0 !important;
	}
	.noaccount,
	.login-show {
		margin-left: auto;
		text-align: right;
	}
	.noaccount p,
	p.login-show {
		margin-bottom: 0;
		font-size: 18px;
		font-family: "Lato", sans-serif;
		color: #222222;
	}
	.noaccount p.create-account,
	p.login-show {
		color: #0054FF;
	}
	.woocommerce-form-login__rememberme {
		display: flex !important;
		align-items: center;
		margin-left: 5px;
	}
	.woocommerce-form-login__rememberme input {
		width: 20px;
		height: 20px;
		margin-top: 0 !important;
		margin-bottom: 0 !important;
	}
	.woocommerce-form-login__rememberme span {
		font-size: 18px;
		font-family: "Lato", sans-serif;
		color: #222222;
		margin-left: 10px;
	}
	.show-password {
		position: absolute;
		right: .7em;
		top: .7em;
		cursor: pointer;
	}
	.show-password-input {
		display: none;
	}
	.show-password {
		color: #4A5568 !important;
	}
	.woocommerce-form-register__submit{
		float: none !important;
		display: block; 
		width:100%; 
	}
	
	.login-show {
		text-align: center;
		display: block; 
		width:100%; 
	}
</style>
<script>
	jQuery(document).ready(function( $ ) {
		$('.create-account').on('click', function(e) {
			
			console.log('haidfhaskf');
			$('#woo-login').css('display', 'none');
			$('#woo-register').fadeIn();
		});
		$('.login-show').on('click', function(e) {
			
			console.log('haidfhaskf');
			$('#woo-register').css('display', 'none');
			$('#woo-login').fadeIn();
		});
		$(window).on('load', function(){
			$('#woo-login .password-input, #woo-register .password-input ').append('<i class="show-password fas fa-eye"></i>');
			$('#woo-login .show-password, #woo-register .show-password').on('click', function() {
					
				var pinput = $(".password-input input");
				if (pinput.attr("type") === "password") {
					$(this).removeClass('fa-eye');
					$(this).addClass('fa-eye-slash');
				  pinput.attr("type", "text");
				} else {
					$(this).addClass('fa-eye');
					$(this).removeClass('fa-eye-slash');
				  pinput.attr("type", "password");

				}

			});
		});
	});

</script>

<div class="" id="customer_login">

	<div class="u-column1 col-1 login-form" id="woo-login">


		<h2><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>
			
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><strong><?php esc_html_e( 'Email or Username', 'woocommerce' ); ?></strong></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" placeholder="Email or Username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><strong><?php esc_html_e( 'Password', 'woocommerce' ); ?></strong></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password" />
				
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>
			
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><strong><?php esc_html_e( 'Forgot Password?', 'woocommerce' ); ?></strong></a>
			</p>
			<p class="form-row">

				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Sign In', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<div class="form-row login-extras">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<div class="noaccount">
					<p>Don't have an account Yet?</p>
					<p class="create-account toggle-form"><strong>Create Account Now</strong></p>
				</div>
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>



	</div>

	<div class="u-column1 col-1 register-form" style="display:none;" id="woo-register">

		<h2><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></h2>
		<p style="font-size: 18px; text-align: center;">Create an account to manage your orders and subscriptions.</p>
		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" placeholder="Email Address" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text password-field" name="password" id="reg_password" autocomplete="new-password" placeholder="Password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>


			<div class="register-extras">
				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				</p>
				<p><button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Create Account', 'woocommerce' ); ?>" style="display: block;width: 100%;"><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></button></p>
				<p class="login-show toggle-form"><strong>Cancel</strong></p>
			</div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<style>
    .woocommerce a, .noaccount p.create-account, p.login-show {
        color:var(--dsw-main-dealer-color) !important;
    }
    .woocommerce .woocommerce-form-login .woocommerce-form-login__submit {
        color:#fff !important;
        background-color:var(--dsw-main-dealer-color) !important;
    }
</style>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
