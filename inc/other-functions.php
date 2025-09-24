<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package dsShowcase Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dsShowcase_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'dsShowcase_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dsShowcase_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'dsShowcase_pingback_header');

add_filter('woocommerce_add_to_cart_fragments', 'dealer_add_to_cart_fragment');

function dealer_add_to_cart_fragment($fragments)
{
    if (!class_exists('WooCommerce')) {
        return $fragments;
    }

    global $dssSiteLanguage;
    global $woocommerce;
    $item_counter = $woocommerce->cart->cart_contents_count;
    if ($item_counter == 0) {
        $fragments['.dealer-cart'] = ' <a href="' . wc_get_cart_url() . '" class="dealer-cart dsn:text-xl dsn:px-4 dsn:border-l"><span class="sr-only">Cart</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>';
        $fragments['.cart-counter'] = '<p class="cart-counter text-right uppercase font-semibold">the cart is empty</p>';
    } else {
        $fragments['.dealer-cart'] = ' <a href="' . wc_get_cart_url() . '" class="dealer-cart dsn:text-xl dsn:px-4 dsn:border-l"><span class="sr-only">Cart</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="dealer-cart__counter dsn:align-top dsn:text-xs dsn:w-5 dsn:h-5 dsn:bg-orange-400 dsn:text-center dsn:text-black dsn:rounded-full dsn:-ml-2 dsn:-mt-2 dsn:inline-block">' . $item_counter . '</span></a>';
        $fragments['.cart-counter'] = '<p class="cart-counter dsn:text-right dsn:uppercase dsn:font-semibold">';
        
        if ($item_counter == 1) $fragments['.cart-counter'] .= $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_singular; 
        else $fragments['.cart-counter'] .= $item_counter . ' ' . dssLang($dssSiteLanguage)->woocommerce_cart->item_plural; 
                      
        $fragments['.cart-counter'] .= '</p>';
    }

    return $fragments;
}

// Create pagination
function foundation_pagination($query = '')
{
    if (empty($query)) {
        global $wp_query;
        $query = $wp_query;
    }
    $current = $_POST['paged'] ? $_POST['paged'] : get_query_var('paged');

    $big = 999999999;
    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '%#%',
        'prev_next' => true,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'current' => max(1, $current),
        'total' => $query->max_num_pages,
        'type' => 'list',
    ));

    $pagination = str_replace( 'class="page-numbers"', 'class="pagination dsn-primary-site-link"', $links ?? '' );

    echo $pagination;
}

add_action('wp_ajax_ds_filter', 'ds_filtration');
add_action('wp_ajax_nopriv_ds_filter', 'ds_filtration');

function ds_filtration($categories = null, $specials = null, $featured_image = null, $price_min = null, $price_max = null, $sale = null, $search = null, $order_by = null, $order = null, $posts_per_page = null, $paged = null)
{
  $categories     = $categories ?: $_POST['categories'];
  $order          = $order ?: $_POST['order'];
  $search         = $search ?: $_POST['search'];
  $order_by       = $order_by ?: $_POST['orderby'];
  $specials       = $specials ?: $_POST['specials'];
  $featured_image = $featured_image ?: $_POST['featured_image'];
  $price_min      = $price_min ?: $_POST['price_min'];
  $price_max      = $price_max ?: $_POST['price_max'];
  $sale           = $sale ?: $_POST['sale'];
  $posts_per_page = $posts_per_page ?: $_POST['posts_per_page'];
  // Determine current page from POST, then GET, then WP query var
  $paged          = $paged ?: (isset($_POST['paged']) ? intval($_POST['paged']) : null);
  if (!$paged && isset($_GET['paged'])) {
      $paged = intval($_GET['paged']);
  }
  if (!$paged && isset($_GET['page'])) { // fallback some themes use 'page'
      $paged = intval($_GET['page']);
  }
  if (!$paged) {
      $qv_paged = get_query_var('paged');
      if ($qv_paged) {
          $paged = intval($qv_paged);
      }
  }

  // Accept unified sort_by (e.g., price-asc, title-desc, date_desc) and map to WP_Query orderby/order
  $sort_by        = isset($_POST['sort_by']) ? sanitize_text_field($_POST['sort_by']) : null;
  if (!$sort_by && isset($_POST['sort'])) {
      $sort_by = sanitize_text_field($_POST['sort']);
  }
  if (!$sort_by && isset($_GET['sort_by'])) {
      $sort_by = sanitize_text_field($_GET['sort_by']);
  }
  if (!$sort_by && isset($_GET['sort'])) {
      $sort_by = sanitize_text_field($_GET['sort']);
  }

  // Normalize incoming values and set defaults
  if (!$order_by && !$sort_by) {
      $order_by = 'date';
  }
  if (!$order) {
      $order = 'DESC';
  }

  // If only legacy orderby provided, normalize price alias
  if ($order_by && !$sort_by) {
      $lower_ob = strtolower($order_by);
      if ($lower_ob === 'price') {
          $order_by = 'dsn_price'; // use custom price sorting (joins provided by filters below)
      } elseif (in_array($lower_ob, ['title','date'], true)) {
          $order_by = $lower_ob;
      }
  }

  // If sort_by is provided, it is authoritative
  if ($sort_by) {
      $sort_by = str_replace('_', '-', strtolower($sort_by));
      switch ($sort_by) {
          case 'price-asc':
              $order_by = 'dsn_price';
              $order = 'ASC';
              break;
          case 'price-desc':
              $order_by = 'dsn_price';
              $order = 'DESC';
              break;
          case 'title-asc':
              $order_by = 'title';
              $order = 'ASC';
              break;
          case 'title-desc':
              $order_by = 'title';
              $order = 'DESC';
              break;
          case 'date-asc':
              $order_by = 'date';
              $order = 'ASC';
              break;
          case 'date-desc':
              $order_by = 'date';
              $order = 'DESC';
              break;
          default:
              // fallback
              $order_by = $order_by ?: 'date';
              $order = $order ?: 'DESC';
              break;
      }
  }

  // Use a safe orderby for category query (get_posts suppresses filters; avoid custom keys like dsn_price)
  $category_orderby = ($order_by === 'dsn_price') ? 'date' : $order_by;

  $categoryArgs  = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'posts_per_page'        => '24',
    'order' => $order,
    'orderby' => $category_orderby,
    'tax_query'             => array(
            array(
              'taxonomy'  => 'product_cat',
              'field'     => 'slug',
              'terms'     => $search,
              'operator'  => 'IN',
            )
        )
    );


    $args = array(
      'post_type' => 'product',
      'post_status' => 'publish',
      'order' => $order,
      'orderby' => $order_by,
    );

    // Compute UI selector (map custom dsn_price back to 'price')
    $ui_orderby = ($order_by === 'dsn_price') ? 'price' : $order_by;
    $order_selector = strtolower($ui_orderby . '-' . $order);

    if ( !empty($search)) {
        $args['s'] = $search;
    }

    if ( !empty($paged)) {
        $args['paged'] = $paged;
    }

    if ( !empty($posts_per_page)) {
        $args['posts_per_page'] = $posts_per_page;
    } else {
        $args['posts_per_page'] = 24;
    }

  if ( !empty($categories)) {
        $cat_array = explode(',', $categories);
        $args['tax_query'] = array(
            'relation ' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $cat_array
            ),
        );
    }

    if (!empty($specials) && get_field('specials_category', 'options')) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $specials
        );
    }

    $args['meta_query']['relation'] = 'AND';

    if (!empty($price_min) || !empty($price_max) || (isset($featured_image) && $featured_image === 'on')) {
        $args['meta_query'][0] = array('relation' => 'AND');
    }

    // if both minimum price and maximum price are specified we will use BETWEEN comparison
    if (!empty($price_min) && !empty($price_max)) {
        $args['meta_query'][0][] = array(
            'key' => '_price',
            'value' => array($price_min, $price_max),
            'type' => 'numeric',
            'compare' => 'between'
        );
    } else {
        // if only min price is set
        if (!empty($price_min)) {
            $args['meta_query'][0][] = array(
                'key' => '_price',
                'value' => $price_min,
                'type' => 'numeric',
                'compare' => '>'
            );
        }

        // if only max price is set
        if (!empty($price_max)) {
            $args['meta_query'][0][] = array(
                'key' => '_price',
                'value' => $price_max,
                'type' => 'numeric',
                'compare' => '<'
            );
        }
    }

    // show only sale products
    if (isset($sale) && $sale === 'true') {
        $args['meta_query'][1]['relation'] = 'OR';
        $args['meta_query'][1][] = array( // Simple products type
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'numeric'
        );
        $args['meta_query'][1][] = array( // Variable products type
            'key' => '_min_variation_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'numeric'
        );
    }

    // Set our defaults to keep our code DRY
    $defaults = [
        'fields'                 => 'ids',
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
        'cache_results'          => false
    ];

    // Build complete candidate lists for post__in (fetch all matching IDs for pagination to work)
    $categoryArgsForIds = $categoryArgs;
    $categoryArgsForIds['posts_per_page'] = -1;
    unset($categoryArgsForIds['paged']);

    $argsForIds = $args;
    $argsForIds['posts_per_page'] = -1;
    unset($argsForIds['paged']);

    $category_query = get_posts(array_merge($defaults, $categoryArgsForIds));
    $product_query = get_posts(array_merge($defaults, $argsForIds));

    // used for counting posts
    $post_query_count = new WP_Query(array_merge($defaults, $args));
    $categoryArgs['posts_per_page'] = 10000000000000;
    $post_cat_query_count = new WP_Query(array_merge($defaults, $categoryArgs));

    if (!$post_query_count->found_posts && $post_cat_query_count->found_posts) {
      $post_query_count->found_posts = $post_cat_query_count->found_posts;
    }


    // Merge the two results
    $post_ids = array_merge($category_query, $product_query); //. You can swop around here

    $final_args = [
        'post_type' => ['product'],
        'post__in'  => $post_ids,
        'orderby'   => $order_by,
        'order'     => $order,
    ];

    if ( !empty($posts_per_page)) {
        $final_args['posts_per_page'] = $posts_per_page;
    } else {
        $final_args['posts_per_page'] = 24;
    }

    // Add pagination to final query
    $final_args['paged'] = max(1, intval($paged ?: 1));

    $the_query = new WP_Query($final_args);
?>
    <div class="dsn:container dsn:mx-auto">
    <div id="ds-filters-root" class="dsn:row dsn:flex-row dsn:w-full dsn:flex dsn:flex-wrap"    data-counter="<?php echo $post_query_count->found_posts; ?>"
        data-categories="<?php echo $categories; ?>" data-default-orderby="<?php echo esc_attr($order_by); ?>" data-default-order="<?php echo esc_attr($order); ?>"
    >
      <div class="dsn:flex ds-filters-nav dsn:w-full dsn:gap-3 dsn:flex-wrap dsn:pt-4">
        <div class="ds-filters-counter dsn:hidden dsn:md:block hide-for-medium-down">
              <span class="ds-filters-counter__value"><?php echo $post_query_count->found_posts; ?> </span>
              <?php _e(' Products to Explore', 'dealer-theme'); ?>
          </div>
        <div class="ds-filters-nav-right dsn:flex-1 dsn:min-w-0 dsn:justify-end dsn:gap-3 dsn:flex flex-wrap">
            <button class="show-filters js-toggle-filters dsn:lg:hidden relative">Filters</button>

            <select name="posts_per_page" id="ds-posts_per_page" class="ds-posts_per_page dsn:hidden dsn:lg:block"">
                <option value="24" <?php echo $posts_per_page === 24 ? 'selected' : ''; ?>>24
                    Per Page
                </option>
                <option value="36" <?php echo $posts_per_page === 36 ? 'selected' : ''; ?>>36
                    Per Page
                </option>
                <option value="72" <?php echo $posts_per_page === 72 ? 'selected' : ''; ?>>72
                    Per Page
                </option>
            </select>

            <select name="sort_by" id="ds-sort_by">
                <option value="" disabled selected>Sort By:</option>
                <option value="price-desc" <?php echo $order_selector === 'price-desc' ? 'selected' : ''; ?>>
                    Price (High to Low)
                </option>

                <option value="price-asc" <?php echo $order_selector === 'price-asc' ? 'selected' : ''; ?>>
                    Price (Low to High)
                </option>

                <option value="title-asc" <?php echo $order_selector === 'title-asc' ? 'selected' : ''; ?>>
                    Name (A-Z)
                </option>
                <option value="title-desc" <?php echo $order_selector === 'title-desc' ? 'selected' : ''; ?>>
                    Name (Z-A)
                </option>
            </select>

            <form id="ds-filters-search-wrap" class="hide-for-medium-down dsn:hidden dsn:md:flex dsn:flex-1 dsn:max-w-sm dsn:min-w-[220px] relative" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" name="s" id="ds-filters-search" class="search__input" placeholder="<?php _e('Search by keyword', 'dealer-theme'); ?>" value="<?php echo $search; ?>" />
                <button type='button' id='ds-filters-search-go' class='dsn:cursor-pointer dsn:inline-flex dsn:items-center dsn:justify-center dsn:ml-2 dsn:w-10 dsn:h-12 dsn:p-0 dsn:bg-black dsn:text-white dsn:hover:bg-gray-700 dsn:transition-colors dsn:duration-150 dsn:rounded' aria-label='<?php _e('Search', 'dealer-theme'); ?>' style='<?php echo !empty($search) ? "display:none;" : ""; ?>'>
                    <?php dsn_icon('search', 'dsn:w-5 dsn:h-5'); ?>
                </button>
                <button type='button' id='ds-filters-search-clear' class='dsn:cursor-pointer dsn:inline-flex dsn:items-center dsn:justify-center dsn:ml-2 dsn:w-10 dsn:h-12 dsn:p-0 dsn:bg-black dsn:text-white dsn:hover:bg-gray-700 dsn:transition-colors dsn:duration-150 dsn:rounded' aria-label='<?php _e('Clear search', 'dealer-theme'); ?>' style='<?php echo !empty($search) ? "" : "display:none;"; ?>'>
                    <?php dsn_icon('clear', 'dsn:w-5 dsn:h-5'); ?>
                </button>
            </form>
        </div>
      </div>
    </div>
  </div>

    <div class="dsn:py-5">
      <?php if (count($post_ids) > 0 && $the_query->have_posts()) : ?>
        <div class="dsn:container dsn:mx-auto dsn:row dsn:w-full dsn:grid dsn:grid-cols-1 dsn:sm:grid-cols-2 dsn:md:grid-cols-3 dsn:gap-8 dsn:gap-y-12">
            <?php while ($the_query->have_posts()) :
                $the_query->the_post(); ?>
                <?php $product = wc_get_product(get_the_ID()); ?>
                <div>
                    <div class="ds-product dsn:bg-white dsn:border-1 dsn:border-solid dsn:border-gray-300">
                        <a href="<?php echo get_permalink() ?>">
                          <?php if ($product->is_on_sale()) : ?>
                              <span class="ds-product__sale">Sale</span>
                          <?php endif ?>

                          <span class="ds-product__image" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')"></span>
                        </a>

                        <a href='<?php echo get_permalink() ?>'>
                          <span class="ds-product__title dsn:px-4 dsn:mb-5">
                            <?php the_title(); ?>
                          </span>
                        </a>
                        <h6 class="ds-product__categories dsn:px-4 dsn:pb-5 dsn:normal-case dsn:m-0 dsn:text-base md:dsn:text-base lg:dsn:text-base dsn:font-dsw dsn:font-normal dsn:truncate dsn:grid-category">
                          <?php get_the_categories($product); ?>
                        </h6>
                        <div class="ds-product__footer dsn:bg-gray-100 dsn:p-4">
                          <div class='ds-product__meta'>
                            <div class='ds-product__price'>
                              <?php echo $product->get_price_html(); ?>
                            </div>
                            <?php if ($product->get_price_html()) { ?>
                              <button class="single_add_to_cart_button dsw-primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:px-3 dsn:py-2" value="<?php echo get_the_ID(); ?>">
                                    <span class='dsn:flex dsn:items-center'>
                                      <?php dsn_icon('plus', 'dsn:w-4 dsn:h-4'); ?>
                                    </span>
                                    <span class="dsn:flex dsn:items-center dsn:hover:bg-gray-700 dsn:transition-colors dsn:duration-150">
                                      <?php     dsn_icon('shopping-cart', 'dsn:w-5 dsn:h-5'); ?>
                                    </span>
                              </button>
                            <?php } ?>
                          </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class='dsn:flex ds-filters-footer-nav dsn:w-full dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3'>
            <div class='dsn:hidden dsn:lg:block'>
              <span class="ds-filters-counter"><?php
                echo $post_query_count->found_posts; ?>
                Products to Explore </span>
            </div>
            <div id="dsPagination" class="js-pagination">
              <?php
              foundation_pagination($post_query_count) ?>
            </div>
            <div class="ds-filters-footer-nav-right">
              <?php
              if ($post_query_count->max_num_pages
                && $post_query_count->max_num_pages > 1
              ) : ?>
                <div class="dsn:flex dsn:items-center dsn:gap-2">
                  Go to page
                  <input type="number" name="paged"
                         min="1" 
                         value="<?php echo $post_query_count->query_vars['paged']; ?>"
                         max="<?php echo $post_query_count->max_num_pages; ?>"
                         id="ds-filters-paged"
                  >
                  of
                  <?php echo $post_query_count->max_num_pages; ?>

                  <button type='button' id='ds-filters-paged-go' class='dsn:cursor-pointer dsn:inline-flex dsn:items-center dsn:justify-center dsn:ml-2 dsn:w-8 dsn:h-8 dsn:p-0 dsn:bg-black dsn:text-white dsn:hover:bg-gray-700 dsn:transition-colors dsn:duration-150 dsn:rounded' aria-label='Go to page'>
                    <?php dsn_icon('enter', 'dsn:w-6 dsn:h-6'); ?>
                  </button>
                  <style>
                    #ds-filters-paged-go:hover{background-color:#2b2b2b!important;}
                  </style>
                </div>
              <?php
              endif; ?>
              <a href="#" class="dsn-primary-site-link dsn:hidden dsn:lg:block" id="toTop">Back to
                Top</a>
            </div>
          </div>
        </div>
      <?php wp_reset_postdata();
        else :
          echo '<h2 class="dsn:text-center" style="width: 100%">No products found</h2>';
        endif;
      ?>
    </div>
  <?php
}

function get_the_categories(WC_Product $product)
{
  $category_ids    = $product->get_category_ids();
  $category_titles = [];
  foreach ($category_ids as $categoryId) {
    $cat = get_term($categoryId, 'product_cat');

    if ($cat && ! is_wp_error($cat)) {
      $category_titles[] = $cat->name;
    }
  }
  echo implode(' / ', $category_titles);
}


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{
    if (!class_exists('WooCommerce')) {
        wp_die();
    }

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    $variation_id = $_POST['variation_id'];

    //check if product from $product_id is a product id from woocommerce
    $product = wc_get_product($product_id);
    if($product->is_type('variable')){
        //go to product page
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    } else {
        if (WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
            do_action('woocommerce_ajax_added_to_cart', $product_id);

            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                wc_add_to_cart_message(array($product_id => $quantity), true);
            }

            WC_AJAX::get_refreshed_fragments();
        }
    }
    
    wp_die();
}

add_action('wp_footer', 'custom_quantity_fields_script');
function custom_quantity_fields_script()
{
    ?>
    <script type='text/javascript'>
        jQuery(function($) {
            if (!String.prototype.getDecimals) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }
            }
            // Quantity "plus" and "minus" buttons
            $(document.body).on('click', '.plus, .minus', function() {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 0;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

                // Change the value
                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                    }
                } else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                    }
                }

                // Trigger change event
                $qty.trigger('change');
            });
        });
    </script>
<?php
}

/**
 * @snippet       Display Coupon under Proceed to Checkout Button @ WooCommerce Cart
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=81542
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.1
 */

add_action('woocommerce_proceed_to_checkout', 'bbloomer_display_coupon_form_below_proceed_checkout', 25);

function bbloomer_display_coupon_form_below_proceed_checkout()
{
    if (!class_exists('WooCommerce')) {
        return;
    }

    global $dssSiteLanguage;
?>


    <form class="woocommerce-coupon-form dsn:mb-6" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
        <?php if (wc_coupons_enabled()) { ?>

            <p class="dsn:mb-4 dsn:mt-8 dsn:text-lg"><?php echo dssLang($dssSiteLanguage)->woocommerce_cart->coupon_code; ?></p>
            <div class="coupon dsn:under-proceed dsn:border dsn:rounded dsn:h-12">
                <input type="text" name="coupon_code" class="input-text dsn:text-lg dsn:px-3 dsn:ml-1 dsn:uppercase" id="coupon_code" value="" placeholder="<?php echo dssLang($dssSiteLanguage)->woocommerce_cart->coupon_placeholder; ?>" style="width: 100%" />
                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply', 'woocommerce'); ?>"><?php esc_attr_e('Apply', 'woocommerce'); ?></button>
            </div>
        <?php } ?>
    </form>

    <?php woocommerce_shipping_calculator("Caclulate Shipping"); ?>


    <?php
}


/**
 * Funtion to get post count from given term or terms and its/their children
 *
 * @param (string) $taxonomy
 * @param (int|array|string) $term Single integer value, or array of integers or "all"
 * @param (array) $args Array of arguments to pass to WP_Query
 * @return $q->found_posts
 *
 */
function get_term_post_count($taxonomy = 'category', $term = '', $args = [])
{
    // Lets first validate and sanitize our parameters, on failure, just return false
    if (!$term)
        return false;

    if ($term !== 'all') {
        if (!is_array($term)) {
            $term = filter_var($term, FILTER_VALIDATE_INT);
        } else {
            $term = filter_var_array($term, FILTER_VALIDATE_INT);
        }
    }

    if ($taxonomy !== 'category') {
        $taxonomy = filter_var($taxonomy, FILTER_UNSAFE_RAW );
        if (!taxonomy_exists($taxonomy))
            return false;
    }

    if ($args) {
        if (!is_array($args))
            return false;
    }

    // Now that we have come this far, lets continue and wrap it up
    // Set our default args
    $defaults = [
        'posts_per_page' => 1,
        'fields' => 'ids'
    ];

    if ($term !== 'all') {
        $defaults['tax_query'] = [
            [
                'taxonomy' => $taxonomy,
                'terms' => $term
            ]
        ];
    }
    $combined_args = wp_parse_args($args, $defaults);
    $q = new WP_Query($combined_args);

    // Return the post count
    return $q->found_posts;
}

remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
add_action('woocommerce_after_variations_form', 'woocommerce_single_variation_add_to_cart_button', 20);
//add_action('woocommerce_single_product_summary', 'woocommerce_single_variation', 20);

// Move "Order Summary" on the checkout page
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_before_customer_details', 'woocommerce_checkout_payment', 20);

// Move coupon form on the checkout form
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_action('woocommerce_review_order_after_order_total', 'woocommerce_checkout_coupon_form');

// Move "place order" button
function output_payment_button()
{
    global $dssSiteLanguage;
    
    $order_button_text = apply_filters('woocommerce_order_button_text', dssLang($dssSiteLanguage)->woocommerce_cart->payment_shipping_btn);
    echo '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '" />';
}

add_action('woocommerce_checkout_after_order_review', 'output_payment_button');




add_filter('woocommerce_default_address_fields', 'custom_default_address_fields');
function custom_default_address_fields($address_fields)
{
    global $dssSiteLanguage;

    if (is_checkout()) {

        // dssLang($dssSiteLanguage)->woocommerce_cart->street_address
        $address_fields['address_1']['label'] = dssLang($dssSiteLanguage)->woocommerce_cart->street_address;
        $address_fields['country']['label'] = dssLang($dssSiteLanguage)->woocommerce_cart->country;
        $address_fields['postcode']['label'] = __('Postal Code', 'woocommerce');
        $address_fields['city']['label'] = __('City', 'woocommerce');
    }
    return $address_fields;
}

add_filter('woocommerce_checkout_fields', 'remove_company_name_address_2');
function remove_company_name_address_2($fields)
{
    global $dssSiteLanguage;

    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);

    $fields['billing']['billing_phone']['label'] = __('Phone Number', 'woocommerce');
    $fields['shipping']['shipping_phone']['label'] = __('Phone Number', 'woocommerce');

    $fields['billing']['billing_postcode']['label'] = __('Postal Code', 'woocommerce');
    $fields['shipping']['shipping_postcode']['label'] = __('Postal Code', 'woocommerce');

    $fields['shipping']['shipping_email'] = array(
        'label'     => __('Email Address', 'woocommerce'),
        'placeholder'   => _x('Email Address', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide'),
        'clear'     => true
    );
    $fields['shipping']['shipping_notes'] = array(
        'type' => 'textarea',
        'class' => array('notes'),
        'label' => dssLang($dssSiteLanguage)->woocommerce_cart->shipping_notes,
        'placeholder' => _x(dssLang($dssSiteLanguage)->woocommerce_cart->customer_notes_for_order, 'placeholder', 'woocommerce')
    );

    return $fields;
}

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Shipping Email').':</strong> ' . get_post_meta( $order->get_id(), '_shipping_email', true ) . '</p>';
    echo '<p><strong>'.__('Shipping Notes').':</strong> ' . get_post_meta( $order->get_id(), '_shipping_notes', true ) . '</p>';
}

add_action('woocommerce_cart_is_empty', 'add_content_empty_cart');

function add_content_empty_cart()
{
    if (WC()->cart->get_cart_contents_count() === 0) { ?>
        <div class="md:h-48"></div>
    <?php
    }
}



add_action('wp_enqueue_scripts', 'wsis_dequeue_stylesandscripts_select2', 100);
function wsis_dequeue_stylesandscripts_select2()
{
    if (class_exists('woocommerce')) {
        wp_dequeue_style('selectWoo');
        wp_deregister_style('selectWoo');

        wp_dequeue_script('selectWoo');
        wp_deregister_script('selectWoo');
    }
}

add_filter('woocommerce_enable_order_notes_field', '__return_false');

// Display the product thumbnail in order received page
add_filter('woocommerce_order_item_name', 'order_received_item_thumbnail_image', 10, 3);
function order_received_item_thumbnail_image($item_name, $item, $is_visible)
{
    // Targeting order received page only
    if (!is_wc_endpoint_url('order-received')) return $item_name;

    // Get the WC_Product object (from order item)
    $product = $item->get_product();

    if ($product->get_image_id() > 0) {
        $product_image = '<span class="inline-block product-thumbnail mr-2">' . $product->get_image(array(60, 60)) . '</span>';
        $item_name = $product_image . $item_name;
    }

    return $item_name;
}


/**
 * Get Custom HTML for a gallery image.
 */
function ds_get_gallery_image_html($attachment_id, $main_image = false)
{
    $flexslider = (bool)apply_filters('woocommerce_single_product_flexslider_enabled', get_theme_support('wc-product-gallery-slider'));
    $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
    $thumbnail_size = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
    $image_size = apply_filters('woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size);
    $full_size = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));
    $thumbnail_src = wp_get_attachment_image_src($attachment_id, $thumbnail_size);
    $full_src = wp_get_attachment_image_src($attachment_id, $full_size);
    $alt_text = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
    $ds_product_id = 'ds_product_gallery_id_' . rand(0, 9999999);
    $image = wp_get_attachment_image(
        $attachment_id,
        $image_size,
        false,
        apply_filters(
            'woocommerce_gallery_image_html_attachment_image_params',
            array(
                'title' => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                'data-caption' => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                'data-src' => esc_url($full_src[0]),
                'data-large_image' => esc_url($full_src[0]),
                'data-large_image_width' => esc_attr($full_src[1]),
                'data-large_image_height' => esc_attr($full_src[2]),
                'class' => esc_attr($main_image ? 'wp-post-image' : ''),
                //                'id'                      => $ds_product_id
            ),
            $attachment_id,
            $image_size,
            $main_image
        )
    );

    return '<div data-thumb="' . esc_url($thumbnail_src[0]) . '" data-thumb-alt="' . esc_attr($alt_text) . '" class="woocommerce-product-gallery__image ">'
        //        . '<a href="' . esc_url($full_src[0]) . '">'
        . $image
        //        . '</a>'
        . '</div>';
}

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/* Convert hexdec color string to rgb(a) string */
function hex2rgba($color, $opacity = false)
{
    $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if (empty($color))
        return $default;
    //Sanitize $color if "#" is provided 
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);
    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }
    //Return rgb(a) color string
    return $output;
}


add_action('wp_ajax_ds_cat_slider_filter', 'ds_cat_slider_filter');
add_action('wp_ajax_nopriv_ds_cat_slider_filter', 'ds_cat_slider_filter');

function ds_cat_slider_filter() {
        
        $post_type = 'learning';
        $taxonomy  = 'learning_cat';
        $terms     = $_POST['term_id'];
        $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ),
            ),
        );


            $loop = new WP_Query( $args );

            if ( $loop->have_posts() ) :

                ?>
                <div class="cat-slider flex flex-wrap pt-5 pb-16">
                    <?php
                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    
                        <?php get_template_part('template-parts/reuseable-block-templates/learning-slider-slides'); ?>

                <?php endwhile; ?>

                </div>
                <div class="cat-nav flex justify-center items-center"></div>

        <?php 
            endif;
            wp_reset_postdata();
        die();

}
function retrieve_var1_replacement( $var1 ) {
    return $_REQUEST[$var1];
}
function register_my_plugin_extra_replacements() {
    wpseo_register_var_replacement( '%%hottub%%', 'retrieve_var1_replacement', 'advanced', 'Include "hottub" query string.' );
    wpseo_register_var_replacement( '%%brand_name%%', 'retrieve_var1_replacement', 'advanced', 'Include "brand_name" query string.' );
    wpseo_register_var_replacement( '%%product_name_field%%', 'retrieve_var1_replacement', 'advanced', 'Include "product_name_field" query string.' );
    wpseo_register_var_replacement( '%%swimspa%%', 'retrieve_var1_replacement', 'advanced', 'Include "swimspa" query string.' );
    wpseo_register_var_replacement( '%%model%%', 'retrieve_var1_replacement', 'advanced', 'Include "model" query string.' );
}
if (function_exists('wpseo_register_var_replacement'))
    add_action( 'wpseo_register_extra_replacements', 'register_my_plugin_extra_replacements' );

/**
 * Custom sorting for product price to consider _price and _regular_price.
 *
 * @param string $orderby_sql The ORDERBY clause of the query.
 * @param WP_Query $query The WP_Query instance.
 * @return string The modified ORDERBY clause.
 */
function dsn_orderby_price_dual_key( $orderby_sql, $query ) {
    // Only apply to our specific price sort
    if ( 'dsn_price' !== $query->get( 'orderby' ) ) {
        return $orderby_sql;
    }

    global $wpdb;
    $order = $query->get( 'order' );
    if ( ! in_array( strtoupper( $order ), array( 'ASC', 'DESC' ) ) ) {
        $order = 'ASC';
    }

    // Order by _price if it exists, otherwise by _regular_price
    $orderby_sql = "CAST(COALESCE(price_meta.meta_value, regular_price_meta.meta_value) AS DECIMAL(10,2)) $order, {$wpdb->posts}.post_date DESC";

    return $orderby_sql;
}
add_filter( 'posts_orderby', 'dsn_orderby_price_dual_key', 10, 2 );

/**
 * Custom join for product price to consider _price and _regular_price.
 *
 * @param string $join The JOIN clause of the query.
 * @param WP_Query $query The WP_Query instance.
 * @return string The modified JOIN clause.
 */
function dsn_join_price_dual_key( $join, $query ) {
    // Only apply to our specific price sort
    if ( 'dsn_price' !== $query->get( 'orderby' ) ) {
        return $join;
    }

    global $wpdb;
    // Join for _price
    $join .= " LEFT JOIN {$wpdb->postmeta} AS price_meta ON ({$wpdb->posts}.ID = price_meta.post_id AND price_meta.meta_key = '_price')";
    // Join for _regular_price
    $join .= " LEFT JOIN {$wpdb->postmeta} AS regular_price_meta ON ({$wpdb->posts}.ID = regular_price_meta.post_id AND regular_price_meta.meta_key = '_regular_price')";
    
    return $join;
}
add_filter( 'posts_join', 'dsn_join_price_dual_key', 10, 2 );

/**
 * Ensure products with either price key are included when sorting by price.
 */
add_filter( 'posts_where', function( $where, $query ) {
    if ( 'dsn_price' === $query->get( 'orderby' ) ) {
        $where .= " AND (price_meta.meta_key IS NOT NULL OR regular_price_meta.meta_key IS NOT NULL) ";
    }
    return $where;
}, 10, 2 );

add_filter('gform_confirmation_anchor', '__return_false');


/**
 * Get bread crumbs HTML code
 */
function dswPageBreadCrumbs()
{
    if (get_field('have_breadcrumbs', 'option') && function_exists('yoast_breadcrumb')) {
        $breadCrumbHtml = do_shortcode('[wpseo_breadcrumb]');
        $breadCrumbHtml = str_replace('/product-category', '', $breadCrumbHtml ?? ''); // english
        $breadCrumbHtml = str_replace('/categorie-produit', '', $breadCrumbHtml ?? ''); // french

        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/shop/">Shop</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link
        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/en/shop/">Shop</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link
        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/shop/">Products</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link
        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/en/shop/">Products</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link
        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/boutique/">Boutique</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link French
        $breadCrumbHtml = str_replace('» <span><a href="' . get_site_url() . '/fr/boutique/">Boutique</a></span> ', "", $breadCrumbHtml ?? ''); // remove "shop" link French

        $breadCrumbHtml = str_replace('®', '<sup class="dsw-breadcrumb-sup">®</sup>', $breadCrumbHtml ?? '');
        $breadCrumbHtml = str_replace('™', '<sup class="dsw-breadcrumb-sup">™</sup>', $breadCrumbHtml ?? '');

        echo '<div class="dsw-breadcrumb-container-px-10 px-10 pt-1">
            <div class="dsw-breadcrumb-container dsw-breadcrumb">' .
            $breadCrumbHtml .
            '</div>
        </div>';
    }
}


/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dsShowcase Theme
 */

if ( ! function_exists( 'dsShowcase_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function dsShowcase_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'dsShowcase' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'dsShowcase' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'dsShowcase_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function dsShowcase_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'dsShowcase' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'dsShowcase' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'dsShowcase' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'dsShowcase' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dsShowcase' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'dsShowcase' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'dsShowcase_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function dsShowcase_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

	<?php endif; // End is_singular().
}
endif;


function dss_publish_promotion ($promotion_id)
{
    // add it to the /promotions page
    $promotion_pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-promotions.php'
    ));
    foreach($promotion_pages as $page){
        $promotion_list = get_field( 'related_promotions_page_cpt', $page->ID );

        $thePost = get_post ($promotion_id);
        $new_promotion = $thePost;
                        
        if( !is_array($promotion_list) ):
            $promotion_list = [];
        endif;

        array_push( $promotion_list, $new_promotion );
        update_field( 'related_promotions_page_cpt', $promotion_list, $page->ID );
    }
}

add_action('publish_promotions', 'dss_publish_promotion');

//add a cron job to remove promotions that are out of date
function dss_remove_add_promotions() {
    if(is_page('promotions')) {
    
    $args = array(
        'post_type' => 'promotions',
        'posts_per_page' => -1,
    );

    $promotions = get_posts($args);
    if($promotions) {
    foreach($promotions as $promotion) {

        $today = date('Ymd');
        $startPromotion = get_field('promo_start_date', $promotion->ID);
        $endPromotion = get_field('promo_end_date', $promotion->ID);

        //convert $startPromotion and $endPromotion to Ymd
        if($startPromotion) {
            $startPromotion = date('Ymd', strtotime($startPromotion));
        }
        if($endPromotion) {
            $endPromotion = date('Ymd', strtotime($endPromotion));
        }
        
        if($today < $startPromotion || $today > $endPromotion) {
            //remove from the /promotions page
            $promotion_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-promotions.php'
            ));
            foreach($promotion_pages as $page){
                $promotion_list = get_field( 'related_promotions_page_cpt', $page->ID );

                $new_promotion_list = [];
                foreach($promotion_list as $promo) {
                    if(isset($promo->ID) && $promo->ID != $promotion->ID) {
                        array_push($new_promotion_list, $promo);
                    }
                  
                }

                update_field( 'related_promotions_page_cpt', $new_promotion_list, $page->ID );
            }
        } 
        //add promotion if is on date range
        else {
            dss_publish_promotion($promotion->ID);
        }
    }
    }
 }
}

add_action('template_redirect', 'dss_remove_add_promotions');


/* languages */
$dssSiteLanguage = apply_filters( 'wpml_current_language', NULL );
if (!$dssSiteLanguage)
    $dssSiteLanguage = 'en';
  
// example for language:  echo dssLang($dssSiteLanguage)->footer->get_directions;     
function dssLang($dssSiteLanguage = 'en')
{
    $data = file_get_contents(locate_template("languages/" . $dssSiteLanguage . ".json"), true);
    $data = json_decode($data);

    return $data;
}

function dssGetLanguageOptions()
{

    // for SVG flags:
    // https://github.com/lipis/flag-icons/tree/main/flags
    // has to be set in console

    
    // get the list of languages with the url for the page that loaded
    $languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=0&orderby=code' );

    //check if file exists
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/syndified/website-content/json/site.json'))
    {
        $syndication_json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/syndified/website-content/json/site.json');
        $syndication_json_data = json_decode($syndication_json, true);
    }
    else
    {
        $syndication_json_data = [];
    }
    // $syndication_json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/syndified/website-content/json/site.json');

    // $syndication_json_data = json_decode($syndication_json, true);

    $useLanguages = [];
    // site's main language
    if(is_array($languages)) {
    foreach ($languages as $language)
    {
        if (explode ('_', $language['default_locale'])[0] == explode ('_', $syndication_json_data['main_language']['abbreviated_name'])[0])
        {
            $syndication_json_data['main_language']['url'] = $language['url'];
            $syndication_json_data['main_language']['native_name'] = $language['native_name'];
            $useLanguages[] = $syndication_json_data['main_language'];
        }
    }
    // site's secondary languages
    foreach ($languages as $language)
    {
        foreach ($syndication_json_data['languages'] as $console_lang)
        {
            if (explode ('_', $language['default_locale'])[0] == explode ('_', $console_lang['abbreviated_name'])[0])
            {
                $console_lang['url'] = $language['url'];
                $console_lang['native_name'] = $language['native_name'];
                $useLanguages[] = $console_lang;
            }
        }
        
    }
    }
    return $useLanguages;
}

//disable support for comments on post types
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
    
}
add_action('init', 'disable_comments_post_types_support');

//remove comments from admin bar
function remove_admin_bar_comments() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_comments');

//remove comments from the admin sidebar
function remove_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comments_admin_menu');

// Close comments on the front-end
function disable_comments_status() {
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);


// Disable plugin update email notifications
add_filter( 'auto_plugin_update_send_email', '__return_false' );


// Register Custom Post Type
function dsShowcase_promotions() {
	
    $labels = array(
        'name'                  => _x( 'Promotions', 'Post Type General Name', 'dsShowcase' ),
        'singular_name'         => _x( 'Promotion', 'Post Type Singular Name', 'dsShowcase' ),
        'menu_name'             => __( 'Promotions', 'dsShowcase' ),
        'name_admin_bar'        => __( 'Promotions', 'dsShowcase' ),
        'archives'              => __( 'Promotions Archives', 'dsShowcase' ),
        'attributes'            => __( 'Item Attributes', 'dsShowcase' ),
        'parent_item_colon'     => __( 'Parent Item:', 'dsShowcase' ),
        'all_items'             => __( 'All Items', 'dsShowcase' ),
        'add_new_item'          => __( 'Add New Item', 'dsShowcase' ),
        'add_new'               => __( 'Add New Promotion', 'dsShowcase' ),
        'new_item'              => __( 'New Promotion', 'dsShowcase' ),
        'edit_item'             => __( 'Edit Item', 'dsShowcase' ),
        'update_item'           => __( 'Update Item', 'dsShowcase' ),
        'view_item'             => __( 'View Item', 'dsShowcase' ),
        'view_items'            => __( 'View Items', 'dsShowcase' ),
        'search_items'          => __( 'Search Item', 'dsShowcase' ),
        'not_found'             => __( 'Not found', 'dsShowcase' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'dsShowcase' ),
        'featured_image'        => __( 'Featured Image', 'dsShowcase' ),
        'set_featured_image'    => __( 'Set featured image', 'dsShowcase' ),
        'remove_featured_image' => __( 'Remove featured image', 'dsShowcase' ),
        'use_featured_image'    => __( 'Use as featured image', 'dsShowcase' ),
        'insert_into_item'      => __( 'Insert into item', 'dsShowcase' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'dsShowcase' ),
        'items_list'            => __( 'Items list', 'dsShowcase' ),
        'items_list_navigation' => __( 'Items list navigation', 'dsShowcase' ),
        'filter_items_list'     => __( 'Filter items list', 'dsShowcase' ),
    );
    $args = array(
        'label'                 => __( 'Promotion', 'dsShowcase' ),
        'description'           => __( 'Promotions', 'dsShowcase' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-tickets',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'dsShowcasePromotions',
    );
    register_post_type( 'Promotions', $args );

}
add_action( 'init', 'dsShowcase_promotions', 0 );

function prioritize_products($orderby, $query) {
    if ($query->is_search() && $query->is_main_query()) {
        global $wpdb;
        return "CASE WHEN {$wpdb->posts}.post_type = 'product' THEN 1 ELSE 2 END, " . $orderby;
    }
    return $orderby;
}
add_filter('posts_orderby', 'prioritize_products', 10, 2);



//prevent emails being sent to site admin on every plugin update
remove_action('admin_notices', 'update_nag');
remove_action('wp_mails', 'send_plugin_update_notification');


add_filter( 'acf/load_value/type=post_object', 'format_order_for_wpml' );
add_filter( 'acf/load_value/type=relationship', 'format_order_for_wpml' );
function format_order_for_wpml( $value ){
    // Only apply if $value is an array and not empty
    if ( ! is_array( $value ) || empty( $value ) ) {
        return $value;
    }

    $lang = apply_filters( 'wpml_current_language', null );

    foreach ( $value as $key => $id ) {
        $type = get_post_type( $id );
        $value[$key] = apply_filters( 'wpml_object_id', $id, $type, true, $lang);
    }
    return $value;
}

function dsn_icon($icon_name, $classes = '') {
    static $icons = null;
    
    // Load icons only once per page load
    if ($icons === null) {
        $icons = include get_template_directory() . '/inc/icons.php';
    }
    
    if (!isset($icons[$icon_name])) {
        echo '<!-- Icon "' . esc_attr($icon_name) . '" not found -->';
        return;
    }
    
    if (empty($classes)) {
        $classes = 'dsn-icon';
    }
    
    echo sprintf($icons[$icon_name], esc_attr($classes));
}

if ( ! function_exists( 'dsn_get_term_meta' ) ) {
  /**
   * Safe wrapper for term meta (replaces deprecated get_woocommerce_term_meta).
  */
  function dsn_get_term_meta(int $term_id, string $key, bool $single = true ) {
    if (function_exists( 'get_term_meta' )) {
      return get_term_meta( $term_id, $key, $single );
    }

    if (function_exists( 'get_woocommerce_term_meta' )) {
      return get_woocommerce_term_meta( $term_id, $key, $single );
    }

    return false;
  }
}