<?php 
$twoBlock = get_field('two_block', $block_id);
$twoBlockContent = $twoBlock['two_block_content'];
?>
<section class="dsn:mb-10 dsn:px-0">
<div class="dsn:container dsn:mx-auto">
        <?php if($twoBlockContent) { 
            foreach($twoBlockContent as $block) { 
               $background = $block['background_color'];
               $textColor = $block['text_color'];
                $gap = $block['gap'];
                if($gap) {
                    $gap = ' dsn:gap-10';
                } else {
                    $gap = 'dsn:gap-0';
                }
              $position = $block['layout']['position'];
              if($position == 'Left Image') { 
                  $order1 = 'dsn:order-1';
                  $order2 = 'dsn:order-2';
              } else {
                  $order1 = 'dsn:order-2';
                  $order2 = 'dsn:order-1';
              }
              $divided = $block['layout']['content_divided'];
              if($divided == '50/50') {
                  $dclass1 = ' dsn:lg:w-1/2';
                  $dclass2 = ' dsn:lg:w-1/2';
              } else {
                  $dclass1 = ' dsn:lg:w-1/3';
                  $dclass2 = ' dsn:lg:w-2/3';
              }
              ?>
       <div class="dsn:w-full dsn:flex dsn:flex-col dsn:md:flex-row <?php echo $gap; ?> dsn:my-10 dsn:justify-between">
        <div class="dsn-twoblock-content-<?php echo $block_id; ?> dsn:w-full dsn:p-5 dsn:md:p-15 dsn:md:pt-30 dsn:text-left dsn:flex dsn:flex-col <?php echo $order1 . ' ' . $dclass1; ?>">
            <h2><?php echo $block['title']; ?></h2>
            <p><?php echo $block['description']; ?></p>
            <?php if ($block['cta']) { ?>
            <a class="btn dsn:mt-5 dsn:justify-start dsn:self-start dsn:hidden dsn:md:block" href="<?php echo $block['cta']['url']; ?>"><?php echo $block['cta']['title']; ?></a>
            <?php } ?>
        </div>
        <div class="dsn:p-0 dsn:w-full <?php echo $order2 . ' ' . $dclass2; ?>">
            <img class="dsn:w-full dsn:h-full" src="<?php echo $block['main_image']; ?>" alt="image">
            <?php if ($block['cta']) { ?>
            <a class="btn dsn:mt-5 dsn:justify-center dsn:w-full dsn:md:w-1/2 dsn:mx-auto dsn:text-center dsn:self-start dsn:block dsn:md:hidden" href="<?php echo $block['cta']['url']; ?>"><?php echo $block['cta']['title']; ?></a>
            <?php } ?>
        </div>
        </div>
        <?php } } ?>
</div>
<style>
    .dsn-twoblock-content-<?php echo $block_id; ?> {
        background-color: <?php echo $background; ?>;
        color: <?php echo $textColor; ?>;
    }
</style>
</section>