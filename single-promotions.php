<?php 
get_header();
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

        $showForm = false;
        $hasPDF = false;
        $cont = 1;
        if (get_field( 'promo_action' ) == 'PDF Download' && get_field('promo_pdf'))
            $hasPDF = true;

        if (get_field( 'promo_action' ) == 'Form' && get_field('form'))
            $showForm = true;

            if ($hasPDF)
            {
                $pdfLink = wp_get_attachment_url (get_field('promo_pdf'));
            } else {
                $pdfLink = null;
            }

    ;?>
    <main class="dsn:relative">
        <div class="dsn:relative dsn:pb-2 dsn:md:pb-0">
            <div class="dsn:md:absolute dsn:top-0 dsn:bg-gray-100 dsn:w-full dsn:md:h-48 dsn:pb-1 dsn:md:pb-0 dsn:pt-6 dsn:text-center">
                <h1 class="dsn:text-4xl">
                <?php echo the_title(); ?>    
                <?php //the_field('short_description_title'); ?></h1>
            </div>
        </div>
        <div class="dsn:md:flex dsn:px-10 dsn:md:pt-32">

        
            <div class="dsn:container promotion-card-list">
                <?php
                    if( have_posts(  ) ):
                        while( have_posts(  ) ):    the_post(  );   ?>
                            <div class="single-promotion-container">
                                <section class="dsn:mb-10">
                               
                                    <div class="dsn:grid dsn:gap-4 dsn:grid-cols-1 dsn:mx-auto dsn:max-w-2xl dsn:md:max-w-full<?php if ($showForm) { ?> dsn:md:grid-cols-2<?php }  ?>">
                                        <div>
                                            
                                            <!-- start -->

                                            <div class="<?php if ($showForm) { ?> dsn:md:hidden <?php } ?> dsn:relative dsn:text-white dsn:md:border-8 dsn:md:border-white dsn:overflow-hidden dsn:mx-auto dsn:border">
                                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="dsn:w-full promotion-details-image" style="height:unset;"/>
                                                <?php //the_post_thumbnail( 'full' ); ?>
                                                        <div class="dsn:absolute dsn:top-0 dsn:w-full dsn:h-full gradient_card">
                                                            <?php 
                                                                //  CSS styles
                                                                $gradient_card    =   get_field( 'color_gradient' );
                                                                wp_register_style('custom', false);
                                                                wp_enqueue_style('custom');

                                                                $color_gradient_card_css   =   "
                                                                    .gradient_card {
                                                                        background: linear-gradient(to right, $gradient_card, transparent);
                                                                        opacity: .9;
                                                                    }
                                                                ";
                                                                wp_add_inline_style( 'custom', $color_gradient_card_css );
                                                            ?>
                                                        </div>

                                                <?php
                                                $bubble = false;
                                                if(!empty(get_field( 'call_action_bubble' )) && !empty(get_field( 'call_to_action_sub_title' ))  && !empty(get_field( 'call_to_action_text' )) ){
                                                    $bubble = true;
                                                }
                                                ?>
                                                <section class="dsn:absolute dsn:top-0 dsn:md:w-full dsn:h-full dsn:p-2 dsn:px-4 dsn:sm:p-8 dsn:md:p-2 dsn:md:px-4 dsn:lg:p-8">
                                                    <?php if (get_field( 'promo_title' )) { ?>
                                                        <h3 class="dsn:font-extrabold dsn:text-white dsn:w-full"> <?php echo get_field('promo_title'); ?></h3>
                                                    <?php } ?>
                                                    <?php if (get_field( 'sub-title_card' )) { ?>
                                                        <p class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-4/5 dsn:lg:w-full';}?>"><?php echo get_field( 'sub-title_card' ); ?></p>
                                                    <?php } ?>    
                                                    <?php if ( !get_field('hide_promo_dates') ) : ?>
                                                            <h6 class="dsn:text-white dsn:w-full"><?php echo get_field('promo_start_date'); ?> - <?php echo get_field('promo_end_date'); ?> </h6>
                                                    <?php endif; ?>
                                                    <?php if (get_field( 'short_description_card' )) { ?>
                                                        <h6 class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-1/2 dsn:lg:w-3/5';}?>"><?php the_field( 'short_description_card' ); ?></h6>
                                                    <?php } ?>
                                                </section>
                                                <?php if($bubble) { ?>
                                    
                                                    <section class="dsn:relative dsn:text-center dsn:bg-red-500 dsn:z-10 dsn:flex dsn:items-center dsn:justify-center dsn:lg:justify-start dsn:lg:absolute dsn:lg:bottom-0 dsn:lg:right-10 dsn:lg:rounded-full dsn:p-2 dsn:lg:pt-6 dsn:lg:pr-2 dsn:flex-col bubble-card bubble_cont_<?php echo $cont; ?>"> 
                                                    <!--<section class="relative text-center bg-red-500 z-10 flex items-center justify-center lg:justify-start lg:absolute lg:-bottom-16 lg:-right-10 lg:rounded-full lg:pt-6 md:pr-2 lg:flex-col bubble-card bubble_cont_<?php echo $cont; ?>">-->    
                                                    
                                                        <?php
                                                            // Injecting CSS styles for color bubble
                                                            $back_bubble    =   get_field( 'bubble_color' );
                                                            wp_register_style('custom', false);
                                                            wp_enqueue_style('custom');

                                                            $color_background_bubble_css   =   "
                                                                .bubble_cont_$cont {
                                                                    background: $back_bubble;
                                                                }
                                                            ";
                                                            wp_add_inline_style( 'custom', $color_background_bubble_css );
                                                        ?>
                                                        <p class="dsn:text-black dsn:m-0"><?php the_field( 'call_action_bubble' ); ?></p>
                                                        <h3 class="dsn:font-bold dsn:m-0 dsn:py-0 dsn:text-black"><?php the_field( 'call_to_action_sub_title' ); ?></h3>
                                                        <p class="dsn:inline-block dsn:m-0 dsn:h-full dsn:my-auto dsn:text-black"><?php the_field( 'call_to_action_text' ); ?></p>

                                                        
                                                    </section>
                                                <?php   }   ?>
                                                
                                                
                                            </div>

                                            <!-- end -->


                                   
                                            <?php if ($pdfLink) { ?>
                                                <div class="dsn:text-center">
                                                    <a href="<?php echo $pdfLink;?>" target="_blank" class="dsw-primary-site-link">View Promotion PDF</a>  
                                                </div>
                                            <?php } ?>
                                                
                                            <div class="dsn:mx-auto dsn:h-full dsn:bg-white dsn:relative dsn:p-4 dsn:drop-shadow-2xl dsn:border dsn:border-gray-300">
                                            <div class="dsn:m-2<?php if (!$showForm) { ?> promotion-details-image<?php } ?>">
                                                <?php if(get_field('promo_start_date') && get_field('promo_end_date') && !get_field('hide_promo_dates')) {  ?>
                                                    <p><?php the_field('promo_start_date'); ?> - <?php the_field('promo_end_date'); ?></p>
                                                <?php } ?> 
                                                
                                                

                                                <?php if (get_field('promotion_show_image_on') == 'left') { ?>
                                                    <div class="dsn:hidden dsn:md:block dsn:w-full dsn:relative dsn:text-white dsn:md:border-8 dsn:md:border-white dsn:overflow-hidden dsn:max-w-fit dsn:mx-auto dsn:border">
                                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="w-full promotion-details-image" style="height:unset;"/>
                                                        <?php //the_post_thumbnail( 'full' ); ?>
                                                                <div class="dsn:absolute dsn:top-0 dsn:w-full dsn:h-full gradient_card">
                                                                    <?php 
                                                                        //  CSS styles
                                                                        $gradient_card    =   get_field( 'color_gradient' );
                                                                        wp_register_style('custom', false);
                                                                        wp_enqueue_style('custom');

                                                                        $color_gradient_card_css   =   "
                                                                            .gradient_card {
                                                                                background: linear-gradient(to right, $gradient_card, transparent);
                                                                                opacity: .9;
                                                                            }
                                                                        ";
                                                                        wp_add_inline_style( 'custom', $color_gradient_card_css );
                                                                    ?>
                                                                </div>

                                                        <?php
                                                        $bubble = false;
                                                        if(!empty(get_field( 'call_action_bubble' )) && !empty(get_field( 'call_to_action_sub_title' ))  && !empty(get_field( 'call_to_action_text' )) ){
                                                            $bubble = true;
                                                        }
                                                        ?>
                                                        <section class="dsn:absolute dsn:top-0 dsn:left-5 dsn:md:w-full dsn:h-full dsn:py-2 dsn:sm:py-8 dsn:md:py-2 dsn:lg:py-8">
                                                            <?php if (get_field( 'promo_title' )) { ?>
                                                                <h3 class="dsn:font-extrabold dsn:text-white dsn:w-full"> <?php echo get_field('promo_title'); ?></h3>
                                                            <?php } ?>
                                                            <?php if (get_field( 'sub-title_card' )) { ?>
                                                                <p class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-4/5 dsn:lg:w-full';}?>"><?php echo get_field( 'sub-title_card' ); ?></p>
                                                            <?php } ?>    
                                                            <?php if ( !get_field('hide_promo_dates') ) : ?>
                                                                    <h6 class="dsn:text-white dsn:w-full"><?php echo get_field('promo_start_date'); ?> - <?php echo get_field('promo_end_date'); ?> </h6>
                                                            <?php endif; ?>
                                                            <?php if (get_field( 'short_description_card' )) { ?>
                                                                <h6 class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-1/2 dsn:lg:w-3/5';}?>"><?php the_field( 'short_description_card' ); ?></h6>
                                                            <?php } ?>
                                                        </section>
                                                        <?php if($bubble) { ?>
                                            
                                                            <section class="dsn:relative dsn:text-center dsn:bg-red-500 dsn:z-10 dsn:flex dsn:items-center dsn:justify-center dsn:lg:justify-start dsn:lg:absolute dsn:lg:bottom-10 dsn:lg:right-10 dsn:lg:rounded-full dsn:p-2 dsn:lg:pt-6 dsn:lg:pr-2 dsn:flex-col bubble-card bubble_cont_<?php echo $cont; ?>"> 
                                                            <!--<section class="relative text-center bg-red-500 z-10 flex items-center justify-center lg:justify-start lg:absolute lg:-bottom-16 lg:-right-10 lg:rounded-full lg:pt-6 md:pr-2 lg:flex-col bubble-card bubble_cont_<?php echo $cont; ?>">-->    
                                                            
                                                                <?php
                                                                    // Injecting CSS styles for color bubble
                                                                    $back_bubble    =   get_field( 'bubble_color' );
                                                                    wp_register_style('custom', false);
                                                                    wp_enqueue_style('custom');

                                                                    $color_background_bubble_css   =   "
                                                                        .bubble_cont_$cont {
                                                                            background: $back_bubble;
                                                                        }
                                                                    ";
                                                                    wp_add_inline_style( 'custom', $color_background_bubble_css );
                                                                ?>
                                                                <p class="dsn:text-black dsn:m-0"><?php the_field( 'call_action_bubble' ); ?></p>
                                                                <h3 class="dsn:font-bold dsn:m-0 dsn:py-0 dsn:text-black"><?php the_field( 'call_to_action_sub_title' ); ?></h3>
                                                                <p class="dsn:inline-block dsn:m-0 dsn:h-full dsn:my-auto dsn:text-black"><?php the_field( 'call_to_action_text' ); ?></p>

                                                                
                                                            </section>
                                                        <?php   }   ?>
                                                        
                                                        
                                                    </div>
                                                <?php } ?>
                                                    
                                                <?php if (get_field('short_description')) { ?>
                                                <div class="single-promotion-body"><?php echo str_replace ('<br /><p>&nbsp;</p><br />', '<br />', str_replace ("\n", "<br />", get_field('short_description'))); ?></div>
                                                <?php } ?> 
                                            </div>
                                            </div>
                                                </div>
                                        
                                        <?php if ($showForm) { ?>
                                        <div class="dsn:mx-0 form-single-promotions_    dsn:relative dsn:bg-white dsn:p-4 dsn:drop-shadow-2xl dsn:border dsn:border-gray-300">
                                            

                                            <!-- start -->
                                            <?php if (get_field('promotion_show_image_on') == 'right' || !get_field('promotion_show_image_on')) { ?>
                                                <div class="dsn:hidden dsn:md:block dsn:w-full dsn:relative dsn:text-white dsn:md:border-8 dsn:md:border-white dsn:overflow-hidden dsn:max-w-fit dsn:mx-auto dsn:border">
                                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="dsn:w-full promotion-details-image" style="height:unset;"/>
                                                    <?php //the_post_thumbnail( 'full' ); ?>
                                                            <div class="dsn:absolute dsn:top-0 dsn:w-full dsn:h-full gradient_card">
                                                                <?php 
                                                                    //  CSS styles
                                                                    $gradient_card    =   get_field( 'color_gradient' );
                                                                    wp_register_style('custom', false);
                                                                    wp_enqueue_style('custom');

                                                                    $color_gradient_card_css   =   "
                                                                        .gradient_card {
                                                                            background: linear-gradient(to right, $gradient_card, transparent);
                                                                            opacity: .9;
                                                                        }
                                                                    ";
                                                                    wp_add_inline_style( 'custom', $color_gradient_card_css );
                                                                ?>
                                                            </div>

                                                    <?php
                                                    $bubble = false;
                                                    if(!empty(get_field( 'call_action_bubble' )) && !empty(get_field( 'call_to_action_sub_title' ))  && !empty(get_field( 'call_to_action_text' )) ){
                                                        $bubble = true;
                                                    }
                                                    ?>
                                                    <section class="dsn:absolute dsn:top-0 dsn:md:w-full dsn:h-full dsn:p-2 dsn:px-4 dsn:sm:p-8 dsn:md:p-2 dsn:md:px-4 dsn:lg:p-8">
                                                        <?php if (get_field( 'promo_title' )) { ?>
                                                            <h3 class="dsn:font-extrabold dsn:text-white dsn:w-full"> <?php echo get_field('promo_title'); ?></h3>
                                                        <?php } ?>
                                                        <?php if (get_field( 'sub-title_card' )) { ?>
                                                            <p class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-4/5 dsn:lg:w-full';}?>"><?php echo get_field( 'sub-title_card' ); ?></p>
                                                        <?php } ?>    
                                                        <?php if ( !get_field('hide_promo_dates') ) : ?>
                                                                <h6 class="dsn:text-white dsn:w-full"><?php echo get_field('promo_start_date'); ?> - <?php echo get_field('promo_end_date'); ?> </h6>
                                                        <?php endif; ?>
                                                        <?php if (get_field( 'short_description_card' )) { ?>
                                                            <h6 class="dsn:text-white dsn:w-full<?php if ($bubble) {echo ' dsn:md:w-1/2 dsn:lg:w-3/5';}?>"><?php the_field( 'short_description_card' ); ?></h6>
                                                        <?php } ?>
                                                    </section>
                                                    <?php if($bubble) { ?>
                                        
                                                        <section class="dsn:relative dsn:text-center dsn:bg-red-500 dsn:z-10 dsn:flex dsn:items-center dsn:justify-center dsn:lg:justify-start dsn:lg:absolute dsn:lg:bottom-0 dsn:lg:right-10 dsn:lg:rounded-full dsn:p-2 dsn:lg:pt-6 dsn:lg:pr-2 dsn:flex-col bubble-card bubble_cont_<?php echo $cont; ?>"> 
                                                        <!--<section class="relative text-center bg-red-500 z-10 flex items-center justify-center lg:justify-start lg:absolute lg:-bottom-16 lg:-right-10 lg:rounded-full lg:pt-6 md:pr-2 lg:flex-col bubble-card bubble_cont_<?php echo $cont; ?>">-->    
                                                        
                                                            <?php
                                                                // Injecting CSS styles for color bubble
                                                                $back_bubble    =   get_field( 'bubble_color' );
                                                                wp_register_style('custom', false);
                                                                wp_enqueue_style('custom');

                                                                $color_background_bubble_css   =   "
                                                                    .bubble_cont_$cont {
                                                                        background: $back_bubble;
                                                                    }
                                                                ";
                                                                wp_add_inline_style( 'custom', $color_background_bubble_css );
                                                            ?>
                                                            <p class="dsn:text-black dsn:m-0"><?php the_field( 'call_action_bubble' ); ?></p>
                                                            <h3 class="dsn:font-bold dsn:m-0 dsn:py-0 dsn:text-black"><?php the_field( 'call_to_action_sub_title' ); ?></h3>
                                                            <p class="dsn:inline-block dsn:m-0 dsn:h-full dsn:my-auto dsn:text-black"><?php the_field( 'call_to_action_text' ); ?></p>

                                                            
                                                        </section>
                                                    <?php   }   ?>
                                                    
                                                    
                                                </div>
                                            <?php } ?>

                                            <!-- end -->

                                            <?php if (get_field('short_description_right')) { ?>
                                            <div class="single-promotion-body"><?php echo str_replace ('<br /><p>&nbsp;</p><br />', '<br />', str_replace ("\n", "<br />", get_field('short_description_right'))); ?></div>
                                            <?php } ?> 
                                            <div class="dsn:p-2"><?php the_field('form'); ?></div>
                                            </div>
                                        <?php } ?>
                                        
                                            </div>
                                </section>
                            </div>
                        <?php   endwhile;
                    endif;
                ?>
            </div>
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

 get_template_part('templates/footer'); ?>

<style>

.single-promotion-body
{
    margin-left: 10px;
    margin-right: 10px;
}

.single-promotion-body ul
{
    padding-left: 20px;
    list-style-type:disc;
    padding-top: 5px;
    padding-bottom: 5px;
}

@media (min-width: 992px)
{
    .single-promotion-body ul
    {
        padding-left: 40px;
    }
}

.single-promotion-body ul li
{
    list-style-type: disc;
    padding-top: 5px;
    padding-bottom: 10px;
    font-size: 1rem;
    line-height: 1.5rem;
}

@media (min-width: 992px)
{
    .single-promotion-body ul li {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }
}

@media (min-width: 1200px)
{
    .single-promotion-body ul li {
        font-size: 1.25rem;
        line-height: 1.75rem;
    }
}

.max-w-fit
{
    max-width: fit-content;
}

.promotion-details-image {
    min-width: 100%;
}


<?php if (!$showForm) { ?>
@media (min-width: 640px)
{
    .promotion-details-image {
        min-width: 600px;
    }
}

@media (min-width: 768px)
{
    .promotion-details-image {
        min-width: 700px;
    }
}
<?php } ?>

</style>
<?php get_footer(); ?>