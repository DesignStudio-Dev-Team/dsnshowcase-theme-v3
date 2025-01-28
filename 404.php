<?php get_template_part('templates/header'); ?>
<main class="dsn:container dsn:mx-auto dsn:text-center">
    <h1 class="dsn:text-6xl dsn:font-bold dsn:text-red-500">404</h1>
    <p class="dsn:text-xl">Oops! The page you’re looking for doesn’t exist.</p>
    <a href="<?php echo home_url(); ?>" class="dsn:text-blue-600 dsn:hover:text-blue-800">Go back to the homepage</a>
</main>
<?php get_template_part('templates/footer'); ?>