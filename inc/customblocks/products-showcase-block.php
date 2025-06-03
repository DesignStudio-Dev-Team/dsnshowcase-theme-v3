<?php 
$productsShowcaseBlock = get_field('products_showcase', $block_id);
$title = $productsShowcaseBlock['title'];
$description = $productsShowcaseBlock['description'];
$titleOfShowcase = $productsShowcaseBlock['title_of_showcase'];
$set_of_products = $productsShowcaseBlock['set_of_products'];
?>

<section id="product-showcase" class="dsn:my-10 dsn:p-10 dsn:text-white">
    <div class="dsn:container dsn:mx-auto dsn:relative">
    <h2 class="dsn:text-left dsn:mb-10"><?php echo $title; ?></h2>
    <p class="dsn:text-left dsn:lg:max-w-8/12"><?php echo $description; ?></p>
    <div class="product-showcase-inner dsn:pt-10">
    
<div class="slider slider-nav dsn:mb-8 dsn:py-4 dsn:border-b-2 dsn:border-white">

    <?php 
    $i = 0;
    //print_r($set_of_products);
foreach($set_of_products as $category => $value ) {

   echo '<div class="slide-nav-label dsn:relative" data-slide='. $i .'>' . $value['category_name'] . '</div>';
   $i++;
}
?>
  </div>
  <div class="slider slider-for">
    <?php 

    $j = 0;

	foreach($set_of_products as $category => $value ) { 
        $category = $value['products'];
         $j++;
    
?>

<div class="all-products dsn:w-full" data-slide="<?php echo $j; ?>"> <?php
 if (!empty($set_of_products)): ?>
                <?php foreach ($category as $post):
                    setup_postdata($post); 
                    $product = wc_get_product( get_the_id() );
                    print_r($product);
                    ?>
                    <div class="dsn:w-full dsn:mx-3 dsn:md:mx-4 dsn:mb-4 dsn:bg-white dsn:shadow-lg dsn:p-6">
                        <a href="<?php echo get_permalink(); ?>">
                            <div class="dsn:text-center thumbnail">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <p class="dsn:text-black dsn:mb-0 dsn:uppercase dsn:text-lg product-category"><?php echo $value['category_name']; ?></p>
                            <h3 class="dsn:text-left dsn:text-white product-title"><?php the_title(); ?></h3>
                        </a>
                        <div class="product-bottom dsn:flex dsn:item-center"><span class="price"><?php //echo get_price(); ?></span><span class="cart-btn"></span></div>
                    </div>
                <?php endforeach; ?>
    <?php endif; ?>
<?php //reset query
wp_reset_postdata();

?>

  </div>
   
  <?php } ?>
 
  </div>
   <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
    <span class="slider__label sr-only"></span>
</div>
</div>
</section>

<style>
    #product-showcase {
    background: #286632; 
}
.product-title {
    color: #286632;
}
    .progress {
    display: block;
    width: 85%;
    height: 10px;
    border-radius: 10px;
    overflow: hidden;
    background-color: #f5f5f5;
    background-image: linear-gradient(to right, black, black);
    background-repeat: no-repeat;
    background-size: 0 100%;
    transition: background-size .4s ease-in-out;
    position: absolute;
    left: 0;
    bottom: 1em;
    }
    .slider-count {
        position: absolute;
        right: 0;
        bottom: -20px;
    }
    .all-products {
        padding-bottom: 4em;
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
  .thumbnail img {
    margin-left: auto;
    margin-right: auto;
    }
    .slider-nav .slick-track {
        margin-left: 0;
    }
    .slide-nav-label.slick-slide.slick-current.slick-active:after {
    content: "";
    width: 100%;
    height: 4px;
    background: red;
    position: absolute;
    bottom: -5px;
    z-index: 9999;
}
</style>