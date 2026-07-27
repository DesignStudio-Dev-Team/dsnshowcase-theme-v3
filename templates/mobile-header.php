<?php
$_mm_logo     = function_exists( 'get_field' ) ? get_field( 'header_logo', 'options' ) : null;
$_mm_logo_url = is_array( $_mm_logo ) ? ( $_mm_logo['url'] ?? '' ) : '';
$_mm_site_name = get_bloginfo( 'name' );
?>
<header class="mobile dsn:lg:hidden dsn-mm-mobile-header">
	<div class="dsn-mm-mobile-header-inner">
		<div class="dsn-mobile-logo dsn-mm-mobile-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( $_mm_logo_url ) : ?>
				<img src="<?php echo esc_url( $_mm_logo_url ); ?>" alt="<?php echo esc_attr( $_mm_site_name ); ?>" />
				<?php endif; ?>
				<span class="screen-reader-text"><?php echo esc_html( $_mm_site_name ); ?></span>
			</a>
		</div>
		<div class="dsn-mobile-icons dsn-mm-mobile-icons">
			<?php dsn_mobile_menu_trigger(); ?>
		</div>
	</div>
</header>
