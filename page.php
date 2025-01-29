<?php get_template_part('templates/header'); ?>
<main class="dsn:container dsn:mx-auto dsn:md:py-0 dsn:py-4">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('dsn-prose dsn:mx-auto'); ?>>
            <h1 class="dsn:text-4xl dsn:font-bold dsn:text-center dsn:md:text-left dsn:pb-4"><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>