<header class="mobile block dsn:lg:hidden dsn:text-[#0988c2] dsn:border-b dsn:relative dsn:z-50 dsn-mm-mobile-header">
	<div class="dsn:flex dsn:justify-between dsn:px-4 dsn:py-2 dsn:container dsn:mx-auto dsn:w-full">
		<div class="dsn-mobile-logo dsn-mm-mobile-logo dsn:w-1/2"><a class="dsn:block dsn:relative dsn:text-center" href="<?php
		echo esc_url(home_url('/'));
		?>"><img class="dsn:w-48" src="<?php echo isset($header_logo['url']) ? $header_logo['url'] : ''; ?>" alt="<?php bloginfo('name'); ?>" /> <span
				class="dsn:hidden"> <?php bloginfo('name'); ?></span></a></div>
		<div class="dsn-mobile-icons dsn:flex dsn:items-center dsn:justify-end dsn:gap-3 dsn:w-1/2">
			<?php dsn_mobile_menu_trigger(); ?>
		</div>
	</div>
</header>
