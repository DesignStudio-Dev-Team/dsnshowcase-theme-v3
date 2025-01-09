<?php get_template_part('templates/header'); ?>
<main class="container mx-auto">
    <header class="mb-4">
        <h1 class="text-3xl font-bold">Search Results for: <?php echo get_search_query(); ?></h1>
    </header>
    <?php if (have_posts()): ?>
        <ul class="list-disc pl-5">
            <?php while (have_posts()): the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No results found. Try a different search term.</p>
    <?php endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>