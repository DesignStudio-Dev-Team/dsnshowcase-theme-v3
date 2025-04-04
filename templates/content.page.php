<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dsnshowcase
 */

// Container settings. Width, padding-top and padding-bottom

// container_width
$container_width = get_field('container_width');
$container_w = '';
if ($container_width != 0) {
	$container_w = 'max-width: ' . $container_width . 'px; margin-left:auto; margin-right:auto;';
}

// container_padding_top
$container_padding_top = get_field('container_padding_top');
$container_pt = '';
if ($container_padding_top != 0) {
	$container_pt = 'padding-top: ' . $container_padding_top . 'px;';
}

// container_padding_bottom
$container_padding_bottom = get_field('container_padding_bottom');
$container_pb = '';
if ($container_padding_bottom != 0) {
	$container_pb = 'padding-bottom: ' . $container_padding_bottom . 'px;';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('dsn:px-10 dsn:mt-10 dsn:mb-16'); ?> style="<?php echo $container_w; ?><?php echo $container_pt; ?><?php echo $container_pb; ?>">

    <?php if (!is_front_page() && !is_page('cart') && !is_page('checkout')) { ?>
        <h2 class="dsn:text-2xl dsn:font-bold"><?php the_title(); ?></h2>
    <?php } ?>


    <div class="entry-content dsn:container dsn:mx-auto">
        <?php the_content(); ?>

        <?php get_template_part('templates/content', 'two-columns'); ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
