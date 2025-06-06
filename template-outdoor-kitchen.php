<?php
/**
 * Template Name: Outdoor Kitchen
*/
get_header();
?>
<script src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js"></script>
<?php
// Include custom blocks helper
require_once get_template_directory() . '/inc/custom-blocks.php';

// fetch the acf group top_custom_blocks
$top_custom_blocks = get_field('top_custom_blocks');
//get selecte_custom_blocks from the group
$selected_blocks = $top_custom_blocks['select_custom_blocks'] ?? [];
//get the display type from the group
$display_type = $top_custom_blocks['how_to_display_blocks'] ?? [];

//Render TOP Custom Blocks
if ($selected_blocks) {
    // Render the blocks using the helper function
    render_custom_blocks($selected_blocks, $display_type);
}
$page_ID = get_the_ID();

//Outdoor Kitchen Internal ACFs
$col_left_img = get_field('left_image', $page_ID);
$col_right_content = get_field('right_content', $page_ID);
$col_right_cta = get_field('right_cta_button', $page_ID);
$specification = get_field('specification', $page_ID);
$specification_title = $specification['title'];
$specification_image = $specification['diagram_image'];
$gallery = get_field('gallery', $page_ID);
$gallery_title = $gallery['title'];
$gallery_image_gallery = $gallery['image_gallery'];
?>
<main class="outdoor-kitchen-internal-pages dsn:py-10 dsn:px-4 dsn:md:px-0">
    <div class="dsn:container dsn:mx-auto">
      <!-- Left - Right Section -->
        <div class="top-container dsn:flex dsn:flex-col dsn:md:flex-row dsn:md:gap-4">
            <div class="col-left dsn:w-full dsn:md:w-1/2">
                <?php if($col_left_img) { ?>
                <img class="dsn:w-full" src="<?php echo $col_left_img['url']; ?>" alt="<?php echo $col_left_img['title']; ?>" /> 
                <?php } ?>
            </div>
            <div class="col-right dsn:w-full dsn:md:w-1/2 dsn:md:pl-10">
                <?php if($col_right_content) { echo $col_right_content; } ?>
                <?php if($col_right_cta) { ?>
                <div class="right-col-cta-btn dsn:block dsn:my-10"><a class="btn dsn:my-6" href="<?php echo $col_right_cta['url']; ?>"><?php echo $col_right_cta['title']; ?></a></div>
                <?php } ?>
            </div>
        </div>
         <!-- Left - Right Section End -->
        <!-- Specification Section -->
        <div class="bottom-container dsn:py-10">
            <h2 class="dsn:text-center"><?php if($specification_title) { echo $specification_title; } ?></h2>
            <?php if ($specification_image) { ?>
            <img class="dsn:mx-auto" src="<?php echo $specification_image['url']; ?>" alt="<?php echo $specification_image['title']; ?>" />
            <?php } ?>
        </div>
        <!-- Specification end -->
        <!-- Gallery Section -->
        <div class="gallery dsn:py-20">
        <?php if ($gallery_title) { ?>
        <h4 class="dsn:text-center dsn:pb-6"><?php echo $gallery_title; ?></h4>
        <?php } ?>
        <?php 

if( $gallery_image_gallery ): ?>
    <div id="carousel" class="flexslider">
        <div class="slides outdoor-kitchen-gallery">
            <?php foreach( $gallery_image_gallery as $image ): ?>
                <div>
                <a href="<?php echo $image['url'] ?>">
                    <img class="dsn:w-full dsn:border-2 dsn:border-gray-500" src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_url($image['alt']); ?>" />
                </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
        </div>
        <!-- Gallery Section End-->
    </div>
</main>
 


<?php
// fetch the acf group bottom_custom_blocks
$bot_custom_blocks = get_field('bottom_custom_blocks');
//get selecte_custom_blocks from the group
$selected_blocks_bot = $bot_custom_blocks['select_custom_blocks_bottom'] ?? [];
//get the display type from the group
$display_type_bot = $bot_custom_blocks['how_to_display_blocks_bottom'] ?? [];

//Render Bottom Custom Blocks
if ($selected_blocks_bot) {
    // Render the blocks using the helper function
    render_custom_blocks($selected_blocks_bot, $display_type_bot);
}

 get_footer(); ?>
<div class="dsn:-mb-3 dsn:hidden dsn:md:m-0"></div>
<style>
  .col-left img {
    position: sticky;
    top: 7em;
    height: 74%;
    object-fit: cover;
    object-position: center;
}
.slick-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    text-align: center;
    height: 100%;
    width: 100%;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.slick-lightbox .slick-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: contain;
    max-height: 60vh !important;
}
 /* space the slides */
 .outdoor-kitchen-gallery .slick-slide {
      margin: 0 15px;
  }

  /* space the parent */
  .outdoor-kitchen-gallery .slick-list {
      margin: 0 -15px;
  }
  .outdoor-kitchen-gallery .slick-slide img {
    display: block;
    height: 15vw;
    width: 100%;
    object-fit: cover;
}
.outdoor-kitchen-gallery.slick-slider {
    margin-left: 0;
    margin-right: 0;

}
button.slick-lightbox-close {
    position: absolute;
    color: #fff;
    right: 12vh;
    top: 10vh;
    width: 40px;
    height: 40px;
    cursor: pointer;
}
button.slick-lightbox-close:before,button.slick-lightbox-close:after{
    content:'';
    position:absolute;
    width:36px;
    height:4px;
    background-color:white;
    border-radius:2px;
    top:16px;
    box-shadow:0 0 2px 0 #ccc;
}
button.slick-lightbox-close:before{
    -webkit-transform:rotate(45deg);
    -moz-transform:rotate(45deg);
    transform:rotate(45deg);
    left:2px;
}
button.slick-lightbox-close:after{
    -webkit-transform:rotate(-45deg);
    -moz-transform:rotate(-45deg);
    transform:rotate(-45deg);
    right:2px;
}
.disabled-link {
  filter: grayscale(100%);
  pointer-events: none;
}

@media only screen and (max-width: 700px) {
    .outdoor-kitchen-gallery .slick-slide img {
        height: 75vw; 
    }
    .outdoor-kitchen-gallery .slick-dots {
        bottom: -45px; 
    }
}
.page-template-template-outdoor-kitchen #gridBlock {
  padding-top: 0;
}
</style>

<script>
jQuery(document).ready(function($) {
  var currentUrl = window.location.href;
  $('a').each(function() {
    var linkUrl = $(this).attr('href');
    if (linkUrl === currentUrl) {
      $(this).click(function(e) {
        e.preventDefault();
      });
      $(this).addClass('disabled-link'); // Add a class for styling
    }
  });
});
</script>