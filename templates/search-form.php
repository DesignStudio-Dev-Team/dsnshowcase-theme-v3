<div class="form-wrapper dsn:fixed dsn:flex-col dsn:w-full dsn:h-full dsn:top-0 dsn:left-0 dsn:flex dsn:justify-center dsn:items-center dsn:bg-[#076594]/95 dsn:z-60">
        <div class="esc-form dsn:absolute dsn:right-[7%] dsn:top-[40%] dsn:md:right-[22%] dsn:md:top-[22%] dsn:w-8 dsn:h-8 dsn:rounded-full dsn:bg-white dsn:flex dsn:justify-center dsn:items-center"><a href="javascript:;" class="close-search dsn:text-2xl dsn:leading-0 dsn:pb-2 dsn:text-red-500">x</a></div>
			<form id="fast-search-desktop" role="search" method="get" class="woocommerce-product-search dsn:w-10/12 dsn:md:w-1/2" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				<h3 class="dsn:text-white dsn:text-xl">Search By..</h3>
				<div class="dsn:text-white dsn:py-2 dsn:flex dsn:items-center dsn:gap-4">
				<div class="dsn:flex dsn:items-center dsn:gap-2"><input type="radio" name="post_type" value="product" id="products" class="dsn:cursor-pointer" checked /><label for="products" class="dsn:cursor-pointer">Products</label></div>
				<div class="dsn:flex dsn:items-center dsn:gap-2"><input type="radio" name="post_type" value="post" id="blogs" class="dsn:cursor-pointer" /> <label for="blogs" class="dsn:cursor-pointer">Blog</label> </div>
				<div class="dsn:flex dsn:items-center dsn:gap-2"><input type="radio" name="post_type" value="all" id="all" class="dsn:cursor-pointer" /> <label for="all" class="dsn:cursor-pointer">All</label></div>
				</div>
				<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
				<input class="popup-search-bar search dsn:p-4 dsn:rounded-md dsn:w-full dsn:bg-white" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
				
            </form>
        </div>