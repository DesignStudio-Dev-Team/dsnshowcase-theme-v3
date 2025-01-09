<?php get_template_part('templates/header'); ?>
<main class="container mx-auto">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('prose mx-auto'); ?>>
            <h1 class="text-4xl font-bold"><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>