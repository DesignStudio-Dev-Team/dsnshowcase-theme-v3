<?php
/***
 Header 1 
 ****/
 
 
$header_logo = get_field('header_logo', 'options');
?>


<header class="dsn-bg-white dsn-text-[#0988c2] dsn-py-4 dsn-mb-10 dsn-hidden md:dsn-block">
	<div class="dsn-container dsn-mx-auto dsn-flex dsn-justify-between dsn-items-center">
        <div class="util-left-nav dsn-w-4/12"><?php wp_nav_menu(array(
            'theme_location' => 'utility_left',
            'menu_class' => 'dsn-flex dsn-space-x-4',
			'link_class' => "dsn-text-[#0988c2]",
        )); ?>
		</div>
		<div class="dsn-logo dsn-w-4/12">
		<a class="dsn-block dsn-relative dsn-text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn-w-48 md:dsn-w-64 dsn-mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn-hidden"> <?php bloginfo('name'); ?></span></a>
		</div>
		<div class="util-left-nav dsn-w-4/12"><?php wp_nav_menu(array(
            'theme_location' => 'utility_right',
            'menu_class' => 'dsn-flex dsn-space-x-4',
        )); ?>
		<div class="cart-search-combo cf dsn-flex dsn-justify-end dsn-items-center dsn-gap-4">
								
			<a aria-label="My Account" href="/my-account" class="my-account-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="25.927" height="25.927" viewBox="0 0 25.927 25.927" class="dsn-stroke-current dsn-fill-current" role="presentation">
					<path id="Icon_material-account-circle" class="dsn-stroke-current dsn-fill-current" data-name="Icon material-account-circle" d="M15.964,3A12.964,12.964,0,1,0,28.927,15.964,12.968,12.968,0,0,0,15.964,3Zm0,3.889a3.889,3.889,0,1,1-3.889,3.889A3.884,3.884,0,0,1,15.964,6.889Zm0,18.408a9.334,9.334,0,0,1-7.778-4.174c.039-2.58,5.185-3.993,7.778-3.993s7.739,1.413,7.778,3.993A9.334,9.334,0,0,1,15.964,25.3Z" transform="translate(-3 -3)" fill="none"></path>
				</svg>
            </a>
                            <a class="cart dsn-relative" href="https://affordablehottubs4u.com/cart/" title="Cart"><span class="the-cart-quantity dsn-absolute dsn--bottom-2 dsn--right-2 dsn-bg-black dsn-w-4 dsn-h-4 dsn-rounded-full dsn-text-white dsn-text-center dsn-text-xs">0</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn-stroke-current dsn-fill-current" width="25.927" height="25.927"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path class="dsn-stroke-current dsn-fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></a>
							<a class="the-search-icon dsn-cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn-stroke-current dsn-fill-current" width="25.927" height="25.927"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path class="dsn-stroke-current dsn-fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>

                                                </div>
		</div>
		
    </div>
	<div class="primary-nav dsn-bg-gray-100 dsn-mt-4 dsn-block dsn-relative">
    <div class="dsn-container dsn-mx-auto dsn-relative">
        
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
			'menu_id'			=> 'dsn-primary-menu',
            'menu_class' => 'dsn-flex dsn-justify-between dsn-items-center dsn-w-full dsn-text-white dsn-w-full',
			'container'			=> "nav",
			'container_class'	=> "dsn-bg-[#076594] dsn-rounded-md dsn-relative",
			'link_class' 		=> "dsn-py-4 dsn-w-full dsn-block dsn-relative",
			'depth'				=>	0,
        )); ?>
    </div>
	</div>
	 
</header>
<div class="form-wrapper dsn-fixed dsn-flex-col dsn-w-full dsn-h-full dsn-top-0 dsn-left-0 dsn-flex dsn-justify-center dsn-items-center dsn-bg-[#076594]/70 dsn-z-40">
        <div class="esc-form dsn-absolute dsn-right-[7%] dsn-top-[40%] md:dsn-right-[22%] md:dsn-top-[22%] dsn-w-8 dsn-h-8 dsn-rounded-full dsn-bg-white dsn-flex dsn-justify-center dsn-items-center"><a href="javascript:;" class="close-search dsn-text-2xl dsn-leading-0 dsn-pb-2">x</a></div>
			<form id="fast-search-desktop" role="search" method="get" class="woocommerce-product-search dsn-w-10/12 md:dsn-w-1/2" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
				<input class="popup-search-bar search dsn-p-4 dsn-rounded-md dsn-w-full" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
				<input type="hidden" name="post_type" value="product" />
            </form>
        </div>
<?php include("mobile-header.php"); ?>

<style>
@media only screen and (min-width: 1024px) {
	#dsn-primary-menu > li > a:after {
		content: "|";
		position: absolute;
		right: 0;
	}
	#dsn-primary-menu > li:last-child > a:after {
		content: "";
	}
	#dsn-primary-menu > li > .sub-menu {
		box-shadow: 0px 0px 3px 0px #eee;
	}
	#dsn-primary-menu > li > .sub-menu {
		margin-top: 56px;
	}
	.open > .sub-menu { 
	display: flex;
	}
	.open > .sub-menu li ul {
		position: relative;
		display: block; 
		padding: 0;
		}
		.mega-menu.open > .sub-menu > li > a { 
			font-weight: 800;
		}
		.open > .sub-menu li {
			min-width: 200px;
		}
}
</style>
 <script>
              (function($) {

                /*add class to menu item with submenu on hover */
                if ($(window).width() >= 1025) {
                  $('.mega-menu.menu-item-has-children').mouseenter(function() {
                    $(this).addClass('open');
                  }).mouseleave(function() {
                    $(this).removeClass('open');
                  });
                }

                $('.dsn-mobile-hamburger').click(function() {
                  $(this).toggleClass('is-active');
                  $('.the-navigation').fadeToggle();
                });
				 $('#nav-close').click(function() {
                  $('.dsn-mobile-hamburger').toggleClass('is-active');
                  $('.the-navigation').fadeToggle();
                });
				
				$('div.form-wrapper').hide();

				$('a.the-search-icon').click(function(){
					$('div.form-wrapper').fadeToggle();
				});

				$('div.esc-form').click(function(){
					$('div.form-wrapper').fadeToggle();
				});

              }(jQuery));
			  
			  
            </script>