<?php get_template_part('templates/header'); ?>
<main class="container mx-auto text-center">
    <h1 class="text-6xl font-bold text-red-500">404</h1>
    <p class="text-xl">Oops! The page you’re looking for doesn’t exist.</p>
    <a href="<?php echo home_url(); ?>" class="text-blue-600 hover:underline">Go back to the homepage</a>
</main>
<?php get_template_part('templates/footer'); ?>