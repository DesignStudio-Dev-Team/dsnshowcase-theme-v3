<?php
/***
 Header 03
 ****/
 
$header_logo = get_field('header_logo', 'options');
$header_sticky_logo = get_field('header_sticky_logo', 'options');
$header_sticky = get_field('sticky_header', 'options');
?>

<header class="header3 dsn:bg-white dsn:text-[#fff] dsn:mb-10 dsn:hidden dsn:lg:block dsn:z-20 <?php if($header_sticky == "1") {echo "dsn:sticky dsn:top-0 sticky-header";}else {echo "dsn:relative"; } ?>">
	
<div class="dsn-logo dsn:w-auto dsn:mx-4 dsn:hidden">
		<a class="dsn:block dsn:relative dsn:text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn:w-14 dsn:object-contain dsn:object-left dsn:mx-auto dsn:p-2" src="<?php echo $header_sticky_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a>
		</div>
		<div class="dsn:bg-[#006197]">
	<div class="dsn:container dsn:mx-auto dsn:flex dsn:justify-end dsn:items-center dsn:px-6 dsn:py-2 dsn-header-top-container">
        <!-- <div class="util-left-nav">
		<?php //wp_nav_menu(array(
            //'theme_location' => 'utility_left',
            //'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:relative dsn:!my-0 dsn:!px-0',
			//'link_class' => "dsn:text-[#fff] dsn:text-lg dsn:py-2 dsn:block",
        //)); ?>
		</div> -->
		
		<div class="util-left-nav dsn:flex dsn:justify-end dsn:items-center dsn:gap-4 dsn:w-8/12">
		<?php wp_nav_menu(array(
            'theme_location' => 'utility_right',
            'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:pr-4 dsn:relative dsn:!my-0',
			'link_class' => "dsn:text-[#fff] dsn:text-xl dsn:py-2 dsn:block",
        )); ?>
		<div class="cart-search-combo cf dsn:flex dsn:justify-end dsn:items-center dsn:gap-3">
					
				<a class="the-search-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
				<a href="/my-account/" class="my-account-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
            </a>
			<a class="wishlist dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[40px]" href="/wishlist/" title="Wishlist"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
				<span class="the-wishlist-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
            <a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:h-[40px]" href="/cart/" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg><span class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
			

            </div>
			</div>
		</div>
		
    </div>
	<div class="primary-nav dsn:block dsn:relative dsn:mx-auto dsn:relative">
	
    <div class="dsn:container dsn:mx-auto dsn:relative nav-container dsn:w-full dsn:flex dsn:items-center dsn:justify-between">
	<div class="dsn-logo dsn:w-auto dsn:absolute dsn:h-48 dsn:bg-white dsn:-top-20 dsn:flex dsn:items-center dsn:justify-center dsn:p-6 dsn:rounded-b-2xl dsn:shadow-lg dsn:z-20">
		<a class="dsn:block dsn:relative dsn:text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn:w-48 dsn:md:w-66 dsn:mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a>
		</div>
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
			'menu_id'			=> 'dsn-primary-menu',
            'menu_class' => 'dsn:flex dsn:justify-between dsn:items-stretch dsn:w-full dsn:text-white dsn:w-full dsn:!my-0 dsn:!px-0',
			'container'			=> "nav",
			'container_class'	=> "dsn:relative dsn:w-full",
			'link_class' 		=> "dsn:px-2 dsn:py-6 dsn:text-[#076594] dsn:w-full dsn:block dsn:relative",
			'depth'				=>	0,
			'walker' => new DSN_Walker_Nav_Menu()
        )); ?>
		
    </div>
	
	</div>
	<div class="cart-search-combo cf dsn:flex dsn:justify-end dsn:items-center dsn:gap-2 dsn:hidden dsn:text-white dsn:mx-4">
									<a class="the-search-icon dsn:cursor-pointer dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
									
									<a href="/my-account/" class="my-account-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:hidden dsn:2xl:flex dsn:items-center dsn:justify-center dsn:w-[40px] dsn:h-[40px]">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
								</a>
								<a class="wishlist dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:hidden dsn:2xl:flex dsn:h-[40px]" href="/wishlist/" title="Wishlist"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
									<span class="the-wishlist-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
								<a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:hidden dsn:2xl:flex dsn:h-[40px]" href="/cart/" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg><span class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
								
									<div class="dsn-desktop-hamburger dsn:cursor-pointer  dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full"><span style="width: 25.927px; height: auto; display: none;"></span><svg class="dsn:stroke-current dsn:fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" preserveAspectRatio="xMidYMid meet"><defs> <clipPath id="__lottie_element_2"><rect width="24" height="24" x="0" y="0"></rect></clipPath></defs><g class="dsn:stroke-current dsn:fill-current" clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,18)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0"  stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,12)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(0,0,0)" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g><g opacity="1" transform="matrix(0.7071067690849304,0.7071067690849304,-0.7071067690849304,0.7071067690849304,12,6)"><path class="dsn:stroke-current dsn:fill-current" stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" stroke-width="2" d=" M6,-6 C6,-6 -6,6 -6,6"></path></g></g></g></svg></div>

							<div class="the-navigation dsn:hidden dsn:absolute dsn:right-0 dsn:shadow-md dsn:top-full dsn:bg-white dsn:py-4">
							<div class="cart-search-combo cf dsn:flex dsn:justify-center dsn:items-center dsn:gap-3 dsn:px-6 dsn:my-4">	
									
								<a href="/my-account/" class="my-account-icon dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:p-2 dsn:rounded-full dsn:block dsn:2xl:hidden">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
								</a>
								<a class="wishlist dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:2xl:hidden" href="/wishlist/" title="Wishlist"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
									<span class="the-wishlist-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
								<a class="cart dsn:relative dsn:cursor-pointer dsn:text-white dsn:bg-[#0988c2] dsn:py-2 dsn:px-4 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:2xl:hidden" href="/cart/" title="Cart"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="20" height="20"><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg><span class="the-cart-quantity dsn:relative dsn:w-6 dsn:rounded-full dsn:text-white dsn:text-center dsn:ml-1 dsn:font-bold">0</span></a>
								
					
								</div>
								<div class="dsn:relative dsn:bg-white dsn:bg-white utility-sticky-nav">
								
								<?php wp_nav_menu(array(
									'theme_location' => 'utility_left',
									'container_class'	=> "dsn:w-full",
									'menu_class' => 'dsn:space-x-10 dsn:relative dsn:!my-0 dsn:!px-0',
									'link_class' => "dsn:text-[#0988c2] dsn:text-xl dsn:py-2 dsn:block dsn:text-left",
								)); ?>
								<?php wp_nav_menu(array(
									'theme_location' => 'utility_right',
									'container_class'	=> "dsn:w-full",
									'menu_class' => 'dsn:space-x-10 dsn:relative dsn:!my-0 dsn:!px-0',
									'link_class' => "dsn:text-[#0988c2] dsn:text-xl dsn:py-2 dsn:block dsn:text-left",
								)); ?>
								
									</div>
							</div>
								
								</div>
							</div>
						</div>
								
							
	</div>
</header>
<?php include("search-form.php"); ?>
<?php include("mobile-header-3.php"); ?>

<style>
@media only screen and (min-width: 1024px) {

		.header3 .util-left-nav ul > li:hover {
			background-color: transparent;
		}
		.header3 .util-left-nav ul > li:hover ul a {
			color: #0988c2;
		}
		.header3 .util-left-nav ul li {
			width: auto;
		}
		.header3 .util-left-nav ul li ul a {
			font-weight: 600;
			color: #0988c2;
		}
		.header3 nav > ul#dsn-primary-menu {
			display: block;
			text-align: right;
			width: calc(100% - 300px);
        	margin-left: auto;
		}
		.header3 nav > ul#dsn-primary-menu > li {
			display: inline-block;
			padding: 0 0.2em;
			width: auto;
			position: initial;
		}
		.header3.sticky-header-active nav > ul#dsn-primary-menu > li { 
			position: relative;
		}
		.header3 nav > ul#dsn-primary-menu > li:last-child {
			padding-right: 0;
		}
		.header3 nav > ul#dsn-primary-menu > li > a {
			border-bottom: 2px solid transparent;
		}
		.header3 nav > ul#dsn-primary-menu > li:hover > a {
			border-bottom: 2px solid #006197;
		}

		.header3 nav > ul > li:after {
			content: "";
			width: 1px;
			height: 100%;
			background: #fff;
			position: absolute;
			right: 0;
			top: 0;
		}
		.header3 nav > ul > li:last-child:after {
			content: "";
			width: 0px;
		}
		.header3.sticky-header-active .primary-nav .dsn-logo {
			display: none;
		}
		.header3.sticky-header-active nav > ul#dsn-primary-menu {
			display: flex;
			width: 100%;
		}
		.header3.sticky-header-active nav > ul#dsn-primary-menu > li {
			width: 100%;
			padding: 0;
		}
		.header3.sticky-header-active nav > ul#dsn-primary-menu > li:hover a, .header3.sticky-header-active .utility-sticky-nav ul > li a, .header3.sticky-header-active .utility-sticky-nav span.dsn_nav__caret {
			color: #076594;
		}
		.header3.sticky-header-active nav > ul > li:first-child:before {
			content: "";
			width: 1px;
			height: 100%;
			background: #fff;
			position: absolute;
			left: 0;
			top: 0;
		}
		.header3.sticky-header-active nav > ul > li:last-child:after {
			content: "";
			width: 1px !important;
		}
		.header3.sticky-header-active .util-left-nav ul li {
			width: 100%;
			justify-content: center;
		}
		.header3.sticky-header-active .dsn-logo {
			background: #076594;
			border-radius: 100%;
			margin-bottom: -59px;
			/* box-shadow: 0px 0px 3px 0px #ddd; */
			display: flex;
			justify-content: center;
			align-items: center;
			height: 91px;
			width: 150px;
			margin-left: -10px;
			margin-right: 1em;
			padding: 1em 1.5em;
		}
		.header3 .utility-sticky-nav ul > li li {
			padding: 0;
		}
		header.header3 ul li ul a {
			font-size: 16px;
			width: 100%;
		}
		.header3 .open > .sub-menu {
			display: block;
			margin: 0;
		}
		.header3 .open > .mega-menu-inner { 
			display: flex;
		}
		.header3 ul > li.open > .mega-menu-inner { 
			right: 0;
			transform: translateX(-8%);
		}
		.header3 ul > li.open.non-mega > .mega-menu-inner { 
			left: auto;
			right: auto;
			transform: unset;
		}
		.header3.sticky-header-active li.open > .mega-menu-inner { 
			left: auto;
			right: auto;
		}
		.primary-nav {
			padding: 1em 2em;
			box-shadow: 0px 3px 6px 0px #ddd;
		}
		.header3.sticky-header-active .primary-nav {
			padding: 0;
			box-shadow: unset;
		}
		
		.header3 .dropdown-content a {
			padding: 0.5em 0;
		}
		.header3 .mega-menucolumn > a {
			pointer-events: none;
			color: #000;
			font-weight: 700;
		}
		.header3 .mega-menu > a {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
			font-size: 18px;
			height: 100%;
		}
		.header3 span.dsn_nav__caret {
			margin-top: 3px;
		}
		.header3.sticky-header-active {
			display: flex;
			padding: 0 1em;
		}
		.header3.sticky-header-active .dsn-header-top-container {
			display: none;
		}
		.header3.sticky-header-active .mega-menu > a {
        	color: #fff;	
			width: 100%;
    	}
		
		.header3.sticky-header-active .cart-search-combo { 
		display: flex;
		}
		.header3 .nav-close svg {
			display: none;
		}
		.header3 .nav-close span {
			display: flex !important;
			height: 28.927px !important;
        	width: 30px !important;
			align-items: center;
		}
		.header3 .dsn-mobile-hamburger {
			height: 46px;
		}
		
		header.header3 ul li ul a:hover {
			opacity: 0.80;
		}
		.header3 li.non-mega ul {
			display: block;
			min-width: 200px;
		}
		.header3 .utility-sticky-nav .mega-menu > a {
			justify-content: start;
		}
		.utility-sticky-nav ul > li {
			padding: 4px 30px;
		}
		.header3 .utility-sticky-nav .open .sub-menu {
			right: 100%;
			top: 0;
		}
		.header3.sticky-header-active .mega-menu > a {
			font-size: 20px;
		}
		.header3 .util-left-nav ul li:after {
			content: "";
			height: 20px;
			width: 1px;
			background: rgb(255, 255, 255, 0.5);
			position: absolute;
			right: -18px;
			top: 50%;
			transform: translateY(-50%);
		}
		.header3 .util-left-nav ul li:first-child:before {
			content: "";
			height: 20px;
			width: 1px;
			background: rgb(255, 255, 255, 0.5);
			position: absolute;
			left: -18px;
			top: 50%;
			transform: translateY(-50%);
		}
		.dsn-mobile-hamburger > svg {
            visibility: visible;
            opacity: 1;
            transform: rotate(0deg);
            transition: visibility 0s, opacity 0.5s linear, transform 2s;
        }
        .dsn-mobile-hamburger > a {
            visibility: hidden;
            opacity: 0;
            transform: rotate(180deg);
            transition: visibility 0s, opacity 0.5s linear, transform 2s;
        }
        .dsn-mobile-hamburger.is-active > svg {
            visibility: hidden;
            transform: rotate(90deg);
            transition: visibility 0s, opacity 0.5s linear, transform 2s;
            opacity: 0;
        }
        .dsn-mobile-hamburger.is-active > a {
            visibility: visible;
            width: 30px;
            height: 30px;
            transform: rotate(90deg);
            transition: visibility 0s, opacity 0.5s linear, transform 2s;
            opacity: 1;
        }
        .nav-close span::before {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 3px;
		  width: 30px;
		  background: #fff;
		  position: absolute;
		  display: block;
		  content: '';
          transition: transform 0.5s;
		  transform: rotate(-45deg);
		}
		.nav-close span::after {
		  cursor: pointer;
		  border-radius: 1px;
		  height: 3px;
		  width: 30px;
		  background: #fff;
		  position: absolute;
		  display: block;
		  content: '';
          transition: transform 0.5s;
		  transform: rotate(45deg);
		}
        .dsn-desktop-hamburger.is-active > .nav-close span::after {
            transform: rotate(-45deg);
            transition: transform 0.5s;
        }
        .dsn-desktop-hamburger.is-active > .nav-close span::before {
            transform: rotate(45deg);
            transition: transform 0.5s;
        }
        .is-active > a span {
            position: absolute;
            top: 36px;
        }
		
}
@media only screen and (min-width: 2460px) {
	
	.header3.sticky-header-active .dsn-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        left: 0%;
        background: #076594;
        height: 127px;
        width: 200px;
        border-radius: 100%;
        top: -9px;
    }
	.header3 .sticky-header-active .dsn-logo img {
		width: 80px;
	}
	.header3 .primary-nav .dsn-logo img {
        width: auto;
    }
	.header3.sticky-header-active .cart-search-combo {
		display: flex;
		position: absolute;
		right: 1%;
		top: 8px;
	}
}
@media only screen and (min-width: 1024px) and (max-width: 1600px) {
    .header3.sticky-header-active .mega-menu > a {
        font-size: 16px;
    }
	.header3 .mega-menu > a {
		font-size: 16px;
		padding-right: 0;
        padding-left: 0;
	}
	
	.header3.sticky-header-active .cart-search-combo a.the-search-icon {
		width: 46px;
		height: 46px;
	}
	.header3.sticky-header-active .the-navigation .cart-search-combo > a {
				width: 46px;
				height: 46px;
				display: flex;
				align-items: center;
				justify-content: center;
			}
	 .header3.sticky-header-active .cart-search-combo a.wishlist, .header3.sticky-header-active .cart-search-combo a.cart {
			width: auto;
		}
	
	.primary-nav {
        padding: 0.5em 0; 
	}
	.primary-nav .dsn-logo {
		height: 175px;
        top: -82px;
        width: 317px;
	}
}
@media only screen and (min-width: 1536px) and (max-width: 2300px){
	.header3.sticky-header-active .dsn-logo {
		width: 190px;
        height: 100px;
	}
}
@media only screen and (min-width: 2301px) and (max-width: 2460px) {
	.header3.sticky-header-active .dsn-logo {
		width: 95px;
	}
}
@media only screen and (min-width: 1024px) and (max-width: 1200px) {
	.header3 .mega-menu > a {
        font-size: 13px;
        padding-right: 0px;
        padding-left: 0px;
    }
	.header3.sticky-header-active .mega-menu > a {
        font-size: 14px;
        padding-right: 10px;
        padding-left: 10px;
    }
	.primary-nav .dsn-logo {
        height: 142px;
        top: -59px;
        width: 259px;
    }
	.cart-search-combo a {
        width: 35px;
        height: 35px;
    }
	.header3 .util-left-nav, .header3 nav > ul#dsn-primary-menu {
		width: calc(100% - 250px);
	}
	.dsn-header-top-container {
		padding-bottom: 5px;
		padding-top: 5px;
	}
}
@media only screen and (min-width: 1800px) {
    .header3 nav > ul#dsn-primary-menu > li {
        display: inline-block;
        padding: 0 0.5em; 
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

                $('.dsn-mobile-hamburger svg').click(function() {
                  $('.dsn-mobile-hamburger').toggleClass('is-active');
				  $(this).toggleClass("nav-close");
                  $('.the-navigation').fadeToggle();
				  jQuery('#dsnHTML').toggleClass('dsnOpen');
            		jQuery('.the-navigation').toggleClass('dsnMobileOpen');
                });
				 $('.dsn-mobile-hamburger .nav-close').click(function() {
                  $('.dsn-mobile-hamburger').toggleClass('is-active');
				  $('.dsn-mobile-hamburger').toggleClass('nav-close');
				  jQuery('#dsnHTML').toggleClass('dsnOpen');
				  jQuery('.the-navigation').toggleClass('dsnMobileOpen');
                  $('.the-navigation').fadeToggle();
                });
				
				$('div.form-wrapper').hide();

				$('a.the-search-icon').click(function(){
					$('div.form-wrapper').fadeToggle();
				});

				$('div.esc-form').click(function(){
					$('div.form-wrapper').fadeToggle();
				});
				
				var clickable_desktop = $('.util-left-nav ul, .util-right-nav ul, .utility-sticky-nav ul').attr('data-clickable');
				$('.util-left-nav ul li:has(ul), .util-right-nav ul li:has(ul), .utility-sticky-nav ul li:has(ul)').addClass('has-sub dsn:relative dsn:flex dsn:items-center dsn:gap-2 dsn:cursor-pointer');
				$('.util-left-nav ul .has-sub>a, .util-right-nav ul .has-sub>a, .utility-sticky-nav ul .has-sub>a').after('<span class="dsn_nav__caret dsn:text-[#fff] dsn:rotate-90"><svg fill="currentColor" width="20" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></span>');

              }(jQuery));
			  
			  jQuery(document).ready(function($) {

			  $('.mega-menu > a').each(function() {
					var $element = $(this);
					$element.html($element.html().replace(/^(\w+)/, '<span>$1&nbsp;</span>'));
					});

					$("ul#dsn-primary-menu li").filter(function () {
						return $(this).find('ul').length == 1
					}).addClass("non-mega");

				});
            </script>
			<?php if ($header_sticky == 1) {?>
				<script>
					  jQuery(document).ready(function($) {
						//caches a jQuery object containing the header element
					var header = $(".sticky-header");
					var width = $("body").width();
					console.log(width);

					if (width > 1024) {
						$('.dsn-desktop-hamburger').click(function () {
							$(this).toggleClass('is-active');
							$(this).toggleClass("nav-close");
							$('.the-navigation').fadeToggle();
						});
						$('.nav-close').click(function () {
							$('.dsn-desktop-hamburger').toggleClass('is-active');
							$('.dsn-desktop-hamburger').toggleClass('nav-close');
							$('.the-navigation').fadeToggle();
						});
					$(window).scroll(function() {
						var scroll = $(window).scrollTop();

						if (scroll >= 5) {
							header.addClass("sticky-header-active dsn:bg-[#076594]");
							header.removeClass("dsn:bg-white dsn:py-4 dsn:mb-10");
							$('.primary-nav').addClass("dsn:container dsn:flex dsn:items-center dsn:justify-between");
							$('.nav-container').removeClass("dsn:container");
						} else {
							header.removeClass("sticky-header-active dsn:bg-[#076594]");
							header.addClass("dsn:bg-white dsn:mb-10");
							$('.primary-nav').removeClass("dsn:container");
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

