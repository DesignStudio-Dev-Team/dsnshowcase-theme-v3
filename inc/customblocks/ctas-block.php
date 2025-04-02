<?php 
$ctas_banner = get_field('ctas_block', $block_id);
$cta_content = $ctas_banner['content'];
$cta1 = $ctas_banner['cta1'];
$cta2 = $ctas_banner['cta2'];
$bgImg = $ctas_banner['background'];
?>

<section style="background: url('<?php echo $bgImg; ?>') no-repeat center center; background-size: cover;" class="dsnctasBlock dsn:min-h-[245px] dsn:w-full dsn:block dsn:lg:flex dsn:gap-10 dsn:my-10 dsn:justify-center dsn:align-middle dsn:items-center">
    <div class="dsnctasContent dsn:w-full dsn:lg:w-1/2 dsn:p-5 dsn:lg:p-10 dsn:lg:pt-25 dsn:block dsn:lg:flex dsn:flex-col">
        <?php echo $cta_content; ?>
    </div>
    <div class="dsn:w-full dsn:lg:w-1/2 dsn:p-5 dsn:lg:p-10 dsn:justify-items-center dsn:justify-center dsn:flex dsn:flex-col">
        <a class="btn dsn:mt-5 dsn:justify-center dsn:lg:justify-start dsn:lg:self-start" href="<?php echo $cta1['url']; ?>"><?php echo $cta1['title']; ?></a>
        <a class="btn dsn:mt-5 dsn:justify-center dsn:lg:justify-start dsn:lg:self-start" href="<?php echo $cta2['url']; ?>"><?php echo $cta2['title']; ?></a>
    </div>
</section>

<style>
    .dsnctasBlock .btn {
        /* all buttons should be the same width */
        max-width: 40%;
        text-align: center;
        width:100%;
    }
    @media (max-width: 1028px) {
        .dsnctasBlock .btn {
            max-width: 100%;
        }
        .dsnctasContent h2, .ctasContent p {
            text-align: center !important;
        }
    }
</style>