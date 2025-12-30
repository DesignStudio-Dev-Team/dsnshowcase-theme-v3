<?php 
$configuration = get_field('configuration', $block_id);
            $layout = $configuration['layout'];

            //depending on the layout is the order of the cards
            if($layout === 'left') {
                $primaryCard = 1;
                $secondaryCard = 2;
                $thirdCard = 3;
                $fourthCard = 4;
                $fifthCard = 5;
            } 
            if ($layout === 'right') {
                $primaryCard = 4;
                $secondaryCard = 1;
                $thirdCard = 2;
                $fourthCard = 3;
                $fifthCard = 5;
            }
            if ($layout === 'middle') {
                $primaryCard = 3;
                $secondaryCard = 2;
                $thirdCard = 1;
                $fourthCard = 4;
                $fifthCard = 5;
            }
            $textLocation = $configuration['text_location'];
            
            $primaryTL = 'dsn:justify-end';
            $otherCardsTL = 'dsn:items-end';

            if($textLocation === 'Top'){
                $primaryTL = 'dsn:justify-start';
                $otherCardsTL = 'dsn:items-start';
                $primaryTLShadow = 'dsn:top-0';
                $shadowLocation = 'dsn:top-0';
            }
            if($textLocation === 'Middle'){
                $primaryTL = 'dsn:justify-center';
                $otherCardsTL = 'dsn:items-center';
                $shadowLocation = 'dsn:top-[35%]';
                $primaryTLShadow = 'dsn:top-[35%]';
            }
            if($textLocation === 'Bottom'){
                $primaryTL = 'dsn:justify-end';
                $otherCardsTL = 'dsn:items-end';
                $shadowLocation = 'dsn:top-[67%]';
                $primaryTLShadow = 'dsn:top-[67%]';
            }

            $heroContent = get_field('hero_1_content', $block_id);
            
            //get content for hero 1
            $primaryTitle = $heroContent['primary_title'];
            $mainCTA = $heroContent['main_cta'];
            $secondaryCTA = $heroContent['secondary_cta'];
            $primaryBGImg = $heroContent['primary_bg_img'];

        
            //get 2nd card text, link, and image
            $secondaryTitle = $heroContent['secondary_card_title'];
            $secondaryLink = $heroContent['secondary_card_link']; 
            $secondaryBGImg = $heroContent['secondary_card_bg_img'];
            
            //get 3rd card text, link, and image
            $thirdTitle = $heroContent['third_card_title'];
            $thirdLink = $heroContent['third_card_link'];
            $thirdBGImg = $heroContent['third_card_bg_img'];

            //get 4th card text, link, and image
            $fourthTitle = $heroContent['fourth_card_title'];
            $fourthLink = $heroContent['fourth_card_link'];
            $fourthBGImg = $heroContent['fourth_card_bg_img'];

            //get 5th card text, link, and image
            $fifthTitle = $heroContent['fifth_card_title'];
            $fifthLink = $heroContent['fifth_card_link'];
            $fifthBGImg = $heroContent['fifth_card_bg_img'];
            ?>   

        

        <div id="hero-block-<?php echo $block_id; ?>" class="dsn:container dsn:mx-auto dsn:px-4 dsn:mb-15">
        <div class="dsn:flex dsn:flex-wrap dsn:lg:grid dsn:lg:grid-cols-3 dsn:gap-5">
      
        <div style="background:url('<?php echo $primaryBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-1 dsn:lg:order-1
        dsn:relative dsn:w-full dsn:h-[400px] dsn:lg:h-[600px] dsn:lg:row-span-2 dsn:p-8 dsn:flex dsn:flex-col 
        
        <?php
        echo ' dsn:lg:order-' . $primaryCard . ' ' . $primaryTL; ?>">
           <?php if($primaryTitle) { ?><h1 class="dsn:text-4xl dsn:font-bold dsn:mb-6 dsn:text-white dsn:relative dsn:z-10">
           <?php echo $primaryTitle; ?>
          </h1><?php } ?>
          <div class="dsn:space-x-4 dsn:flex dsn:items-center dsn:relative dsn:z-10">
            <a href="<?php echo $mainCTA['url']; ?>" target="<?php echo $mainCTA['target']; ?>" class="dsn:bg-orange-500 dsn:border dsn:rounded-lg dsn:border-white dsn:text-white dsn:px-8 dsn:py-3 dsn:font-medium" role="button">
            <?php echo $mainCTA['title']; ?>
            </a>
            <?php if($secondaryCTA) { ?>
            <a href="<?php echo $secondaryCTA['url']; ?>" target="<?php echo $mainCTA['target']; ?>" class="dsn:text-blue-600 dsn:font-medium" role="button">
              <?php echo $secondaryCTA['title']; ?>
             </a>
            <?php } ?>
          </div>

          <?php if($textLocation === 'Top') { ?>
          <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-transparent dsn:to-black dsn:h-1/2 dsn:z-0 <?php echo $primaryTLShadow; ?>"></div>
            <?php } if ($textLocation === 'Bottom') { ?>
                <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 <?php echo $primaryTLShadow; ?>"></div>
                <?php } if ($textLocation === 'Middle') { ?>
                    <div class="dsn:absolute dsn:inset-0 dsn:bg-black dsn:opacity-65 dsn:h-1/3 dsn:z-0 <?php echo $primaryTLShadow; ?>"></div>
                    <?php } ?>

        </div>
        
        <div style="background:url('<?php echo $secondaryBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-2 dsn:lg:order-2  dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full <?php  echo ' dsn:lg:order-' . $secondaryCard; ?>">
        <a class="dsn:size-full dsn:p-6 dsn:flex <?php echo $otherCardsTL; ?>" href="<?php echo $secondaryLink; ?>" role="button">
              <?php if($secondaryTitle) { ?><h2 class="dsn:relative dsn:z-10 dsn:text-2xl dsn:font-semibold dsn:text-white">
            <?php echo $secondaryTitle; ?>
          </h2><?php } ?>
          
          <?php if($textLocation === 'Top') { ?>
          <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-transparent dsn:to-black dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Bottom') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Middle') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-black dsn:opacity-65 dsn:h-[25%] dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } ?>
          </a>
        </div>

       
        <div style="background:url('<?php echo $thirdBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-3 dsn:lg:order-3 dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full <?php  echo ' dsn:lg:order-' . $thirdCard; ?> ">
        <a class="dsn:size-full dsn:p-6 dsn:flex <?php echo $otherCardsTL; ?>" href="<?php echo $thirdLink; ?>" role="button">
                <?php if($thirdTitle) { ?><h2 class="dsn:text-2xl dsn:font-semibold dsn:text-white dsn:relative dsn:z-10">
            <?php echo $thirdTitle; ?>
          </h2><?php } ?>
            
          <?php if($textLocation === 'Top') { ?>
          <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-transparent dsn:to-black dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Bottom') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Middle') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-black dsn:opacity-65 dsn:h-[25%] dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } ?>
         </a>
        </div>

       
        <div style="background:url('<?php echo $fourthBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-4 dsn:lg:order-4 dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full <?php  echo ' dsn:lg:order-' . $fourthCard; ?> ">
        <a class="dsn:size-full dsn:p-6 dsn:flex <?php echo $otherCardsTL; ?>" href="<?php echo $fourthLink; ?>" role="button">
       <?php if($fourthTitle) { ?><h2 class="dsn:relative dsn:z-10 dsn:text-2xl dsn:font-semibold dsn:text-white">
            <?php echo $fourthTitle; ?>
          </h2><?php } ?>
          
          <?php if($textLocation === 'Top') { ?>
          <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-transparent dsn:to-black dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Bottom') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Middle') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-black dsn:opacity-65 dsn:h-[25%] dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } ?>
          </a>
        </div>

    
        <div style="background:url('<?php echo $fifthBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-5 dsn:lg:order-5 dsn:relative dsn:w-full  dsn:h-[280px] dsn:lg:h-full <?php  echo ' dsn:lg:order-' . $fifthCard; ?>">
        <a class="dsn:size-full dsn:p-6 dsn:flex <?php echo $otherCardsTL; ?>" href="<?php echo $fifthLink; ?>" role="button">
        <?php if($fifthTitle) { ?><h2 class="dsn:relative dsn:z-10 dsn:text-2xl dsn:font-semibold dsn:text-white">
            <?php echo $fifthTitle; ?>
          </h2><?php } ?>
        
          <?php if($textLocation === 'Top') { ?>
          <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-transparent dsn:to-black dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Bottom') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } if($textLocation === 'Middle') { ?>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-black dsn:opacity-65 dsn:h-[25%] dsn:z-0 <?php echo $shadowLocation; ?>"></div>
            <?php } ?>
          </a>
        </div>
      </div>
    </div>
<?php ?>