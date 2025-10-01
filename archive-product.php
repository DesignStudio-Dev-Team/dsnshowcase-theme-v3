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
<?php }); ?>

<?php get_footer(); ?>

<?php
  function dsn_get_archive_description_excerpt(): string
{
  return wp_trim_words(wp_strip_all_tags(get_the_archive_description()),
    DSN_ARCHIVE_DESCRIPTION_NUM_WORDS, '...');
}
?>