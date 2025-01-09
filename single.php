<?php get_template_part('templates/header'); ?>
<main class="container mx-auto">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('prose mx-auto'); ?>>
            <h1 class="text-4xl font-bold"><?php the_title(); ?></h1>
            <div class="text-sm text-gray-500">Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?></div>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>