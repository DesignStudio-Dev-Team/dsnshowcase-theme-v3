<?php 
$LeftRightBlock = get_field('left_right_block', $block_id);
$gap = $LeftRightBlock['gap'];
$layout = $LeftRightBlock['layout'];
$position = $layout['position'];
$content_divided = $layout['content_divided'];

//Left Content
$left_content = $LeftRightBlock['left_content'];
$left_title = $left_content['title'];
$left_description = $left_content['description'];
$left_cta = $left_content['cta'];
$left_background_image = $left_content['background_image'];
$left_background_image_overlay = $left_content['background_overlay'];
$left_image = $left_content['image'];
$left_text_color = $left_content['text_color'];
$left_background_color = $left_content['background_color'];

//Right Content
$right_content = $LeftRightBlock['right_content'];
$right_title = $right_content['title'];
$right_description = $right_content['description'];
$right_cta = $right_content['cta'];
$right_background_image = $right_content['background_image'];
$right_background_image_overlay = $right_content['background_overlay'];
$right_image = $right_content['image'];
$right_text_color = $right_content['text_color'];
$right_background_color = $right_content['background_color'];
?>
<section id="left-right-block-<?php echo $block_id; ?>" class="dsn:mb-10 dsn:px-0">
<div class="dsn:container dsn:mx-auto">
        <?php if($LeftRightBlock) { 
            
                
                if($gap) {
                    $gap = ' dsn:gap-6';
                } else {
                    $gap = 'dsn:gap-0';
                }
            
              if($position == 'Left Image') { 
                  $order1 = 'dsn:order-2 dsn:md:order-1';
                  $order2 = 'dsn:order-1 dsn:md:order-2';
              } else {
                  $order1 = 'dsn:order-2';
                  $order2 = 'dsn:order-1';
              }
              $divided = $content_divided;
              if($divided == '50/50') {
                  $dclass1 = ' dsn:lg:w-1/2';
                  $dclass2 = ' dsn:lg:w-1/2';
              } else {
                  $dclass1 = ' dsn:lg:w-1/3';
                  $dclass2 = ' dsn:lg:w-2/3';
              }
              ?>
       <div class="dsn:w-full dsn:flex dsn:flex-col dsn:md:flex-row <?php echo $gap; ?> dsn:my-10 dsn:justify-between dsn:items-stretch">
        <div class="dsn-left-content-<?php echo $block_id; ?> dsn:relative dsn:w-full dsn:p-10 dsn:md:p-15 dsn:text-center dsn:md:text-left dsn:flex dsn:flex-col dsn:justify-center dsn:gap-10 <?php echo $order1 . ' ' . $dclass1; ?>">
            <div class="dsn:z-40 dsn:flex dsn:flex-col dsn:order-2 dsn:md:order-1">
            <h2><?php echo $left_title; ?></h2>
            <p><?php echo $left_description; ?></p>
            <?php if ($left_cta) { ?>
            <a class="btn dsn:mt-5 dsn::md:justify-start dsn:md:self-start dsn:md:block" href="<?php echo $left_cta['url']; ?>"><?php echo $left_cta['title']; ?></a>
            <?php } ?>
            </div>
            <?php if($left_image) {?> 
            <div class="dsn:relative dsn:mb-10 dsn:md:mb-0 dsn:order-1 dsn:md:order-2 left-image-block">
            <img class="dsn:w-full dsn:h-auto dsn:object-cover" src="<?php echo $left_image; ?>" alt="image">
            </div>
            <?php } ?>
        </div>
        <div class="dsn-right-content-<?php echo $block_id; ?> dsn:relative dsn:p-0 dsn:w-full dsn:flex dsn:items-center dsn:flex-col dsn:md:flex-row dsn:p-10 dsn:md:p-15 dsn:text-center dsn:md:text-left dsn:gap-10 <?php echo $order2 . ' ' . $dclass2; ?>">
            <div class="dsn:z-40 dsn:flex dsn:flex-col dsn:order-2 dsn:md:order-1">
            <h2><?php echo $right_title; ?></h2>
            <p><?php echo $right_description; ?></p>
            <?php if ($right_cta) { ?>
            <a class="btn dsn:mt-5 dsn::md:justify-start dsn:md:self-start dsn:md:block" href="<?php echo $right_cta['url']; ?>"><?php echo $right_cta['title']; ?></a>
            <?php } ?>
            </div>
            <?php if($right_image) {?> 
            <div class="dsn:relative dsn:mb-10 dsn:md:mb-0 dsn:order-1 dsn:md:order-2 right-image-block">
            <img class="dsn:w-full dsn:h-auto dsn:object-cover" src="<?php echo $right_image; ?>" alt="image">
            </div>
            <?php } ?>
        </div>
        </div>
        <?php }  ?>
</div>
<style>
    .dsn-left-content-<?php echo $block_id; ?> {
        <?php if($left_background_image) { ?>
        background-image: url('<?php echo $left_background_image; ?>'); 
        background-position: center;
        background-size: cover;<?php } ?>
        background-color: <?php echo $left_background_color; ?>;
        color: <?php echo $left_text_color; ?>;
    }
   <?php if(!empty($left_background_image_overlay == 'Yes')) { ?>
    .dsn-left-content-<?php echo $block_id; ?>:after {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(-92deg, rgba(0,0,0,0 ) 0.00%, rgba(0,0,0,0.6 ) 49.95%, rgba(0,0,0,0.67 ) 100.00%);
    }
    <?php } ?>
    .dsn-right-content-<?php echo $block_id; ?> {
        <?php if($right_background_image) { ?>
        background-image: url('<?php echo $right_background_image; ?>'); 
        background-position: center;
        background-size: cover;<?php } ?>
        background-color: <?php echo $right_background_color; ?>;
        color: <?php echo $right_text_color; ?>;
    }
    <?php if(!empty($right_background_image_overlay == 'Yes')) { ?>
    .dsn-right-content-<?php echo $block_id; ?>:after {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(-92deg, rgba(0,0,0,0 ) 0.00%, rgba(0,0,0,0.6 ) 49.95%, rgba(0,0,0,0.67 ) 100.00%);
    }
    <?php } ?>
</style>
</section>