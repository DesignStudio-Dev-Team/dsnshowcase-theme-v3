<?php 
$videoBlock = get_field('video_block', $block_id);
$image = $videoBlock['image'];
$list = $videoBlock['list'];
$title = $videoBlock['title'];
$cta = $videoBlock['cta'];
if($image) {
    $bgImgUrl = $image['url']; 
} else {
    $bgImgUrl = '';
}
$videoType = $videoBlock['video_type'];
if($videoType == 'youtube') {
    $video = $videoBlock['youtube_video'];
    $youtubeUrl = $video;
    $youtubeUrl = str_replace('watch?v=', 'embed/', $youtubeUrl);
    $youtubeUrl = str_replace('&', '?', $youtubeUrl);
    $youtubeUrl = str_replace('https://www.youtube.com/', 'https://www.youtube-nocookie.com/', $youtubeUrl);    
} else {
    $video = $videoBlock['mp4_link'];
}

?>
<section class="dsn:mb-10">
<div class="dsn:container dsn:mx-auto">
    <div class="dsn:w-full dsn:grid dsn:grid-cols-1 dsn:xl:grid-cols-6 dsn:gap-10">
        <div class="dsn:p-0 dsn:text-left dsn:col-span-4 dsn:flex dsn:flex-col dsn:bg-cover dsn:bg-center dsn:h-66 dsn:md:h-auto" style="background-image: url(<?php echo $bgImgUrl; ?>);">
         <?php 
         if($video && $videoType == 'youtube') {
            //echo the video here
            echo '<iframe width="100%" height="100%" src="'.$youtubeUrl.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
         }
         if($video && $videoType == 'link') {
            //echo the video here
            echo '<video class="dsn:w-full dsn:h-full dsn:object-cover" autoplay muted loop controls>
                  <source src="'.$video.'" type="video/mp4">
                  Your browser does not support the video tag.
                  </video>';
         }
         
         ?>
        </div>
        <div class="dsn:p-0 dsn:text-left dsn:col-span-4 dsn:md:col-span-2  dsn:flex dsn:flex-col">
         <div class="dsn:bg-[#F1F0EC] dsn:p-4 dsn:md:py-10 dsn:md:px-5">
            <h2 class="dsn:text-center"><?php echo $title; ?></h2>
            <ul class="dsn:pl-0">
                <?php if($list) { 
                    foreach($list as $item) { ?>
                <li class="dsn:flex dsn:items-center dsn:align-middle dsn:self-center dsn:gap-3 dsn:mt-0 dsn:py-2 dsn:list-none">
                    <div>
                    <svg role="presentation" class="checkBoxesList" xmlns="http://www.w3.org/2000/svg" width="34.571" height="34.571" viewBox="0 0 34.571 34.571">
                    <path id="Path_6503" data-name="Path 6503" d="M21.786,4.5A17.286,17.286,0,1,0,39.071,21.786,17.305,17.305,0,0,0,21.786,4.5Zm9,11.493-11.169,13.3a1.33,1.33,0,0,1-1,.475h-.022a1.33,1.33,0,0,1-.988-.44L12.818,24a1.33,1.33,0,1,1,1.976-1.778l3.764,4.182L28.746,14.282a1.33,1.33,0,1,1,2.036,1.71Z" transform="translate(-4.5 -4.5)"/>
                    </svg>
                    </div>
                    <div class="dsn:pt-4 listLinks">
                        <?php echo $item['description']; ?>
                    </div>
                </li>
                <?php } } ?>
            </ul>
            <div class="dsn:w-full dsn:text-center dsn:mb-10 dsn:md:mt-15">
                <?php if(!empty($cta['url'])) { ?>
            <a class="btn" href="<?php echo $cta['url']; ?>" role="button"><?php echo $cta['title']; ?></a>
            <?php } ?>
            </div>
         </div>
        </div>
    </div>
</div>
</section>

<style>
.listLinks a {
    color: var(--dealerLinkColor);
    text-decoration: none;
 }
.checkBoxesList {
    fill: var(--dealerColor);
}
</style>