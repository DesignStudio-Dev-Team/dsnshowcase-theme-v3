<?php 
$productsShowcaseBlock = get_field('products_showcase', $block_id);
$title = $productsShowcaseBlock['title'];
$description = $productsShowcaseBlock['description'];
$titleOfShowcase = $productsShowcaseBlock['title_of_showcase'];
$set_of_products = $productsShowcaseBlock['set_of_products'];
?>

<section id="product-showcase-<?php echo $block_id; ?>" class="dsn:my-20">
    
    <div class="product-showcase-inner dsn:py-10 dsn:md:py-10 dsn:px-4 dsn:md:px-10 dsn:text-white">
    <div class="dsn:container dsn:mx-auto dsn:relative">
    <div class="dsn:relative">
        <div class="product-showcase-title-block dsn:container dsn:mx-auto dsn:relative dsn:text-center">
    <?php if ($title) { ?> <h2 class="dsn:mb-4"><?php echo $title; ?></h2> <?php } ?>
    <?php if ($description) { ?>  <p class="dsn:mb-4"><?php echo $description; ?></p> <?php } ?>
    </div>
    <?php if ($titleOfShowcase) { ?> <h3 class="dsn:text-center dsn:mb-4"><?php echo $titleOfShowcase; ?></h3> <?php } ?>    
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
    $product_showcase_all_products = array();
    if ($set_of_products) {
	foreach($set_of_products as $all_category => $value ) { 
        $AllProducts[] = $value['products'];
    }
}
$get_all_products = call_user_func_array ('array_merge', $AllProducts);
?> 
    <div class="all-products dsn:w-full" data-slide="0">
        <?php 
        // Build unique list of products for the "All" tab
        $product_showcase_all_products = array();
        if (!empty($get_all_products)) {
            $get_all_products = array_values($get_all_products);
            foreach ($get_all_products as $p) {
                if (!in_array($p, $product_showcase_all_products, true)) {
                    $product_showcase_all_products[] = $p;
                }
            }
        }

        foreach ($product_showcase_all_products as $post):
                    setup_postdata($post);
                    $postID = $post->ID;
                    $product = wc_get_product($postID);
                    // Determine the product's primary category name to display per product in the All tab
                    $prod_cat_name = '';
                    $terms = get_the_terms($postID, 'product_cat');
                    if ($terms && !is_wp_error($terms)) {
                        // Prefer the first non-empty term name
                        $prod_cat_name = $terms[0]->name;
                    }
                    ?>
                    <div class="dsn:w-full dsn:mx-3 dsn:sm:mx-2 dsn:lg:mx-4 dsn:mb-4 dsn:relative product-box dsn:shadow-lg">
                        <a class="product-inner dsn:bg-white dsn:p-4 dsn:block" href="<?php echo get_permalink($postID); ?>">
                            <div class="dsn:text-center thumbnail dsn-ps-thumbnail dsn:h-[200px]">
                                <?php if (has_post_thumbnail($postID)): ?>
                                    <?php echo get_the_post_thumbnail($postID, 'medium'); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <p class="dsn:text-black dsn:mb-0 dsn:uppercase dsn:text-sm product-category dsn:mt-2"><?php echo esc_html($prod_cat_name); ?></p>
                            <h3 class="dsn:text-left dsn:text-white product-title"><?php echo get_the_title($postID); ?></h3>
                        </a>
                       
                        <div class="product-bottom dsn:flex dsn:items-center dsn:justify-between dsn:lg:p-4 dsn:p-4 dsn:text-black dsn:md:h-14">
                             <?php 
                             $price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) );
                              if ($product->get_price_html() || $price) { ?>
                                <span class="product-prices"><?php if($product->get_price_html() && $price) { echo $product->get_price_html(); } else { echo $price; } ?></span><span>
                                    <?php if($product->get_price_html() && $price) { ?>
                                        <button class="single_add_to_cart_button product_shocase_add_to_cart dsn:p-2 dsn:rounded-md"
                                                    value="<?php echo $postID; ?>">
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate add-to-cart-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            <span class="loading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" fill="#fff" /></svg></span>
                                            </button><?php } else { ?><a href="<?php echo get_permalink($postID); ?>" class="product_shocase_add_to_cart dsn:p-2 dsn:rounded-md" >
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            </a> <?php } ?></span>
                        <?php } else { ?><span class="product-prices">Request price</span><span><a href="<?php echo get_permalink($postID); ?>" class="product_shocase_add_to_cart dsn:p-2 dsn:rounded-md" >
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
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
                        <a class="product-inner dsn:bg-white dsn:p-4 dsn:block" href="<?php echo get_permalink($postID); ?>">
                            <div class="dsn:text-center thumbnail dsn-ps-thumbnail dsn:h-[200px]">
                                <?php if (has_post_thumbnail($postID)): ?>
                                    <?php echo get_the_post_thumbnail($postID, 'medium'); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <p class="dsn:text-black dsn:mb-0 dsn:uppercase dsn:text-sm product-category dsn:mt-2"><?php echo $value['category_name']; ?></p>
                            <h3 class="dsn:text-left dsn:text-white product-title"><?php echo get_the_title($postID); ?></h3>
                        </a>
                       
                        <div class="product-bottom dsn:flex dsn:items-center dsn:justify-between dsn:lg:p-4 dsn:p-2 dsn:text-black dsn:md:h-14">
                              <?php 
                              $price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) );
                              if ($product->get_price_html() || $price) { ?>
                                <span class="product-prices"><?php if($product->get_price_html() && $price) { echo $product->get_price_html(); } else { echo $price; } ?></span><span>
                                     <?php if($product->get_price_html() && $price) { ?>
                                        <button class="single_add_to_cart_button product_shocase_add_to_cart dsn:p-2 dsn:rounded-md"
                                                    value="<?php echo $postID; ?>">
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate add-to-cart-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            <span class="loading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" fill="#fff" /></svg></span>
                                            </button><?php } else { ?><a href="<?php echo get_permalink($postID); ?>" class="product_shocase_add_to_cart dsn:p-2 dsn:rounded-md" >
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            </a> <?php } ?></span>
                        <?php } else { ?><span class="product-prices"><?php echo $price; ?>Request price</span><span><a href="<?php echo get_permalink($postID); ?>" class="product_shocase_add_to_cart dsn:p-2 dsn:rounded-md" >
                                                <span class="dsn:normal-case dsn:no-underline dsn:text-base md:dsn:text-lg dsn:cursor-pointer dsn:px-2 lg:dsn:px-4 dsn:py-1 lg:dsn:py-1 dsn:primary-site-btn dsn:font-dsw dsn:font-normal dsn:rounded-md dsn:mx-auto dsn:w-full dsn:text-center dsn:truncate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dsn:w-5 dsn:inline-flex dsn:align-text-top dsn:text-white"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"></path></svg>
                                            <svg class="dsn:w-5 dsn:mt-0.5 dsn:-ml-1 dsn:inline-flex dsn:align-text-top dsn:text-white" fill="currentColor" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg></span>
                                            </a></span> <?php } ?></div>
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
</div>
</section>

<style>
.product-showcase-inner, .product_shocase_add_to_cart {
    background: #286632; 
}
#product-showcase-<?php echo $block_id; ?> .product-title {
    color: #007437;
    height: 80px;
    font-size: 24px;
    line-height: 28px;
}
#product-showcase-<?php echo $block_id; ?> .product-slider-nav:before {
    content: "";
    width: 20%;
    background: linear-gradient(45deg, transparent, #286632);
    height: 100%;
    position: absolute;
    right: 0;
    z-index: 99;
}
    #product-showcase-<?php echo $block_id; ?> .progress {
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
    #product-showcase-<?php echo $block_id; ?> .all-products .slider-count {
        position: absolute;
        right: 27px;
        bottom: 5px;
        width: 44px;
    }
     #product-showcase-<?php echo $block_id; ?> .all-products  .slider-count p {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
    #product-showcase-<?php echo $block_id; ?> .all-products {
        padding-bottom: 4em;
        margin-left: 0;
        margin-right: 0;
        height: auto;
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-for {
       margin-left: 0;
        margin-right: 0; 
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-nav {
    margin-left: 0;
    margin-right: 0;
    }
   #product-showcase-<?php echo $block_id; ?> .product-box {
    min-height: 370px;
    background: #fff;
    display: flex !important;
    flex-direction: column;
    justify-content: space-between;
    height: auto;
   }
#product-showcase-<?php echo $block_id; ?> .sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  border: 0;
}
#product-showcase-<?php echo $block_id; ?> .product-slider-nav .slide-nav-label:hover {
    background: #1e4925;
}
  #product-showcase-<?php echo $block_id; ?> .thumbnail img {
    margin-left: auto;
    margin-right: auto;
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-nav .slick-track {
        margin-left: 0;
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-nav .slick-list {
        z-index: 9;
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-nav .slide-nav-label {
        text-align: center;
        cursor: pointer;
        height: auto;
    }
    #product-showcase-<?php echo $block_id; ?> .slide-nav-label.slick-slide.slick-current.slick-active:after {
    content: "";
    width: 100%;
    height: 4px;
    background: #F47A1F;
    position: absolute;
    left: 0;
    bottom: 0px;
    z-index: 99999;
}
#product-showcase-<?php echo $block_id; ?> .product-slider-nav:after {
    content: "";
    width: 100%;
    height: 2px;
    background: #fff;
    position: absolute;
    bottom: 1px;
    left: 0;
    z-index: 1;
}
#product-showcase-<?php echo $block_id; ?> .product-bottom {
    background-color: #f3f4f6;
}
/* .product-bottom .single_add_to_cart_button.added {
    display: none;
} */
 #product-showcase-<?php echo $block_id; ?> .product-bottom a.added_to_cart.wc-forward {
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
#product-showcase-<?php echo $block_id; ?> .product-bottom span.product-prices {
    margin-bottom: 0;
}
#product-showcase-<?php echo $block_id; ?> .product-bottom span.product-prices .amount {
    display: flex;
    align-items: center;
    margin-bottom: 0 !important;
}
#product-showcase-<?php echo $block_id; ?> a.product-inner .thumbnail img {
    height: 200px;
    width: 100%;
    object-fit: contain;
    object-position: top;
}
#product-showcase-<?php echo $block_id; ?> .slider-count p {
    font-size: 18px;
}

#product-showcase-<?php echo $block_id; ?> .pull-left, #product-showcase-<?php echo $block_id; ?> .pull-right {
    width: 10px;
    height: 10px;
    position: absolute;
    bottom: 27px;
}
#product-showcase-<?php echo $block_id; ?> .pull-left {
    right: 65px;
}
#product-showcase-<?php echo $block_id; ?> .pull-right {
    right: 26px;
}
#product-showcase-<?php echo $block_id; ?> .pull-left:before, #product-showcase-<?php echo $block_id; ?> .pull-right:after {
    color: white;
    border-right: 2px solid currentcolor;
    border-bottom: 2px solid currentcolor;
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    cursor: pointer;
}

#product-showcase-<?php echo $block_id; ?> .pull-left:before{
    left: -16px;
    transform: rotate(135deg)
}
#product-showcase-<?php echo $block_id; ?> .pull-right:after{
    right: -16px;
    transform: rotate(-45deg)
}
#product-showcase-<?php echo $block_id; ?> span.loading-icon { 
    display: none;
}
#product-showcase-<?php echo $block_id; ?> span.loading-icon svg { 
    width: 20px;
} 
#product-showcase-<?php echo $block_id; ?> .loading span.loading-icon {
    display: block;
}
#product-showcase-<?php echo $block_id; ?> .loading span.add-to-cart-icon {
    display: none;
}

@media only screen and (max-width: 1800px) {
    #product-showcase-<?php echo $block_id; ?> .product-box {
        margin-left: 5px;
        margin-right: 5px;
    }
    /* #product-showcase-<?php echo $block_id; ?> a.product-inner .thumbnail img {
    height: 250px;
} */
}
@media only screen and (max-width: 1024px) {
    #product-showcase-<?php echo $block_id; ?> .all-products {
        margin-left: 20px;
        margin-right: 20px;
        height: auto;
    }
    #product-showcase-<?php echo $block_id; ?> .product-title {
        font-size: 18px;
    }
    #product-showcase-<?php echo $block_id; ?> .progress {
        width: 70%;
    }
    #product-showcase-<?php echo $block_id; ?> .progress {
        bottom: 1.5em;
    }
    #product-showcase-<?php echo $block_id; ?> .all-products .slider-count {
        bottom: 0;
        right: 0;
    }
    #product-showcase-<?php echo $block_id; ?> .pull-left, #product-showcase .pull-right {
        bottom: 33px;
    }
    #product-showcase-<?php echo $block_id; ?> .pull-left {
    right: 35px;
    }
    #product-showcase-<?php echo $block_id; ?> .pull-right {
    right: 0px;
    }
    #product-showcase-<?php echo $block_id; ?> .product-slider-nav:before {
    content: "";
    width: 20%;
    background: linear-gradient(45deg, transparent, #286632);
    height: 100%;
    position: absolute;
    right: 0;
    z-index: 99;
}
}
.all-products, .product-slider-nav, .product-slider-for {
    opacity: 0;
    visibility: hidden;
	display: none;
    transition: opacity 1s ease;
    -webkit-transition: opacity 1s ease;
}

.all-products.slick-initialized, .product-slider-nav.slick-initialized, .product-slider-for.slick-initialized {
    visibility: visible;
    opacity: 1;   
	display: block;
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