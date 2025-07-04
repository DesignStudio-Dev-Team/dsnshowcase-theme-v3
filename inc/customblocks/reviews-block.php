<?php 
$reviews_block = get_field('reviews_block', $block_id);
$title = $reviews_block['title'];
$reviews = $reviews_block['reviews'];
?>

<section id="reviews-block-<?php echo $block_id; ?>" class="dsn:mb-10 dsn:py-25">
<div class="dsn:container dsn:mx-auto">
    <div class="dsn:w-full dsn:lg:w-1/2 dsn:mx-auto dsn:text-center dsn:mb-20">
        <h2><?php echo $title; ?></h2>
    </div>
    <div class="dsnReviewsBlock">
         <?php 
         if($reviews) {
         foreach($reviews as $review) { 
            $reviewTitle = $review['title'];
            $reviewContent = $review['content'];
            $reviewAuthor = $review['author'];
            $reviewAuthorAvatar = $review['author_avatar'];
            $reviewImg = $review['image'];
            ?>
        <div class="dsn:container dsn:mx-auto dsn:flex dsn:flex-col dsn:lg:flex-row dsn:items-center dsn:relative">
            <div class="dsn:w-full dsn:lg:w-1/2 dsn:p-0 dsn:z-10 dsn:h-auto dsn:lg:h-[72vh]">
                <img class="dsn:w-full dsn:h-full dsn:object-cover" src="<?php echo $reviewImg; ?>" alt="image">
            </div>
            <div class="dsn:w-full dsn:lg:h-[82%] dsn:lg:left-[45%] dsn:p-5 dsn:lg:p-10 dsn:lg:max-w-[700px] dsn:lg:absolute dsn:bg-white dsn:shadow dsn:z-20 dsn:flex dsn:flex-col dsn:justify-center dsn:relative dsn:left-0 dsn:h-auto">
                <div class="dsn:relative">
                  <div class="dsn:relative dsn:lg:absolute dsn:left-0 dsn:-top-5 dsn:mt-4 dsn:lg:mt-0 dsn:-mb-6 dsn:lg:mb-4">
                    <svg role="presentation" class="dsn:w-7 dsn:h-14 dsn:lg:w-15 dsn:lg:h-30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 65">
                    <text id="_" data-name="&quot;" transform="translate(0 53)" fill="#65a23b" font-size="54" font-family="Lato-Bold, Lato" font-weight="700"><tspan x="0" y="0">&quot;</tspan></text>
                    </svg>
                </div>
                <h3 class="dsn:mb-0 dsn:pb-0 dsn:text-center"> <?php echo $reviewTitle; ?> </h3>
                  
                </div>
                    <div class="dsn:h-auto dsn:sm:h-50 dsn:lg:h-60 dsn:overflow-y-auto dsn:mt-4">
                        <?php echo $reviewContent; ?>
                    </div>
                    <div class="dsn:py-5 dsn:flex dsn:gap-5 dsn:items-center dsn:justify-center">
                    <?php if($reviewAuthorAvatar) { ?><img src="<?php echo $reviewAuthorAvatar; ?>" alt="author avatar"> <?php } ?>
                    <p><?php echo $reviewAuthor; ?></p>
                </div>
                </div>
              
        </div>

         <?php 
         }}
         ?>
    </div>
</div>

</section>