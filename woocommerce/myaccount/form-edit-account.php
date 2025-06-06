<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );

global $dssSiteLanguage;

?>
<style>
	.woocommerce-form-row {
		max-width: 500px;
	}
	.woocommerce-EditAccountForm {
		margin-top: 3em;
	}
	.woocommerce-form-row label {
		font-family: "Lato", sans-serif;
		font-size: 20px;
		font-weight: 900;
	}
	.woocommerce-form-row input[type="text"],
	.woocommerce-form-row input[type="email"],
	.woocommerce-form-row input[type="password"] {
		padding: 10px 15px !important;
		border:1px solid #A0AEC0 !important;
		border-radius: 4px;
	}
	.display-name span {
		display: none;
	}
	fieldset legend {
		color: #A0AEC0;
		font-family: "Lato", sans-serif;
		font-size: 20px;
		font-weight: 900;
		padding-top: 15px;
		margin: 15px 0;
	}
	fieldset {
		border: none;
		margin: 0;
		padding: 0;
	}
	.action-buttons {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		padding-top: 1em;
	}
	button.reset-form {
		background: none;
		color: #4A5568 !important;
		font-size: 20px;
		font-family: "Lato", sans-serif;
	}
	.show-password-input {
		display: none;
	}
	.show-password {
		position: absolute;
		right: .7em;
		top: .7em;
		cursor: pointer;
	}
    .password-fields {
        display:none;
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
<script>
	jQuery(document).ready(function( $ ) {
		$(window).on('load', function(){
			$('.current-password .password-input, .new-password .password-input, .confirm-password .password-input').append('<i class="show-password fas fa-eye"></i>');	
		});
	});

</script>
<div class="account-header">
	<div class="account-header-inner">

		<div class="content-title">
				<h2><?php echo dssLang($dssSiteLanguage)->my_account->menu->account_settings; ?></h2>
				<div class="left-mobile">
					<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) );?>"><?php echo dssLang($dssSiteLanguage)->my_account->menu->back; ?></a>
				</div>
				
			</div>


		<!-- <div class="content-title">
		    <h2>Personal Settings</h2>
		</div> -->
	</div>
</div>
<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide display-name">
		<label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<fieldset>
		<legend class="change-password" style="cursor:pointer; color:var(--dsw-main-dealer-color) !important;"><?php echo dssLang($dssSiteLanguage)->my_account->account_settings->change_password; ?></legend>
        <div class="password-fields">
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide current-password">
			<label for="password_current"><?php echo dssLang($dssSiteLanguage)->my_account->account_settings->current_password; ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide new-password">
			<label for="password_1"><?php echo dssLang($dssSiteLanguage)->my_account->account_settings->new_password; ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide confirm-password">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
		</p>
        </div>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p class="action-buttons">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
		<button type="reset" class="reset-form"><?php echo dssLang($dssSiteLanguage)->my_account->account_settings->cancel_btn; ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<script>
    jQuery('.change-password').on('click', function(){
        jQuery('.password-fields').toggle();
    });
    jQuery(document).on('click', '.show-password', function(e){
        var pinput = $(this).parent().find("input");
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
</script>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
