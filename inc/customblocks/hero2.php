<?php

$hero2Content = get_field('hero_2_content', $block_id);
$title_and_cta = $hero2Content['title_and_cta'];
$title = $title_and_cta['title'];
$cta = $title_and_cta['cta'];
$bg = $title_and_cta['container_background'];
$text_color = $title_and_cta['text_color'];
$bar_position = $title_and_cta['bar_position'];
if($bar_position == 'top') {
    $bar_order = 'order-2';
    $top_row_order = 'order-3';
    $bottom_row_order = 'order-4';
}
if ($bar_position == 'middle') {
    $bar_order = 'order-3';
    $top_row_order = 'order-2';
    $bottom_row_order = 'order-4';
}
if ($bar_position == 'bottom') {
    $bar_order = 'order-4';
    $top_row_order = 'order-2';
    $bottom_row_order = 'order-3';
}
//print_r($cards);
?>


<div
    class="dsn:container dsn:mx-auto dsn:grid dsn:grid-cols-1">
    

    <?php

    if (have_rows('hero_2_content', $block_id)): ?>
    <div class="dsn:flex dsn:flex-col dsn:w-full dsn:md:flex-row dsn:flex-grow-1 dsn:basis-full dsn:gap-4 dsn:my-0 dsn:justify-center dsn:items-center dsn:px-4 dsn:md:px-0 dsn:py-2 dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3 dsn:order-2 dsn:md:<?php echo $top_row_order; ?>">
    <?php
        while (have_rows('hero_2_content', $block_id)):
            the_row();
            if (have_rows('top_row_images_and_title', $block_id)):
                while (have_rows('top_row_images_and_title', $block_id)):
                    the_row();

                    if (have_rows('cards', $block_id)):
                        while (have_rows('cards', $block_id)):
                            the_row();
                            $card_image = get_sub_field('card_image');
                            $card_title = get_sub_field('card_title');
                            $card_link = get_sub_field('card_link');
    ?>
                            <div
                                class="dsn:flex-auto dsn:w-full dsn:h-60 dsn:2xl:h-90 dsn:flex-grow-1 dsn:md:w-1/3 dsn:basis-50 dsn:md:basis-0 dsn:transition-all dsn:duration-1000 dsn:hover:flex-grow-2 dsn:relative dsn:!bg-cover dsn:!bg-center dsn:order-2 dsn:md:<?php echo $top_row_order; ?>"
                                style="background: url(<?php echo $card_image['url']; ?>);">
                                <a id="<?php echo strtolower(str_replace(' ', '-', trim($card_title))); ?>" class="dsn:flex dsn:w-full dsn:h-full dsn:text-white dsn:items-end dsn:justify-center dsn:p-4 dsn:before:absolute dsn:before:w-full dsn:before:h-full dsn:before:left-0 dsn:before:top-0 dsn:before:opacity-80 dsn:before:bg-linear-to-b dsn:before:from-transparent dsn:before:to-black dsn:before:from-70%"
                                    href="<?php echo $card_link['url']; ?>" role="button"><span class="dsn:z-10 dsn:text-xl dsn:xl:text-3xl"><?php echo $card_title; ?></span></a>
                            </div>
                        <?php endwhile;
                    endif;
                endwhile;
            endif;
        endwhile; ?>
        </div>
        <?php 
    endif;
    ?>


    <div 
        class="dsn:flex dsn:flex-col dsn:w-full dsn:md:flex-row dsn:flex-grow-1 dsn:basis-full dsn:gap-4 dsn:my-2 dsn:justify-center dsn:items-center dsn:px-4 dsn:md:px-6 dsn:py-6 dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3 dsn:order-1 dsn:md:<?php echo $bar_order; ?>" style="background-color: <?php echo $bg; ?>">
        <h1 class="dsn:mb-0 dsn:text-center dsn:text-2xl dsn:lg:text-5xl dsn:font-medium <?php if ($text_color == 'black') {
                                                                                                echo 'dsn:text-black';
                                                                                            } else {
                                                                                                echo 'dsn:text-white';
                                                                                            } ?>"><?php echo $title; ?></h1>
                                                                                            
                                                                                            <a
            class="dsn:py-4 dsn:px-6 dsn:bg-white dsn:hover:text-white dsn:text-lg dsn:md:text-xl dsn:shadow-md dsn:border-1 dsn:hover:border-white dsn:w-full dsn:md:w-auto dsn:text-center"
            id="" href="<?php echo $cta['url']; ?>" onmouseover="this.style.background='<?php echo $bg; ?>', this.style.color='white'" ; onmouseout="this.style.background='white', this.style.color='<?php echo $bg; ?>'" ; style="color: <?php echo $bg; ?>"><?php echo $cta['title']; ?></a>
    </div>

    <?php

    if (have_rows('hero_2_content', $block_id)): ?> 
        <div class="dsn:flex dsn:flex-col dsn:w-full dsn:md:flex-row dsn:flex-grow-1 dsn:basis-full dsn:py-2 dsn:gap-4 dsn:justify-center dsn:items-center dsn:px-4 dsn:md:px-0 dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3 dsn:order-3 dsn:md:<?php echo $bottom_row_order; ?>">
        <?php 
        while (have_rows('hero_2_content', $block_id)):
            the_row();
            if (have_rows('bottom_row_images_and_title', $block_id)):
                while (have_rows('bottom_row_images_and_title', $block_id)):
                    the_row();

                    if (have_rows('cards', $block_id)):
                        while (have_rows('cards', $block_id)):
                            the_row();
                            $card_image = get_sub_field('card_image');
                            $card_title = get_sub_field('card_title');
                            $card_link = get_sub_field('card_link');
    ?>
                            <div
                                class="dsn:w-full dsn:h-60 dsn:2xl:h-90 dsn:flex-grow-1 dsn:md:w-1/3 dsn:basis-50 dsn:md:basis-0 dsn:transition-all dsn:duration-1000 dsn:hover:flex-grow-2 dsn:relative dsn:!bg-cover dsn:!bg-center dsn:order-2 dsn:md:<?php echo $bottom_row_order; ?>"
                                style="background: url(<?php echo $card_image['url']; ?>);">
                                <a id="<?php echo strtolower(str_replace(' ', '-', trim($card_title))); ?>" class="dsn:flex dsn:w-full dsn:h-full dsn:text-white dsn:items-end dsn:justify-center dsn:p-4 dsn:before:absolute dsn:before:w-full dsn:before:h-full dsn:before:left-0 dsn:before:top-0 dsn:before:opacity-80 dsn:before:bg-linear-to-b dsn:before:from-transparent dsn:before:to-black dsn:before:from-70%"
                                    href="<?php echo $card_link['url']; ?>" role="button"><span class="dsn:z-10 dsn:text-xl dsn:xl:text-3xl dsn:mb-2"><?php echo $card_title; ?></span></a>
                            </div>
                    <?php endwhile;
                    endif;
                endwhile;
            endif;
        endwhile; ?>
        </div>
        <?php
    endif;
    ?>
</div>
<?php ?>
<div class="dsn:hidden dsn:order-1 dsn:order-2 dsn:order-3 dsn:md:order-1 dsn:md:order-2 dsn:md:order-3 dsn:md:order-4"></div>