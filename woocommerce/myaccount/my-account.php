<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account/.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_navigation' ); ?>
<style>
        .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea, .woocommerce form .form-row select {
        color:black;
        border: 1px solid #a0aec0;
        background-color: #f5f5f5;
        padding: 0.5rem 1rem;
        border-radius: 3px;
    }

@media (max-width: 754px) {
    .woocommerce-MyAccount-navigation {
        display: none;
    }
}
    .woocommerce-account .content-container {
        max-width: 1610px;
        padding: 0 15px;
        margin-left: auto;
        margin-right: auto;
    }
    .woocommerce-MyAccount-navigation ul {  
        list-style: none;
        margin-left:0 !important;
        padding-left:0 !important;
        
    }
    .woocommerce-MyAccount-navigation ul li {
        position: relative;
        list-style:none;
        margin-bottom: 0 !important;
    }
    .woocommerce-MyAccount-navigation ul li:first-child > a {
        border-top: 2px solid #DADCDF;
    }
    .woocommerce-MyAccount-navigation ul li a {
        border-bottom: 2px solid #DADCDF;
        display: block;

    }
    .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--customer-logout > a{
        color:var(--dsw-main-dealer-color) !important;
        font-weight: normal;
    }
    .woocommerce-MyAccount-navigation ul li a {
        color: #222222 !important;
        padding: 13.5px 0;
        padding-left: 20px;
        font-size: 24px;
        font-weight: 300;
        font-family: "Lato", sans-serif;        
    }
    .woocommerce-MyAccount-navigation ul li.is-active a {
        font-weight: bold;
    }
    .woocommerce-MyAccount-navigation ul li.is-active a:before {
        content: '';
        display: block;
        width: 5px;
        height: 100%;
        background: var(--dsw-main-dealer-color) !important;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
    }
    .woocommerce-MyAccount-navigation {
        max-width: 300px;
    }
    .woocommerce-MyAccount-navigation h2,
    .woocommerce-MyAccount-content h2 {
        color: #222222;
        font-size: 36px;
        font-family: "Lato", sans-serif;  
        font-weight: 300;
        margin-bottom: 1em;
        line-height: 1.3;
    }
    .woocommerce-MyAccount-content h2 {
        margin-bottom: 0;
    }
    .woocommerce-MyAccount-content p {
        font-family: "Lato", sans-serif;
    }
    .account-header {
        border-bottom: 2px solid #DADCDF;
        padding-bottom: 2em;
    }
    .woocommerce-MyAccount-navigation > ul {
        padding-top: 3px;
    }
    .account-header {
        display: block;
    }
    .account-header-inner {
        display: flex;
        width: 100%;
        align-items: baseline;
    }


    .welcome-title {
        
        margin-left: auto;
    }
    .welcome-title p {
        margin-bottom: 0;
        font-weight: normal;
    }
    .woocommerce-MyAccount-navigation-link--downloads {
        display: none;
    }
    .woocommerce {
        max-width:1300px;
        margin:25px auto;
        width:100%;
        margin-bottom:100px;
        
    }
    .woocommerce button.button {
		margin-right:15px;
        color:#fff;
        background:var(--dsw-main-dealer-color) !important;
	}
    .woocommerce button.button:hover{
        color:#fff;
        background:#1D9DC8 !important;
    }
    .woocommerce a {
        color:var(--dsw-main-dealer-color) !important;
    }
    .woocommerce-message {
        padding-left:50px !important;
    }
</style>
<div class="woocommerce-MyAccount-content">

	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>
