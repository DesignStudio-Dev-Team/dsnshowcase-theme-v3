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

const DSN_ALLOWED_PAGINATION_VALUES = ['24', '36', '72'];
const DSN_DEFAULT_PAGINATION_VALUE  = 36;
const DSN_ARCHIVE_DESCRIPTION_NUM_WORDS = 25;
const DSN_DEFAULT_ORDER = 'ASC';
const DSN_DEFAULT_ORDER_BY = 'menu_order';

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
  <?php if ($image): ?>
    <div class="ds-archive-banner" style="background-image: url('<?php echo $image ?>')">
          <div class="dsn:container">
              <div class="dsn:flex dsn:justify-center">
                  <div class="dsn:w-full dsn:md:w-3/4 dsn:lg:w-1/2">
                      <h1 class="dsn:text-center dsn:text-white"><?php woocommerce_page_title(); ?></h1>

                      <div class="ds-estore-search">
                          <form role="search" class="blog-search" method="get" action="<?= esc_url(home_url('/')); ?>">

                              <input type="search" size="16" value="" name="s" class="search-field form-control" placeholder="SEARCH" required>

                              <input type="hidden" name="post_type" value="blog-posts" /> <!-- // hidden 'blog-posts' value -->

                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php else: ?>
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
                          <a href="<?php echo get_permalink(); ?>"><?php echo $clear_filter_label ? $clear_filter_label : 'Clear'; ?></a>
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

<?php add_action('wp_footer', function () use ($all_categories) { ?>
  <script>
    const handlePerPageSortChange = e => {
      const currentUrl = new URL(window.location.href);
      const params = new URLSearchParams(currentUrl.search);
      const changedId = e.target.id;
      const changedValue = e.target.value;

      switch (changedId) {
        case 'ds-sort_by':
          changedValue ? params.set('sort_by', changedValue) : params.delete(
            'sort_by');

          break;
        case 'ds-posts_per_page':
        case 'ds-posts_per_page_footer':
          console.log('posts_per_page', changedValue);
          changedValue
            ? params.set('posts_per_page', changedValue)
            : params.delete('posts_per_page');
          break;
      }
      // Always reset paged to 1 when changing per page or sort
      currentUrl.search = params.toString();
      currentUrl.pathname = currentUrl.pathname.replace(/\/page\/\d+\/?/, '/');
      window.location.href = currentUrl.toString();
    };

    (function($) {

      // Keep the dsFilter function for other AJAX filters
      const dsFilter = function(paged, posts_per_page) {
        const filter = $('#ds-filter');

        // gather categories
        let categoriesCheckboxValue = '';
        $('.content-categories :checkbox').each(function() {
          var ischecked = $(this).is(':checked');
          var thisVal = $(this).val();

          if (ischecked) {
            if ($(this).parent().hasClass('filter-menu') &&
              $(this).next().next().find('input:checkbox:checked').length > 0) {
              categoriesCheckboxValue.replace(thisVal, '');
            } else {
              categoriesCheckboxValue += thisVal + ',';
            }
          }
        });

        if (categoriesCheckboxValue === '') {
          categoriesCheckboxValue = $('#ds-filters-root').data('categories');
          categoriesCheckboxValue = categoriesCheckboxValue + '';
        }

        // gather brands
        var brandsCheckboxValue = '';
        $('.content-brands :checkbox').each(function() {
          var ischecked = $(this).is(':checked');
          if (ischecked) {
            brandsCheckboxValue += $(this).val() + ',';
          }
        });

        // gather product use
        var prUseCheckboxValue = '';
        $('.content-product-use :checkbox').each(function() {
          var ischecked = $(this).is(':checked');
          if (ischecked) {
            prUseCheckboxValue += $(this).val() + ',';
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

        // When clearing search, restore default sort if none selected
        if (!orderItem.length || !orderItem.val()) {
          const $root = $('#ds-filters-root');

          const defaultOrderby = $root.data('default-orderby');
          const defaultOrder = $root.data('default-order');
          if (defaultOrderby && defaultOrder) {
            orderBy = defaultOrderby;
            order = defaultOrder;
          }
        }

        const data = {
          action: 'ds_filter',
          posts_per_page: posts_per_page ?? $('#ds-posts_per_page').val(),
          orderby: orderBy,
          order: order,
          categories: '<?php echo $all_categories; ?>',
          categories_checkbox: categoriesCheckboxValue,
          brands: brandsCheckboxValue,
          product_use: prUseCheckboxValue,
          price_min: $('#price_min').val(),
          price_max: $('#price_max').val(),
          sale: sale,

        };

        // check if "Specials" enabled
        if ($('.special_link').hasClass('active')) {
          data.specials = true;
        }

        if (paged) {
          data.paged = paged;
        }

        const dsFiltersSearch = $('#ds-filters-search');
        const dsEstoreSearch = $('.ds-estore-search .search-field');

        if (dsFiltersSearch.val() !== '') {
          data.search = dsFiltersSearch.val();
        } else if (dsEstoreSearch.val() !== '') {
          data.search = dsEstoreSearch.val();
        }

        const ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
        console.log('dsFilter → AJAX URL', ajaxUrl, 'data', data);

        $.ajax({
          url: ajaxUrl,
          data: data,
          type: 'POST',
          dataType: 'html',
          beforeSend: function(xhr) {
            $('.ds-filters-over').addClass('show');
          },
          success: function(data) {
            $('.ds-filters-over').removeClass('show');
            $('#main').html(data);

            // update value for product counter in filter section
            if ($('.ds-filters-counter.hide-for-medium-down').length) {
              $('.ds-filters-counter.show-for-medium-down').
                html($('.ds-filters-counter.hide-for-medium-down').html());
            } else {
              $('.ds-filters-counter.show-for-medium-down').
                html('No products found')
            }
          },
          error: function(xhr, status, error) {
            $('.ds-filters-over').removeClass('show');
            console.error('Filter AJAX error:', status, error);
            console.debug('Response:', xhr && xhr.responseText
              ? xhr.responseText.substring(0, 500)
              : '(no response)');
          }
        });
        return false;
      };
      const $body = $('body');

      // Handle URL parameter changes for sorting and posts per page
      $body.on('change',
        '#ds-sort_by, #ds-posts_per_page, #ds-posts_per_page_footer',
        handlePerPageSortChange);

      // Handle other filter changes with AJAX
      $body.on('submit', '#ds-filter, .ds-estore-search form', function(e) {
        e.preventDefault();
        dsFilter();
      });

      // Click-to-search for header search input
      $body.on('click', '#ds-filters-search-go', function() {
        dsFilter();
        // After a successful search, swap to clear mode
        $('#ds-filters-search-go').hide();
        if ($('#ds-filters-search-clear').length) {
          $('#ds-filters-search-clear').show();
        }
      });

      $body.on('keydown', '#ds-filters-search', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();

          dsFilter();
          // After a successful search, swap to clear mode
          $('#ds-filters-search-go').hide();
          if ($('#ds-filters-search-clear').length) {
            $('#ds-filters-search-clear').show();
          }
        }
      });

      // Clear search
      $body.on('click', '#ds-filters-search-clear', function() {
        $('#ds-filters-search').val('');
        $('#ds-filters-search-clear').hide();
        $('#ds-filters-search-go').show();
        // Reset pagination and use defaults
        dsFilter(1);
      });

      $body.on('click', '.special_link', function() {
        $(this).addClass('active');
        dsFilter();
      });

      $body.on('change', '#ds-filter :checkbox, #ds-filter :radio', function() {
        dsFilter();
      });

      // Only navigate when clicking Go
      $body.on('click', '#ds-filters-paged-go', function() {
        var n = parseInt($('#ds-filters-paged').val(), 10) || 1;
        var currentUrl = new URL(window.location.href);
        var path = currentUrl.pathname.replace(/\/page\/\d+\/?/, '/');
        if (n > 1) {
          if (!/\/$/.test(path)) path += '/';
          path += 'page/' + n + '/';
        }
        currentUrl.pathname = path;
        window.location.href = currentUrl.toString();
      });

      $body.on('click', '#toTop', function() {
        $('html, body').animate({ scrollTop: 0 }, 1000);
      });

      $('.article-title').on('click', function() {

        $(this).next().slideToggle(200);

        $(this).toggleClass('open');
      });

      $body.on('click', '.js-pagination a', function(e) {
        e.preventDefault();
        var urlThis = $(this).attr('href');
        var url = new URL(urlThis, window.location.origin);
        var paged = url.searchParams.get('paged');
        if (!paged) {
          var m = url.pathname.match(/\/page\/(\d+)/);
          if (m && m[1]) paged = m[1];
        }

        var currentUrl = new URL(window.location.href);
        var path = currentUrl.pathname.replace(/\/page\/\d+\/?/, '/');
        var n = parseInt(paged, 10) || 1;
        if (n > 1) {
          if (!/\/$/.test(path)) path += '/';
          path += 'page/' + n + '/';
        }
        currentUrl.pathname = path;
        window.location.href = currentUrl.toString();
      });

      $(document).on('click', '.single_add_to_cart_button', function(e) {
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
          beforeSend: function(response) {
            $thisbutton.removeClass('added').addClass('loading');
          },
          complete: function(response) {
            $thisbutton.addClass('added').removeClass('loading');
          },
          success: function(response) {

            if (response.error & response.product_url) {
              window.location = response.product_url;
              return;
            } else {
              $(document.body).
                trigger('added_to_cart',
                  [response.fragments, response.cart_hash, $thisbutton]);
            }
          },
        });

        return false;
      });

      $(document).on('ready', function() {
        //dsFilter();
        $('.ds-filters .ds-filters-counter__value').
          html($('#ds-filters-root').data('counter'));
      });
    }(jQuery));
  </script>
  <style>
    #ds-filters-paged-go:hover{
      background-color:#2b2b2b!important;
    }
    .dsn-taxonomy-description {
      max-width: 1000px;
      margin: 0 auto;
      text-align: center;
    }
    /* Fix for dsn:container stuff */
    .page-template-template-estore #dsShowcaseContent {
      padding-left: 2.5rem;
      padding-right: 2.5rem;
    }
    .page-template-template-estore .ds-estore-banner-wrap {
      padding-left: 0.1rem !important;
      padding-right: 0.1rem !important;
    }
    input[type='search']::-webkit-search-decoration,
    input[type='search']::-webkit-search-cancel-button,
    input[type='search']::-webkit-search-results-button,
    input[type='search']::-webkit-search-results-decoration {
      padding-right: 20px;
    }

    .ds-scrollable {
      overflow: auto;
    }

    .ds-estore-search-content {
      background: transparent;
    }

    @media (max-width: 639px) {

      .featured-cat__wrap {
        height: auto;
      }
      .featured-cat {
        height: 40px;
      }
      .ds-estore-banner-wrap {
        margin-top: 0px !important;
        padding-top: 0px !important;
      }
      .featured-cat img {
        display: none;
      }
      .ds-estore-search {
        background-position: center;
        height: 300px !important;
        margin-bottom: 80px !important;
      }
      .ds-estore-search-content {
        background: white;
        width: 90%;
        color: black;
        padding: 15px;
        position: absolute;
        top: 250px;
      }
      .ds-estore-search-content h4 {
        color: black;
        text-align: center;
      }
    }

    #dsPagination {
      display: block;
      width: auto;
      margin: 50px 0px;
      text-align: center;
      color: var(--dealerLinkColor) !important;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers li a:hover {
      padding: 10px 14px !important;
      background: #fff !important;
    }

    #dsPagination .page-numbers .current,
    #dsPagination .page-numbers a {
      font-size: 1rem;
    }

    #dsPagination .page-numbers a:link,
    #dsPagination .page-numbers a:visited {
      padding: 10px 14px !important;
      background: #fff !important;
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

    #dsPagination ul li a.next.page-numbers, #dsPagination ul li a.prev.page-numbers {
      color: var(--dealerLinkColor) !important;
    }

    #dsPagination ul li:before {
      display: none;
    }


    .ds-filters {
      background-color: #f7f7f7;
      position: relative;
      padding: 20px 15px 0;
      width: 100%
    }
    .ds-filters h1,
    .ds-filters h2,
    .ds-filters h3,
    .ds-filters h4,
    .ds-filters h5,
    .ds-filters h6 {
      margin-top: .2rem;
      margin-bottom: .5rem
    }
    .ds-filters .article-title {
      position: relative;
      font-size: 18px;
      padding-top: 25px;
      border-top: 2px solid #c6c6c6;
      cursor: pointer
    }
    .ds-filters .article-title .svg-inline--fa {
      position: absolute;
      top: 25px;
      right: 5px
    }
    .ds-filters .article-title .fa-minus {
      display: none
    }
    .ds-filters .article-title.open .fa-minus {
      display: block
    }
    .ds-filters .article-title.open .fa-plus,
    .ds-filters .article-title:not(.open) + .accordion-content {
      display: none
    }
    .ds-filters-over {
      background-color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 3;
      opacity: 0;
      visibility: hidden;
      transition: all .3s ease
    }
    .ds-filters-over.show {
      opacity: .7;
      visibility: visible
    }
    .flex-dsn:row {
      display: flex;
      flex-wrap: wrap
    }
    .ds-filters-wrap {
      position: relative
    }
    @media (min-width: 1201px) {
      .ds-filters-wrap {
        width: auto
      }
      .ds-filters-wrap,
      .ds-filters-wrap .dsn:row {
        max-width: 1700px !important
      }
    }
    .columns .dsn:row {
      width: auto;
      margin-left: -15px;
      margin-right: -15px
    }
    .ds-filters-wrap .columns {
      display: flex
    }
    .featured-cat__wrap {
      margin-bottom: 2rem;
      height: 250px
    }
    @media (max-width: 639px) {
      .featured-cat__wrap {
        height: 65vw
      }
    }
    @media (min-width: 1024px) {
      .featured-cat__wrap {
        height: calc(50% - 1rem);
        margin-bottom: 1rem
      }
      .featured-cat__wrap:last-of-type,
      .featured-cat__wrap:nth-last-of-type(2),
      .featured-cat__wrap:nth-last-of-type(3) {
        margin-bottom: 0;
        margin-top: 1rem
      }
    }
    .featured-cat {
      display: flex;
      width: 100%;
      flex-direction: column;
      align-items: center;
      text-align: center;
      justify-content: flex-start;
      height: 100%;
      position: relative;
      transition: all .3s ease;
      background-color: #2d4062;
      overflow: hidden
    }
    .featured-cat:hover img {
      transform: scale(1.1)
    }
    .featured-cat__image {
      position: absolute;
      top: 0;
      width: 100%;
      height: calc(100% - 50px);
      -o-object-fit: cover;
      object-fit: cover;
      -o-object-position: top;
      object-position: top;
      transition: transform .3s ease
    }
    .featured-cat__title {
      font-size: 20px;
      color: #fff;
      padding: 10px;
      width: 100%;
      position: absolute;
      bottom: 0;
      background-color: #2d4062
    }
    .ds-estore-search {
      position: relative;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      align-items: center;
      padding: 35px;
      min-height: 540px;
      margin-bottom: 2em;
      background-size: cover;
      background-position: top
    }
    .page-template-template-estore .ds-estore-search {
      height: 100%;
      margin-bottom: 0
    }
    @media (min-width: 1800px) {
      .page-template-template-estore .ds-estore-search {
        height: 30vw
      }
    }
    @media (max-width: 1024px) {
      .ds-estore-search {
        min-height: 0;
        padding: 75px 35px 35px
      }
    }
    .ds-estore-search h4 {
      color: #fff;
      margin-bottom: 0
    }
    .ds-estore-search .blog-search {
      display: flex;
      margin-bottom: 0;
      width: 100%;
      max-width: 380px
    }
    .ds-estore-search .blog-search input {
      display: inline-block;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      width: 100%;
      height: auto;
      background-color: #fff;
      color: #333;
      border-radius: 5px;
      margin: 1em auto 0;
      max-width: 100%;
      box-shadow: inherit;
      background-image: url(../../images/a2.png);
      background-size: 20px;
      background-repeat: no-repeat;
      background-position: 95% 50%;
      border: 1px solid rgba(0, 0, 0, .1);
      padding: 1em 1.5em
    }
    .ds-estore-search:before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: linear-gradient(0deg, rgba(0, 0, 0, .78) 0, transparent 70%);
      z-index: 0
    }
    .archive .ds-estore-search {
      min-height: 0;
      padding: 0;
      margin: 0
    }
    .archive .ds-estore-search:before {
      display: none
    }
    .ds-estore-search * {
      z-index: 1
    }
    .ds-filters-page-content-wrap {
      width: 100%;
      display: flex;
      align-items: flex-end;
      margin-bottom: 10px
    }
    .ds-filters-page-content {
      width: 100%
    }
    .ds-filters-page-content h1 {
      font-size: 24px
    }
    .ds-filters-page-content h2 {
      font-size: 20px
    }
    .ds-filters-page-content h3 {
      font-size: 19px
    }
    .ds-filters-page-content h4 {
      font-size: 18px
    }
    .ds-filters-page-content h5 {
      font-size: 17px
    }
    .ds-filters-page-content h6 {
      font-size: 16px
    }
    .ds-filters-page-content p {
      font-size: 14px
    }
    @media (min-width: 768px) {
      .ds-filters-page-content h1 {
        font-size: 48px
      }
      .ds-filters-page-content h2 {
        font-size: 40px
      }
      .ds-filters-page-content h3 {
        font-size: 31px
      }
      .ds-filters-page-content h4 {
        font-size: 25px
      }
      .ds-filters-page-content h5 {
        font-size: 20px
      }
      .ds-filters-page-content h6 {
        font-size: 16px
      }
    }
    #ds-filter > a {
      position: absolute;
      right: 35px;
      top: 25px
    }
    #ds-filter ul {
      margin: 0
    }
    #ds-filter ul li {
      list-style-type: none
    }
    #ds-filter ul li ul {
      margin-left: 30px
    }
    #ds-filter input[type=checkbox] + label {
      display: block;
      margin: .2em;
      cursor: pointer;
      padding: .2em;
      font-size: 16px
    }
    #ds-filter input[type=checkbox] {
      display: none
    }
    #ds-filter input[type=checkbox] + label:before {
      content: "\2714";
      border: .1em solid #c6c6c6;
      border-radius: .2em;
      display: inline-block;
      width: 20px;
      height: 20px;
      padding-left: .2em;
      padding-bottom: .3em;
      margin-right: 10px;
      color: transparent;
      transition: .2s;
      font-size: 13px;
      vertical-align: top
    }
    #ds-filter input[type=checkbox] + label:active:before {
      transform: scale(0)
    }
    #ds-filter input[type=checkbox]:checked + label:before {
      background-color: #858585;
      border-color: #858585;
      color: #fff
    }
    #ds-filter [type=radio]:checked,
    #ds-filter [type=radio]:not(:checked) {
      position: absolute;
      left: -9999px
    }
    #ds-filter [type=radio]:checked + label,
    #ds-filter [type=radio]:not(:checked) + label {
      position: relative;
      padding-left: 28px;
      font-size: 16px;
      cursor: pointer;
      line-height: 20px;
      display: inline-block;
      margin-bottom: 8px
    }
    #ds-filter [type=radio]:checked + label:before,
    #ds-filter [type=radio]:not(:checked) + label:before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 20px;
      height: 20px;
      border: 1px solid #ddd;
      border-radius: 100%;
      background: #fff
    }
    #ds-filter [type=radio]:checked + label:after,
    #ds-filter [type=radio]:not(:checked) + label:after {
      content: '';
      width: 12px;
      height: 12px;
      background: #858585;
      position: absolute;
      top: 4px;
      left: 4px;
      border-radius: 100%;
      transition: all .2s ease
    }
    #ds-filter [type=radio]:not(:checked) + label:after {
      opacity: 0;
      transform: scale(0)
    }
    #ds-filter [type=radio]:checked + label:after {
      opacity: 1;
      transform: scale(1)
    }
    .ds-prices-wrap {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-end
    }
    #price_max,
    #price_min {
      font-size: 16px;
      width: 48%;
      padding: 5px 10px
    }
    #price_max {
      margin-left: 4%
    }
    .ds-filters-counter {
      font-size: 22px;
      margin-top: 10px
    }
    .ds-filters-counter__value {
      font-weight: 700;
      margin-right: 5px
    }
    .ds-filters-footer-nav .ds-filters-counter__value {
      margin-left: 5px;
      margin-right: 0
    }
    .ds-filters-footer-nav {
      justify-content: space-between;
      align-items: center;
      margin-bottom: 50px
    }
    .ds-filters-footer-nav #ds-posts_per_page {
      margin-left: 0
    }
    .ds-filters-footer-nav > .hide-for-medium-down {
      align-items: center
    }
    .ds-filters-footer-nav-right {
      display: flex;
      align-items: center
    }
    .ds-filters-footer-nav .ds-filters-counter__value {
      font-weight: 400
    }
    #toTop {
      margin-left: 30px;
    }

    .dsn-primary-site-link {
      color: var(--dealerLinkColor) !important;
    }

    .ds-filters-footer-nav #ds-filters-paged {
      border: 1px solid #ccc;
      padding: 10px 0 10px 6px;
      font-size: .875rem;
      width: 45px
    }
    .ds-filters-nav {
      justify-content: space-between;

      margin: 0 0 0px 0rem
    }
    .ds-filters-nav-right {
      display: flex;
    }
    #ds-filters-search {
      box-shadow: inherit;
      background-image: url(../../images/a2.png);
      background-size: 20px;
      background-repeat: no-repeat;
      background-position: 95% 50%;
      border: 1px solid #ccc;
      padding: 10px 15px
    }
    #ds-posts_per_page {
    }
    #ds-posts_per_page,
    #ds-sort_by {
      border: 1px solid #ccc
    }

    .ds-product {
    }

    .ds-product .single_add_to_cart_button {
      background-color: #2d4062;
      width: 78px;
      height: 38px;
      color: #fff;
      font-size: 30px;
    }
    .ds-product .single_add_to_cart_button svg {
      color: #fff;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%)
    }
    .ds-product .single_add_to_cart_button span svg {
      position: relative;
      top: auto;
      left: auto;
      transform: none;
    }
    .ds-product .single_add_to_cart_button.loading svg.fa-shopping-cart,
    .ds-product .single_add_to_cart_button svg.fa-check-circle,
    .ds-product .single_add_to_cart_button svg.fa-spinner {
      display: none
    }
    .ds-product .single_add_to_cart_button.loading svg.fa-spinner {
      display: block
    }
    .ds-product .single_add_to_cart_button.added svg.fa-shopping-cart {
      display: none
    }
    .ds-product .single_add_to_cart_button.added svg.fa-check-circle {
      display: block
    }
    .ds-product .single_add_to_cart_button:focus,
    .ds-product .single_add_to_cart_button:hover {
      background-color: #0988c2
    }
    .ds-product {
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between
    }
    .ds-product .added_to_cart {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: 600;
      z-index: 1
    }
    .ds-product .added_to_cart:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: hsla(0, 0%, 100%, .5);
      z-index: -1
    }
    .ds-product__image {
      display: block;
      position: relative;
      width: 100%;
      padding-bottom: 100%;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: 50%;
      margin-bottom: 25px
    }
    .ds-product__title {
      display: inline-block;
      font-size: 22px;
      font-weight: 600;
      color: #595959;
    }
    .ds-product__price {
      font-size: 21px;
      color: #4a4a4a
    }
    .ds-product__price del .woocommerce-Price-amount {
      color: #979595
    }
    .ds-product__price ins {
      text-decoration: none
    }
    .ds-product__price ins .woocommerce-Price-amount {
      font-weight: 700;
      color: #457574
    }
    .js-pagination .pagination {
      margin: 0;
      display: flex;
      list-style-type: none;
      color: var(--dealerLinkColor) !important;
    }
    .js-pagination .pagination li {
      margin: 0 5px
    }
    .js-pagination .pagination li a,
    .js-pagination .pagination li span {
      padding: 0 5px
    }
    @media (max-width: 1024px) {
      .ds-filters {
        transform: translateX(-100%);
        transition: transform .5s ease;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
        z-index: 21
      }
      .admin-bar .ds-filters {
        top: 32px
      }
      .ds-filters.active {
        transform: none
      }
      .ds-filters-nav-right {
        width: 100%;
        justify-content: space-between;
        margin-bottom: 25px
      }
      #ds-filter > a {
        left: 35px;
        right: auto
      }
      .ds-filters h3 {
        text-align: center;
        font-size: 20px
      }
      .ds-filters-counter {
        font-size: 14px;
        text-align: center;
        margin-bottom: 20px
      }
    }
    .show-filters {
      margin: 0 !important;
      padding: 10px 40px 10px 20px;
      border: 1px solid #ccc;
      background: transparent;
      color: #000 !important
    }
    .show-filters:hover {
      background-color: #f1f1f1;
      color: #000
    }
    .show-filters:after {
      content: '+';
      position: absolute;
      top: 9px;
      right: 4px;
      color: #000;
      font-size: 23px;
      line-height: 20px
    }
    .hide-filters {
      background: transparent !important;
      color: #000 !important;
      border: 0;
      margin: 0 !important;
      position: absolute;
      right: 0;
      top: 0;
      font-size: 31px
    }
    .apply-button {
      background-color: #2d4062;
      font-size: 25px;
      padding: 10px 30px;
      margin: 0 auto 40px !important;
      color: #fff
    }
    .ds-product__sale {
      position: absolute;
      right: -20px;
      top: -20px;
      border-radius: 50%;
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
      color: #fff;
      text-transform: uppercase;
      font-size: 17px
    }
    @media (max-width: 640px) {
      .apply-button {
        width: 100%
      }
    }
    @media (max-width: 1023px) {
      body.admin-bar #wprmenu_bar {
        top: 42px
      }
      .ds-filters-footer-nav,
      .ds-filters-footer-nav-right {
        flex-direction: column
      }
      .js-pagination {
        margin-bottom: 40px
      }
      #ds-filters-paged {
        margin: 0 20px
      }
      #toTop {
        margin-top: 40px
      }
    }
    .ds-product__meta {
      display: flex;
      justify-content: space-between
    }
    .ds-product__like {
      display: flex;
      font-size: 22px;
      align-items: center
    }
    .ds-nav-container .dsn:row {
      margin-left: -1rem;
      margin-right: -1rem;
      width: auto;
      min-width: 100%
    }
    .ds-nav-container .flex-dsn:row > .columns {
      display: flex
    }
    @media (max-width: 1024px) {
      .page-template-template-estore .ds-nav-container,
      .tax-product_cat .ds-nav-container {
        padding: 0 1rem !important
      }
      .ds-filters-page-content * {
        text-align: center !important
      }
    }
    body .ds-estore-banner-wrap {
      margin-bottom: 65px;
      padding-top: 2rem
    }
    .archive.woocommerce ul.products {
      display: flex;
      flex-wrap: wrap
    }
    .ds-archive-banner {
      padding: 40px 0;
      margin-bottom: 40px;
      background-size: cover;
      background-position: 50%
    }
    .ds-archive-banner h1 {
      font-weight: 400;
      color: #fff
    }
    .ds-back-link {
      display: inline-block;
      background: url(../img/ardsn:row.png) 0 no-repeat;
      background-size: contain;
      font-size: 16px;
      color: var(--dealerLinkColor);
      padding: 7px 0 7px 45px;
      margin-bottom: 30px
    }
    .page-template-template-estore form, .tax-product_cat form {
      margin-bottom: 1em;
    }
    .woocommerce select {
      height: 3em;
      padding: 0 1em;
    }
  </style>
<?php }); ?>

<?php get_footer(); ?>

<?php
  function dsn_get_archive_description_excerpt(): string
{
  return wp_trim_words(wp_strip_all_tags(get_the_archive_description()),
    DSN_ARCHIVE_DESCRIPTION_NUM_WORDS, '...');
}
?>