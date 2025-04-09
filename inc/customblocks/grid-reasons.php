<?php 
$gridReasons = get_field('grid_reasons', $block_id);
$title = $gridReasons['title'];
$reasons = $gridReasons['reasons'];

?>

<section id="gridReasons" class="dsn:py-20 dsn:bg-gradient-to-b dsn:from-[#F2F9FF] dsn:to-transparent">
    <div class="dsn:text-center dsn:mb-10">
        <h2><?php echo $title; ?></h2>
    </div>
<?php if($reasons) { ?>
    <div id="grid-reasons" class="dsn:container dsn:mx-auto dsn:grid dsn:grid-cols-1 dsn:lg:grid-cols-2 dsn:xl:grid-cols-3 dsn:grid-rows-4 dsn:gap-5">
        <?php 
        $x = 1;
        foreach($reasons as $reason){ ?>
            <?php if ($x == 1) { ?>
                <div class="card-reason dsn:p-15 dsn:text-center dsn:row-span-4 dsn:bg-white dsn:shadow-lg dsn:border dsn:border-gray-200 dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:xl:min-h-[700px] <?php echo 'dsn:order-' . $x; ?>">
            <?php } else { ?>
                <div class="card-reason dsn:p-15 dsn:text-center dsn:row-span-2 dsn:bg-white dsn:shadow-lg dsn:border dsn:border-gray-200 dsn:flex dsn:flex-col dsn:items-center dsn:justify-center <?php echo 'dsn:order-' . $x; ?>">
            <?php } ?>
                <div class="hover-hide">
                    <span class="dsn:text-[60px] dsn:font-bold"><?php echo $x; ?></span>
                    <h2 class="dsn:text-4xl dsn:px-10"><?php echo $reason['label']; ?></h2>
                </div>
                <div class="hover-show">
                    <p class="dsn:text-lg dsn:xl:text-2xl"><?php echo $reason['reason']; ?></p>
                </div>
            </div>
        <?php 
        $x++;
            }
        ?>
    </div>
<?php } ?>


<style>
.card-reason span {
    color: var(--dealerColor);
}
.hover-show {
    display:none;
}
.hover-hide {
    display:block;
}
.card-reason:hover .hover-show {
    display:block;
}
.card-reason:hover .hover-hide {
    display:none;
}
</style>

</section>