<?php get_template_part('templates/header'); ?>
    <main class="dsn:container dsn:mx-auto">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <?php get_template_part('templates/content', get_post_type()); ?>
        <?php endwhile; else: ?>
            <?php get_template_part('templates/content', 'none'); ?>
        <?php endif; ?>
    </main>
<?php get_template_part('templates/footer'); ?>