<?php 
            $heroContent = get_field('hero_3_content', $block_id);
            
            //get content for hero 1
            $primaryTitle = $heroContent['primary_title'];
            $sub_title = $heroContent['sub_title'];
            $mainCTA = $heroContent['main_cta'];
            $secondaryCTA = $heroContent['secondary_cta'];
            $primaryBG = $heroContent['primary_bg'];
            $primaryBGtype = $primaryBG['background_type'];
            $primaryBGvideoType = $primaryBG['video_type'];
            $primaryBG_YouTube_ID = $primaryBG['youtube_video'];
            $primaryBG_MP4 = $primaryBG['mp4_video'];
            $primaryBGImg = $primaryBG['background_image'];
            $primaryBG_hasForm = $heroContent['has_form'];
            $primaryBG_Form = $heroContent['form_shortcode'];

            //get 2nd card text, link, and image
            $secondaryTitle = $heroContent['secondary_card_title'];
            $secondaryLink = $heroContent['secondary_card_link']; 
            $secondaryBGImg = $heroContent['secondary_card_bg_img'];
            
            //get 3rd card text, link, and image
            $thirdTitle = $heroContent['third_card_title'];
            $thirdLink = $heroContent['third_card_link'];
            $thirdBGImg = $heroContent['third_card_bg_img'];
            
            ?>   

        

        <section id="hero-block-<?php echo $block_id; ?>" class="dsn:container dsn:mx-auto dsn:px-4 dsn:mb-15 dsn:mt-5">
        <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:gap-5">
      
        <div style="background:url('<?php if($primaryBGtype == 'img') { echo $primaryBGImg['url']; }?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-1 dsn:lg:order-1 dsn:relative dsn:w-full dsn:h-full dsn:min-h-[400px] dsn:lg:min-h-[600px] dsn:lg:w-7/12 dsn:lg:row-span-2 dsn:p-0 dsn:flex dsn:flex-col dsn:lg:order-1 dsn:justify-end dsn:overflow-hidden left-col">
          <?php  if($primaryBGtype == 'video' && $primaryBGvideoType == "mp4") { ?>
         <video autoplay muted loop class="dsn:absolute dsn:left-0 dsn:top-0 dsn:object-cover dsn:w-full dsn:h-full">
            <source src="<?php echo $primaryBG_MP4; ?>" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>
         <?php } ?>
          <?php  if($primaryBGtype == 'video' && $primaryBGvideoType == "youtube") { ?>
             <div class="video-foreground dsn:absolute dsn:left-0 dsn:top-0 dsn:object-cover dsn:w-full dsn:h-full">
        <iframe class="dsn:absolute dsn:left-0 dsn:top-0 dsn:object-cover dsn:w-full dsn:h-full" src="https://www.youtube.com/embed/<?php echo $primaryBG_YouTube_ID; ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1" frameborder="0" allowfullscreen></iframe>
          </div>
            <?php } ?>
            <div class="perfect-hot-tub dsn:p-10 dsn:flex dsn:flex-wrap dsn:items-center dsn:justify-center dsn:gap-4">
          <h1 class="dsn:text-4xl dsn:font-bold dsn:my-0 dsn:text-white dsn:relative dsn:z-10">
           <?php echo $primaryTitle; ?>
          </h1>
          <div class="dsn:space-x-4 dsn:flex dsn:items-center dsn:relative dsn:z-10">
            <a href="<?php if($primaryBG_hasForm == 'no') { echo $mainCTA['url']; } else {echo 'javascript:;'; } ?>" target="<?php echo $mainCTA['target']; ?>" class="dsn:bg-orange-500 dsn:border dsn:rounded-lg dsn:border-white dsn:text-white dsn:px-8 dsn:py-3 dsn:font-medium <?php if($primaryBG_hasForm == 'yes') { echo 'start-quiz'; } ?>" role="button">
            <?php echo $mainCTA['title']; ?>
            </a>
            <?php if($secondaryCTA) { ?>
            <a href="<?php echo $secondaryCTA['url']; ?>" target="<?php echo $mainCTA['target']; ?>" class="dsn:bg-orange-500 dsn:border dsn:rounded-lg dsn:border-white dsn:text-white dsn:px-8 dsn:py-3 dsn:font-medium" role="button">
              <?php echo $secondaryCTA['title']; ?>
             </a>
            <?php } ?>
          </div>
          </div>
         
                 <?php if($primaryBG_hasForm == 'yes') { ?>
                  <span class="close-quiz dsn:absolute dsn:right-2 dsn:top-2 dsn:lg:right-4 dsn:lg:top-4 dsn:cursor-pointer dsn:bg-white dsn:w-8 dsn:h-8 dsn:rounded-full dsn:flex dsn:items-center dsn:justify-center dsn:hidden dsn:z-50">X</span>
            <div id="quiz-form" class="dsn:relative dsn:bg-black-500/75 dsn:transition-opacity dsn:hidden dsn:z-40 dsn:text-center dsn:p-5 dsn:lg:min-h-[600px] dsn:items-center">
              <div class="dsn:flex dsn:w-full dsn:h-full dsn:items-center dsn:justify-center">
              <div class="dsn:bg-white dsn:w-full dsn:lg:w-10/12 dsn:p-4 dsn:lg:p-10">
                  <?php if($primaryBG_Form) { echo do_shortcode($primaryBG_Form); } ?>
                </div>
                </div>
                </div>
         <?php } ?>
                <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>

        </div>
        <div class="dsn:lg:w-5/12 dsn:flex dsn:flex-col dsn:gap-5 dsn:h-[400px] dsn:lg:h-[600px] dsn:order-2 right-col">
        <div style="background:url('<?php echo $secondaryBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-2 dsn:lg:order-2  dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full">
        <a class="dsn:size-full dsn:p-6 dsn:flex dsn:items-end" href="<?php echo $secondaryLink; ?>" role="button">
            <h2 class="dsn:relative dsn:z-10 dsn:text-2xl dsn:font-semibold dsn:text-white dsn:my-0">
            <?php echo $secondaryTitle; ?>
          </h2>
          
          
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>
           
          </a>
        </div>

       
        <div style="background:url('<?php echo $thirdBGImg; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-3 dsn:lg:order-3 dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full">
        <a class="dsn:size-full dsn:p-6 dsn:flex dsn:items-end" href="<?php echo $thirdLink; ?>" role="button">

            <h2 class="dsn:text-2xl dsn:font-semibold dsn:text-white dsn:relative dsn:z-10 dsn:my-0">
            <?php echo $thirdTitle; ?>
          </h2>
          
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>
           
         </a>
        </div>   
       </div>
      </div>
                 </section>
    

<style>
  .video-foreground,
.video-background iframe {
  pointer-events: none; 
}
@media (min-aspect-ratio: 16/9) {
  .video-foreground {
    height: 300%;
    top: -100%;
  }
}
@media (max-aspect-ratio: 16/9) {
  .video-foreground {
    width: 300%;
    left: -100%;
  }
}
@media all and (max-width: 600px) {
  .vid-info {
    width: 50%;
    padding: 0.5rem;
  }
  .vid-info h1 {
    margin-bottom: 0.2rem;
  }
}
@media all and (max-width: 500px) {
  .vid-info .acronym {
    display: none;
  }
}

@media only screen and (min-width: 1024px) and (max-width: 1400px) {
  #hero-block-<?php echo $block_id; ?> .left-col {
    min-height: 400px;
  }
  #hero-block-<?php echo $block_id; ?> .right-col { 
    height: 400px;
  }
}
@media only screen and (min-width: 1401px) and (max-width: 1800px) {
  #hero-block-<?php echo $block_id; ?> .left-col {
    min-height: 500px;
  }
  #hero-block-<?php echo $block_id; ?> .right-col { 
    height: 500px;
  }
}
</style>

<script>
    jQuery(document).ready(function($){
        $(".start-quiz").click(function(){
            $(".perfect-hot-tub").hide();
            $(".close-quiz").css("display","flex");
            $("#quiz-form").css("display","flex");
        });
    
        $(".close-quiz").click(function(){
                console.log("close");
                $(".close-quiz").hide();
                $(".perfect-hot-tub").show();
                $("#quiz-form").hide();
        });
    
        
    });
    
</script>