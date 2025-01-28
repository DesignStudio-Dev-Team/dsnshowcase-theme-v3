<?php get_template_part('templates/header'); ?>
<main class="dsn:container dsn:mx-auto">
    <header class="dsn:mb-4">
        <h1 class="dsn:text-3xl dsn:font-bold">Search Results for: <?php echo get_search_query(); ?></h1>
    </header>
    <?php if (have_posts()): ?>
        <ul class="dsn:list-disc dsn:pl-5">
            <?php while (have_posts()): the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="dsn:text-blue-600"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No results found. Try a different search term.</p>
    <?php endif; ?>
</main>
<?php get_template_part('templates/footer'); ?>