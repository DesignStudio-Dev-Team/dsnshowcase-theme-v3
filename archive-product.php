<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     8.6.0
 */

if (!defined('DSN_ALLOWED_PAGINATION_VALUES')) {
	define('DSN_ALLOWED_PAGINATION_VALUES', ['24', '36', '72']);
}
if (!defined('DSN_DEFAULT_PAGINATION_VALUE')) {
	define('DSN_DEFAULT_PAGINATION_VALUE', 36);
}
if (!defined('DSN_ARCHIVE_DESCRIPTION_NUM_WORDS')) {
	define('DSN_ARCHIVE_DESCRIPTION_NUM_WORDS', 25);
}
if (!defined('DSN_DEFAULT_ORDER')) {
	define('DSN_DEFAULT_ORDER', 'ASC');
}
if (!defined('DSN_DEFAULT_ORDER_BY')) {
	define('DSN_DEFAULT_ORDER_BY', 'menu_order');
}

if ( ! defined('ABSPATH')) {
    exit;
}

get_header();

$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-estore.php'
];
$pages = get_posts($args);

wp_reset_postdata();

$this_id = (is_array($pages) && !empty($pages)) ? $pages[0] : 0;
$all_categories = get_queried_object_id();
$this_obj = get_queried_object();
$thumbnail_id = dsn_get_term_meta($all_categories, 'thumbnail_id', true);
$image = wp_get_attachment_url($thumbnail_id);

// Get hero image (separate from thumbnail)
$hero_image_id = get_term_meta($all_categories, 'category_hero_image_id', true);
$hero_image = $hero_image_id ? wp_get_attachment_url($hero_image_id) : '';
$hero_position_y = get_term_meta($all_categories, 'hero_image_position_y', true) ?: 'center';
$hero_position = 'center ' . esc_attr($hero_position_y);

$paged = (get_query_var('paged')) ?: 1;
$orderby = DSN_DEFAULT_ORDER_BY;
$order = DSN_DEFAULT_ORDER;

$posts_per_page = DSN_DEFAULT_PAGINATION_VALUE;
if (isset($_GET['posts_per_page']) && in_array($_GET['posts_per_page'], DSN_ALLOWED_PAGINATION_VALUES, true)) {
  $posts_per_page = (int) $_GET['posts_per_page'];
}

if ( !empty($_GET['sort_by'])) {
  $sort_parts = explode('-', sanitize_text_field($_GET['sort_by']));

  if (count($sort_parts) === 2) {

    switch($sort_parts[0]) {

      case 'price':
        $orderby = 'price';
        $order = strtoupper($sort_parts[1]);
        break;
      case 'title':
        $orderby = 'title';
        $order = strtoupper($sort_parts[1]);
        break;
      default:
    }
  }
}

$arg = array(
  'post_type' => 'product',
  'tax_query' => array(
    array(
      'taxonomy' => 'product_cat',
      'field' => 'id',
      'terms' => $all_categories
    )
  ),
  'orderby' => $orderby,
  'order' => $order,
  'posts_per_page' => $posts_per_page,
  'paged' => $paged,
);
?>

<div class="dsn-template-wrapper dsn:px-5">
  <?php if ($hero_image): ?>
    <!-- New Hero Banner Section (hero image set) - image above, title below -->
    <div class="ds-category-hero" style="background-image: url('<?php echo esc_url($hero_image); ?>'); background-position: <?php echo $hero_position; ?>;"></div>
    <div class="ds-category-header dsn:container dsn:mx-auto">
      <h1 class="dsn-taxonomy-title dsn:text-center"><?php woocommerce_page_title(); ?></h1>
      <?php
      $description = dsn_get_archive_description_excerpt();
      if (!empty($description)): ?>
        <div class="dsn-taxonomy-description dsn:py-4 dsn:text-center">
          <?php echo $description; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php elseif ($image): ?>
    <!-- Original Banner (thumbnail set) - title inside banner -->
    <div class="ds-archive-banner" style="background-image: url('<?php echo esc_url($image); ?>')">
      <div class="dsn:container">
        <div class="dsn:flex dsn:justify-center">
          <div class="dsn:w-full dsn:md:w-3/4 dsn:lg:w-1/2">
            <h1 class="dsn:text-center dsn:text-white"><?php woocommerce_page_title(); ?></h1>
            <div class="ds-estore-search">
              <form role="search" class="blog-search" method="get" action="<?= esc_url(home_url('/')); ?>">
                <input type="search" size="16" value="" name="s" class="search-field form-control" placeholder="SEARCH" required>
                <input type="hidden" name="post_type" value="blog-posts" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <!-- No image - just title and description -->
    <div class="dsn-header-container dsn:container dsn:mx-auto dsn:pt-5 dsn:md:pt-0">
        <h1 class="dsn-taxonomy-title dsn:text-center"><?php woocommerce_page_title(); ?></h1>
        <div class="dsn-taxonomy-description dsn:py-8">
          <?php echo dsn_get_archive_description_excerpt() ?>
        </div>
    </div>
  <?php endif; ?>

  <div class="dsn:container dsn:mx-auto">
      <div class="dsn:row dsn:flex-row">
          <div class="ds-filters-over"></div>
          <div class="dsn:w-full dsn:md:w-1/4 dsn:hidden">
              <?php if (have_rows('filter', 'options')): ?>
                  <div class="ds-filters">
                      <form class="dsn:mb-4" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="ds-filter">
                          <?php if ($title_p_f = get_field('title_p_f', 'options')) : ?>
                              <h5 class="dsn:text-center dsn:md:text-left"><?php echo $title_p_f; ?></h5>
                              <div class="ds-filters-counter dsn:lg:hidden show-for-medium-down">
                                  <span
                                          class="ds-filters-counter__value"></span>
                                  <?php _e('Products to Explore', 'dsnshowcase'); ?>
                              </div>
                          <?php endif; ?>
                          <?php $clear_filter_label = get_field('clear_filter_label', 'options'); ?>
                          <a href="<?php echo get_permalink(); ?>"><?php echo $clear_filter_label ?: 'Clear'; ?></a>
                          <div id="accordion" class="accordion-container">
                              <?php while (have_rows('filter', 'options')) : the_dsn:row();

                                  $row = get_row();
                                  if ($row['field_5f2975ae8a3b8'][0]['field_5f2975ae8a3b9'] == $all_categories)
                                  switch (get_row_layout()) {
                                      case "category":
                                          ?>
                                          <?php if ($title = get_sub_field('title')) : ?>
                                          <h4 class="article-title open"><?php echo $title; ?>
                                              <i class="fas fa-minus"></i>
                                              <i class="fas fa-plus"></i></h4>
                                      <?php endif; ?>
                                          <div class="accordion-content content-categories">
                                              <ul>
                                                  <li class="filter-menu">
                                                      <input name="<?php echo $this_obj->slug; ?>"
                                                             type="checkbox"
                                                             value="<?php echo $this_obj->term_id; ?>"
                                                             id="<?php echo $this_obj->slug; ?>">
                                                      <label
                                                              for="<?php echo $this_obj->slug; ?>"><?php echo $this_obj->name; ?></label>
                                                      <?php
                                                      //                                                            $term_childrens = get_term_children( $this_obj->term_id, 'product_cat' );

                                                      $cat_args = array(
                                                          'parent' => $this_obj->term_id,
                                                          'hide_empty' => false,
                                                      );

                                                      $terms_ch = get_terms('product_cat', $cat_args);
                                                      if ($terms_ch) : ?>


                                                          <ul class="filter-submenu">
                                                              <?php foreach ($terms_ch as $term_obj):
                                                                  $term_id = $term_obj->term_id;

                                                                  //get count of products of category
                                                                  $args = array(
                                                                      'post_type' => 'product',
                                                                      'tax_query' => array(
                                                                          array(
                                                                              'taxonomy' => 'product_cat',
                                                                              'field' => 'id',
                                                                              'terms' => $term_id,
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

                                                                  ?>
                                                                  <li>
                                                                      <input name="<?php echo $term_obj->slug; ?>"
                                                                             type="checkbox"
                                                                             value="<?php echo $term_id; ?>"
                                                                             id="<?php echo $term_obj->slug; ?>">
                                                                      <label
                                                                              for="<?php echo $term_obj->slug; ?>"><?php echo $term_obj->name; ?> (<?php echo $productCount; ?>)</label>
                                                                  </li>
                                                              <?php endforeach; ?>

                                                          </ul>
                                                      <?php endif; ?>
                                                  </li>
                                              </ul>
                                          </div>
                                          <?php break;
                                      case "price_range":
                                          ?>
                                          <?php if ($title = get_sub_field('title')) : ?>
                                          <h4 class="article-title"><?php echo $title; ?>
                                              <i class="fas fa-minus"></i>
                                              <i class="fas fa-plus"></i></h4>
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
                                          <h4 class="article-title"><?php echo $title; ?></h4>
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
                          </div>
                      </form>
                  </div>
              <?php endif; ?>
          </div>

      </div>
      <div class="dsn:w-full">
        <?php
        // Get the paged parameter
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Set up the main query arguments
        $arg = [
          'post_type'      => 'product',
          'tax_query'      => [
            [
              'taxonomy' => 'product_cat',
              'field'    => 'id',
              'terms'    => $all_categories,
            ],
          ],
          'orderby'        => $orderby,
          'order'          => $order,
          'posts_per_page' => $posts_per_page,
          'paged'          => $paged,
        ];

        $the_query = new WP_Query($arg);
        ?>
        <?php if ($the_query->have_posts()) : ?>
          <?php
          /**
           * woocommerce_before_main_content hook
           *
           * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
           * @hooked woocommerce_breadcrumb - 20
           */
          do_action('woocommerce_before_main_content');
          $args          = [
            'post_type'   => 'product',
            'post_status' => 'publish',
          ];
          $product_count = get_term_post_count('product_cat', $all_categories,
            $args);
          ?>

          <?php
          ds_filtration($all_categories, null,
            null, null, null,
            null, null, $orderby,
            $order, $posts_per_page, $paged);
          ?>

          <?php
          do_action('woocommerce_after_main_content'); ?>
        <?php
        endif; ?>
        <?php wp_reset_query(); ?>
      </div>
  </div>
</div>

<?php
// Include Syndified Call to Action Modal for product reservation/inquiry functionality
// Only included on product archive pages where CTA buttons are displayed
if ( function_exists('syndified_include_cta_modal') ) {
    syndified_include_cta_modal();
}
?>

<?php get_footer(); ?>

<?php
  function dsn_get_archive_description_excerpt(): string
{
  $description = wp_strip_all_tags(get_the_archive_description());

  if (DSN_ARCHIVE_DESCRIPTION_NUM_WORDS === 0) {
    return $description;
  }

  return wp_trim_words($description, DSN_ARCHIVE_DESCRIPTION_NUM_WORDS, '...');
}
?>