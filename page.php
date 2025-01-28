<?php get_template_part('templates/header'); ?>
<main class="dsn:container dsn:mx-auto">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('dsn-prose dsn:mx-auto'); ?>>
            <h1 class="dsn:text-4xl dsn:font-bold"><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>