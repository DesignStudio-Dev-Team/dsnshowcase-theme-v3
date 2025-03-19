<?php 
$twoBlock = get_field('two_block', $block_id);
$twoBlockContent = $twoBlock['two_block_content'];
?>
<section class="dsn:my-10">
<div class="dsn:container dsn:mx-auto">
        <?php if($twoBlockContent) { 
            foreach($twoBlockContent as $block) { 
              $layout = $block['layout'];
              if($layout == 'Left Image') { 
                  $order1 = 'dsn:order-1';
                  $order2 = 'dsn:order-2';
              } else {
                  $order1 = 'dsn:order-2';
                  $order2 = 'dsn:order-1';
              }

              ?>
       <div class="dsn:w-full dsn:flex dsn:gap-10 dsn:my-10 dsn:justify-center dsn:items-center">
        <div class="dsn:w-full dsn:lg:w-1/2 dsn:p-25 dsn:text-left dsn:flex dsn:flex-col <?php echo $order1; ?>">
            <h2><?php echo $block['title']; ?></h2>
            <p><?php echo $block['description']; ?></p>
            <a class="btn dsn:mt-5 dsn:justify-start dsn:self-start" href="<?php echo $block['cta']['url']; ?>"><?php echo $block['cta']['title']; ?></a>
        </div>
        <div class="dsn:p-0 dsn:w-full dsn:lg:w-1/2 <?php echo $order2; ?>">
            <img class="dsn:w-full dsn:h-full" src="<?php echo $block['main_image']; ?>" alt="image">
        </div>
        </div>
        <?php } } ?>
</div>
</section>