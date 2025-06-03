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
    <h2 class="dsn:text-center dsn:mb-10"><?php echo $title; ?></h2>
    <p class="dsn:text-center dsn:lg:max-w-8/12 dsn:mx-auto"><?php echo $description; ?></p>
    <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:items-center dsn:gap-20 dsn:my-20 dsn:px-10 dsn:lg:px-0">
        <div class="dsn:w-full dsn:lg:w-5/12">
            <h3><?php echo $contentTitle; ?></h3>
            <p class="dsn:mb-12"><?php echo $contentDescription; ?></p>
            <a class="btn dsn:my-6" href="<?php echo $contentCTA['url']?>"><?php echo $contentCTA['title']; ?></a>
        </div>
        <div class="dsn:w-full dsn:lg:w-7/12">
            <?php //print_r($logos); ?>
            <div class="logo-slider dsn:w-full dsn:relative dsn:!mx-0">
                <?php if($logos) {
                    foreach($logos as $blocklogo) {
                    ?>
                       <a href="<?php echo $blocklogo['url']['url']; ?>"><img class="dsn:w-full" src="<?php echo $blocklogo['logo']['url']; ?>" alt="<?php echo $blocklogo['url']['title']; ?>" /></a>
                <?php } 
                }?>
            </div>
        </div>
    </div>
    

</section>
<style>
    .logo-slider .slick-slide div {
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
    .logo-slider.slick-slider {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    /* space the slides */
 .logo-slider .slick-slide {
      margin: 0 15px;
  }

  /* space the parent */
  .logo-slider .slick-list {
      margin: 0 -15px;
  }
 @media only screen and (min-width: 2100px) {
    .logo-slider .slick-slide div { 
        height: 6vw;
    }
 }
 @media only screen and (max-width: 700px) {
    .logo-slider .slick-slide div {
        height: 25vw;
    }
 }
</style>