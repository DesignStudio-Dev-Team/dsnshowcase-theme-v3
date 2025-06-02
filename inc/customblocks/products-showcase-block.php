<?php 
$productsShowcaseBlock = get_field('products_showcase', $block_id);
$title = $productsShowcaseBlock['title'];
$description = $productsShowcaseBlock['description'];
$titleOfShowcase = $productsShowcaseBlock['title_of_showcase'];
$set_of_products = $productsShowcaseBlock['set_of_products'];
?>

<section class="dsn:container dsn:mx-auto dsn:my-10">
    <h2 class="dsn:text-center dsn:mb-10"><?php echo $title; ?></h2>
  
</section>