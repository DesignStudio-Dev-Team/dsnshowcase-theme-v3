<?php get_header(); ?>
<main class="dsn:container dsn:mx-auto">
    <header class="dsn:mb-4">
        <h1 class="dsn:text-3xl dsn:font-bold dsn:text-center dsn:md:text-left"><?php the_archive_title(); ?></h1>
        <p><?php the_archive_description(); ?></p>
    </header>
    <?php if (have_posts()): ?>
        <div class="dsn:grid dsn:grid-cols-1 dsn:md:grid-cols-2 dsn:lg:grid-cols-3 dsn:gap-4">
            <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('dsn:border dsn:p-4 dsn:rounded-lg dsn:shadow-lg'); ?>>
                    <h2 class="dsn:text-2xl dsn:font-bold">
                        <a href="<?php the_permalink(); ?>" class="dsn:text-blue-600"><?php the_title(); ?></a>
                    </h2>
                    <div class="dsn:text-gray-500 dsn:text-sm"><?php echo get_the_date(); ?></div>
                    <p><?php the_excerpt(); ?></p>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>