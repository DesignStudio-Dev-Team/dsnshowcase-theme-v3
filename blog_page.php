<?php

/**
 * Template Name: Blog Page
 * 
 */
get_header();

$feature_blog_articles = get_field('feature_blog_articles');

//if no feature_blog_articles, get latest 3 posts

if (!$feature_blog_articles) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3
    );
    $feature_blog_articles = new WP_Query($args);
}

if(isset($feature_blog_articles[0])) {
$firstArticle = $feature_blog_articles[0];
//get post thumbnail
$firstArticle->thumbnail = get_the_post_thumbnail_url($firstArticle->ID);
//get permalink
$firstArticle->permalink = get_permalink($firstArticle->ID);
} else {
    $firstArticle = new stdClass();
    $firstArticle->post_title = 'Coming Soon';
    $firstArticle->thumbnail = '#';
    $firstArticle->permalink = '#';
}

if(isset($feature_blog_articles[1])) {
$secondArticle = $feature_blog_articles[1];
//get featured image
$secondArticle->thumbnail = get_the_post_thumbnail_url($secondArticle->ID);
//get permalink
$secondArticle->permalink = get_permalink($secondArticle->ID);
} else {
    $secondArticle = new stdClass();
    $secondArticle->post_title = 'Coming Soon';
    $secondArticle->thumbnail = '#';
    $secondArticle->permalink = '#';
}

if(isset($feature_blog_articles[2])) {
$thirdArticle = $feature_blog_articles[2];
//get post thumbnail
$thirdArticle->thumbnail = get_the_post_thumbnail_url($thirdArticle->ID);
//get permalink
$thirdArticle->permalink = get_permalink($thirdArticle->ID);

} else {
    $thirdArticle = new stdClass();
    $thirdArticle->post_title = 'Coming Soon';
    $thirdArticle->thumbnail = '#';
    $thirdArticle->permalink = '#';
}

// var_dump($firstArticle);

//get the 3 ids from feature_blog_articles to remove from query
$exclude = array();
foreach ($feature_blog_articles as $article) {
    $exclude[] = $article->ID;
}

//Get categories for blog
$args = array(
    'taxonomy' => 'category',
    'orderby' => 'name',
    'order' => 'ASC'
);
$cats = get_categories($args);
$categories = array();
$x = 0;

foreach ($cats as $cat) {

    $categories[$x]['name'] = $cat->name;
    $categories[$x]['id'] = $cat->term_id;

    $x++;
}

//get dates for blog
$args = array(
    'echo' => 0,
    'format' => 'option',
);
$archives = wp_get_archives($args);

if ($_GET) {
    $selectedCat = htmlspecialchars($_GET["categories"]);
    if ($selectedCat == 0) {
        $selectedCat = '';
    }
}

// for h1 title, page number
$paged_for_title = (get_query_var('paged')) ? get_query_var('paged') : '';

// for h1 title, category
$category_for_title = null;
$selectedCat = $selectedCat ?? '';
foreach ($categories as $category) {
    $selected = '';
    if ($selectedCat == $category['id']) {
        $category_for_title = $category['name']; 
    }
} 


$pageTitle = $category_for_title ? $category_for_title : get_the_title();
//page content from get content
$pageContent = get_the_content();
?>

<!-- Hero -->
<section class="dsn:container dsn:w-full dsn:flex dsn:flex-wrap dsn:items-center dsn:justify-center dsn:py-0 dsn:mx-auto">
    <div class="dsn:bg-gray-50 dsn:h-full dsn:w-full dsn:md:w-1/2 dsn:py-5">
        <h1 class="dsn:text-4xl dsn:m-0 dsn:font-bold dsn:text-left dsn:md:text-center dsn:w-full dsn:p-2"><?php echo $pageTitle; ?></h1>
    </div>
    <p class="dsn:text-center dsn:m-0 dsn:md:text-left dsn:w-full dsn:md:w-1/2 dsn:md:pl-5 dsn:p-2"><?php echo $pageContent; ?></p>
</section>

<!-- Featured Articles -->
<div class="dsn:container dsn:mx-auto dsn:px-4 dsn:mb-15">
        <div class="dsn:flex dsn:flex-wrap dsn:lg:grid dsn:lg:grid-cols-5 dsn:gap-5">
      
        <div style="background:url('<?php echo $firstArticle->thumbnail; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-1
        dsn:relative dsn:w-full dsn:h-[400px] dsn:lg:h-[600px] dsn:lg:row-span-2 dns:col-span-5 dsn:lg:col-span-3 dsn:p-8 dsn:flex dsn:flex-col dsn:lg:order-1 dsn:justify-end">
          <h2 class="dsn:text-3xl dsn:font-bold dsn:mb-0 dsn:text-white dsn:relative dsn:z-10">
          <a href="<?php echo $firstArticle->permalink; ?>" > <?php echo $firstArticle->post_title; ?> </a> </h2>
         <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>
                
        </div>
        
        <div style="background:url('<?php echo $secondArticle->thumbnail; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-2 dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:col-span-2 dsn:lg:h-full  dsn:lg:order-2">
        <a class="dsn:size-full dsn:p-6  dsn:flex dsn:items-end" href="<?php echo $secondArticle->permalink; ?>" >
            <h2 class="dsn:relative dsn:z-10 dsn:mb-0 dsn:text-2xl dsn:font-semibold dsn:text-white">
            <?php echo $secondArticle->post_title; ?> </h2>
            <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>
            </a>
        </div>

       
        <div style="background:url('<?php echo $thirdArticle->thumbnail; ?>'); background-size:cover; background-repeat:no-repeat; background-position:50%;" class="dsn:order-3 dsn:relative dsn:w-full dsn:h-[280px] dsn:lg:h-full dsn:lg:col-span-2 dsn:lg:order-3 ">
        <a class="dsn:size-full dsn:p-6 dsn:flex dsn:items-end" href="<?php echo $thirdArticle->permalink; ?>">
       
            <h2 class="dsn:text-2xl dsn:mb-0 dsn:font-semibold dsn:text-white dsn:relative dsn:z-10">
             <?php echo $thirdArticle->post_title; ?>         </h2>
                      <div class="dsn:absolute dsn:inset-0 dsn:bg-gradient-to-t dsn:from-black dsn:to-transparent dsn:h-1/3 dsn:z-0 dsn:top-[67%]"></div>
                     </a>
        </div>
       
      </div>
    </div>


<!-- Filters -->
<section class="dsn:container dsn:mx-auto dsn:w-full dsn:flex dsn:flex-row dsn:md:py-8">
    <div class="dsn:w-full dsn:md:w-9/12 dsn:md:pr-5 dsn:mb-3 dsn:md:mb-0">
        <form role="search" method="get" action="<?= esc_url(home_url('/')); ?>">
            <input type="search" size="16" value="" name="s" class="dsn:md:max-w-lg dsn:border dsn:dsw-border-gray-300 dsn:w-full dsn:p-2 dsn:h-10 dsn:color-black dsn:relative dsn:flex dsn:align-middle dsn:m-0 dsn:rounded-md dsn:text-xl dsn:md:text-xl dsn:lg:text-2xl dsn:leading-snug dsn:md:leading-snug dsn:lg:leading-snug" placeholder="<?php echo dssLang($dssSiteLanguage)->blog_page->search_blog; ?>" required>
            <input type="hidden" value="post" name="post_type" id="post_type" />
            <div class="dsn:absolute dsn:top-3 dsn:right-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path id="Path_54" data-name="Path 54" d="M986.919,960.269l-4.994-4.994a1.407,1.407,0,0,0-1.1-.4,7.578,7.578,0,1,0-1.3,1.292,1.409,1.409,0,0,0,.4,1.112l4.994,4.994a1.415,1.415,0,0,0,2-2ZM974.9,955.455h-.014a5.209,5.209,0,1,1,.014,0Z" transform="translate(-967.332 -942.684)" fill="#0988c2"></path>
                </svg>
            </div>
        </form>

    </div>
    <?php if ($categories && count($categories) > 1) { ?>
        <div class="dsn:w-full dsn:md:w-3/12 dsn:mb-3 dsn:md:mb-0">
            <div class="dsn:w-full">
                <form>
                    <select id="categories" name="categories" onchange="submit()" class="dsn:block dsn:w-full dsn:pl-3 dsn:pr-10 dsn:py-2 dsn:border dsn:border-gray-300 dsn:focus:outline-none dsn:focus:ring-black-500 dsn:focus:border-black-500 dsn:rounded-md dsn:text-xl dsn:md:text-xl dsn:lg:text-2xl dsn:leading-snug dsn:md:leading-snug dsn:lg:leading-snug">
                        <option value='0'><?php echo dssLang($dssSiteLanguage)->blog_page->filter_by_category; ?></option>
                        <?php
                        foreach ($categories as $category) {
                            $selected = '';
                            if ($selectedCat == $category['id']) {
                                $selected = 'selected';
                            }

                            echo "<option value='" . $category['id'] . "' " . $selected . ">" . $category['name'] . "</option>";
                        } ?>
                    </select>
                </form>
            </div>
        </div>
    <?php } ?>
    <hr class="dsn:hidden dsn:md:block w-full">
</section>


<section id="dsPostContainer" class="dsn:container dsn:mx-auto dsn:w-full dsn:grid dsn:grid-cols-5 dsn:gap-5">
<!-- Sidebar with categories --> 
<section class="dsn:col-span-1 dsn:bg-gray-100 dsn:p-5 dsn:mb-10">
    <!-- Categories with checkboxes for filters -->
    <h2 class="dsn:text-2xl dsn:font-bold dsn:mb-5"><?php echo dssLang($dssSiteLanguage)->blog_page->categories; ?></h2>
    <ul class="dsn:pl-0">
        <?php
        if($categories && count($categories) > 1) { ?>
        <form>
        <?php
        foreach ($categories as $category) {
            $selected = '';
            if ($selectedCat == $category['id']) {
                $selected = 'checked';
            }
        ?>
            <li class="blogCatsList dsn:mb-2">
                <input type="checkbox" id="<?php echo $category['id']; ?>" name="categories" value="<?php echo $category['id']; ?>"
                <?php echo $selected; ?>>
                <label for="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></label>
            </li>
        <?php  } ?>
        </form>
        <?php } ?>
    </ul> 
</section>
    <!-- Blog Posts -->
<section id="dsPosts" class="dsn:col-span-4">
    <div class="dsn:grid dsn:grid-cols-2 dsn:gap-10">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'     => 'post',
            'cat' => $selectedCat,
            'posts_per_page' => 10,
            'paged' => $paged,
            'post__not_in' => $exclude,
            
            // 'offset' => 3,
            //remove the 1st 3 posts from the query
        
        );
        $query = new WP_Query($args);
        // The Loop
        if ($query->have_posts()) {
        ?>

            <?php
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title();
                $featured_img = $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(450, 250));
            ?>
                <article class="dsn:col-span-2 dsn:md:col-span-1 dsn:bg-white dsn:rounded-lg dsn:shadow-md dsn:mb-10">
                    <?php if ($featured_img) { ?>
                        <a href="<?php the_permalink() ?>">
                            <header style="background:url('<?php echo $featured_img[0] ?>'); background-size:cover; height:270px;"></header>
                        </a>
                    <?php } ?>

                    <div class="dsn:p-8">
                        <a href="<?php the_permalink() ?>">
                            <h3><?php echo $title ?></h3>
                        </a>
                        <!-- <a href="<?php echo the_permalink() ?>" class="mt-10 block" style="color:#ff9309;"><?php echo dssLang($dssSiteLanguage)->blog_page->read_more_link_text; ?></a> -->
                    </div>
                </article>

            <?php }  ?>

            <?php wp_reset_postdata(); ?>
    </div>


    <div id="dsPagination">
        <?php
            echo paginate_links(array(
                'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total'        => $query->max_num_pages,
                'current'      => max(1, get_query_var('paged')),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'list',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text' => '&larr;',
                'next_text' => '&rarr;',
                'add_args'     => false,
                'add_fragment' => '',

            ));
        ?>
    </div>

<?php } ?>
</section>

</section>

<script>
    //filter by category sidebar
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>

<style>
    #dsPagination {
        display: block;
        width: 100%;
        margin: 50px 0px;
        text-align: center;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers li a:hover {
        padding: 10px 14px !important;
        background: var(--dsw-main-dealer-color) !important;
        color: #fff !important;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers a {
        font-size: 1rem;
    }

    #dsPagination .page-numbers a:link,
    #dsPagination .page-numbers a:visited {
        padding: 10px 14px !important;
        background: #fff !important;
        color: #000 !important;
        -webkit-box-shadow: -1px 2px 18px -9px rgba(0, 0, 0, 0.25);
        -moz-box-shadow: -1px 2px 18px -9px rgba(0, 0, 0, 0.25);
        box-shadow: -1px 2px 18px -9px rgba(0, 0, 0, 0.25);
        border: 1px solid #f0f0f0 !important;
    }

    #dsPagination .page-numbers {
        border: none !important;
        margin: 0;
    }

    #dsPagination ul li {
        border-right: 4px solid #fff;
        background: #fff !important;
        display: inline-block;
        padding: 0;
    }

    #dsPagination ul li:before {
        display: none;
    }

    .blogCatsList {
        list-style: none;
    }
    .blogCatsList input[type="checkbox"] {
        /* make checkbox bigger */
        transform: scale(1.5);
        margin-right: 10px;
    }
</style>

<?php

 get_footer(); ?>