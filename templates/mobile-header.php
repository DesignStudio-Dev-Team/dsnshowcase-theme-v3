<header class="mobile block dsn:lg:hidden dsn:text-[#0988c2] dsn:border-b dsn:relative dsn:z-50">
	<div class="dsn:flex dsn:justify-between dsn:px-4 dsn:py-4 dsn:container dsn:mx-auto">
		<div class="dsn-mobile-logo dsn:w-1/2"><a class="dsn:block dsn:relative dsn:text-center" href="<?php
		echo esc_url(home_url('/'));
		?>"><img class="dsn:w-48" src="<?php echo isset($header_logo['url']) ? $header_logo['url'] : ''; ?>" alt="<?php bloginfo('name'); ?>" /> <span
				class="dsn:hidden"> <?php bloginfo('name'); ?></span></a></div>
		<div class="dsn-mobile-icons dsn:flex dsn:items-center dsn:justify-end dsn:gap-3 dsn:w-1/2">
			<?php if($header_selling_online == 'yes') { ?>
				<a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[46px]"
				href="<?php echo wc_get_cart_url(); ?>" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
					class="dsn:stroke-current dsn:fill-current" width="20" height="20">
					<path class="dsn:stroke-current dsn:fill-current"
						d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
				</svg><span
					class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
			<?php } ?>

			<?php dsn_mobile_menu_trigger(); ?>
		</div>
	</div>
</header>
