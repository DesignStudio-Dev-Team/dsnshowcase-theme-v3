<?php
/**
 * Template for displaying product archives
 * 
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 * 
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_template_part('templates/header');
?>

<!-- Main Content Wrapper -->
<div class="dsn-container mx-auto p-6">

    <!-- WooCommerce Shop Page Header -->
    <header class="dsn-mb-8">
        <h1 class="dsn-text-3xl dsn-font-bold dsn-text-gray-800"><?php woocommerce_page_title(); ?></h1>
        <?php
        /**
         * Display category description or other header content
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>

    <!-- WooCommerce Product Loop -->
    <div class="dsn-grid dsn-grid-cols-1 sm:dsn-grid-cols-2 md:dsn-grid-cols-3 lg:dsn-grid-cols-4 gap-8">

        <?php if ( have_posts() ) : ?>

            <?php
            // Start the product loop
            woocommerce_product_loop_start();

            // Loop through products
            while ( have_posts() ) : the_post();
                wc_get_template_part( 'content', 'product' );
            endwhile;

            // End the product loop
            woocommerce_product_loop_end();
            ?>

        <?php else : ?>

            <p class="dsn-col-span-full dsn-text-center dsn-text-lg dsn-text-gray-500">
                <?php esc_html_e( 'No products found', 'your-theme' ); ?>
            </p>

        <?php endif; ?>

    </div>

    <!-- WooCommerce Pagination -->
    <div class="dsn-mt-6">
        <?php
        // WooCommerce pagination
        woocommerce_pagination();
        ?>
    </div>

</div>

<?php
get_template_part('templates/footer');
