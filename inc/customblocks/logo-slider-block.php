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

<section class="dsn:container dsn:mx-auto dsn:my-10">
    <h2 class="dsn:text-center dsn:mb-10"><?php echo $title; ?></h2>
    
    

</section>