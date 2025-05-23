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
    border-color: var(--dealerLinkColor);
}


.search-result-content a,
.search-result-content a .read-more{
    color: var(--dealerLinkColor);
}
.search-image-content img {
  height: 300px;
  object-fit: cover;
  object-position: center;
  width: 100%;
}
.search-result-content article {
	min-height: 650px; 
	position: relative;
	}
	footer.entry-footer {
	  position: absolute;
	  width: 100%;
	  bottom: 0;
	  left: 0;
	}
	header.entry-header {
		  min-height: 100px;
		}
</style>

<?php
$viewStyle = 'Grid';
?>

<div class="search-result-content dsn:w-full dsn:border dsn:border-gray-400">
 
        <div class="dsn:text-xl dsn:p-5 dsn:border-t-8 search-border">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <a class="dsn:cursor-pointer" href="<?php echo get_permalink();?>">
                <header class="entry-header">
                    <h4 class="entry-title font-bold truncate"><?php echo substr ( strip_tags (get_the_title()), 0, 45); ?><?php if (strlen(get_the_title()) > 45 ) { ?>...<?php } ?></h4>
                </header>
				</a>
             
                    <div class="search-result-image-holder dsn:my-4 hidden dsn:sm:block">
                        <?php if (get_the_post_thumbnail()) { ?>
                            <a class="dsn:cursor-pointer" href="<?php echo get_permalink();?>"><div class="search-image-content">
                                <?php the_post_thumbnail('medium'); ?>
								</div></a>
                        <?php } else { ?>
                            
                            <p class="truncate-lines dsn:hidden"><?php echo substr ( strip_tags (get_the_excerpt()), 0, 100); ?><?php if (get_the_excerpt()) { ?>...<?php } ?></p>
                        <?php } ?>
                    </div>
             
                
                <div class="dsn:my-4 <?php if ($viewStyle == 'Grid') { ?> block sm:hidden<?php } ?>">
                    <p><?php echo substr ( strip_tags (get_the_excerpt()), 0, 100); ?><?php if (get_the_excerpt()) { ?>...<?php } ?></p>
                </div>

                <footer class="entry-footer">
                    <div class="dsn:float-right read-more dsn:hidden"><?php echo dssLang($dssSiteLanguage)->search->view_link;?></div>
                    <div><?php
                        $post_type_object = get_post_type_object(get_post_type());
                        if ( $post_type_object ) {
                            echo esc_html( $post_type_object->labels->singular_name );
                        }?>
                    </div>
                </footer>
            </article><!-- #post-<?php the_ID(); ?> -->
        </div>
</div>
