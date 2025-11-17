<?php 
$gridBlock = get_field('grid_block', $block_id);
$title = $gridBlock['title'];
$description = $gridBlock['description'];
$gridContent = $gridBlock['grid_content_rows'];
$mainCTA = $gridBlock['cta'];
$gridType = $gridBlock['grid_type'];
$gridRowCount = count($gridContent);


?>

<section id="grid-block-<?php echo $block_id; ?>" class="dsn:py-10 dsn:px-5 dsn:md:px-0">
    <div class="dsn:text-center dsn:mb-10">
        <h2><?php echo $title; ?></h2>
        <?php if($description) { ?>
            <div class="dsn:mx-auto dsn:py-4 dsn:max-w-[900px]">
                <p class="dsn:py-3 dsn:text-center"><?php echo $description; ?></p>
            </div>
        <?php } ?>
        
    </div>
<?php if($gridContent) { 
    foreach($gridContent as $gridRows){
        $gridColumns = $gridRows['grid_content_columns'];
        $gridCoumnsCount = count($gridColumns);     
    ?>

        <?php if($gridType == '1') { ?>
        <div id="grid-block" class="grid-block1 dsn:container dsn:mb-5 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5">
        <?php } ?>
        <?php if($gridType == '2') { ?>
        <div id="grid-block" class="grid-block2 dsn:container dsn:mb-5 dsn:mx-auto dsn:flex dsn:flex-col dsn:w-full dsn:md:flex-row dsn:flex-grow-1 dsn:basis-full dsn:py-2 dsn:gap-4 dsn:justify-center dsn:items-center dsn:px-0 dsn:md:px-0 dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3">
        <?php } ?>
        <?php if($gridType == '3') { ?>
        <div id="grid-block" class="grid-block3 dsn:container dsn:mb-5 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5">
        <?php } ?>
          <?php if($gridType == '4') { ?>
        <div id="grid-block" class="grid-block4 dsn:container dsn:mb-5 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5">
        <?php } ?>
        <?php if($gridType == '5') { ?>
        <div id="grid-block" class="grid-block5 dsn:container dsn:mb-5 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-3 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5">
        <?php } ?>
         <?php if($gridType == '6') { ?>
        <div id="grid-block" class="grid-block6 dsn:container dsn:mb-5 dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-4 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5 dsn:items-center dsn:items-stretch">
        <?php } ?>
            <?php 
            foreach($gridColumns as $gridColumn){ 
                $gridContentContent = $gridColumn['grid_content_content'];
                //get row layout from $gridContentContent
                if($gridContentContent[0]['acf_fc_layout'] == 'wysywig') {
                    $content = $gridContentContent[0]['wysiwyg_content'];
                ?>
                <div>
                    <?php echo $content; ?>
                </div>
                <?php } ?>
                
                <?php
                if($gridContentContent[0]['acf_fc_layout'] == 'card') {
                    $title = $gridContentContent[0]['title'];
                    $image = $gridContentContent[0]['image'];
                    $cta = $gridContentContent[0]['cta']; 
                ?>
                   <?php if($gridType == '1') { ?>
                    <div>
                        <a href="<?php echo !empty($cta['url']) ? $cta['url'] : '#'; ?>" class="dsn:block dsn:transition-all dsn:duration-300 dsn:hover:opacity-90">
                    <div class="dsn:relative">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="dsn:w-full dsn:h-auto">
                        <?php if($title) { ?>
                        <div class="dsn:pt-4">
                            <h3 class="dsn:text-center dsn:px-4"><?php echo $title; ?></h3>
                        </div>
                        <?php } ?>
                    </div>
                </a>
                </div>
                    <?php } ?>

                <?php if($gridType == '2') { ?>
                    <div class="dsn:flex-auto dsn:w-full dsn:flex-grow-1 dsn:md:w-1/3 dsn:basis-50 dsn:md:basis-0 dsn:transition-all dsn:duration-1000 dsn:hover:flex-grow-2 dsn:relative dsn:!bg-cover dsn:!bg-center">
                        <a href="<?php echo !empty($cta['url']) ? $cta['url'] : '#'; ?>" class="dsn:block dsn:transition-all dsn:duration-300 dsn:hover:opacity-90">
                    <div class="dsn:relative">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="dsn:w-full dsn:h-auto">
                        <?php if($title) { ?>
                        <div class="dsn:absolute dsn:bottom-0 dsn:left-0 dsn:right-0 dsn:h-1/2 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:flex dsn:items-end dsn:justify-center dsn:pb-6">
                            <h3 class="dsn:text-white dsn:text-center dsn:px-4"><?php echo $title; ?></h3>
                        </div>
                        <?php } ?>
                    </div>
                </a>
                </div>
                    <?php } ?>

                <?php if($gridType == '3') { ?>
                    <a href="<?php echo !empty($cta['url']) ? $cta['url'] : '#'; ?>" class="dsn:block dsn:transition-all dsn:duration-300 dsn:hover:opacity-90">
                    <div class="dsn:relative">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="dsn:w-full dsn:h-auto">
                        <?php if($title) { ?>
                        <div class="dsn:absolute dsn:bottom-0 dsn:left-0 dsn:right-0 dsn:h-1/4 dsn:flex dsn:items-end dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:justify-center dsn:pb-3">
                            <h3 class="dsn:text-white dsn:text-center dsn:px-4 dsn:mb-0"><?php echo $title; ?></h3>
                        </div>
                        <?php } ?>
                    </div>
                </a>
                <?php } ?>

                <?php if($gridType == '4') { ?>
                    <div>
                    <div class="dsn:relative">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="dsn:w-full dsn:h-auto">
                        <?php if($title) { ?>
                        <div class="grid-block-bottom dsn:absolute dsn:bottom-0 dsn:left-0 dsn:right-0 dsn:px-4 dsn:h-1/3 dsn:bg-black-500/50 dsn:flex dsn:flex-row dsn:items-center dsn:justify-between dsn:pb-0">
                            <h3 class="dsn:text-white dsn:text-left dsn:mb-0"><?php echo $title; ?></h3>

                            <?php 
                            if($cta) { ?>
                            <div class="dsn:mt-0 dsn:text-left">
                                <a href="<?php echo !empty($cta['url']) ? $cta['url'] : '#'; ?>" class="btn dsn:py-2"><?php echo $cta['title']; ?></a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                
                </div>
                <?php } ?>

               <?php } ?>

               <?php
                if($gridContentContent[0]['acf_fc_layout'] == 'card_with_stacked_logo') {
                    $cardImage = $gridContentContent[0]['card_image'];
                    $cardLogo = $gridContentContent[0]['card_logo'];
                    $cardLink = $gridContentContent[0]['card_link']; 
                ?>
                   <?php if($gridType == '5') { ?>
                    <div class="dsn:relative dsn:h-74 dsn:lg:min-h-84 dsn:xl:min-h-120 dsn:mb-15">
                        <a href="<?php echo !empty($cardLink) ? $cardLink : '#'; ?>" class="dsn:block dsn:transition-all dsn:duration-300 dsn:hover:opacity-90 dsn:h-full dsn:w-full dsn:!bg-cover dsn:!bg-center dsn:flex dsn:items-end dsn:justify-center" style="background: url(<?php echo $cardImage['url']; ?>)">
                    <div class="dsn:relative dsn:bg-white dsn:-mb-10 dsn:p-6 dsn:rounded-full dsn:w-10/12 dsn:shadow-lg">
                        <img src="<?php echo $cardLogo['url']; ?>" alt="<?php echo "stacked Logo"; ?>" class="dsn:w-full dsn:h-10 dsn:object-contain">
                    </div>
                </a>
                </div>
                    <?php } ?>
               <?php } ?>
               <?php
                if($gridContentContent[0]['acf_fc_layout'] == 'grid_icon') {
                    $cardTitle = $gridContentContent[0]['card_title'];
                    $cardLogo = $gridContentContent[0]['card_logo'];
                    $cardLink = $gridContentContent[0]['card_link']; 
                ?>
                    <?php if($gridType == '6') { ?>
              
               <a href="<?php echo !empty($cardLink) ? $cardLink : '#'; ?>" class="dsn:border-2 dsn:rounded-md dsn:flex dsn:items-center dsn:justify-start dsn:gap-4 dsn:p-2 dsn:min-h-30">
                 <img src="<?php echo $cardLogo['url']; ?>" alt="<?php echo "stacked Logo"; ?>" class="dsn:h-15 dsn:object-contain dsn:w-3/12">
                 <p class="dsn:text-black dsn:w-9/12 dsn:mb-0 dsn:text-xl dsn:text-base"><?php echo $cardTitle; ?></p>
                </a>
              
                    <?php } ?>
                    <style>
                        .grid-block6 a {
                            color: var(--dealerLinkColor);
                        }   
                    </style>
                     <?php } ?>
            <?php } ?>   
        </div>
    <?php } ?>
<?php } ?>
<?php
if($mainCTA) { ?>
    <div class="dsn:text-center dsn:mt-20">
        <a href="<?php echo $mainCTA['url']; ?>" class="btn"><?php echo $mainCTA['title']; ?></a>
    </div>
<?php } ?>
<div class="dsn:hidden dsn:xl:grid-cols-1 dsn:xl:grid-cols-2 dsn:xl:grid-cols-3 dsn:xl:grid-cols-4 dsn:xl:grid-cols-5"></div>
</section>
<style>
    #grid-block-<?php echo $block_id; ?> .grid-block-bottom {
  background: linear-gradient(transparent 0%, #000000c9 100%);
}
#grid-block-<?php echo $block_id; ?> .grid-block6 a {
    transition: all 0.5s;
}
#grid-block-<?php echo $block_id; ?> .grid-block6 a:hover {
  transform: scale(1.05);
}
</style>