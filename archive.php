<?php get_template_part('templates/header'); ?>
<main class="container mx-auto">
    <header class="mb-4">
        <h1 class="text-3xl font-bold"><?php the_archive_title(); ?></h1>
        <p><?php the_archive_description(); ?></p>
    </header>
    <?php if (have_posts()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('border p-4 rounded-lg shadow-lg'); ?>>
                    <h2 class="text-2xl font-bold">
                        <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline"><?php the_title(); ?></a>
                    </h2>
                    <div class="text-gray-500 text-sm"><?php echo get_the_date(); ?></div>
                    <p><?php the_excerpt(); ?></p>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>