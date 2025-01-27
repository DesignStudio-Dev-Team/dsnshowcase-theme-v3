<header class="mobile block md:dsn-hidden dsn-text-[#0988c2] dsn-border-b">
	<div class="dsn-flex dsn-justify-between dsn-px-4 dsn-py-4">
		<div class="dsn-mobile-logo"><a class="dsn-block dsn-relative dsn-text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn-w-48 md:dsn-w-64 dsn-mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn-hidden"> <?php bloginfo('name'); ?></span></a></div><div class="dsn-mobile-icons dsn-flex dsn-items-center dsn-justify-end dsn-gap-4"><a class="the-search-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn-stroke-current dsn-fill-current dsn-cursor-pointer" width="25.927" height="25.927">
		<path class="dsn-stroke-current dsn-fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a><div class="dsn-mobile-hamburger"><svg class="dsn-stroke-current dsn-fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35.927" height="35.927" preserveAspectRatio="xMidYMid meet"><defs> <clipPath id="__lottie_element_2"><rect width="24" height="24" x="0" y="0"></rect></clipPath></defs><g class="dsn-stroke-current dsn-fill-current" clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,18)"><path class="dsn-stroke-current dsn-fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0"  stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,12)"><path class="dsn-stroke-current dsn-fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(0,0,0)" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,6)"><path class="dsn-stroke-current dsn-fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g></g></g></svg></div></div>
	</div>
	<div class="the-navigation dsn-hidden dsn-absolute dsn-top-0 dsn-left-0 dsn-w-full dsn-h-full dsn-flex dsn-bg-gray-900/90">
		<a id="nav-close" class="nav-left dsn-w-1/12 dsn-block dsn-mt-10 dsn-ml-4 dsn-float-left" href="javascript:;"><span class="dsn-block"></span></a>
			<div class="mobile-nav-right dsn-relative dsn-bg-white dsn-w-10/12 dsn-h-full dsn-float-right">
			<div class="nav-open-logo dsn-block dsn-w-1/2 dsn-mx-auto dsn-py-4"><img class="dsn-w-full dsn-mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> </div>
				<?php wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_id'			=> 'dsn-primary-menu',
					'menu_class' => 'dsn-block dsn-w-full dsn-w-full',
					'container'			=> "nav",
					'container_class'	=> "dsn-bg-[#076594]",
					'link_class' 		=> "dsn-py-4 dsn-w-full dsn-block dsn-relative dsn-text-left dsn-px-4 dsn-border-b dsn-border-cyan-700",
					'depth'				=>	0,
				)); ?>
				<?php wp_nav_menu(array(
					'theme_location' => 'utility_left',
					'menu_id'			=> 'dsn-primary-menu',
					'menu_class' => 'dsn-block dsn-w-full dsn-text-white dsn-w-full',
					'container'			=> "nav",
					'container_class'	=> "dsn-bg-white dsn-relative",
					'link_class' 		=> "dsn-py-4 dsn-w-full dsn-block dsn-relative dsn-text-black dsn-text-left dsn-px-4 dsn-border-b dsn-border-gray-100",
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
		#nav-close span::before {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 5px;
		  width: 44px;
		  background: #fff;
		  position: absolute;
		  display: block;
		  content: '';
		  transform: rotate(45deg);
		}
		#nav-close span::after {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 5px;
		  width: 44px;
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
			height: 56px;
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
				top: 0;
				width: 84%;
				background: #fff;
				height: 100%;
				z-index: 9;
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
			height: 56px;
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
	</style>
</header>
<script>
(function($) {
var clickable = $('.mobile nav ul').attr('data-clickable');
    $('.mobile nav ul li:has(ul)').addClass('has-sub');
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