<?php 
$parallax = get_field('parallax_block', $block_id);
$bgImg = $parallax['background_image'];
$logo = $parallax['logo'];
$title = $parallax['title'];
$description = $parallax['description'];
$cta = $parallax['cta'];
?>

<section  class="dsn:my-10">
<div class="dsn:h-[1000px]" style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;">
      <div class="dsn:container dsn:mx-auto dsn:relative dsn:flex dsn:flex-col dsn:items-start dsn:justify-center dsn:mr-20 dsn:h-full">
         <div class="dsn:p-0 dsn:mt-50 dsn:w-full dsn:md:w-1/4 ">   
               <img class="dsn:mb-5" src="<?php echo $logo; ?>" alt="logo">
               <h2 class="dsn:text-6xl dsn:text-white"><?php echo $title; ?></h2>
               <p class="dsn:text-white dsn:mb-10"><?php echo $description; ?></p>
               <a class="btn dsn:mt-15 dsn:justify-start dsn:self-start" href="<?php echo $cta['url']; ?>"><?php echo $cta['title']; ?></a>
         </div>
      </div>
</div>
</section>