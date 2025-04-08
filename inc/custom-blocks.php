<?php

// Function to render custom blocks based on the relationship field and display type
function render_custom_blocks($blocks, $display_type = 'stack') {

    //here we want to check if the blocks are empty or not

    if (!$blocks || !is_array($blocks)) return;

    // check if the display type is valid and what type for now is either slideshow or stack it
    if ($display_type === 'Slideshow') {
        echo '<div class="custom-blocks-slideshow dsn:container dsn:mx-auto dsn:relative dsn:z-1">';
    } else {
        echo '<div class="custom-blocks-stacked dsn:relative dsn:z-1">';
    }

    // Loop through the blocks
    foreach ($blocks as $block) {
        $block_id = $block->ID;

        // Fetch ACF fields for the block
        $block_type = get_field('type', $block_id); // Example ACF field

        //if block type is hero1 then lets do hero1 or hero2 ect
        if($block_type === 'Hero 1'){
           include get_template_directory() . '/inc/customblocks/hero1.php';
        }
        if($block_type === 'Hero 2'){
            include get_template_directory() . '/inc/customblocks/hero2.php';
        }
        if($block_type === 'Google Reviews') {
            include get_template_directory() . '/inc/customblocks/google-reviews.php';
        }
        if($block_type === 'Grid Reasons') {
            include get_template_directory() . '/inc/customblocks/grid-reasons.php';
        } 
        if($block_type === 'Grid Brands') {
            include get_template_directory() . '/inc/customblocks/grid-brands.php';
        }
        if($block_type === 'Process List') {
            include get_template_directory() . '/inc/customblocks/process-list.php';
        }
        if($block_type === 'Grid Categories') {
            include get_template_directory() . '/inc/customblocks/grid-categories.php';
        }
        if($block_type === 'Video Block') {
            include get_template_directory() . '/inc/customblocks/video-block.php';
        }
        if($block_type === 'Parallax Block') {
            include get_template_directory() . '/inc/customblocks/parallax-block.php';
        }
        if($block_type === 'Timer Block') {
            include get_template_directory() . '/inc/customblocks/timer-block.php';
        }
        if($block_type === 'Two Block') {
            include get_template_directory() . '/inc/customblocks/two-block.php';
        }
        if($block_type === 'Reviews Block') {
            include get_template_directory() . '/inc/customblocks/reviews-block.php';
        }
        if($block_type === 'CTAs Block') {
            include get_template_directory() . '/inc/customblocks/ctas-block.php';
        }
    }
  echo '</div>'; ?>
<style>
  .custom-blocks-slideshow .custom-block {
    padding: 20px;
    text-align: center;
  }

  .custom-blocks-slideshow .slick-dots {
      bottom:20px;
  }

  .custom-blocks-slideshow .slick-dots li button:before {
      font-size:20px;
  }  
</style>
<?php } ?>