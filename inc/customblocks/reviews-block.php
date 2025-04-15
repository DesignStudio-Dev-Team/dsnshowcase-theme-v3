<?php 
$reviews_block = get_field('reviews_block', $block_id);
$title = $reviews_block['title'];
$reviews = $reviews_block['reviews'];
?>

<section class="dsn:mb-10 dsn:py-25">
<div class="dsn:container dsn:mx-auto">
    <div class="dsn:w-full dsn:md:w-1/2 dsn:mx-auto dsn:text-center">
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
        <div class="dsn:container dsn:mx-auto dsn:flex dsn:relative">
            <div class="dsn:w-full dsn:lg:w-1/2 dsn:p-0 dsn:mb-5 dsn:z-10">
                <img class="dsn:w-full dsn:h-full" src="<?php echo $reviewImg; ?>" alt="image">
            </div>
            <div class="dsn:w-full dsn:h-[55%] dsn:left-[45%] dsn:p-15 dsn:lg:w-[800px] dsn:absolute dsn:bg-white dsn:shadow dsn:my-12 dsn:z-20">
                <div class="dsn:absolute dsn:left-10 dsn:top-10 dsn:mb-4">
                    <svg role="presentation" xmlns="http://www.w3.org/2000/svg" width="55" height="105" viewBox="0 0 22 65">
                    <text id="_" data-name="&quot;" transform="translate(0 53)" fill="#65a23b" font-size="54" font-family="Lato-Bold, Lato" font-weight="700"><tspan x="0" y="0">&quot;</tspan></text>
                    </svg>
                </div>
                    <div>
                        <h2 class="dsn:mb-0 dsn:pb-0 dsn:text-center"> <?php echo $reviewTitle; ?> </h2>
                        <p> <?php echo $reviewContent; ?> </p>
                    </div>
                    <div class="dsn:py-15 dsn:flex dsn:gap-5 dsn:items-center dsn:justify-center">
                    <img src="<?php echo $reviewAuthorAvatar; ?>" alt="author avatar">
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