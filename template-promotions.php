<?php

/**
 * Template Name: Promotions
*/

get_template_part('templates/header'); 

$promotionsPost = get_field('related_promotions_page_cpt');

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
?>

  <main class="archive-promotions">

    <div class="dsn:container">
        <div class="dsn:md:flex dsn:px-10 dsn:my-6 dsn:lg:my-10">
            <div class="dsn:w-full dsn:mx-auto dsn:inline-block dsn:relative">
                <h1 class="dsn:my-4 dsn:text-3xl dsn:md:text-4xl dsn:lg:text-5xl dsn:md:text-center">Promotions</h1>
            </div>
        </div>
    </div>

    <?php
        if($promotionsPost) {
    ?>

    <!-- large promotions -->
    <section class="dsn:container">
        <div class="dsn:md:flex px-10">
            <ul class="dsn:w-full">
                <?php
                    
                    // Cont for differentiate classes
                    $cont = 1;
                    // Make a loop for setup_postdata method
                    foreach( $promotionsPost as $post ) :   setup_postdata( $post );  ?>
                        <?php
                        $size = get_field('promotion_card_size');
                        if ($size == 'large') {
                            $today = date('Ymd');
                            $startPromotion = get_field('promo_start_date');
                            $endPromotion = get_field('promo_end_date');
                            $dateStart = DateTime::createFromFormat('F j, Y', $startPromotion);
                            $dateEnd = DateTime::createFromFormat('F j, Y', $endPromotion);
                            if ($dateStart)
                                $echoStart = $dateStart->format('Ymd');
                            if ($dateEnd)
                                $echoEnd = $dateEnd->format('Ymd');
                            $hide_title = get_field('hide_title');
                            
                            if( ( $echoStart <= $today ) && ( $today <= $echoEnd ) ){
                                // $thePost = array('ID' => get_the_ID() , 'post_status' => 'publish');
                                // wp_update_post($thePost);
                                ?> <li class="dsn:w-full dsn:relative dsn:text-white dsn:overflow-hidden dsn:break-inside dsn:mb-8 dsn:border"> <?php
                            } else {
                                // $thePost = array('ID' => get_the_ID() , 'post_status' => 'draft');
                                // wp_update_post($thePost);
                                ?> <li class="dsn:w-full dsn:relative dsn:text-white dsn:overflow-hidden" style="display:none"> <?php
                            }

                            
                                ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="dsn:w-full" style="height:unset;"/>
                                
                                        <div class="dsn:absolute dsn:top-0 dsn:w-full dsn:h-full gradient_card_<?php echo $cont; ?>">
                                            <?php
                            //  CSS styles
                            $gradient_card    =   get_field('color_gradient');
                            wp_register_style('custom', false);
                            wp_enqueue_style('custom');

                            $color_gradient_card_css   =   "
                                .gradient_card_$cont {
                                                background: linear-gradient(to right, $gradient_card, transparent);
                                                opacity: .9;
                                            }";
                            wp_add_inline_style('custom', $color_gradient_card_css); ?>
                            </div> 
                            <?php
                             $bubble = false;
                            if(!empty(get_field('call_action_bubble')) && !empty(get_field('call_to_action_sub_title'))  && !empty(get_field('call_to_action_text'))) {
                                $bubble = true;
                            }
                            ?>
                                <section class="dsn:absolute dsn:top-0 dsn:md:w-full dsn:h-full dsn:p-2 dsn:px-4 dsn:sm:p-8 dsn:md:p-2 dsn:md:px-4 dsn:lg:p-8">
                                    <?php if (get_field('promo_title')) { ?>
                                        <h3 class="dsn:font-extrabold dsn:text-white dsn:w-full"> <?php echo get_field('promo_title'); ?></h3>
                                    <?php } ?>
                                    <?php if (get_field('sub-title_card')) { ?>
                                        <p class="dsn:text-white dsn:w-full<?php if ($bubble) {
                                            echo ' dsn:md:w-4/5 dsn:lg:w-full';
                                        }?>"><?php echo get_field('sub-title_card'); ?></p>
                                    <?php } ?>    
                                    <?php if (!get_field('hide_promo_dates')) : ?>
                                            <h6 class="dsn:text-white dsn:w-full"><?php echo get_field('promo_start_date'); ?> - <?php echo get_field('promo_end_date'); ?> </h6>
                                    <?php endif; ?>
                                    <?php if (get_field('short_description_card')) { ?>
                                        <h6 class="dsn:text-white dsn:w-full<?php if ($bubble) {
                                            echo ' dsn:md:w-1/2 dsn:lg:w-3/5';
                                        }?>"><?php the_field('short_description_card'); ?></h6>
                                    <?php } ?> 
                                </section>
                                
                                <?php if($bubble) { ?>
                                    
                                    <section class="dsn:relative dsn:text-center dsn:bg-red-500 dsn:z-10 dsn:flex dsn:items-center dsn:justify-center dsn:md:justify-start dsn:md:absolute dsn:md:-bottom-32 dsn:d:-right-10 dsn:md:rounded-full dsn:p-2 dsn:md:pt-6 dsn:md:pr-2 dsn:flex-col bubble-card bubble_cont_<?php echo $cont; ?>"> 
                                    <!--<section class="relative text-center bg-red-500 z-10 flex items-center justify-center lg:justify-start lg:absolute lg:-bottom-16 lg:-right-10 lg:rounded-full lg:pt-6 md:pr-2 lg:flex-col bubble-card bubble_cont_<?php echo $cont; ?>">-->    
                                    
                                        <?php
                                            // Injecting CSS styles for color bubble
                                            $back_bubble    =   get_field('bubble_color');
                                    wp_register_style('custom', false);
                                    wp_enqueue_style('custom');

                                    $color_background_bubble_css   =   "
                                                .bubble_cont_$cont {
                                                    background: $back_bubble;
                                                }
                                            ";
                                    wp_add_inline_style('custom', $color_background_bubble_css);
                                    ?>
                                        <p class="dsn:text-black dsn:m-0"><?php the_field('call_action_bubble'); ?></p>
                                        <h3 class="dsn:font-bold dsn:m-0 dsn:py-0 dsn:text-black"><?php the_field('call_to_action_sub_title'); ?></h3>
                                        <p class="dsn:inline-block dsn:m-0 dsn:h-full dsn:my-auto dsn:text-black"><?php the_field('call_to_action_text'); ?></p>

                                        
                                    </section>
                                <?php   }   ?>
                            </a>
                        </li>
                    <?php }  $cont++;
                    endforeach;
                ?>
            </ul>
        </div>
    </section>

    <!-- small promotions -->
    <section class="dsn:container">
        <div class="dsn:md:flex px-10">
            <ul class="dsn:md:masonry dsn:md:masonry-sm">
                <?php
                    
                    // Cont for differentiate classes
                    $cont = 1;
                    // Make a loop for setup_postdata method
                    foreach( $promotionsPost as $post ) :   setup_postdata( $post );  ?>
                        <?php
                        $size = get_field('promotion_card_size');
                        if ($size == 'small') {
                            $today = date('Ymd');
                            $startPromotion = get_field('promo_start_date');
                            $endPromotion = get_field('promo_end_date');
                            $dateStart = DateTime::createFromFormat('F j, Y', $startPromotion);
                            $dateEnd = DateTime::createFromFormat('F j, Y', $endPromotion);
                            if ($dateStart) {
                                $echoStart = $dateStart->format('Ymd');
                            }
                            if ($dateEnd) {
                                $echoEnd = $dateEnd->format('Ymd');
                            }
                            $hide_title = get_field('hide_title');

                            if(($echoStart <= $today) && ($today <= $echoEnd)) {
                                $thePost = array('ID' => get_the_ID() , 'post_status' => 'publish');
                                wp_update_post($thePost);
                                ?> <li class="dsn:w-full dsn:relative dsn:text-white dsn:overflow-hidden dsn:break-inside dsn:mb-8 dsn:border"> <?php
                            } else {
                                //$thePost = array('ID' => get_the_ID() , 'post_status' => 'draft');
                                //wp_update_post($thePost);
                                ?> <li class="dsn:w-full dsn:relative dsn:text-white dsn:overflow-hidden" style="display:none"> <?php
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="w-full" style="height:unset;"/>
                                
                                        <div class="dsn:absolute dsn:top-0 dsn:w-full dsn:h-full gradient_card_<?php echo $cont; ?>">
                                            <?php
                        //  CSS styles
                        $gradient_card    =   get_field('color_gradient');
                        wp_register_style('custom', false);
                        wp_enqueue_style('custom');

                        $color_gradient_card_css   =   "
                                                                        .gradient_card_$cont {
                                                                            background: linear-gradient(to right, $gradient_card, transparent);
                                                                            opacity: .9;
                                                                        }
                                                                    ";
                        wp_add_inline_style('custom', $color_gradient_card_css);
                        ?>
                                                            </div> 
                                        
                                                    <?php
                                                    $bubble = false;
                        if(!empty(get_field('call_action_bubble')) && !empty(get_field('call_to_action_sub_title'))  && !empty(get_field('call_to_action_text'))) {
                            $bubble = true;
                        }
                        ?>
                                <section class="dsn:absolute dsn:top-0 dsn:md:w-full dsn:h-full dsn:p-2 dsn:px-4 dsn:sm:p-8 dsn:md:p-2 dsn:md:px-4 dsn:lg:p-8">
                                    <?php if (get_field('promo_title')) { ?>
                                        <h3 class="dsn:font-extrabold dsn:text-white dsn:w-full"> <?php echo get_field('promo_title'); ?></h3>
                                    <?php } ?>
                                    <?php if (get_field('sub-title_card')) { ?>
                                        <p class="dsn:text-white dsn:w-full<?php if ($bubble) {
                                            echo ' dsn:md:w-4/5 dsn:lg:w-full';
                                        }?>"><?php echo get_field('sub-title_card'); ?></p>
                                    <?php } ?>    
                                    <?php if (!get_field('hide_promo_dates')) : ?>
                                            <h6 class="dsn:text-white dsn:w-full"><?php echo get_field('promo_start_date'); ?> - <?php echo get_field('promo_end_date'); ?> </h6>
                                    <?php endif; ?>
                                    <?php if (get_field('short_description_card')) { ?>
                                        <h6 class="dsn:text-white dsn:w-full<?php if ($bubble) {
                                            echo ' dsn:md:w-1/2 dsn:lg:w-3/5';
                                        }?>"><?php the_field('short_description_card'); ?></h6>
                                    <?php } ?> 
                                </section>
                                
                                <?php if($bubble) { ?>
                                    
                                    <section class="dsn:relative dsn:text-center dsn:bg-red-500 dsn:z-10 dsn:flex dsn:items-center dsn:justify-center dsn:md:justify-start dsn:md:absolute dsn:md:-bottom-32 dsn:md:-right-10 dsn:md:rounded-full dsn:p-2 dsn:md:pt-6 dsn:md:pr-2 dsn:flex-col bubble-card bubble_cont_<?php echo $cont; ?>"> 
                                    <!--<section class="relative text-center bg-red-500 z-10 flex items-center justify-center lg:justify-start lg:absolute lg:-bottom-16 lg:-right-10 lg:rounded-full lg:pt-6 md:pr-2 lg:flex-col bubble-card bubble_cont_<?php echo $cont; ?>">-->    
                                    
                                        <?php
                                            // Injecting CSS styles for color bubble
                                            $back_bubble    =   get_field('bubble_color');
                                    wp_register_style('custom', false);
                                    wp_enqueue_style('custom');

                                    $color_background_bubble_css   =   "
                                                .bubble_cont_$cont {
                                                    background: $back_bubble;
                                                }
                                            ";
                                    wp_add_inline_style('custom', $color_background_bubble_css);
                                    ?>
                                        <p class="dsn:text-black dsn:m-0"><?php the_field('call_action_bubble'); ?></p>
                                        <h3 class="dsn:font-bold dsn:m-0 dsn:py-0 dsn:text-black"><?php the_field('call_to_action_sub_title'); ?></h3>
                                        <p class="dsn:inline-block dsn:m-0 dsn:h-full dsn:my-auto dsn:text-black"><?php the_field('call_to_action_text'); ?></p>

                                        
                                    </section>
                                <?php   }   ?>
                            </a>
                        </li>
                    <?php }  $cont++;
                    endforeach;
                ?>
            </ul>
        </div>
    </section>
    <?php } else { ?>
        <section class="dsn:container">
        <div class="dsn:w-full">
        <?php echo get_the_content(); ?>
        </div>
        </section>
        <?php } ?>
    <br /><br />
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

 get_template_part('templates/footer'); ?>