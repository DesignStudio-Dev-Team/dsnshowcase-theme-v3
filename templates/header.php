<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold"><?php bloginfo('name'); ?></h1>
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'flex space-x-4',
        )); ?>
    </div>
</header>