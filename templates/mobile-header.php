<header class="mobile dsn:lg:hidden dsn-mm-mobile-header">
	<div class="dsn-mm-mobile-header-inner">
		<div class="dsn-mobile-logo dsn-mm-mobile-logo">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo isset($header_logo['url']) ? $header_logo['url'] : ''; ?>" alt="<?php bloginfo('name'); ?>" />
				<span class="screen-reader-text"><?php bloginfo('name'); ?></span>
			</a>
		</div>
		<div class="dsn-mobile-icons dsn-mm-mobile-icons">
			<?php dsn_mobile_menu_trigger(); ?>
		</div>
	</div>
</header>
