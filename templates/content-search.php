<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dsShowcase Theme
 */


global $dssSiteLanguage;
?>

<style>

#dsShowcaseContent .search-result-content
{
    box-shadow: 0px 2px 10px 0px rgb(112 112 112 / 50%);
}

#dsShowcaseContent .search-result-image-holder img
{
    margin: 0 auto;
}

#dsShowcaseContent .truncate-lines {
  height: 22rem;
  line-height: 2rem;
  display: block;
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
}

.search-result-content .search-border{
    border-color: var(--dsw-main-dealer-color);
}

.search-result-content .search-border:hover{
    border-color: var(--dsw-main-dealer-hover);
}

.search-result-content a,
.search-result-content a .read-more{
    color: var(--dsw-main-dealer-color);
}

.search-result-content a:hover{
    color: var(--dsw-main-dealer-hover);
}
</style>

<?php
$viewStyle = 'Grid';
?>

<div class="search-result-content dsn:w-full dsn:border dsn:border-gray-400">
    <a href="<?php echo get_permalink();?>">
        <div class="dsn:text-xl dsn:p-5 dsn:border-t-8 dsn:cursor-pointer search-border">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
                <header class="entry-header">
                    <h3 class="entry-title font-bold truncate"><?php echo get_the_title ();?></h3>
                </header>

             
                    <div class="search-result-image-holder my-4 hidden sm:block">
                        <?php if (get_the_post_thumbnail()) { ?>
                            <div class="search-image-content h-88">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php } else { ?>
                            
                            <p class="truncate-lines"><?php echo substr ( strip_tags (get_the_excerpt()), 0, 500); ?><?php if (get_the_excerpt()) { ?>...<?php } ?></p>
                        <?php } ?>
                    </div>
             
                
                <div class="dsn:my-4<?php if ($viewStyle == 'Grid') { ?> block sm:hidden<?php } ?>">
                    <p><?php echo substr ( strip_tags (get_the_excerpt()), 0, 500); ?><?php if (get_the_excerpt()) { ?>...<?php } ?></p>
                </div>

                <footer class="entry-footer">
                    <div class="dsn:float-right read-more"><?php echo dssLang($dssSiteLanguage)->search->view_link;?></div>
                    <div><?php
                        $post_type_object = get_post_type_object(get_post_type());
                        if ( $post_type_object ) {
                            echo esc_html( $post_type_object->labels->singular_name );
                        }?>
                    </div>
                </footer>
            </article><!-- #post-<?php the_ID(); ?> -->
        </div>
    </a>
</div>
