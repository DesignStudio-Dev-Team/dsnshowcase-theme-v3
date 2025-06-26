<?php 
$visualBlock = get_field('visual_block', $block_id);
$visualElement = $visualBlock['visual_element'];
$bgType = $visualElement['background_type'];
$bgImg = $visualElement['background_image'];
$videoLink = $visualElement['video_link'];
$container = $visualElement['container'];

if($container == 'full-width') {
    $containerClass = 'dsn:mx-auto';
} else {
    $containerClass = 'dsn:container dsn:mx-auto dsn:relative';
}

$content = $visualBlock['content'];
$logo = $content['logo'];
$title = $content['title'];
$description = $content['description'];
$cta = $content['cta'];
$cta2 = $content['cta2'];
$position = $content['position'];

if($position == 'top-left') {
      $positionClass = 'dsn:items-start dsn:justify-start';
}
if($position == 'top-center') {
      $positionClass = 'dsn:items-center dsn:justify-start';
}
if($position == 'top-right') {
      $positionClass = 'dsn:items-end dsn:justify-start';
}
if($position == 'middle-left') {
      $positionClass = 'dsn:items-start dsn:justify-center';
      $cards = $content['cards'];
}
if($position == 'middle-center') {
      $positionClass = 'dsn:items-center dsn:justify-center';
}
if($position == 'middle-right') {
      $positionClass = 'dsn:items-end dsn:justify-center';
}
if($position == 'bottom-left') {
      $positionClass = 'dsn:items-start dsn:justify-end';
}
if($position == 'bottom-center') {
      $positionClass = 'dsn:items-center dsn:justify-end';
}
if($position == 'bottom-right') {
      $positionClass = 'dsn:items-end dsn:justify-end';
}


$contentContainer = $content['content_container_size'];
$contentContainerClass = 'dsn:lg:w-1/4';

if($contentContainer == 'Small') {
    $contentContainerClass = 'dsn:lg:w-4/12';
}
if($contentContainer == 'Medium') {
    $contentContainerClass = 'dsn:lg:w-1/3';
}
if($contentContainer == 'Large') {
    $contentContainerClass = 'dsn:lg:w-1/2';
}

?>

<section  class="dsn:mb-10 <?php echo $containerClass; ?>">
<?php if($bgType == 'image') { ?>
<div class="dsn:h-auto dsn:lg:h-max" style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;">
<?php } ?>
<?php if($bgType == 'video') { ?>
<div class="dsn:h-auto dsn:lg:h-[85vh] dsn:relative">
      <video class="dsn:w-full dsn:h-full dsn:object-cover dsn:absolute" autoplay muted loop>
            <source src="<?php echo $videoLink; ?>" type="video/mp4">
            Your browser does not support the video tag.
      </video>
      <div class="dsn:absolute dsn:top-0 dsn:left-0 dsn:w-full dsn:h-full dsn:bg-black dsn:opacity-40"></div>
<?php } ?>


          <?php 
if($position == 'middle-left' && $cards) { ?>
   <div class="dsn:container dsn:mx-auto dsn:relative dsn:flex dsn:flex-col dsn:lg:flex-row dsn:gap-10 dsn:items-center dsn:align-middle  dsn:p-10 dsn:h-full dsn:justify-items-center">
<?php } else { ?>
   <div class="dsn:container dsn:mx-auto dsn:relative dsn:flex dsn:flex-col dsn:p-10 dsn:h-full <?php echo $positionClass; ?>">
<?php } ?>


            <div class="dsn:w-full <?php echo $contentContainerClass; ?>">  
                  <?php if($logo) { ?>
                  <img class="dsn:mb-5" src="<?php echo $logo; ?>" alt="logo">
                  <?php } ?>
                  <?php if($title) { ?>
                  <h2 class="dsn:text-white"><?php echo $title; ?></h2>
                  <?php } ?>
                  <?php if($description) { ?>
                  <p class="dsn:text-white dsn:mb-5"><?php echo $description; ?></p>
                  <?php } ?>

                  <div class="dsn:flex dsn:flex-col dsn:md:flex-row dsn:gap-5 dsn:items-start dsn:justify-start">
                  <?php if($cta) { ?>
                  <a class="btn dsn:mt-5 dsn:text-center dsn:px-4 dsn:w-full dsn:md:w-1/2 dsn:justify-start dsn:self-start" href="<?php echo $cta['url']; ?>" role="button"><?php echo $cta['title']; ?></a>
                  <?php } ?>
                  <?php if($cta2) { ?>
                  <a class="btn dsn:mt-5 dsn:text-center dsn:px-4  dsn:w-full dsn:md:w-1/2 dsn:justify-start dsn:self-start" href="<?php echo $cta2['url']; ?>" role="button"><?php echo $cta2['title']; ?></a>
                  <?php } ?>
                  </div>
         </div>

          <?php 
if($position == 'middle-left' && $cards) { ?>
            <div class="dsn:lg:w-8/12 dsn:flex dsn:flex-col dsn:lg:flex-row dsn:gap-10 dsn:items-start dsn:items-stretch dsn:h-full dsn:justify-items-center">
                  <?php foreach($cards as $card) { ?>
                   <div class="dsn:bg-white dsn:p-10 dsn:border-t-15 dsn:border-green-800 dsn:w-full dsn:lg:w-1/2 dsn:shadow-lg dsn:flex dsn:flex-col dsn:justify-start">

                   <div class="dsn:h-auto dsn:lg:h-max">
                              <img class="dsn:mb-3" src="<?php echo $card['icon']['url']; ?>" alt="<?php echo $card['title']; ?>">
                              <h3 class="dsn:text-black"><?php echo $card['title']; ?></h3>
                        </div>
                        <div class="dsn:text-gray-600"><?php echo $card['description']; ?></div>
                        </div>
                  <?php } ?>
                  </div>
<?php } ?>  

      </div>



      
</div>
</section>
<div class="dsn:hidden dsn:md:w-1/2 dsn:md:w-1/3 dsn:md:w-1/4"></div>