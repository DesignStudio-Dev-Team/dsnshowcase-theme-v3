<?php
/***
 Header 05 
 ****/

$header_logo = get_field('header_logo', 'options');
$header_sticky_logo = get_field('header_sticky_logo', 'options');
$header_sticky = get_field('sticky_header', 'options');
?>

<header
	class="header5 dsn:bg-white dsn:text-[#65a23b] dsn:py-4 dsn:mb-10 dsn:hidden dsn:z-20 dsn:lg:block dsn:shadow-xl <?php if ($header_sticky == "1") {
		echo "dsn:sticky dsn:top-0 sticky-header";
	} else {
		echo "dsn:relative";
	} ?>">
	<div
		class="dsn:container dsn:mx-auto dsn:flex dsn:justify-between dsn:items-center dsn:px-6 dsn:py-4 dsn-header-top-container">
		<div class="util-left-nav dsn:w-5/12">
			<?php wp_nav_menu(array(
				'theme_location' => 'utility_left',
				'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:relative dsn:!my-0',
				'link_class' => "dsn:text-[#000] dsn:text-lg dsn:py-2 dsn:block",
			)); ?>
		</div>
		<div class="dsn-logo dsn:w-2/12">
			<a class="dsn:block dsn:relative dsn:text-center" href="<?php
			echo esc_url(home_url('/'));
			?>"><img class="dsn:w-48 dsn:md:w-80 dsn:mx-auto" src="<?php echo $header_logo['url']; ?>"
					alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a>
		</div>
		<div class="util-left-nav dsn:flex dsn:justify-end dsn:items-center dsn:gap-4 dsn:w-5/12">
			<div class="header-text dsn:mr-4"><a href="javascript:;" class="get-started dsn:text-black dsn:border-b-3 dsn:border-b-[#65a23b] dsn:text-xl dsn:cursor-pointer">GET STARTED</a></div>
			<?php
			// wp_nav_menu(array(
			//     'theme_location' => 'utility_right',
			//     'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:pr-4 dsn:relative dsn:!my-0',
			// 	'link_class' => "dsn:text-[#000] dsn:text-xl dsn:py-4",
			// )); 
			?>
			<div class="cart-search-combo cf dsn:flex dsn:justify-end dsn:items-center dsn:gap-3">


				<a href="javascript:;" class="the-search-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#65a23b] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]"><svg
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
						class="dsn:stroke-current dsn:fill-current" width="20" height="20">
						<path class="dsn:stroke-current dsn:fill-current"
							d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
					</svg></a>
				<a href="/my-account/"
					class="my-account-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#65a23b] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
						class="dsn:stroke-current dsn:fill-current" width="20" height="20">
						<path
							d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
					</svg> 
				</a>
				<a class="wishlist dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#65a23b] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[40px]"
					href="/wishlist/" title="Wishlist"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
						class="dsn:stroke-current dsn:fill-current" width="20" height="20">
						<path
							d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
					</svg>
					<span
						class="the-wishlist-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
				<a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#65a23b] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[40px]"
					href="/cart/" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
						class="dsn:stroke-current dsn:fill-current" width="20" height="20">
						<path class="dsn:stroke-current dsn:fill-current"
							d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
					</svg><span
						class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>


			</div>
		</div>

	</div>
	<div class="primary-nav dsn:bg-gray-100 dsn:block dsn:relative dsn:mx-auto dsn:relative dsn:hidden">

		<div class="dsn:container dsn:mx-auto dsn:relative nav-container dsn:w-full">

			<?php wp_nav_menu(array(
				'theme_location' => 'primary',
				'menu_id' => 'dsn-primary-menu',
				'menu_class' => 'dsn:flex dsn:justify-between dsn:items-stretch dsn:w-full dsn:text-white dsn:w-full dsn:!my-0 dsn:!px-0',
				'container' => "nav",
				'container_class' => "dsn:bg-white dsn:rounded-md dsn:relative",
				'link_class' => "dsn:px-2 dsn:py-6 dsn:w-full dsn:block dsn:relative",
				'depth' => 0,
				'walker' => new DSN_Walker_Nav_Menu()
			)); ?>

		</div>

	</div>
</header>
<?php include("search-form.php"); ?>
<?php include("mobile-header.php"); ?>
<?php include("get-started.php"); ?>

<style>
	@media only screen and (min-width: 1024px) {

		.open>.sub-menu {
			display: block;
			margin: 0;
		}

		.open>.mega-menu-inner {
			display: flex;
		}

		.util-left-nav ul li {
			width: auto;
		}

		.util-left-nav ul li ul a {
			font-weight: 600;
			color: #65a23b;
		}

		nav>ul>li {
			border-top: 1px solid #076594;
			background-color: #076594;
			margin-right: 1em;
    	}
		nav>ul>li:last-child {
			margin-right: 0;
			border-top: 1px solid #65a23b;
			background-color: #65a23b;
		}
		nav>ul>li:hover {
			background-color: #fff;
		}
		.sticky-header-active nav>ul>li:hover a {
			color: #65a23b;
		}
		
		nav>ul>li:hover {
			border-top: 1px solid #eeeeee;
			box-shadow: 0px 0px 3px 0px #ddd;
		}

		nav>ul>li:after {
			content: "";
			width: 1px;
			height: 100%;
			background: #fff;
			position: absolute;
			right: 0;
			top: 0;
		}

		nav>ul>li:last-child:after {
			content: "";
			width: 0px;
		}

		.sticky-header-active nav>ul>li:first-child:before {
			content: "";
			width: 1px;
			height: 100%;
			background: #fff;
			position: absolute;
			left: 0;
			top: 0;
		}

		.sticky-header-active nav>ul>li:last-child:after {
			content: "";
			width: 1px !important;
		}

		
		.utility-sticky-nav ul>li li {
			padding: 0;
		}

		header ul li ul a {
			font-size: 16px;
		}

		.dropdown-content a {
			padding: 0.5em 0;
		}

		.mega-menucolumn>a {
			pointer-events: none;
			color: #000 !important;
			font-weight: 700;
			text-transform: uppercase;
		}

		.mega-menu>a {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
			height: 100%;
			text-transform: uppercase;
			font-weight: 600;
		}

		span.dsn_nav__caret {
			margin-top: 3px;
		}
	
		/* header ul li ul li ul li:hover {
			opacity: 0.85;
		} */

		li.non-mega ul {
			display: block;
			min-width: 200px;
		}

		.utility-sticky-nav .mega-menu>a {
			justify-content: start;
		}

		.utility-sticky-nav ul>li {
			padding: 4px 30px;
		}

		.utility-sticky-nav .open .sub-menu {
			right: 100%;
			top: 0;
		}
		.sticky-header-active .dsn-header-top-container {
			display: none;
		}
		.sticky-header-active .primary-nav {
			display: flex;
			height: 135px;
		}
		.dsn-header-top-container {
			height: 135px;
		}
		.sticky-header-active .mega-menu>a {
			font-size: 20px;
		}
		
		.util-left-nav ul li.util-mega-menu {
		display: block;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu:before {
		content: "";
		width: 100%;
		height: 2em;
		position: absolute;
		left: 0;
		top: -2em;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu {
		width: max-content;
		display: flex;
		margin-top: 1em;
		left: -20%;
    	transform: translateX(-2%);
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu li {
		display: block;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu .sub-menu {
		display: block;
		position: relative;
		top: 0;
		filter: none;
		padding: 0px 24px 0px 0px;
        min-width: 200px;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu > li > a {
		   font-weight: 700;
		   color: #000;
		   text-transform: uppercase;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu > li > a {
		   color: #65a23b;
		   font-weight: 600;
		   text-transform: capitalize;
	}
	.util-left-nav ul li ul a:hover {
    	color: #50852c;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu > li:nth-child(1) > a, .util-left-nav ul > li.util-mega-menu.about-us > .sub-menu > li:nth-child(2) > a {
		font-weight: 700;
		color: #000;
		text-transform: capitalize;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(1) .sub-menu, .util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(2) .sub-menu  {
		display: flex;
		position: relative;
		top: 0;
		filter: none;
		padding: 0;
		width: 320px;
		flex-wrap: wrap;
		gap: 10px;
		margin-right: 1em;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(1) .sub-menu li, .util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(2) .sub-menu li {
		width: 150px;
		background-color: #3e3124;
		min-height: 85px;
        display: flex;
        align-items: center;
        justify-content: center;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(1) .sub-menu li:hover, .util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(2) .sub-menu li:hover {
    	background-color: #624e3b;
	}
	.util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(1) .sub-menu li a, .util-left-nav ul > li.util-mega-menu > .sub-menu li:nth-child(2) .sub-menu li a {
		color: #fff;
		padding: 1em;
		text-align: center;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu {
		width: max-content;
		display: flex;
		margin-top: 1em;
		left: -20%;
		transform: translateX(-2%);
		width: 440px;
		flex-wrap: wrap;
		flex-direction: column;
		height: 190px;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu > li:nth-child(1), .util-left-nav ul > li.util-mega-menu.about-us > .sub-menu > li:nth-child(2) {
		height: 50%;
		border-right: 1px solid #eee;
    	max-width: 220px;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(1) .sub-menu li, .util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(2) .sub-menu li {
		width: max-content;
		background-color: transparent;
		display: flex;
    	gap: 10px;
		min-height: auto;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(1) .sub-menu li a, .util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(2) .sub-menu li a {
		color: #65a23b;
		padding: 0;
		text-align: left;
	}
	.util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(1) .sub-menu, .util-left-nav ul > li.util-mega-menu.about-us > .sub-menu li:nth-child(2) .sub-menu  {
		width: max-content;
	}
	.util-left-nav > div > ul > li > a  {
		border-bottom: 3px solid transparent;
	}
	.util-left-nav > div > ul > li:hover > a {
		border-bottom: 3px solid #65a23b;
		color: #65a23b;
	}
	.header-text a {
    	font-weight: 600;
	}
	.header-text a:hover {
    	color: #65a23b;
	}
	}

	

	@media only screen and (min-width: 1024px) and (max-width: 1600px) {
		.sticky-header-active .mega-menu>a {
			font-size: 16px;
		}

		.mega-menu>a {
			font-size: 20px;
		}
		.sticky-header-active .primary-nav {
			display: flex;
			height: 85px;
		}
		.dsn-header-top-container {
			height: 85px;
		}
			
	}


	
</style>
<script>
	(function ($) {

		/*add class to menu item with submenu on hover */
		if ($(window).width() >= 1025) {
			$('.mega-menu.menu-item-has-children').mouseenter(function () {
				$(this).addClass('open');
			}).mouseleave(function () {
				$(this).removeClass('open');
			});

			$('.util-left-nav .mega-menu.menu-item-has-children').mouseenter(function () {
				$(this).addClass('util-mega-menu');
			}).mouseleave(function () {
				$(this).removeClass('util-mega-menu');
			});
		}

		$('.dsn-mobile-hamburger').click(function () {
			$(this).toggleClass('is-active');
			$(this).toggleClass("nav-close");
			$('.the-navigation').fadeToggle();
		});
		$('.nav-close').click(function () {
			$('.dsn-mobile-hamburger').toggleClass('is-active');
			$('.dsn-mobile-hamburger').toggleClass('nav-close');
			$('.the-navigation').fadeToggle();
		});

		$('div.form-wrapper').hide();

		$('a.the-search-icon').click(function () {
			$('div.form-wrapper').fadeToggle();
		});

		$('div.esc-form').click(function () {
			$('div.form-wrapper').fadeToggle();
		});

		$('div.form-wrapper, div.get-started-wrapper').hide();

		$('a.get-started').click(function () {
			$('div.get-started-wrapper').fadeToggle();
		});

		$('div.esc-get-started-form').click(function () {
			$('div.get-started-wrapper').fadeToggle();
		});

		var clickable_desktop = $('.util-left-nav ul, .util-right-nav ul, .utility-sticky-nav ul').attr('data-clickable');
		$('.util-left-nav ul li:has(ul), .util-right-nav ul li:has(ul), .utility-sticky-nav ul li:has(ul)').addClass('has-sub dsn:relative dsn:flex dsn:items-center dsn:gap-2 dsn:cursor-pointer');
		//$('.util-left-nav ul .has-sub>a, .util-right-nav ul .has-sub>a, .utility-sticky-nav ul .has-sub>a').after('<span class="dsn_nav__caret dsn:text-[#65a23b] dsn:rotate-90"><svg fill="currentColor" width="20" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></span>');
		$('.util-left-nav ul a[href^="tel:"]').before('<span class="dsn_nav__caret dsn:text-[#65a23b]"><svg fill="currentColor" width="28" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M347.1 24.6c7.7-18.6 28-28.5 47.4-23.2l88 24C499.9 30.2 512 46 512 64c0 247.4-200.6 448-448 448c-18 0-33.8-12.1-38.6-29.5l-24-88c-5.3-19.4 4.6-39.7 23.2-47.4l96-40c16.3-6.8 35.2-2.1 46.3 11.6L207.3 368c70.4-33.3 127.4-90.3 160.7-160.7L318.7 167c-13.7-11.2-18.4-30-11.6-46.3l40-96z"/></svg></span>');
		

	}(jQuery));

	jQuery(document).ready(function ($) {

		// $('.mega-menu > a').each(function () {
		// 	var $element = $(this);
		// 	$element.html($element.html().replace(/^(\w+)/, '<span>$1&nbsp;</span>'));
		// });

		$("ul#dsn-primary-menu li").filter(function () {
			return $(this).find('ul').length == 1
		}).addClass("non-mega");

	});
</script>
<?php if ($header_sticky == 1) { ?>
	<script>
		jQuery(document).ready(function ($) {
			//caches a jQuery object containing the header element
			var header = $(".sticky-header");
			var width = $("body").width();
					console.log(width);

					if (width > 1024) {
			$(window).scroll(function () {
				var scroll = $(window).scrollTop();

				if (scroll >= 20) {
					header.addClass("sticky-header-active");
					//header.removeClass("dsn:py-4 dsn:mb-10");
					$('.primary-nav').addClass("dsn:container dsn:flex dsn:items-center dsn:justify-between");
					$('.primary-nav').removeClass("dsn:bg-gray-100");
					$('.nav-container').removeClass("dsn:container");
				} else {
					header.removeClass("sticky-header-active");
					//header.addClass("dsn:py-4 dsn:mb-10");
					$('.primary-nav').removeClass("dsn:container");
					$('.primary-nav').addClass("dsn:bg-gray-100");
					$('.nav-container').addClass("dsn:container");
					$('.the-navigation').hide();
					$('.dsn-mobile-hamburger').removeClass('nav-close');
				}
			});
		}
		});
	</script>
<?php
} ?>