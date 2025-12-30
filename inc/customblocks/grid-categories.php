<?php 
$gridCategories = get_field('grid_categories', $block_id);
$title = $gridCategories['title'];
$cta = $gridCategories['cta'];
$categories = $gridCategories['categories'];
$bgImg = $gridCategories['background_image'];
?>
<section id="grid-category-<?php echo $block_id; ?>" class="dsn:my-0 dsn:py-50"  style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;">
    <div class="dsn:w-2/3 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:xl:grid-cols-4 dsn:grid-rows-4 dsn:gap-10">
      <div class="dsn:p-10 dsn:text-left dsn:row-span-4 dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:xl:min-h-[700px]">
            <?php if($title) { ?><h2><?php echo $title; ?></h2> <?php } ?>
             <?php if($cta) { ?> <a class="btn dsn:mt-5 dsn:justify-start dsn:self-start" href="<?php echo $cta['url']; ?>"><?php echo $cta['title']; ?></a><?php } ?>
        </div>
        <?php if($categories) { 
            foreach($categories as $category) { ?>
        <div class="dsn:relative dsn:p-0 dsn:text-center dsn:row-span-2 dsn:flex dsn:flex-col" style="background: url('<?php echo $category['image']; ?>') no-repeat center center; background-size: cover;">
        <a class="dsn:h-full dsn:w-full dsn:absolute dsn:before:absolute dsn:before:w-full dsn:before:h-[35%] dsn:before:left-0 dsn:before:bottom-0 dsn:before:opacity-80 dsn:before:bg-linear-to-b dsn:before:from-transparent dsn:before:to-black" href="<?php echo $category['url']; ?>" aria-label="<?php echo $category['name']; ?>" role="button">   
            <h3 class="dsn:bottom-0 dsn:w-full dsn:absolute dsn:text-center dsn:text-white"><?php echo $category['name']; ?></h3>
            </a>
         </div>
        <?php } } ?>
    </div>
</section>