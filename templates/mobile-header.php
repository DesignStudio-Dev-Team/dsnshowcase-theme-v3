<header class="mobile block dsn:lg:hidden dsn:text-[#0988c2] dsn:border-b">
	<div class="dsn:flex dsn:justify-between dsn:px-4 dsn:py-4 dsn:container dsn:mx-auto">
		<div class="dsn-mobile-logo dsn:w-1/2"><a class="dsn:block dsn:relative dsn:text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn:w-48" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a></div>
		<div class="dsn-mobile-icons dsn:flex dsn:items-center dsn:justify-end dsn:gap-3 dsn:w-1/2">
		<a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[46px]" href="/cart/" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg><span class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>	
		
		
		<div class="dsn-mobile-hamburger dsn:cursor-pointer dsn:bg-[#0988c2] dsn:text-white dsn:p-2 dsn:rounded-full"><svg class="dsn:stroke-current dsn:fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" preserveAspectRatio="xMidYMid meet"><defs> <clipPath id="__lottie_element_2"><rect width="24" height="24" x="0" y="0"></rect></clipPath></defs><g class="dsn:stroke-current dsn:fill-current" clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,18)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0"  stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,12)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(0,0,0)" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,6)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g></g></g></svg></div></div>
	</div>
	<div class="the-navigation dsn:hidden dsn:absolute dsn:top-0 dsn:left-0 dsn:w-full dsn:h-full dsn:flex dsn:bg-gray-900/90 <?php if(is_user_logged_in()){echo "dsn:mt-8"; } ?>">
		<a class="nav-close nav-left dsn:w-1/12 dsn:block dsn:mt-10 dsn:ml-4 dsn:float-left" href="javascript:;"><span class="dsn:block"></span></a>
		<div class="mobile-nav-right dsn:relative dsn:bg-white dsn:w-10/12 dsn:h-full dsn:float-right">
			<div class="nav-open-logo dsn:block dsn:w-1/2 dsn:mx-auto dsn:py-4"><img class="dsn:w-full dsn:mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> </div>
			<div class="cart-search-combo cf dsn:flex dsn:justify-center dsn:items-center dsn:px-4 dsn:py-4 dsn:gap-3 dsn:border-1">
								
		
				<a class="the-search-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[46px] dsn:h-[46px]"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
				<a href="/my-account/" class="my-account-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[46px] dsn:h-[46px]">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
            </a>
			<a class="wishlist dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[46px]" href="/wishlist/" title="Wishlist"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
				<span class="the-wishlist-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
            
			

            </div>
				<?php wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_id'			=> 'dsn-primary-menu',
					'menu_class' => 'dsn:block dsn:w-full dsn:w-full',
					'container'			=> "nav",
					'container_class'	=> "dsn:bg-[#076594]",
					'link_class' 		=> "dsn:py-4 dsn:w-full dsn:block dsn:relative dsn:text-left dsn:px-4 dsn:border-b dsn:border-cyan-700",
					'depth'				=>	0,
				)); ?>
				<?php wp_nav_menu(array(
					'theme_location' => 'utility_left',
					'menu_id'			=> 'dsn-utility-menu',
					'menu_class' => 'dsn:block dsn:w-full dsn:text-white dsn:w-full',
					'container'			=> "nav",
					'container_class'	=> "dsn:bg-white dsn:relative",
					'link_class' 		=> "dsn:py-4 dsn:w-full dsn:block dsn:relative dsn:text-black dsn:text-left dsn:px-4 dsn:border-b dsn:border-gray-100",
					'depth'				=>	0,
				)); ?>
			</div>
	</div>
	<style>
		.the-navigation.dsMobileOpen {
			display: flex;
		}
		.mobile nav > ul > li:hover {
			background: unset;
			color: #fff;
		}
		.mobile ul.sub-menu {
			width: 100%;
		}
		.nav-close span::before {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 5px;
		  width: 30px;
		  background: #fff;
		  position: absolute;
		  display: block;
		  content: '';
		  transform: rotate(45deg);
		}
		.nav-close span::after {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 5px;
		  width: 30px;
		  background: #fff;
		  position: absolute;
		  display: block;
		  content: '';
		  transform: rotate(-45deg);
		}
		.mobile span.dsn_nav__caret {
			position: absolute;
			right: 0;
			top: 0px;
			width: 35px;
			height: 64px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.mobile span.dsn_nav__caret svg {
			fill: #fff;
		}
		.mobile .has-sub.is-open {
				position: fixed;
				right: 0;
				top: <?php if(is_user_logged_in()){echo "2em";}else {echo "0";} ?>;
				width: 84%;
				background: #fff;
				height: 100%;
				z-index: 99;
			}
		.mobile .has-sub.is-open > a {
			position: relative;
			background-color: #076594;
			color: #fff;
			padding-left: 35px;
		}
		.mobile .has-sub.is-open > span.dsn_nav__caret {
			left: 0;
			transform: rotate(180deg);
			height: 64px;
			top: 0;
		}
		.mobile .has-sub.is-open ul {
			position: relative;
			padding: 0;
			color: #000;
		}
		.mobile .has-sub.is-open ul span.dsn_nav__caret svg {
			fill: #000;
		}
		.mobile .has-sub.is-open > span > svg {
			fill: #fff !important;
		}
		.mobile ul#dsn-utility-menu span.dsn_nav__caret svg {
			fill: #000;
		}
	</style>
</header>
<script>
(function($) {
var clickable = $('.mobile nav ul').attr('data-clickable');
    $('.mobile nav ul li:has(ul)').addClass('has-sub dsn:relative');
    $('.mobile nav ul .has-sub>a').after('<span class="dsn_nav__caret"><svg width="20" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></span>');
 
    /* menu open and close on click */
    $('.mobile nav ul .has-sub>.dsn_nav__caret').click(function () {
        var element = $(this).parent('li');
        if (element.hasClass('is-open')) {
            element.removeClass('is-open');
            element.find('li').removeClass('is-open');
            element.find('ul').slideUp(200);
        }
        else {
            element.addClass('is-open');
            element.children('ul').slideDown(200);
            element.siblings('li').children('ul').slideUp(200);
            element.siblings('li').removeClass('is-open');
            element.siblings('li').find('li').removeClass('is-open');
            element.siblings('li').find('ul').slideUp(200);
        }
    });
	}(jQuery));
	</script>