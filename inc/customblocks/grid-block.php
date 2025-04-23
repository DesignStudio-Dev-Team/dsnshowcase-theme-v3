<?php 
$gridBlock = get_field('grid_block', $block_id);
$title = $gridBlock['title'];
$description = $gridBlock['description'];
$gridContent = $gridBlock['grid_content_rows'];
$cta = $gridBlock['cta'];
$gridType = $gridBlock['grid_type'];

$gridRowCount = count($gridContent);
?>

<section id="gridBlock" class="dsn:py-20 dsn:mb-10 dsn:px-10 dsn:md:px-0">
    <div class="dsn:text-center dsn:mb-10">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $description; ?></p>
    </div>
<?php if($gridContent) { 
    foreach($gridContent as $gridRows){
        $gridColumns = $gridRows['grid_content_columns'];
        $gridCoumnsCount = count($gridColumns);     
    ?>
        <div id="grid-block" class="dsn:container dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-<?php echo $gridCoumnsCount; ?> dsn:gap-5">
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
                <div>
                    <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="dsn:mb-5 dsn:w-full dsn:h-auto">
                    <?php if($title) { ?>
                    <h2 class="dsn:text-4xl dsn:mb-8"><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php if($cta) { ?>
                    <a class="btn" href="<?php echo $cta['url']; ?>"><?php echo $cta['title']; ?></a>
                    <?php } ?>
                </div>
               <?php } ?>
               
            <?php } ?>   
        </div>
<?php } } ?>
<?php if($cta) { ?>
    <div class="dsn:text-center dsn:mt-20">
        <a href="<?php echo $cta['url']; ?>" class="btn"><?php echo $cta['title']; ?></a>
    </div>
<?php } ?>
</section>