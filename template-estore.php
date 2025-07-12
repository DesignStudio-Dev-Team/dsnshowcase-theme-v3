<?php
/**
 * Template Name: E-Store Template
 */

get_header();

$this_id = get_the_ID();
$all_categories = []; // used to show only items from categories that exist in filter
$cat_cols = get_field('category_columns');

$col_1_classes = 'dsn:md:w-1/3';
$col_2_classes = 'dsn:md:w-2/3';
$col_2_item_classes = 'dsn:sm:w-1/2';

if($cat_cols == '2_column') {
    $col_1_classes = 'dsn:md:w-1/3';
    $col_2_classes = 'dsn:md:w-2/3';
    $col_2_item_classes = 'dsn:sm:w-1/2';
}
if($cat_cols == '3_column') {
    $col_1_classes = 'dsn:md:w-1/3';
    $col_2_classes = 'dsn:md:w-2/3';
    $col_2_item_classes = 'dsn:sm:w-1/2 dsn:md:w-1/3';
}
if($cat_cols == '4_column') {
    $col_1_classes = 'dsn:md:w-1/3';
    $col_2_classes = 'dsn:md:w-2/3';
    $col_2_item_classes = 'dsn:sm:w-1/2 dsn:md:w-1/4';
}
?>
<style>
    .featured-cat__wrap:nth-last-of-type(1), .featured-cat__wrap:nth-last-of-type(2), .featured-cat__wrap:nth-last-of-type(3) {
        margin-top: 0;
    }
</style>
<!--<div class="ds-filters-wrap row">-->
<!--<div class="row">-->
<div class="container ds-estore-banner-wrap mt-2">
    <?php if (have_rows('featured_categories')): ?>
    <div class="dsn:row dsn:flex-row dsn:-mx-4">
        <div class="dsn:w-full dsn:px-4 dsn:mb-8 dsn:md:mb-0 <?php echo $col_1_classes; ?>">

            <div class="ds-estore-search"
                 style="background-image: url('<?php echo get_field("search_image")['url'] ?>')">

                 <div class="ds-estore-search-content">
                <?php if ($search_title = get_field('search_title')) : ?>
                    <h1><?php echo $search_title; ?></h1>
                <?php endif; ?>
                <form role="search" class="blog-search" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="ds-filter">

                    <input type="search" size="16" value="" name="s" class="search-field form-control" placeholder="<?php echo dssLang($dssSiteLanguage)->template_store->search_placeholder;?>" required>

                </form>
                </div>
            </div>
        </div>
        <div class="dsn:w-full dsn:px-4 <?php echo $col_2_classes; ?>">
            <div class="dsn:row dsn:flex-row dsn:-mx-4 dsn:h-full">
                <?php while (have_rows('featured_categories')):
                    the_row(); ?>
                    <?php
                    $category = get_sub_field('category');
                    $image = get_sub_field('image');
                    if ($category && $image): ?>
                        <div class="dsn:w-full featured-cat__wrap dsn:px-4 <?php echo $col_2_item_classes; ?>">
                            <a class="featured-cat dsn:cursor-pointer dsw-primary-site-background" id="id-<?php echo $category->slug; ?>">
                                <?php
                                $attr = array(
                                    'class' => 'featured-cat__image',
                                );
                                echo wp_get_attachment_image($image['id'], 'full', '', $attr);
                                ?>
                                <span class="featured-cat__title dsw-primary-site-background"><?php echo $category->name; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!--</div>-->
<!--<div class="ds-filters-wrap row">-->
<div id="above-product-results" class="dsn:h-10 dsn:md:h-32 dsn:-mt-32"></div>  
<div class="container ds-estore-banner-wrap">
<div class="ds-filters-page-content-wrap">
            <div class="ds-filters-page-content dsn:mb-4">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="ds-filters-over"></div>

    <div class="dsn:flex dsn:justify-between">
        <?php while (have_posts()) : the_post(); ?>
            <div class="dsn:w-0 dsn:md:w-1/4 dsn:top-24 dsn:z-50 dsn:md:z-10" style="min-height:400px;">
                <?php if (have_rows('filter', 'options')): ?>
                    <div class="ds-filters dsw-primary-site-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="dsn:h-10 dsn:w-10 js-toggle-filters dsn:md:hidden dsn:absolute dsn:right-4 dsn:cursor-pointer " viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>
                        <!--<button class="hide-filters js-toggle-filters md:hidden ">X</button>--->
                        <form class="dsn:mb-4" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="ds-filter">
                            
                            <?php if ($title_p_f = get_field('title_p_f', 'options')) : ?>
                                <h5 class="dsn:text-center dsn:md:text-left"><?php echo $title_p_f; ?></h5>
                                <!--<div class="ds-filters-counter lg:hidden show-for-medium-down">
                                    <span
                                            class="ds-filters-counter__value"></span>
                                        <?php echo dssLang($dssSiteLanguage)->template_store->products_to_explore;?> 
                                </div>-->
                            <?php endif; ?>
                            <?php $clear_filter_label = get_field('clear_filter_label', 'options'); ?>
                            <a id="clearFiltersLink" class="dsw-primary-site-link dsn:cursor-pointer"><?php echo $clear_filter_label ? $clear_filter_label : dssLang($dssSiteLanguage)->template_store->clear_filters_link_text; ?></a>
                            <div id="accordion" class="accordion-container">
                                <?php while (have_rows('filter', 'options')) : the_row();

                                    switch (get_row_layout()) {
                                        case "category":
                                            $categories = get_sub_field('categories'); 
                                            $catCount = count($categories);
                                            ?>
                                            <?php if ($title = get_sub_field('title')) : ?>
                                            <h4 class="article-title open"><?php echo $title; ?>
                                                <i class="fas fa-minus"></i>
                                                <i class="fas fa-plus"></i></h4>
                                        <?php endif; ?>

                            
                                            <div class="accordion-content content-categories <?php if($catCount  >= 5) {echo 'ds-scrollable'; } ?>">
                                                <ul class="filter-menu-acc">
                                                    <?php
                                                    $x = 0;
                                                    foreach ($categories as $category): 
                                                    ?>
                                                        <?php
                                                        $x ++;
                                                        $categoryTermID = '';
                                                        if (isset($category->term_id) && !in_array($category->term_id, $all_categories)):
                                                            $all_categories[] = $category->term_id;
                                                        endif;
                                                         if(isset($category['category']->term_id)):
                                                            $categoryTermID = $category['category']->term_id; 
                                                        else:
                                                            if(isset($category->term_id)):
                                                                $categoryTermID = $category->term_id;
                                                            endif;
                                                        endif;


                                                        //get count of products of category
                                                        $args = array(
                                                            'post_type' => 'product',
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'field' => 'id',
                                                                    'terms' => $categoryTermID,
                                                                    'inclue_children' => true,
                                                                ),
                                                            ),
                                                            'nopaging' => true,
                                                            'fields' => 'ids',
                                                        );
                                                        $query = new WP_Query($args);
                                                        
                                                        $productCount = $query->post_count;
                                                 
                                                        //reset query
                                                        wp_reset_query();

                                                            if(isset($category['category']->slug)):
                                                                $CatSlug = $category['category']->slug;
                                                            else:
                                                                $CatSlug = '';
                                                            endif;

                                                            if(isset($category['category']->name)):
                                                                $catName = $category['category']->name;
                                                            else:
                                                                $catName = '';
                                                            endif;

                                                            if(isset($category['category']->term_id)):
                                                                $catTermID = $category['category']->term_id;
                                                            else:
                                                                $catTermID = '';
                                                            endif;



                                                        ?>
                                                        <li class="filter-menu">
                                                            <input name="<?php echo $catSlug; ?>"
                                                                   type="checkbox"
                                                                   value="<?php echo $catTermID; ?>"
                                                                   id="<?php echo $CatSlug; ?>">
                                                            <label
                                                                    for="<?php echo $catSlug; ?>"><?php echo $catName; ?> (<?php echo $productCount; ?>)</label>
            
                                                            <?php
                                                            //                                                            $term_childrens = get_term_children( $category['category']->term_id, 'product_cat' );

                                                            $cat_args = array(
                                                                'parent' => $catTermID,
                                                                'hide_empty' => false,
                                                            );

                                                            $terms_ch = get_terms('product_cat', $cat_args);
                                                            if ($category['show_child_categories'] && $terms_ch) : ?>

                                                            <?php $count = count($terms_ch); ?>
                                                            <div class="filter-menu__toggle">
                                                                        <i class="fas fa-minus"></i>
                                                                        <i class="fas fa-plus"></i>
                                                                    </div>
                                                                <ul class="filter-submenu">
                                                                    <?php 
                                                
                                                                    foreach ($terms_ch as $term_obj):
                                                                        
                                                                        $term_id = $term_obj->term_id;
                                                                        $all_categories[] = $term_id;
                                                                        if (!in_array($term_id, $all_categories)):
                                                                            $all_categories[] = $term_id;
                                                                        endif;


                                                                                          //get count of products of category
                                                        $subargs = array(
                                                            'post_type' => 'product',
                                                            'nopaging' => true,
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'field' => 'term_id',
                                                                    'terms' => $term_id,
                                                                ),
                                                            ),
                                                        );
                                                        $subquery = new WP_Query($subargs);
                                                        $subproductCount = $subquery->post_count;
                                                       
                                                        //reset query
                                                        wp_reset_query();

                                                                        ?>
                                                                        <li>
                                                                            <input name="<?php echo $term_obj->slug; ?>"
                                                                                   type="checkbox"
                                                                                   value="<?php echo $term_id; ?>"
                                                                                   id="<?php echo $term_obj->slug; ?>">
                                                                            <label
                                                                                    for="<?php echo $term_obj->slug; ?>"><?php echo $term_obj->name; ?> (<?php echo $subproductCount; ?>)</label>

                                                                                  


                                                                        <?php 
                                                            $cat_args2 = array(
                                                                'parent' => $term_id,
                                                                'hide_empty' => false,
                                                            );

                                                            $terms_ch2 = get_terms('product_cat', $cat_args2);
                                                         
                                                            if ($category['show_child_categories'] && $terms_ch2) : ?>

                                                            <?php $count = count($terms_ch2); ?>

                                                            <div class="filter-menu__toggle">
                                                                                        <i class="fas fa-minus"></i>
                                                                                        <i class="fas fa-plus"></i>
                                                            </div>

                                                                <ul class="filter-submenu">
                                                                    <?php 
                                                
                                                                    foreach ($terms_ch2 as $term_obj2):
                                                                        
                                                                        $term_id2 = $term_obj2->term_id;
                                                                        $all_categories[] = $term_id2;
                                                                        if (!in_array($term_id2, $all_categories)):
                                                                            $all_categories[] = $term_id2;
                                                                        endif;


                                                                                          //get count of products of category
                                                        $subargs2 = array(
                                                            'post_type' => 'product',
                                                            'nopaging' => true,
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'field' => 'term_id',
                                                                    'terms' => $term_id2,
                                                                ),
                                                            ),
                                                        );
                                                        $subquery2 = new WP_Query($subargs2);
                                                        $subproductCount2 = $subquery2->post_count;
                                                       
                                                        //reset query
                                                        wp_reset_query();

                                                                        ?>
                                                                        <li>
                                                                            <input name="<?php echo $term_obj2->slug; ?>"
                                                                                   type="checkbox"
                                                                                   value="<?php echo $term_id2; ?>"
                                                                                   id="<?php echo $term_obj2->slug; ?>">
                                                                            <label
                                                                                    for="<?php echo $term_obj2->slug; ?>"><?php echo $term_obj2->name; ?> (<?php echo $subproductCount2; ?>)</label>

                                                                                    <!-- <div class="filter-menu__toggle">
                                                                                        <i class="fas fa-minus"></i>
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </div> -->
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                        </li>


                                                                </ul>
                                                            <?php endif; ?>
                                                                    <?php endforeach; ?>

                                                                </ul>
                                                            <?php endif; ?>

                                                           


                                                        </li>
                                                    <?php endforeach; $x = 0; ?>
                                                </ul>
                                            </div>
                                            <?php break;
                                        case "price_range":
                                            ?>
                                            <?php if ($title = get_sub_field('title')) : ?>
                                            <h4 class="article-title"><?php echo $title; ?>
                                                <i class="fas fa-minus"></i>
                                                <i class="fas fa-plus"></i>
                                            </h4>
                                        <?php endif; ?>
                                            <div class="accordion-content">
                                                <div class="ds-prices-wrap">
                                                    <input class="dsn:px-4 dsn:py-2" id="price_min" type="number" name="price_min"
                                                           placeholder="Min price"/>
                                                    <input class="dsn:px-4 dsn:py-2" id="price_max" type="number" name="price_max"
                                                           placeholder="Max price"/>
                                                    <button class="dsn:mt-3 dsn:mb-2 dsn:w-full bg-ldBlueLight dsn:uppercase dsn:text-white dsn:py-4 dsn:px-4">search</button>
                                                </div>
                                            </div>
                                            <?php
                                            break;
                                        case "sale":
                                            ?>
                                            <?php if ($title = get_sub_field('title')) : ?>
                                            <h4 class="article-title"><?php echo $title; ?>
                                                <i class="fas fa-minus"></i>
                                                <i class="fas fa-plus"></i></h4>
                                        <?php endif; ?>
                                            <div class="accordion-content">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="sale_sale" name="sale" value="sale">
                                                        <label
                                                                for="sale_sale"><?php echo get_field('show_only_sale_label') ? get_field('show_only_sale_label') : "Sale"; ?></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="sale_all" name="sale" value="all">
                                                        <label
                                                                for="sale_all"><?php echo get_field('show_all_label') ? get_field('show_all_label') : "All"; ?></label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php
                                            break;
                                    }


                                endwhile; ?>
                                <div class="dsn:text-center">
                                    <button
                                            class="js-toggle-filters dsn:text-center apply-button dsn:md:hidden dsw-primary-site-btn">
                                        Apply Filter
                                    </button>
                                </div>
                            </div><!--/#accordion-->
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            <div class="dsn:w-full dsn:md:w-3/4 dsn:flex dsn:flex-col" style="min-height:600px;">
                <?php   
                // use ACF if it exists. if not - take all categories from the filter
                $estore_main_cat = get_field('main_estore_category', 'options');
                $all_categories = $estore_main_cat ? $estore_main_cat : $all_categories;

                $arg = array(
                    'post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'id',
                            'terms' => $all_categories,
                            'include_children' => true
                        )
                    ),
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                    'posts_per_page' => 24
                );
                $the_query = new WP_Query($arg);
                if ($the_query->have_posts()) : ?>
                    <div class="dsn:row dsn:flex-row dsn:w-full dsn:md:pl-4" id="response" data-counter="<?php echo $the_query->found_posts; ?>"
                         data-categories="<?php echo json_encode($all_categories); ?>">
                        <div class="dsn:flex-row ds-filters-nav dsn:w-full">
                            <div class="ds-filters-counter hidden md:block hide-for-medium-down">
                                <span class="ds-filters-counter__value"><?php echo $the_query->found_posts; ?> </span>
                                <?php echo dssLang($dssSiteLanguage)->template_store->products_to_explore;?>
                            </div>
                            <div class="ds-filters-nav-right">
                                <button class="show-filters js-toggle-filters dsn:md:hidden dsn:relative">Filters
                                </button>
                                <form id="ds-filters-search-wrap" class="hidden dsn:md:flex dsn:relative"
                                      action="<?php echo esc_url(home_url('/')); ?>">
                                    <input type="search" name="s" id="ds-filters-search" class="search__input"
                                           placeholder="<?php echo dssLang($dssSiteLanguage)->template_store->search_placeholder;?>"
                                           value="<?php echo get_search_query(); ?>"/>
                                </form>

                                <select name="posts_per_page" id="ds-posts_per_page"
                                        class="ds-posts_per_page dsn:hidden dsn:lg:block">
                                    <option
                                            value="24" <?php echo $_POST['posts_per_page'] == '24' ? 'selected' : ''; ?> >
                                        <?php echo dssLang($dssSiteLanguage)->template_store->per_page_24;?>
                                    </option>
                                    <option
                                            value="36" <?php echo $_POST['posts_per_page'] == '36' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->per_page_36;?>
                                    </option>
                                    <option
                                            value="72" <?php echo $_POST['posts_per_page'] == '72' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->per_page_72;?>
                                    </option>
                                </select>
                                <select name="sort_by" id="ds-sort_by">
                                    <option value="" disabled selected><?php echo dssLang($dssSiteLanguage)->template_store->sort_by_title;?></option>
                                    <option
                                            value="price-asc" <?php echo $_POST['sort_by'] == 'price-asc' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->sort_by_price_low_to_high;?>
                                    </option>
                                    <option
                                            value="price-desc" <?php echo $_POST['sort_by'] == 'price-desc' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->sort_by_price_high_to_low;?>
                                    </option>
                                    <option
                                            value="title-asc" <?php echo $_POST['sort_by'] == 'title-asc' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->sort_by_name_A_to_Z;?>
                                    </option>
                                    <option
                                            value="title-desc" <?php echo $_POST['sort_by'] == 'title-desc' ? 'selected' : ''; ?> >
                                            <?php echo dssLang($dssSiteLanguage)->template_store->sort_by_name_Z_to_A;?>
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="dsn:w-full dsn:flex dsn:-mr-4 dsn:flex-wrap">
                        <?php while ($the_query->have_posts()) :
                            $the_query->the_post(); ?>
                            <?php $product = wc_get_product(get_the_ID()); ?>
                            <div class="dsn:w-full dsn:sm:w-1/2 dsn:md:w-1/3 dsn:px-4 dsn:mb-12">
                                <div class="ds-product">
                                    <a href="<?php echo get_permalink() ?>">
                                        <?php if ($product->is_on_sale()): ?>
                                            <span class="ds-product__sale bg-ldBlueLight"><?php echo dssLang($dssSiteLanguage)->template_store->sale_badge;?></span>
                                        <?php endif; ?>
                                        <span class="ds-product__image"
                                              style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
                                            <?php if ($product->get_price_html()) { ?>
                                              <button class="single_add_to_cart_button dsw-primary-site-background"
                                                    value="<?php echo get_the_ID(); ?>">
                                                <i class="fas fa-shopping-cart"></i>
                                                <i class="fas fa-spinner"></i>
                                                <i class="far fa-check-circle"></i>
                                            </button>
                                            <?php } ?>
                                        </span>
                                        <span class="ds-product__title"><?php the_title(); ?></span>
                                    </a>
                                    <div class="ds-product__meta">
                                        <div class="ds-product__price"><?php echo $product->get_price_html(); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                        <div class="dsn:flex-row ds-filters-footer-nav dsn:w-full">
                            <div class="dsn:hidden dsn:lg:block">
                                <!--<select name="posts_per_page" id="ds-posts_per_page">
                                    <option
                                            value="24" <?php echo $_POST['posts_per_page'] == '24' ? 'selected' : ''; ?> >
                                        24
                                        Per Page
                                    </option>
                                    <option
                                            value="36" <?php echo $_POST['posts_per_page'] == '36' ? 'selected' : ''; ?> >
                                        36
                                        Per Page
                                    </option>
                                    <option
                                            value="72" <?php echo $_POST['posts_per_page'] == '72' ? 'selected' : ''; ?> >
                                        72
                                        Per Page
                                    </option>
                                </select>-->
                                <span class="ds-filters-counter__value"><?php echo $the_query->found_posts; ?>
                                <?php echo dssLang($dssSiteLanguage)->template_store->products_to_explore;?> </span>
                            </div>
                            <div id="dsPagination" class="js-pagination">
                                <?php foundation_pagination($the_query) ?>
                            </div>
                            <div class="ds-filters-footer-nav-right">
                                <?php if ($the_query->max_num_pages && $the_query->max_num_pages > 1): ?>
                                    <div class="">
                                        Go to page
                                        <input type="number" name="paged" min="1"
                                               max="<?php echo $the_query->max_num_pages; ?>"
                                               id="ds-filters-paged">
                                        of
                                        <?php echo $the_query->max_num_pages; ?>
                                    </div>
                                <?php endif; ?>
                                <a href="#" class="dsw-primary-site-link" id="toTop"><?php echo dssLang($dssSiteLanguage)->template_store->back_to_top;?></a>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query(); ?>
            </div>
        <?php endwhile; ?>
        <script>
            ;
            (function ($) {

                var $body = $('body');

                $body.on('submit', '#ds-filter, #ds-filters-search-wrap, .ds-estore-search form', function () {
                    $('.filter-menu input').prop( "checked", false );
                    dsFilter();
                });

                $body.on('click', '.special_link', function () {
                    $(this).addClass('active');
                    dsFilter();
                });

                $body.on('change', '#ds-filter :checkbox, #ds-filter :radio, #ds-sort_by', function () {

                    $('#ds-filters-search').val ('');
                    $('.search-field').val ('');
                    dsFilter();
                });

                $body.on('change', '#ds-posts_per_page', function () {
                    dsFilter('', $(this).val());
                });

                $body.on('change', '#ds-filters-paged', function () {
                    dsFilter($(this).val());
                });
                $body.on('click', '.js-toggle-filters', function () {
                    $('.ds-filters').toggleClass('active');
                });

                $body.on('click', '#toTop', function () {
                    
                    $("html, body").animate({scrollTop: 0}, 1000);
                });

                $('.article-title').on('click', function () {

                    $(this).next().slideToggle(200);

                    $(this).toggleClass('open');
                });

                $body.on('click', '.js-pagination a', function () {
                    event.preventDefault();
                    var urlThis = $(this).attr('href'),
                        paged = '';
                    if (urlThis.includes('admin-ajax.php')) {
                        paged = urlThis.split('?paged=')[1];
                    } else {
                        var pagedStr = urlThis.split('/page/')[1];
                        paged = pagedStr.split('/')[0];
                    }
                    dsFilter(paged, '');
                    
                    jQuery('html, body').animate({
                        scrollTop: jQuery("#above-product-results").offset().top
                    }, 1000);
                });

                var dsFilter = function (paged, posts_per_page, scrollDownAfterLoad = false) {

                    event.preventDefault(); //need this so it doesn't actually go to /ajax page

                    

                    var filter = $('#ds-filter');

                    // gather categories
                    var categoriesCheckboxValue = "";
                    $(".content-categories :checkbox").each(function () {
                        var ischecked = $(this).is(":checked");
                        var thisVal = $(this).val();

                        if (ischecked) {
                            if ($(this).parent().hasClass('filter-menu') && $(this).next().next().find('input:checkbox:checked').length > 0) {

                                categoriesCheckboxValue.replace(thisVal, '');
                            } else {
                                categoriesCheckboxValue += thisVal + ",";
                            }
                        }
                    });

                    if (categoriesCheckboxValue === '') {
                        categoriesCheckboxValue = $('#response').data('categories');
                        categoriesCheckboxValue = categoriesCheckboxValue + '';
                    }

                    // gather brands
                    var brandsCheckboxValue = "";
                    $(".content-brands :checkbox").each(function () {
                        var ischecked = $(this).is(":checked");
                        if (ischecked) {
                            brandsCheckboxValue += $(this).val() + ",";
                        }
                    });

                    // gather product use
                    var prUseCheckboxValue = "";
                    $(".content-product-use :checkbox").each(function () {
                        var ischecked = $(this).is(":checked");
                        if (ischecked) {
                            prUseCheckboxValue += $(this).val() + ",";
                        }
                    });

                    var sale = $('#sale_sale').is(':checked'),
                        orderItem = $('#ds-sort_by'),
                        orderBy = 'date',
                        order = 'desc';

                    if (orderItem.length > 0 && orderItem.val() !== null) {
                        var orderStr = orderItem.val();
                        orderBy = orderStr.split('-')[0];
                        order = orderStr.split('-')[1];
                    }
                    var data = {
                        action: 'ds_filter',
                        posts_per_page: posts_per_page ?? $('#ds-posts_per_page').val(),
                        orderby: orderBy,
                        order: order,
                        categories: categoriesCheckboxValue,
                        brands: brandsCheckboxValue,
                        product_use: prUseCheckboxValue,
                        price_min: $('#price_min').val(),
                        price_max: $('#price_max').val(),
                        sale: sale,
                        this_id: <?php echo $this_id ?>
                    }

                    // check if "Specials" enabled
                    if ($('.special_link').hasClass('active')) {
                        data.specials = true;
                    }

                    if (paged) {
                        data.paged = paged;
                    }

                    var dsFiltersSearch = $('#ds-filters-search');
                    var dsEstoreSearch = $('.search-field');

                    if (dsFiltersSearch.val() !== undefined && dsFiltersSearch.val() !== '') {
                        console.log('catch');
                            data.search = dsFiltersSearch.val();
                    } else if (dsEstoreSearch.val() !== undefined) {
                            data.search = dsEstoreSearch.val();
                    }
                    
                    
                    $.ajax({
                        url: filter.attr('action'),
                        data: data,
                        type: filter.attr('method'), // POST
                        beforeSend: function (xhr) {
                            $('.ds-filters-over').addClass('show');
                        },
                        success: function (data) {
                            
                         
                            $('.ds-filters-over').removeClass('show');
                            $('#response').html(data); // insert data

                            // update value for product counter in filter section
                            if ($('.ds-filters-counter.hide-for-medium-down').length) {
                                $('.ds-filters-counter.show-for-medium-down').html($('.ds-filters-counter.hide-for-medium-down').html());
                            } else {
                                $('.ds-filters-counter.show-for-medium-down').html('No products found')
                            }
                            // return false;
                            if (scrollDownAfterLoad)
                            {
                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#above-product-results").offset().top
                                }, 1000);
                            }
                        }
                    });

                    $('#ds-filters-search').keyup (function () {
                    
                        $('.search-field').val ($('#ds-filters-search').val ());

                        if (!$(this).val ())
                        {
                            dsFilter();
                        }
                    });

                    $('html,body').animate({
                        scrollTop: $("#response").offset().top - 50
                    });
                    
                    return false;
                }

                $(document).on('click', '.single_add_to_cart_button', function (e) {
                    e.preventDefault();

                    var $thisbutton = $(this),
                        id = $thisbutton.val(),
                        variation_id = $thisbutton.data('variation_id') || 0;

                    var data = {
                        action: 'woocommerce_ajax_add_to_cart',
                        product_id: id,
                        product_sku: '',
                        quantity: 1,
                        variation_id: variation_id,
                    };

                    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
                    
                    $.ajax({
                        type: 'post',
                        url: wc_add_to_cart_params.ajax_url,
                        data: data,
                        beforeSend: function (response) {
                            $thisbutton.removeClass('added').addClass('loading');
                        },
                        complete: function (response) {
                            $thisbutton.addClass('added').removeClass('loading');
                        },
                        success: function (response) {

                            if (response.error & response.product_url) {
                                window.location = response.product_url;
                                return;
                            } else {
                                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                            }
                        },
                    });

                    return false;
                });

                $(document).on('ready', function () {
                    $('.ds-filters .ds-filters-counter__value').html($('#response').data('counter'));
                });

               

                $('.search-field').keyup (function () {
                    
                    $('#ds-filters-search').val ($('.search-field').val ());

                    if (!$(this).val ())
                    {
                        dsFilter();
                    }
                });

                $('#ds-filters-search').keyup (function () {
                    
                    $('.search-field').val ($('#ds-filters-search').val ());

                    if (!$(this).val ())
                    {
                        dsFilter();
                    }
                });

                $('.featured-cat').click (function () {
                    
                    var id = $(this).attr ('id').substring(3);

                    $('#ds-filters-search').val ('');
                    $('.search-field').val ('');

                    $('.filter-menu input').prop( "checked", false );
                    $('.filter-menu').find ('#'+id).prop( "checked", true );
                    
                    jQuery('html, body').animate({
                        scrollTop: jQuery("#above-product-results").offset().top
                    }, 1000);
                    dsFilter();
                });

                $('#clearFiltersLink').click (function () {
                    
                    $('.filter-menu input').prop( "checked", false );
                    
                    jQuery('html, body').animate({
                        scrollTop: jQuery("#above-product-results").offset().top
                    }, 1000);
                    dsFilter();
                });

                <?php if ($_REQUEST['category']) { ?>
                $('.filter-menu').find ('#<?php echo $_REQUEST['category'];?>').prop( "checked", true );
                dsFilter(1, 24, true);
                
                jQuery('html, body').animate({
                    scrollTop: jQuery("#above-product-results").offset().top
                }, 1000);
                <?php } ?>
                

            }(jQuery));
        </script>
    </div>

    <div class="mb-28"></div>
</div>


<style>
    #dsPagination {
        display: block;
        width: auto;
        margin: 50px 0px;
        text-align: center;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers li a:hover {
        padding: 10px 14px !important;
        background: #fff !important;
        color: #666 !important;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers a {
        font-size: 1rem;
    }

    #dsPagination .page-numbers a:link,
    #dsPagination .page-numbers a:visited {
        padding: 10px 14px !important;
        background: #fff !important;
        color: #00a5e6 !important;
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

.ds-estore-search-content h1 {
             font-size: 30px;
         }
         


    /* Fix for container stuff */
    .page-template-template-estore #dsShowcaseContent{
       padding-left: 2.5rem;
       padding-right: 2.5rem;
    }
    .page-template-template-estore .ds-estore-banner-wrap {
        padding-left: 0.1rem !important;
         padding-right: 0.1rem !important;
    }
    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-results-button,
    input[type="search"]::-webkit-search-results-decoration { 
        padding-right:20px;
     }

     .ds-scrollable{
        overflow: auto;
     }

     .ds-estore-search-content {
         background:transparent;
     }

     @media (max-width:639px) {
         
        .featured-cat__wrap{
            height:auto;
        }
        .featured-cat {
            height:40px;
        }
        .ds-estore-banner-wrap {
            margin-top: 0px !important;
            padding-top:0px !important;
        }
         .featured-cat img {
             display:none;
         }
         .ds-estore-search {
             background-position:center;
             height:300px !important;
             margin-bottom: 80px !important;
         }
         .ds-estore-search-content {
             background:white;
             width:90%;
             color:black;
             padding:15px;
             position:absolute;
             top:250px;
         }
         .ds-estore-search-content h1 {
             color:black;
             text-align:center;
             font-size: 30px;
         }
     }

     .filter-menu__toggle {
         cursor:pointer;
     }
     .filter-menu__toggle .fa-minus {
         display:none;
     }
     .filter-submenu li, .filter-menu {
        position:  relative;
        display:block;
     }
     .filter-menu__toggle {
         position:absolute;
         right:0;
         top:0;
     }  
     .filter-menu__toggle .fa-plus {
         display:inline-block;
     }
     .filter-menu__toggle .fa-minus {
         display:none;
     }
</style>

<script>
//accordion script for filter categories if filter-menu has inside filter-submenu then it will toggle using the - and + icon
jQuery(document).ready(function(){
    //toggle all the filter-submenu
    jQuery('.filter-menu__toggle').each(function(){
        jQuery(this).parent().find('.filter-submenu').slideToggle();
    });

    //toggle the filter-submenu
    jQuery('.filter-menu__toggle').click(function(){
        jQuery(this).parent().find('.filter-submenu').slideToggle();
        jQuery(this).find('.fa-minus').toggle();
        jQuery(this).find('.fa-plus').toggle();
    });

    //toggle the filter categories
    jQuery('.article-title').click(function(){
        jQuery(this).next('.accordion-content').slideToggle();
        
    });
    
});

</script>

<script>

jQuery( "form" ).submit(function() {
    //move page down to a specific div
    
    jQuery('html, body').animate({
        scrollTop: jQuery("#above-product-results").offset().top
    }, 1000);
});

</script>
<?php get_footer(); ?>