<?php 
$cardStack = get_field('card_stack', $block_id);
$title = $cardStack['main_title'];
$bgImg = $cardStack['background'];
$CTA = $cardStack['cta'];
$cards = $cardStack['cards'];
?>

<section id="card-stack-block-<?php echo $block_id; ?>" class="dsn:mb-10">
    <?php if($bgImg) { ?>
        <div class="dsn:min-h-[1000px] dsn:h-auto" style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;">
    <?php } else { ?>
        <div class="dsn:min-h-[1000px] dsn:h-auto">
    <?php } ?>  

        <!-- Title -->
        <div class="dsn:container dsn:mx-auto dsn:text-center dsn:py-20">
            <h2 class="dsn:text-white"><?php echo $title; ?></h2>
        </div>

        <!-- Cards -->
        <div class="dsn:container dsn:mx-auto dsn:pb-15">
        <?php 
        if($cards) { ?> 
        <div class="dsn:grid dsn:grid-cols-1 dsn:md:grid-cols-2 dsn:lg:grid-cols-3 dsn:gap-10">
          <?php foreach($cards as $card) { ?>
                <div class="dsn:relative dsn:text-center dsn:md:text-left dsn:my-12 dsn:min-w-[400px] dsn:max-w-[400px] dsn:mx-auto">
                    <img class="dsn:mx-auto dsn:text-center dsn:md:mx-1 dsn:md:text-left" src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['title']; ?>">
                    <div>
                        <h3 class="dsn:text-white dsn:mb-0 dsn:pb-0"> <?php echo $card['title']; ?> </h3>
                        <p class="dsn:text-white"> <?php echo $card['description']; ?> </p>
                    <?php if($card['cta']) { ?>
                        <div class="cta dsn:py-5">
                            <a class="btn" href="<?php echo $card['cta']['url']; ?>" role="button"> <?php echo $card['cta']['title']; ?></a>
                        </div>
                    <?php } ?>
                    </div>
                    
                </div>
        <?php }  ?>
        </div>
        <?php } ?>
        <!-- CTA -->
       
        <?php if($CTA) { ?>
            <div class="cta dsn:py-5 dsn:text-center">
                <a class="btn" href="<?php echo $CTA['url']; ?>" role="button"> <?php echo $CTA['title']; ?></a>
            </div>
        <?php } ?>

        </div>

</div>
</section>
