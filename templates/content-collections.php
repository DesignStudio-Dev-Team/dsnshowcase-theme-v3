<?php echo dswPageBreadCrumbs(); ?>
<?php

// Container settings. Width, padding-top and padding-bottom

// container_width
$container_width = get_field('container_width');
$container_w = '';
if ($container_width != 0) {
    $container_w = 'max-width: ' . $container_width . 'px; margin-left:auto; margin-right:auto;';
}

// container_padding_top
$container_padding_top = get_field('container_padding_top');
$container_pt = '';
if ($container_padding_top != 0) {
    $container_pt = 'padding-top: ' . $container_padding_top . 'px;';
}

// container_padding_bottom
$container_padding_bottom = get_field('container_padding_bottom');
$container_pb = '';
if ($container_padding_bottom != 0) {
    $container_pb = 'padding-bottom: ' . $container_padding_bottom . 'px;';
}
$show_collection_boxes = get_field('show_collection_boxes');

$num_collections = get_field('num-collections');

$title_gradient_bg = get_field('title_gradient_bg');
$title_gradient = '';
if ($title_gradient_bg != false) {
    $title_gradient = '<div class="dsn:absolute dsn:w-full dsn:z-20 dsn:left-0 dsn:right-0 dsn:p-10 dsn:block" style="background: linear-gradient(rgba(0,0,0,1), rgba(255,255,255,0)); box-shadow: inset 0 31px 23px 0 rgb(0 0 0 / 70%);"></div>';
}
$collections = get_field('hot-tubs');

$col_show_products = get_field('col_show_products');
$product_category = get_field('product-category-slider');

$type_of_content_to_display = get_field('type_of_content_to_display');
$set_of_products = get_field('set_of_products');

//title overwrite
$title_overwrite = get_field('ht-page-title');
if ($title_overwrite) {
    $page_title = $title_overwrite;
} else {
    $page_title = get_the_title();
}
?>

<!-- Collection Page Title and Content -->
<div class="dsn:pt-5">
    <div class="dsn:container dsn:mx-auto">
        <div class="dsn:flex dsn:flex-wrap dsn:justify-center">
            <h1 class="dsn:text-center"><?php echo $page_title; ?></h1>
        </div>
    </div>
    <div class="dsn:container dsn:mx-auto">
        <div class="dsn:content-container dsn:text-center dsn:mx-5" style="<?php echo $container_w; ?><?php echo $container_pt; ?><?php echo $container_pb; ?>">
            <?php the_content(); ?>
        </div>
    </div>
    <?php get_template_part('template/content', 'two-columns'); ?>

    <?php
    //static Menu Links
    $custom_static_menu = get_field('custom_static_menu');
    $static_links = get_field('collections_static_links');
    if ($custom_static_menu):
    ?>
        <style>
            .dsw-collections-btn {
                background: var(--dealerColor);
                color: #fff;
            }

            .dsw-collections-btn:hover {
                background: var(--dsw-main-dealer-hover);
                color: #fff;
            }

            @media (max-width:1028px) {
                .dsw-collections-btn {
                    margin-top: 20px;
                }
            }
        </style>
        <div class="dsn:container dsn:px-6 dsn:mt-10">
            <div class="dsn:flex dsn:flex-wrap">
                <?php foreach ($static_links as $link): ?>
                    <div class="dsn:w-full dsn:md:w-1/2 dsn:lg:w-1/3 dsn:px-2">
                        <a href="<?php echo $link['collections_static_link_url']; ?>" class="dsw-collections-btn dsn:block dsn:p-2 dsn:text-center dsn:rounded-lg dsn:shadow-lg">
                            <?php echo $link['collections_static_link_title']; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php if ($show_collection_boxes === true): ?>
    <!-- Featured Collections -->
    <?php if ($collections): ?>
        <div class="dsn:container dsn:mx-auto dsn:pt-5">
            <div class="dsn:flex dsn:flex-wrap dsn:justify-center">
                <?php foreach ($collections as $item):
                    $title = $item['collection-title'];
                    $desc = $item['collection-description'];
                    $img = $item['collection-image'];
                    $img_src = $img['url'];
                    $cdn_src = $item['collection_image_cdn_url'];
                    if ($cdn_src != '') {
                        $img_src = $cdn_src;
                        $img_alt = $title;
                    } else {
                        $img_alt = $img['alt'];
                    }

                    //$img_width = $img['width'];
                    //$img_height = $img['height'];
                    $link = $item['collection-link'];
                ?>
                    <div class="dsn:w-full dsn:md:w-1/2 <?php if($num_collections == 2) { echo "dsn:lg:w-1/2"; } elseif($num_collections == 3) { echo "dsn:lg:w-1/3"; } else {echo "dsn:lg:w-1/4";}  ?> dsn:text-center dsn:relative dsn:mb-4">
                        <div class="dsn:relative dsn:mx-3 dsn:group dsn:overflow-hidden">

                            <?php if ($link != ''): ?>
                                <a href="<?php echo $link; ?>">
                                <?php endif; ?>
                                <?php echo $title_gradient; ?>
                                <?php if ($title) { ?>
                                    <h2 class="dsn:absolute dsn:z-30 dsn:top-0 dsn:left-0 dsn:right-0 dsn:py-4 dsn:text-xl dsn:text-bold dsn:text-center dsn:text-white"><?php echo $title; ?></h2>
                                <?php } ?>
                                <?php if (!empty($img_src)): ?>
                                    <?php if (!$img_alt) {
                                        if ($title)
                                            $img_alt = $title;
                                        else if ($desc)
                                            $img_alt = $desc;
                                        else {
                                            $parts = pathinfo($img_src);
                                            $img_alt = $parts['filename'];
                                        }
                                    } ?>
                                    <img class="dsn:w-full dsn:duration-500 dsn:relative dsn:z-10" src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>">
                                <?php endif; ?>
                                <?php if ($desc != ''): ?>
                                    <div class="dsn:bg-gray-600 dsn:py-4 dsn:px-2 dsn:relative">
                                        <p class="dsn:text-center dsn:text-white dsn:m-0"><?php echo $desc; ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if ($link != ''): ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($type_of_content_to_display === 'product-category'): ?>
    <?php if (!empty($product_category)):
    ?>
        <?php
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => '-1',
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'         => $product_category,
                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                )
            )
        );
        $result = new WP_Query($args);

        $columnClass = 'dsn:w-full dsn:px-3 dsn:md:px-4 dsn:mb-4 dsn:md:mb-20 dsn:sm:w-1/2 dsn:md:w-1/3';
        if ($result->post_count == 2 || $result->post_count == 4) {
            $columnClass = 'dsn:w-full dsn:px-3 dsn:md:px-4 dsn:mb-4 dsn:md:mb-20 dsn:sm:w-1/2';
        }
        ?>

        <?php if ($result->have_posts()) : ?>
            <div class="dsn:container dsn:mx-auto dsn:py-5">
                <div class="dsn:flex dsn:flex-wrap dsn:justify-center">
                    <?php while ($result->have_posts()):
                        $result->the_post();
                    ?>
                        <div class="<?php echo $columnClass; ?>">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="dsn:text-center thumbnail">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php else: ?>
                                        <?php echo wc_placeholder_img(); ?>
                                    <?php endif; ?>
                                </div>
                                <h3 class="dsn:text-center"><?php the_title(); ?></h3>
                            </a>
                        </div>
                    <?php endwhile; ?>
                    <style>
                        .thumbnail img {
                            margin-left: auto;
                            margin-right: auto;
                        }
                    </style>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


<?php if ($type_of_content_to_display === 'product'): ?>
    <?php if (!empty($set_of_products)): ?>
        <div class="dsn:container dsn:mx-auto dsn:py-5">
            <div class="dsn:flex dsn:flex-wrap dsn:justify-center">
                <?php foreach ($set_of_products as $post):
                    setup_postdata($post); ?>
                    <div class="dsn:w-full dsn:px-3 dsn:md:px-4 dsn:mb-4 dsn:sm:w-1/2 dsn:md:w-1/3">
                        <a href="<?php echo get_permalink(); ?>">
                            <div class="dsn:text-center thumbnail">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else: ?>
                                    <?php echo wc_placeholder_img(); ?>
                                <?php endif; ?>
                            </div>
                            <h3 class="dsn:text-center"><?php the_title(); ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
                <style>
                    .thumbnail img {
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php //reset query
wp_reset_postdata();
?>
<br />