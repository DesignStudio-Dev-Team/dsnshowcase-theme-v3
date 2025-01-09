<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_template_part('templates/header'); ?>
    <main class="container mx-auto">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <?php get_template_part('templates/content', get_post_type()); ?>
        <?php endwhile; else: ?>
            <?php get_template_part('templates/content', 'none'); ?>
        <?php endif; ?>
    </main>
    <?php get_template_part('templates/footer'); ?>
    <?php wp_footer(); ?>
</body>
</html>
