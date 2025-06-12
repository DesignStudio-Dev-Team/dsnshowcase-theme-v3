<?php 
$productsShowcaseBlock = get_field('products_showcase', $block_id);
$title = $productsShowcaseBlock['title'];
$description = $productsShowcaseBlock['description'];
$titleOfShowcase = $productsShowcaseBlock['title_of_showcase'];
$set_of_products = $productsShowcaseBlock['set_of_products'];
?>

<section id="product-showcase" class="dsn:my-20 dsn:py-20 dsn:px-4 dsn:md:px-10 dsn:text-white">
    <div class="dsn:container dsn:mx-auto dsn:relative">
    <h2 class="dsn:text-left dsn:mb-10"><?php if ($title) { echo $title; } ?></h2>
    <p class="dsn:text-left dsn:lg:max-w-8/12"><?php if($description) { echo $description; } ?></p>
    <div class="product-showcase-inner dsn:pt-10 dsn:relative">
    
<div class="slider product-slider-nav dsn:mb-8">

    <?php 
    $i = 1;
    //print_r($set_of_products);
    if ($set_of_products) {
          echo '<div class="slide-nav-label dsn:relative dsn:py-4" data-slide=0>All</div>';
foreach($set_of_products as $category => $value ) {

   echo '<div class="slide-nav-label dsn:relative dsn:py-4" data-slide='. $i .'>' . $value['category_name'] . '</div>';
   $i++;
}
    }
?>
  </div>
  <div class="slider product-slider-for">
    <?php 
    $AllProducts = array();
    if ($set_of_products) {
	foreach($set_of_products as $all_category => $value ) { 
        $AllProducts[] = $value['products'][0];
    }
}

?> 
    <div class="all-products dsn:w-full" data-slide="0">
        <?php 
        foreach ($AllProducts as $post):
                    setup_postdata($post); 
                    $postID = $post->ID;
                    $product = wc_get_product($postID); 
                    ?>
                    <div class="dsn:w-full dsn:mx-3 dsn:sm:mx-2 dsn:lg:mx-4 dsn:mb-4 dsn:relative product-box dsn:shadow-lg">
                        <a class="product-inner dsn:bg-white dsn:p-6 dsn:block" href="<?php echo get_permalink($postID); ?>">
                            <div class="dsn:text-center thumbnail">
                                <?php if (has_post_thumbnail($postID)): ?>
                                    <?php echo get_the_post_thumbnail($postID, 'medium'); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <p class="dsn:text-black dsn:mb-0 dsn:uppercase dsn:text-sm product-category dsn:my-4"><?php echo $value['category_name']; ?></p>
                            <h3 class="dsn:text-left dsn:text-white product-title"><?php echo get_the_title($postID); ?></h3>
                        </a>
                       
                        <div class="product-bottom dsn:flex dsn:items-center dsn:justify-between dsn:lg:p-4 dsn:p-4 dsn:text-black dsn:md:h-20">
                             <?php if ($product->get_price_html()) { ?>
                                <span class="product-prices"><?php echo $product->get_price_html(); ?></span><span><button class="single_add_to_cart_button product_shocase_add_to_cart dsn:px-4 dsn:py-2 dsn:rounded-md"
                                                    value="<?php echo $postID; ?>">
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate add-to-cart-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            <span class="loading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" fill="#fff" /></svg></span>
                                            </button></span>
                        <?php } else { ?><span class="product-prices">Request price</span><span><a href="<?php echo get_permalink($postID); ?>" class="product_shocase_add_to_cart dsn:px-4 dsn:py-2 dsn:rounded-md" >
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            </a></span> <?php } ?></div>
                    </div>
                <?php endforeach; ?>
    </div>
    <?php 

    $j = 1;
    
  if ($set_of_products) {
	foreach($set_of_products as $category => $value ) { 
        $category = $value['products'];
         $j++;
?>

<div class="all-products dsn:w-full" data-slide="<?php echo $j; ?>"> <?php
 if (!empty($set_of_products)): ?>
                <?php foreach ($category as $post):
                    setup_postdata($post); 
                    $postID = $post->ID;
                    $product = wc_get_product($postID); 
                    ?>
                    <div class="dsn:w-full dsn:mx-3 dsn:sm:mx-2 dsn:lg:mx-4 dsn:mb-4 dsn:relative product-box dsn:shadow-lg">
                        <a class="product-inner dsn:bg-white dsn:p-6 dsn:block" href="<?php echo get_permalink($postID); ?>">
                            <div class="dsn:text-center thumbnail">
                                <?php if (has_post_thumbnail($postID)): ?>
                                    <?php echo get_the_post_thumbnail($postID, 'medium'); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <p class="dsn:text-black dsn:mb-0 dsn:uppercase dsn:text-sm product-category dsn:my-4"><?php echo $value['category_name']; ?></p>
                            <h3 class="dsn:text-left dsn:text-white product-title"><?php echo get_the_title($postID); ?></h3>
                        </a>
                       
                        <div class="product-bottom dsn:flex dsn:items-center dsn:justify-between dsn:lg:p-4 dsn:p-2 dsn:text-black dsn:md:h-20">
                             <?php if ($product->get_price_html()) { ?>
                                <span class="product-prices"><?php echo $product->get_price_html(); ?></span><span><button class="single_add_to_cart_button product_shocase_add_to_cart dsn:px-4 dsn:py-4 dsn:rounded-md"
                                                    value="<?php echo $postID; ?>">
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate add-to-cart-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            <span class="loading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" fill="#fff" /></svg></span>
                                            </button></span>
                        <?php } else { echo "Request price"; } ?></div>
                    </div>
                <?php endforeach; ?>
    <?php endif; ?>
<?php //reset query
wp_reset_postdata();

?>

  </div>
  
   
  <?php } 
  }?>
 
  </div>
   <div class="progress" role="progressbar" aria-valuemin="10" aria-valuemax="100" style="background-size: 10%;">
    <span class="slider__label sr-only"></span>
</div>
</div>
</section>

<style>
    #product-showcase, .product_shocase_add_to_cart {
    background: #286632; 
}
.product-title {
    color: #286632;
}
.product-slider-nav:before {
    content: "";
    width: 20%;
    background: linear-gradient(45deg, transparent, #286632);
    height: 100%;
    position: absolute;
    right: 0;
    z-index: 99;
}
    .progress {
        display: block;
        width: 90%;
        height: 10px;
        border-radius: 0;
        overflow: hidden;
        background-color: #092E0F;
        background-image: linear-gradient(to right, white, white);
        background-repeat: no-repeat;
        background-size: 0 100%;
        transition: background-size .4s ease-in-out;
        position: absolute;
        left: 0;
        bottom: 1em;
    }
    .slider-count {
        position: absolute;
        right: 27px;
        bottom: -6px;
        width: 44px;
    }
    .slider-count p {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
    .all-products {
        padding-bottom: 4em;
        margin-left: 0;
        margin-right: 0;
    }
    .product-slider-for {
       margin-left: 0;
        margin-right: 0; 
    }
    .product-slider-nav {
    margin-left: 0;
    margin-right: 0;
    }
   .product-box {
    min-height: 370px;
    background: #fff;
    display: flex !important;
    flex-direction: column;
    justify-content: space-between;
   }
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  border: 0;
}
.product-slider-nav .slide-nav-label:hover {
    background: #1e4925;
}
  .thumbnail img {
    margin-left: auto;
    margin-right: auto;
    }
    .product-slider-nav .slick-track {
        margin-left: 0;
    }
    .product-slider-nav .slick-list {
        z-index: 9;
    }
    .product-slider-nav .slide-nav-label {
        text-align: center;
        cursor: pointer;
    }
    .slide-nav-label.slick-slide.slick-current.slick-active:after {
    content: "";
    width: 100%;
    height: 4px;
    background: #F47A1F;
    position: absolute;
    left: 0;
    bottom: 0px;
    z-index: 99999;
}
.product-slider-nav:after {
    content: "";
    width: 100%;
    height: 2px;
    background: #fff;
    position: absolute;
    bottom: 1px;
    left: 0;
    z-index: 1;
}
.product-bottom {
    background-color: #f3f4f6;
}
/* .product-bottom .single_add_to_cart_button.added {
    display: none;
} */
 .product-bottom a.added_to_cart.wc-forward {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    text-align: center;
    height: 100%;
    background: #000000a6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2em;
    color: #fff;
}
.product-bottom span.product-prices {
    margin-bottom: 0;
}
.product-bottom span.product-prices .amount {
    display: flex;
    align-items: center;
    margin-bottom: 0 !important;
}
a.product-inner .thumbnail img {
    min-height: 170px;
    width: 100%;
    object-fit: cover;
}
.slider-count p {
    font-size: 18px;
}

.pull-left, .pull-right {
    width: 10px;
    height: 10px;
    position: absolute;
    bottom: 27px;
}
.pull-left {
    right: 65px;
}
.pull-right {
    right: 26px;
}
.pull-left:before, .pull-right:after {
    color: white;
    border-right: 2px solid currentcolor;
    border-bottom: 2px solid currentcolor;
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.pull-left:before{
    left: -16px;
    transform: rotate(135deg)
}
.pull-right:after{
    right: -16px;
    transform: rotate(-45deg)
}
span.loading-icon { 
    display: none;
}
span.loading-icon svg { 
    width: 20px;
} 
.loading span.loading-icon {
    display: block;
}
.loading span.add-to-cart-icon {
    display: none;
}

@media only screen and (max-width: 1800px) {
    .product-box {
        margin-left: 5px;
        margin-right: 5px;
    }
    a.product-inner .thumbnail img {
    min-height: 250px;
}
}
@media only screen and (max-width: 1024px) {
    .all-products {
        margin-left: 20px;
        margin-right: 20px;
    }
    .progress {
        width: 70%;
    }
    .progress {
        bottom: 1.5em;
    }
    .slider-count {
        bottom: 0;
        right: 0;
    }
    .pull-left, .pull-right {
        bottom: 33px;
    }
    .pull-left {
    right: 35px;
    }
     .pull-right {
    right: 0px;
    }
    .product-slider-nav:before {
    content: "";
    width: 20%;
    background: linear-gradient(45deg, transparent, #286632);
    height: 100%;
    position: absolute;
    right: 0;
    z-index: 99;
}
}

</style>

<script>
            ;
            (function ($) {
                
                $(document).on('click', '.single_add_to_cart_button', function (e) {
                    e.preventDefault();

                    var $thisbutton = $(this),
                        id = $thisbutton.val(),
                        variation_id = $thisbutton.data('variation_id') || 0;

                    var data = {
                        action: 'woocommerce_ajax_add_to_cart',
                        product_id: id,
                        product_sku: '',
                        quantity: 1,
                        variation_id: variation_id,
                    };

                    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
                    
                    $.ajax({
                        type: 'post',
                        url: wc_add_to_cart_params.ajax_url,
                        data: data,
                        beforeSend: function (response) {
                            $thisbutton.removeClass('added').addClass('loading');
                        },
                        complete: function (response) {
                            $thisbutton.addClass('added').removeClass('loading');
                        },
                        success: function (response) {

                            if (response.error & response.product_url) {
                                window.location = response.product_url;
                                return;
                            } else {
                                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                            }
                        },
                    });

                    return false;
                });
                
            }(jQuery));
        </script>