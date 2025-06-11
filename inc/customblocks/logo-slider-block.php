<?php 
$logoSliderBlock = get_field('logo_slider', $block_id);
$title = $logoSliderBlock['title'];
$description = $logoSliderBlock['description'];
$content = $logoSliderBlock['content'];
$contentTitle = $content['title'];
$contentDescription = $content['description'];
$contentCTA = $content['cta'];
$logos = $logoSliderBlock['logos'];
?>

<section class="dsn:container dsn:mx-auto dsn:my-10 logo-slider-container">
    <?php if($title) { ?>
    <h2 class="dsn:text-center dsn:mb-10"><?php echo $title; ?></h2>
    <?php } ?>
    <?php if($description) { ?>
    <p class="dsn:text-center dsn:lg:max-w-8/12 dsn:mx-auto"><?php echo $description; ?></p>
   <?php } ?>
    <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:items-center dsn:gap-20 dsn:my-20 dsn:px-10 dsn:lg:px-0">
        <div class="dsn:w-full dsn:lg:w-5/12">
           <?php if($contentTitle) { ?>      
            <h3><?php echo $contentTitle; ?></h3>
            <?php } ?>
            <?php if($contentDescription) { ?>
            <p class="dsn:mb-12"><?php echo $contentDescription; ?></p>
            <?php } ?>

            <?php if($contentCTA) { ?>
            <a class="btn dsn:my-6" href="<?php echo $contentCTA['url']?>"><?php echo $contentCTA['title']; ?></a>
            <?php } ?>
        </div>
        <div class="dsn:w-full dsn:lg:w-7/12">
            <div class="dsn-logo-slider dsn:w-full dsn:relative dsn:!mx-0">

                <?php if($logos) {
                    foreach($logos as $blocklogo) {
                    ?>
                <?php if($blocklogo['logo'] && $blocklogo['url']) { ?>
                       <a href="<?php echo $blocklogo['url']['url']; ?>"><img class="dsn:w-full" src="<?php echo $blocklogo['logo']['url']; ?>" alt="<?php echo $blocklogo['url']['title']; ?>" /></a>
                <?php } else if($blocklogo['logo']) { ?>
                        <img class="dsn:w-full" src="<?php echo $blocklogo['logo']['url']; ?>" alt="<?php echo $blocklogo['logo']['alt']; ?>" />
                <?php }    
                }
             } ?>
            </div>
        </div>
    </div>
    

</section>
<style>
    .dsn-logo-slider .slick-slide div {
	background-color: white;
	display: flex !important;
	justify-content: center;
	align-items: center;
	text-align: center;
	height: 10vw;
    box-shadow: 0px 0px 3px 0px #ddd;
    margin-bottom: 30px;
    margin-top: 15px;
    padding: 1em;
    }
    .dsn-logo-slider.slick-slider {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    /* space the slides */
 .dsn-logo-slider .slick-slide {
      margin: 0 15px;
  }

  /* space the parent */
  .dsn-logo-slider .slick-list {
      margin: 0 -15px;
  }
 @media only screen and (min-width: 2100px) {
    .dsn-logo-slider .slick-slide div { 
        height: 6vw;
    }
 }
 @media only screen and (max-width: 700px) {
    .dsn-logo-slider .slick-slide div {
        height: 25vw;
    }
 }
</style>