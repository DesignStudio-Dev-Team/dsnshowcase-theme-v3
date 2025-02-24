<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package DSNShowcase Theme
 */

get_template_part('templates/header'); 

global $dssSiteLanguage;

$viewStyle = 'Grid'; ?>

<style>
    .nav-links {
        height: 40px;
        text-align: center;
    }

    .nav-links .page-numbers {
        padding-left: 3px;
        padding-right: 3px;
    }

    .nav-links a {
        color: var(--dsw-main-dealer-color);
    }

    .nav-links a:hover {
        color: var(--dsw-main-dealer-hover);
    }

    .nav-links .nav-previous {
        float: right;
    }

    .nav-links .nav-next {
        float: left;
    }
</style>

<div class="dsn:container dsn:px-6">
    <section id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            if (have_posts()) : ?>
                    <?php
                    global $wp_query;
                    $args = array_merge($wp_query->query_vars, ['posts_per_page' => '12']);
                    $search = new WP_Query($args);


                    ?>

                <header class="page-header">
                    <h3 class="page-title dsn:mt-8 dsn:mb-18">
                        <?php echo $search->found_posts . ' ' . dssLang($dssSiteLanguage)->search->results . ': <b>' . get_search_query() . '</b>'; ?>
                    </h3>
                </header><!-- .page-header -->

                <div class="dsn:grid dsn:gap-4 dsn:grid-cols-3">

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post(); ?>

                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        if (get_post_type() != 'reusable_block')
                            get_template_part('templates/content', 'search');
                        ?>


                    <?php endwhile; ?>
                </div>

                <div class="dsn:grid dsn:gap-4 dsn:grid-cols-1 dsn:lg:grid-cols-3 dsn:text-xl dsn:mt-4">
                    <div>
                        <?php the_posts_navigation(['prev_text' => '<span class="hidden">prev</span>', 'next_text' => '&laquo; ' . dssLang($dssSiteLanguage)->search->previous_link]); ?>
                    </div>
                    <div>
                        <?php the_posts_pagination(['mid_size' => 3, 'prev_text' => 'previous', 'next_text' => 'next']); ?>
                    </div>
                    <div>
                        <?php the_posts_navigation(['prev_text' => dssLang($dssSiteLanguage)->search->next_link . ' &raquo;', 'next_text' => '<span class="hidden">next</span>']); ?>
                    </div>
                </div>

            <?php

            else :

                get_template_part('templates/content', 'none');

            endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->
</div>

<style>
.nav-links .prev, .nav-links .next
{
    display: none;
}

    </style>

<?php
get_template_part('templates/footer');
