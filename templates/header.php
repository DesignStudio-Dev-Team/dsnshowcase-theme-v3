<header class="dsn-bg-blue-600 dsn-text-white dsn-py-4">
    <div class="dsn-container dsn-mx-auto dsn-flex dsn-justify-between dsn-items-center">
        <h1 class="dsn-text-2xl dsn-font-bold"><?php bloginfo('name'); ?></h1>
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'dsn-flex dsn-space-x-4',
        )); ?>
    </div>
</header>