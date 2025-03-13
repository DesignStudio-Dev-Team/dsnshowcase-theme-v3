<?php 
$processList = get_field('process_list', $block_id);
$title = $processList['title'];
$description = $processList['description'];
$mainImg = $processList['main_image'];
$hoverImg = $processList['hover_image'];
$list = $processList['list'];
$cta = $processList['cta'];
$bgImg = $processList['background_image'];
?>
<section class="dsn:my-10 dsn:py-25" style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;">
<div class="dsn:container dsn:mx-auto">
    <div class="dsn:w-full dsn:md:w-1/2 dsn:mx-auto dsn:text-center">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $description; ?></p>
    </div>
    <div class="dsn:block dsn:lg:flex dsn:flex-row dsn:justify-center dsn:items-center dsn:py-10 dsn:w-full dsn:2xl:w-[1415px] dsn:mx-auto">
        <div class="mainImgHover dsn:w-full dsn:lg:w-1/2 dsn:lg:pr-20">
            <img class="mainImg" src="<?php echo $mainImg; ?>" alt="<?php echo $title; ?>">
            <img class="hoverImg" src="<?php echo $hoverImg; ?>" alt="<?php echo $title; ?>">
        </div>
        <div class="dsn:w-full dsn:lg:w-1/2 dsn:pl-25 dsn:lg:px-20">
            <?php if($list) { ?>
                <div class="processList">
                    <?php 
                        $x = 1;
                    foreach($list as $process) { ?>
                    <div class="dsn:relative dsn:my-12">
                        <span class="processListNum dsn:absolute"><?php echo $x; ?> </span>
                        <div>
                           <h2 class="dsn:mb-0 dsn:pb-0"> <?php echo $process['title']; ?> </h2>
                           <p> <?php echo $process['description']; ?> </p>
                        </div>
                    </div>
                    <?php $x ++; }  ?>
                </div>
            <?php } ?>

            <?php if($cta) { ?>
                <div class="cta dsn:py-5">
                <a class="btn" href="<?php echo $cta['url']; ?>"> <?php echo $cta['title']; ?></a>
                </div> 
            <?php } ?>
        </div>
    </div>
</div>
</section>
<style>
    .processListNum {
        color:white;
        background: var(--dealerColor);
        border-radius: 50%; /* Makes it a circle */
        width: 66px; 
        height: 66px; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        position:absolute;
        left:-100px;
        top:0;

    }
    .hoverImg {
        display:none;
    }
    .mainImgHover:hover .hoverImg {
        display:block;
    }
    .mainImgHover:hover .mainImg {
        display:none;
    }
    
</style>