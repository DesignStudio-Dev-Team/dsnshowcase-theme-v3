<?php
/***
 Header 1 
 ****/
 
$header_logo = get_field('header_logo', 'options');
?>


<header class="dsn:bg-white dsn:text-[#0988c2] dsn:py-4 dsn:mb-10 dsn:hidden dsn:md:block">
	<div class="dsn:container dsn:mx-auto dsn:flex dsn:justify-between dsn:items-center">
        <div class="util-left-nav dsn:w-4/12">
		<?php wp_nav_menu(array(
            'theme_location' => 'utility_left',
            'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:relative',
			'link_class' => "dsn:text-[#0988c2] dsn:text-xl dsn:py-2 dsn:block",
        )); ?>
		</div>
		<div class="dsn-logo dsn:w-4/12">
		<a class="dsn:block dsn:relative dsn:text-center" href="<?php
            echo esc_url(home_url('/'));
        ?>"><img class="dsn:w-48 dsn:md:w-64 dsn:mx-auto" src="<?php echo $header_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" /> <span class="dsn:hidden"> <?php bloginfo('name'); ?></span></a>
		</div>
		<div class="util-left-nav dsn:flex dsn:justify-end dsn:items-center dsn:gap-4 dsn:w-4/12">
		<?php wp_nav_menu(array(
            'theme_location' => 'utility_right',
            'menu_class' => 'dsn:flex dsn:items-center dsn:space-x-10 dsn:pr-4 dsn:relative',
			'link_class' => "dsn:text-[#0988c2] dsn:text-xl dsn:py-4",
        )); ?>
		<div class="cart-search-combo cf dsn:flex dsn:justify-end dsn:items-center dsn:gap-4">
								
			<a aria-label="My Account" href="/my-account" class="my-account-icon">
				<!-- <svg xmlns="http://www.w3.org/2000/svg" width="25.927" height="25.927" viewBox="0 0 25.927 25.927" class="dsn:stroke-current dsn:fill-current" role="presentation">
					<path id="Icon_material-account-circle" class="dsn:stroke-current dsn:fill-current" data-name="Icon material-account-circle" d="M15.964,3A12.964,12.964,0,1,0,28.927,15.964,12.968,12.968,0,0,0,15.964,3Zm0,3.889a3.889,3.889,0,1,1-3.889,3.889A3.884,3.884,0,0,1,15.964,6.889Zm0,18.408a9.334,9.334,0,0,1-7.778-4.174c.039-2.58,5.185-3.993,7.778-3.993s7.739,1.413,7.778,3.993A9.334,9.334,0,0,1,15.964,25.3Z" transform="translate(-3 -3)" fill="none"></path>
				</svg> -->
				<a class="the-search-icon dsn:cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dsn:stroke-current dsn:fill-current" width="25.927" height="25.927"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path class="dsn:stroke-current dsn:fill-current" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
				<svg class="svg-icon" width="30" height="30" style="vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 853.333333c-69.393067 53.486933-149.333333 81.92-239.786667 85.333334H496.64c-90.453333-2.850133-170.376533-30.72-239.786667-83.626667v-88.746667C330.24 710.5536 415.2832 682.666667 512 682.666667c97.28 0 182.613333 28.450133 256 85.333333v85.333333z m-86.186667-426.666666c0 47.223467-16.776533 87.313067-50.346666 120.32-33.006933 33.5872-73.096533 50.346667-120.32 50.346666-47.223467 0-87.620267-16.759467-121.173334-50.346666-32.989867-33.006933-49.493333-73.096533-49.493333-120.32s16.503467-87.6032 49.493333-121.173334c33.553067-32.989867 73.949867-49.493333 121.173334-49.493333 47.223467 0 87.313067 16.503467 120.32 49.493333 33.570133 33.570133 50.346667 73.949867 50.346666 121.173334z"  /><path d="M496.64 955.733333c-94.208-2.9696-178.176-32.273067-250.146133-87.125333l-0.238934-0.187733a547.4304 547.4304 0 0 1-48.401066-43.1104C111.872 739.2768 68.266667 633.890133 68.266667 512c0-121.856 43.588267-227.549867 129.536-314.112C284.450133 111.854933 390.126933 68.266667 512 68.266667c121.9072 0 227.293867 43.605333 313.2928 129.5872C911.854933 284.416 955.733333 390.109867 955.733333 512c0 121.924267-43.895467 227.328-130.474666 313.326933a509.7472 509.7472 0 0 1-47.0016 41.642667c-71.953067 55.364267-155.835733 85.213867-249.3952 88.746667L496.64 955.733333z m-222.72-109.2608c64.699733 47.2576 139.758933 72.516267 223.266133 75.144534L528.213333 921.6c82.926933-3.157333 158.020267-28.962133 222.72-76.765867v-68.369066C682.376533 725.5552 602.026667 699.733333 512 699.733333c-89.480533 0-169.540267 25.258667-238.08 75.144534v71.594666zM512 102.4c-112.5376 0-210.1248 40.2432-290.065067 119.620267C142.6432 301.8752 102.4 399.479467 102.4 512c0 112.503467 40.226133 209.783467 119.586133 289.160533 5.888 5.870933 11.810133 11.554133 17.800534 16.9984V766.293333a17.066667 17.066667 0 0 1 6.741333-13.585066C322.6112 694.903467 411.938133 665.6 512 665.6c100.693333 0 190.344533 29.917867 266.4448 88.917333 4.181333 3.2256 6.621867 8.192 6.621867 13.482667v48.571733c5.410133-4.949333 10.8032-10.103467 16.093866-15.394133C881.1008 721.7664 921.6 624.4864 921.6 512c0-112.503467-40.516267-210.090667-120.439467-290.013867C721.800533 142.626133 624.520533 102.4 512 102.4z m-0.853333 512c-51.729067 0-96.5632-18.619733-133.256534-55.3472-36.1472-36.164267-54.4768-80.708267-54.4768-132.386133 0-51.6096 18.295467-96.4096 54.391467-133.137067C414.702933 257.2288 459.502933 238.933333 511.146667 238.933333c51.677867 0 96.221867 18.3296 132.386133 54.493867 36.727467 36.727467 55.3472 81.5616 55.3472 133.239467 0 51.746133-18.653867 96.324267-55.4496 132.488533C607.488 595.746133 562.8928 614.4 511.146667 614.4z m0-341.333333c-42.973867 0-78.6944 14.574933-109.2096 44.5952-29.7984 30.327467-44.3904 66.048-44.3904 109.0048 0 42.888533 14.557867 78.301867 44.4928 108.253866C432.5376 565.435733 468.224 580.266667 511.146667 580.266667c42.8544 0 78.2336-14.7968 108.151466-45.243734C649.949867 504.8832 664.746667 469.504 664.746667 426.666667c0-42.888533-14.830933-78.574933-45.346134-109.1072C589.448533 287.624533 554.052267 273.066667 511.146667 273.066667z"  /></svg>
            </a>
            <a class="cart dsn:relative" href="https://affordablehottubs4u.com/cart/" title="Cart"><span class="the-cart-quantity dsn:absolute dsn:-bottom-2 dsn:-right-2 dsn:bg-black dsn:w-4 dsn:h-4 dsn:rounded-full dsn:text-white dsn:text-center dsn:text-xs">0</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="dsn:stroke-current dsn:fill-current" width="25.927" height="25.927"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path class="dsn:stroke-current dsn:fill-current" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></a>
			

            </div>
		</div>
		
    </div>
	<div class="primary-nav dsn:bg-gray-100 dsn:mt-4 dsn:block dsn:relative">
    <div class="dsn:container dsn:mx-auto dsn:relative">
        
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
			'menu_id'			=> 'dsn-primary-menu',
            'menu_class' => 'dsn:flex dsn:justify-between dsn:items-center dsn:w-full dsn:text-white dsn:w-full',
			'container'			=> "nav",
			'container_class'	=> "dsn:bg-[#076594] dsn:rounded-md dsn:relative",
			'link_class' 		=> "dsn:py-4 dsn:w-full dsn:block dsn:relative",
			'depth'				=>	0,
			'walker' => new DSN_Walker_Nav_Menu()
        )); ?>
    </div>
	</div>
	 
</header>
<div class="form-wrapper dsn:fixed dsn:flex-col dsn:w-full dsn:h-full dsn:top-0 dsn:left-0 dsn:flex dsn:justify-center dsn:items-center dsn:bg-[#076594]/95 dsn:z-40">
        <div class="esc-form dsn:absolute dsn:right-[7%] dsn:top-[40%] dsn:md:right-[22%] dsn:md:top-[22%] dsn:w-8 dsn:h-8 dsn:rounded-full dsn:bg-white dsn:flex dsn:justify-center dsn:items-center"><a href="javascript:;" class="close-search dsn:text-2xl dsn:leading-0 dsn:pb-2 dsn:text-red-500">x</a></div>
			<form id="fast-search-desktop" role="search" method="get" class="woocommerce-product-search dsn:w-10/12 dsn:md:w-1/2" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
				<input class="popup-search-bar search dsn:p-4 dsn:rounded-md dsn:w-full dsn:bg-white" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
				<input type="hidden" name="post_type" value="product" />
            </form>
        </div>
<?php include("mobile-header.php"); ?>

<style>
@media only screen and (min-width: 1024px) {
	
	.open > .sub-menu {
	display: block;
	}
	.open > .mega-menu-inner { 
	display: flex;
	}
		.util-left-nav ul li {
			width: auto;
		}
		nav > ul > li:after {
			content: "";
			width: 1px;
			height: 100%;
			background: #fff;
			position: absolute;
			right: 0;
			top: 0;
		}
		nav > ul > li:last-child:after {
			content: "";
			width: 0px;
		}
		.dropdown-content a {
			padding: 0.5em 0;
		}
		.mega-menucolumn > a {
			pointer-events: none;
			color: #000;
			font-weight: 700;
		}
		.mega-menu > a {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-wrap: wrap;
		}
		span.dsn_nav__caret {
			margin-top: 3px;
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
				
				var clickable_desktop = $('.util-left-nav ul').attr('data-clickable');
				$('.util-left-nav ul li:has(ul)').addClass('has-sub dsn:relative dsn:flex dsn:items-center dsn:gap-2 dsn:cursor-pointer');
				$('.util-left-nav ul .has-sub>a').after('<span class="dsn_nav__caret dsn:text-[#0988c2] dsn:rotate-90"><svg fill="currentColor" width="20" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></span>');

              }(jQuery));
			  
			  jQuery(document).ready(function($) {

			  $('.mega-menu > a').each(function() {
					var $element = $(this);
					$element.html($element.html().replace(/^(\w+)/, '<span>$1&nbsp;</span>'));
					});
				});
            </script>

