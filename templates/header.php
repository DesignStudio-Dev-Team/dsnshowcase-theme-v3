<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php get_template_part('templates/header1'); ?>
<!-- <header class="dsn-bg-blue-600 dsn-text-white dsn-py-4 dsn-mb-10">
    <div class="dsn-container dsn-mx-auto dsn-flex dsn-justify-between dsn-items-center">
        <h1 class="dsn-text-2xl dsn-font-bold"><a href="<?php
            echo esc_url(home_url('/'));
        ?>"><?php bloginfo('name'); ?></a></h1>
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'dsn-flex dsn-space-x-4',
        )); ?>
    </div>
</header> -->