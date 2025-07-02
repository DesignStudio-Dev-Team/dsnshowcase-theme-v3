<?php 
$twoBlock = get_field('two_block', $block_id);
$twoBlockContent = $twoBlock['two_block_content'];
?>
<section id="grid-block-<?php echo $block_id; ?>" class="dsn:mb-10 dsn:px-0">
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
                  $order1 = 'dsn:order-2 dsn:md:order-1';
                  $order2 = 'dsn:order-1 dsn:md:order-2';
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
       <div class="dsn:w-full dsn:flex dsn:flex-col dsn:md:flex-row <?php echo $gap; ?> dsn:my-10 dsn:justify-between dsn:items-stretch">
        <div class="dsn-twoblock-content-<?php echo $block_id; ?> dsn:w-full dsn:p-15 dsn:md:p-15 dsn:md:pt-30 dsn:text-center dsn:md:text-left dsn:flex dsn:flex-col dsn:justify-center <?php echo $order1 . ' ' . $dclass1; ?>">
            <h2><?php echo $block['title']; ?></h2>
            <p><?php echo $block['description']; ?></p>
            <?php if ($block['cta']) { ?>
            <a class="btn dsn:mt-5 dsn::md:justify-start dsn:md:self-start dsn:md:block" href="<?php echo $block['cta']['url']; ?>"><?php echo $block['cta']['title']; ?></a>
            <?php } ?>
        </div>
        <div class="dsn:p-0 dsn:w-full <?php echo $order2 . ' ' . $dclass2; ?>">
            <img class="dsn:w-full dsn:h-76 dsn:lg:h-full dsn:object-cover" src="<?php echo $block['main_image']; ?>" alt="image">
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