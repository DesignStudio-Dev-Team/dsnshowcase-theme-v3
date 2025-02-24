<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dsnShowcase Theme
 */

// get the parts of the URL
// since the page cannot be found, we will search
// based on the text in the url site.com/water-care <- search for water care


$url_parts = parse_url($_SERVER['REQUEST_URI']);

$search_query = preg_replace("/[^A-Za-z0-9]/", " ", $url_parts['path']);

$args = array('s' => $search_query);

$the_query = new WP_Query($args);

$viewStyle = 'Grid';

get_template_part('templates/header'); 


global $dssSiteLanguage;
?>

<style>
    #searchform input[type="search"]::-webkit-search-decoration,
    #searchform input[type="search"]::-webkit-search-cancel-button,
    #searchform input[type="search"]::-webkit-search-results-button,
    #searchform input[type="search"]::-webkit-search-results-decoration {
        -webkit-appearance: none;
    }

    .error-search-content .searchform {
        width: 424px;
        max-width: 100%;
        font-size: 30px;
        border: 1px #ccc solid;
        padding: 4px;
        padding-left: 20px;
        margin: 5px;
    }

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

<div id="primary" class="">
    <main id="main" class="site-main dsn:container dsn:mx-auto">

        <section class="error-404 not-found dsn:container dsn:mx-auto">

            <?php if (!$the_query->have_posts()) { ?>
                <div class="dsn:grid dsn:place-items-center dsn:mt-20">
                    <div class="dsn:px-10 dsn:text-center">

                        <svg class="dsn:max-w-full" xmlns="http://www.w3.org/2000/svg" width="531" height="300" viewBox="0 0 531 300"><text transform="translate(0 231)" fill="#dedede" font-size="300" font-family="Helvetica-Bold, Helvetica" font-weight="700" letter-spacing="0.05em">
                                <tspan x="0" y="0">404</tspan>
                            </text></svg>
                    </div>
                </div>
            <?php } ?>

            <header class="page-header">
                <h1 class="page-title dsn:text-3xl dsn:md:text-6xl dsn:text-center mt-5">
                    <?php echo dssLang($dssSiteLanguage)->error_404->cannot_be_found; ?>
                </h1>
            </header><!-- .page-header -->

            <div class="page-content dsn:text-center">

                <?php if (!$the_query->have_posts()) { ?>
                    <p class="dsn:text-xl dsn:md:text-2xl dsn:text-center dsn:mt-5">
                        <?php echo dssLang($dssSiteLanguage)->error_404->nothing_found; ?>    
                    </p>
                <?php } ?>

                <div class="error-search-content dsn:grid dsn:place-items-center dsn:my-10">
                    <div>
                        <?php get_search_form(); ?>
                    </div>
                </div>


            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->

<script>
    $(document).ready(function() {
        $('#search-results-view-style').change(function() {
            window.location = '<?php echo $url_parts['path']; ?>?view=' + $(this).val();
        });

        $('#searchform input').val('<?php echo $search_query; ?>');
    });
</script>

<?php
get_template_part('templates/footer');?> 