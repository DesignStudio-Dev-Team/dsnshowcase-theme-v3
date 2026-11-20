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
           include locate_template('/inc/customblocks/hero1.php');
        }
        if($block_type === 'Hero 2'){
            include locate_template('/inc/customblocks/hero2.php');
        }
        if($block_type === 'Hero 3'){
            include locate_template('/inc/customblocks/hero3.php');
        }
        if($block_type === 'Google Reviews') {
            include locate_template('/inc/customblocks/google-reviews.php');
        }
        if($block_type === 'Grid Reasons') {
            include locate_template('/inc/customblocks/grid-reasons.php');
        } 
        if($block_type === 'Grid Brands') {
            include locate_template('/inc/customblocks/grid-brands.php');
        }
        if($block_type === 'Grid Block') {
            include locate_template('/inc/customblocks/grid-block.php');
        }
        if($block_type === 'Process List') {
            include locate_template('/inc/customblocks/process-list.php');
        }
        if($block_type === 'Grid Categories') {
            include locate_template('/inc/customblocks/grid-categories.php');
        }
        if($block_type === 'Video Block') {
            include locate_template('/inc/customblocks/video-block.php');
        }
        if($block_type === 'Visual Block') {
            include locate_template('/inc/customblocks/visual-block.php');
        }
        if($block_type === 'Timer Block') {
            include locate_template('/inc/customblocks/timer-block.php');
        }
        if($block_type === 'Two Block') {
            include locate_template('/inc/customblocks/two-block.php');
        }
        if($block_type === 'Reviews Block') {
            include locate_template('/inc/customblocks/reviews-block.php');
        }
        if($block_type === 'CTAs Block') {
            include locate_template('/inc/customblocks/ctas-block.php');
        }
        if($block_type === 'Card Stack Block') {
            include locate_template('/inc/customblocks/card-stack-block.php');
        }
        if($block_type === 'Icon Block') {
            include locate_template('/inc/customblocks/icon-block.php');
        }
        if($block_type === 'Logo Slider') {
            include locate_template('/inc/customblocks/logo-slider-block.php');
        }
        if($block_type === 'Products Showcase') {
            include locate_template('/inc/customblocks/products-showcase-block.php');
        }
        if($block_type === 'Left Right Block') {
            include locate_template('/inc/customblocks/left-right-block.php');
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