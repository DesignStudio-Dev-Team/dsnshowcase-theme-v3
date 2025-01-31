<header class="mobile block dsn:md:hidden dsn:text-[#0988c2] dsn:border-b">
	<div class="dsn:flex dsn:justify-between dsn:px-4 dsn:py-4">
		<div class="dsn-mobile-logo dsn:w-1/2"><a class="dsn:block dsn:relative dsn:text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn:w-48 dsn:md:w-64 dsn:mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a></div>
		<div class="dsn-mobile-icons dsn:flex dsn:items-center dsn:justify-end dsn:gap-3 dsn:w-1/2">
			<a class="the-search-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current dsn:cursor-pointer" width="22" height="22">
			<path class="dsn:stroke-current dsn:fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
		<a aria-label="My Account" href="/my-account" class="my-account-icon">
				<svg class="svg-icon" width="28" height="28" style="vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 853.333333c-69.393067 53.486933-149.333333 81.92-239.786667 85.333334H496.64c-90.453333-2.850133-170.376533-30.72-239.786667-83.626667v-88.746667C330.24 710.5536 415.2832 682.666667 512 682.666667c97.28 0 182.613333 28.450133 256 85.333333v85.333333z m-86.186667-426.666666c0 47.223467-16.776533 87.313067-50.346666 120.32-33.006933 33.5872-73.096533 50.346667-120.32 50.346666-47.223467 0-87.620267-16.759467-121.173334-50.346666-32.989867-33.006933-49.493333-73.096533-49.493333-120.32s16.503467-87.6032 49.493333-121.173334c33.553067-32.989867 73.949867-49.493333 121.173334-49.493333 47.223467 0 87.313067 16.503467 120.32 49.493333 33.570133 33.570133 50.346667 73.949867 50.346666 121.173334z"  /><path d="M496.64 955.733333c-94.208-2.9696-178.176-32.273067-250.146133-87.125333l-0.238934-0.187733a547.4304 547.4304 0 0 1-48.401066-43.1104C111.872 739.2768 68.266667 633.890133 68.266667 512c0-121.856 43.588267-227.549867 129.536-314.112C284.450133 111.854933 390.126933 68.266667 512 68.266667c121.9072 0 227.293867 43.605333 313.2928 129.5872C911.854933 284.416 955.733333 390.109867 955.733333 512c0 121.924267-43.895467 227.328-130.474666 313.326933a509.7472 509.7472 0 0 1-47.0016 41.642667c-71.953067 55.364267-155.835733 85.213867-249.3952 88.746667L496.64 955.733333z m-222.72-109.2608c64.699733 47.2576 139.758933 72.516267 223.266133 75.144534L528.213333 921.6c82.926933-3.157333 158.020267-28.962133 222.72-76.765867v-68.369066C682.376533 725.5552 602.026667 699.733333 512 699.733333c-89.480533 0-169.540267 25.258667-238.08 75.144534v71.594666zM512 102.4c-112.5376 0-210.1248 40.2432-290.065067 119.620267C142.6432 301.8752 102.4 399.479467 102.4 512c0 112.503467 40.226133 209.783467 119.586133 289.160533 5.888 5.870933 11.810133 11.554133 17.800534 16.9984V766.293333a17.066667 17.066667 0 0 1 6.741333-13.585066C322.6112 694.903467 411.938133 665.6 512 665.6c100.693333 0 190.344533 29.917867 266.4448 88.917333 4.181333 3.2256 6.621867 8.192 6.621867 13.482667v48.571733c5.410133-4.949333 10.8032-10.103467 16.093866-15.394133C881.1008 721.7664 921.6 624.4864 921.6 512c0-112.503467-40.516267-210.090667-120.439467-290.013867C721.800533 142.626133 624.520533 102.4 512 102.4z m-0.853333 512c-51.729067 0-96.5632-18.619733-133.256534-55.3472-36.1472-36.164267-54.4768-80.708267-54.4768-132.386133 0-51.6096 18.295467-96.4096 54.391467-133.137067C414.702933 257.2288 459.502933 238.933333 511.146667 238.933333c51.677867 0 96.221867 18.3296 132.386133 54.493867 36.727467 36.727467 55.3472 81.5616 55.3472 133.239467 0 51.746133-18.653867 96.324267-55.4496 132.488533C607.488 595.746133 562.8928 614.4 511.146667 614.4z m0-341.333333c-42.973867 0-78.6944 14.574933-109.2096 44.5952-29.7984 30.327467-44.3904 66.048-44.3904 109.0048 0 42.888533 14.557867 78.301867 44.4928 108.253866C432.5376 565.435733 468.224 580.266667 511.146667 580.266667c42.8544 0 78.2336-14.7968 108.151466-45.243734C649.949867 504.8832 664.746667 469.504 664.746667 426.666667c0-42.888533-14.830933-78.574933-45.346134-109.1072C589.448533 287.624533 554.052267 273.066667 511.146667 273.066667z"  /></svg>
            </a>
            <a class="cart dsn:relative" href="https://affordablehottubs4u.com/cart/" title="Cart"><span class="the-cart-quantity dsn:absolute dsn:-bottom-2 dsn:-right-2 dsn:bg-black dsn:w-4 dsn:h-4 dsn:rounded-full dsn:text-white dsn:text-center dsn:text-xs">0</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="25" height="25"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></a>		
		
		
		<div class="dsn-mobile-hamburger dsn:cursor-pointer"><svg class="dsn:stroke-current dsn:fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35.927" height="35.927" preserveAspectRatio="xMidYMid meet"><defs> <clipPath id="__lottie_element_2"><rect width="24" height="24" x="0" y="0"></rect></clipPath></defs><g class="dsn:stroke-current dsn:fill-current" clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,18)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0"  stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,12)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(0,0,0)" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,6)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g></g></g></svg></div></div>
	</div>
	<div class="the-navigation dsn:hidden dsn:absolute dsn:top-0 dsn:left-0 dsn:w-full dsn:h-full dsn:flex dsn:bg-gray-900/90 <?php if(is_user_logged_in()){echo "dsn:mt-8"; } ?>">
		<a class="nav-close nav-left dsn:w-1/12 dsn:block dsn:mt-10 dsn:ml-4 dsn:float-left" href="javascript:;"><span class="dsn:block"></span></a>
		<div class="mobile-nav-right dsn:relative dsn:bg-white dsn:w-10/12 dsn:h-full dsn:float-right">
			<div class="nav-open-logo dsn:block dsn:w-1/2 dsn:mx-auto dsn:py-4"><img class="dsn:w-full dsn:mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> </div>
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