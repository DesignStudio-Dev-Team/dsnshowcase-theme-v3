<?php 
$gridBrands = get_field('grid_brands', $block_id);
$title = $gridBrands['title'];
$brands = $gridBrands['brands'];

?>


<section id="gridBrands" class="dsn:py-20 dsn:px-0">
    <div class="dsn:text-left dsn:md:text-center dsn:mb-15">
        <h2><?php echo $title; ?></h2>
    </div>
<?php if($brands) { ?>
    <div id="grid-brands" class="dsn:container dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-4 dsn:grid-rows-4 dsn:gap-5">
    <?php 
        $x = 1;
        foreach($brands as $brand){ 
            $hoverColor = $brand['background_color_logo'];  
            //convert it to a lower transparency
            $hoverColor = hex2rgba($hoverColor, 0.8);
        ?>
            <?php if ($x == 1) { ?>
                <div class="card-brand dsn:relative dsn:p-0 dsn:text-center dsn:col-span-2 dsn:row-span-4 dsn:bg-white dsn:flex dsn:flex-col dsn:min-h-[350px] dsn:lg:min-h-[800px] <?php echo 'dsn:order-' . $x; ?>">
            <?php } else { ?>
                <div class="card-brand dsn:cursor-pointer dsn:relative dsn:p-0 dsn:text-center dsn:lg:col-span-1 dsn:col-span-2 dsn:row-span-2 dsn:bg-white dsn:flex dsn:flex-col dsn:min-h-[500px] dsn:lg:min-h-[300px] <?php echo 'dsn:order-' . $x; ?>">
            <?php } ?>
                
                    <div class="dsn:h-[95%] dsn:relative dsn:w-full" style="background: url(<?php echo $brand['main_image']; ?>) no-repeat center center; background-size: cover;">
                        <a href="<?php echo $brand['link']; ?>" aria-label="<?php echo $brand['name']; ?>"><div class="hover-show dsn:h-[100%] dsn:w-full dsn:absolute dsn:top-0 dsn:left-0 dsn:flex dsn:justify-center dsn:justify-items-center dsn:place-content-center dsn:items-center " style="background-color:<?php echo $hoverColor; ?>; no-repeat center center; background-size: cover;">
                        <img src="<?php echo $brand['logo']; ?>" alt="<?php echo $brand['name']; ?>">   
                        </div></a>
                    </div>
                    <div class="pt-5">
                        <h3 class="dsn:py-5"><a href="<?php echo $brand['link']; ?>"><?php echo $brand['name']; ?></a></h3>
                    </div>
             
                
            </div>
        <?php 
        $x++;
            }
        ?>
    </div>
<?php } ?>
</section>

<style>
    #grid-brands h2 {
        color: var(--dealerColor);
    }


    .hover-show {
        display:none;
    }
    
    .card-brand:hover .hover-show {
        display:block;
    }
  
</style>