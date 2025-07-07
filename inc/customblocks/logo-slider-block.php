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

<section id="logo-slider-<?php echo $block_id; ?>" class="dsn-logo-slider-container">
    <div class="dsn:container dsn:mx-auto dsn:py-20 dsn:px-4">
    <h2 class="dsn:text-center dsn:mb-10 dsn:text-2xl dsn:md:text-5xl"><?php if($title) { 
        echo $title; } ?></h2>
    <p class="dsn:text-center dsn:lg:max-w-8/12 dsn:mx-auto"><?php if($description) {  echo $description; } ?></p>
    <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:items-center dsn:gap-20 dsn:my-10 dsn:md:my-20 dsn:px-0 dsn:text-center dsn:md:text-left dsn:lg:px-0">
        <div class="dsn:w-full dsn:lg:w-5/12">
            <h3><?php if($contentTitle) { echo $contentTitle; } ?></h3>
            <p class="dsn:mb-12"><?php if($contentDescription) { echo $contentDescription; }?></p>
            <?php if($contentCTA): ?>
            <a class="btn dsn:my-6" href="<?php echo $contentCTA['url']?>"><?php echo $contentCTA['title']; ?></a>
            <?php endif; ?>
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
</div>
</section>
<style>
    .dsn-logo-slider-container {
        background: linear-gradient(180deg, #f1f1f1 0.00%, #f9f9f9 34.30%,rgba(255,255,255,0 ) 100.00%);
    }
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
    .dsn-logo-slider.slick-slider button.slick-prev.slick-arrow {
    top: 100%;
    right: 0% !important;
    left: unset !important;
    transform: translateX(42vw);
    }
    .dsn-logo-slider.slick-slider button.slick-next.slick-arrow {
    top: 100%;
    left: 50%;
    transform: translateX(0%);
    }
     .dsn-dsn-logo-slider .slick-slide {
      margin: 0 8px;
  }

  /* space the parent */
  .dsn-logo-slider .slick-list {
      margin: 0 -8px;
  }
  .dsn-logo-slider .slick-slide div { 
  margin-bottom: 16px;
  }
 }
	.dsn-logo-slider {
    opacity: 0;
    visibility: hidden;
	display: none;
    transition: opacity 1s ease;
    -webkit-transition: opacity 1s ease;
}

.dsn-logo-slider.slick-initialized {
    visibility: visible;
    opacity: 1;   
	display: block;
}
</style>