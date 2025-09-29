<?php
global $dssSiteLanguage;

const ON_RESERVE_STOCK_STATUS = 'on_reserve';


$translatedText = dssLang($dssSiteLanguage);
/**
 * Custom DSN products loop the template used by AJAX ds_filtration and archive page.
 * Expected variables (passed via wc_get_template args):
 * - $the_query (WP_Query)
 * - $post_ids (array<int>)
 * - $post_query_count (WP_Query)
 * - $order_selector (string)
 * - $posts_per_page (int)
 * - $order_by (string)
 * - $order (string)
 * - $categories (string)
 * - $search (string)
 */
?>
    <div class="dsn:container dsn:mx-auto">
    <div id="ds-filters-root" class="dsn:row dsn:flex-row dsn:w-full dsn:flex dsn:flex-wrap"    data-counter="<?php echo $post_query_count->found_posts; ?>"
        data-categories="<?php echo $categories; ?>" data-default-orderby="<?php echo esc_attr($order_by); ?>" data-default-order="<?php echo esc_attr($order); ?>"
    >
      <div class="dsn:flex ds-filters-nav dsn:w-full dsn:gap-3 dsn:flex-wrap dsn:pt-10 dsn:pb-4">
        <div class="ds-filters-counter dsn:hidden dsn:md:block hide-for-medium-down">
            <span class="ds-filters-counter__value"><?php echo $post_query_count->found_posts; ?> </span>
            <?php echo $translatedText->template_store->products_to_explore;?>
        </div>

        <div class="ds-filters-nav-right dsn:flex-1 dsn:justify-end dsn:gap-6 dsn:flex flex-wrap dsn:flex-col dsn:md:flex-row dsn:items-center dsn:md:items-start">
            <select name="posts_per_page" id="ds-posts_per_page" class="ds-posts_per_page dsn:w-full dsn:lg:w-1/4">
                <option value="24" <?php echo $posts_per_page === 24 ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->per_page_24;?>
                </option>
                <option value="36" <?php echo $posts_per_page === 36 ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->per_page_36;?>
                </option>
                <option value="72" <?php echo $posts_per_page === 72 ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->per_page_72;?>
                </option>
            </select>

            <select name="sort_by" id="ds-sort_by" class="dsn:w-full dsn:lg:w-1/4">
                <option value="" disabled selected>
                  <?php echo $translatedText->template_store->sort_by_title;?>
                </option>
                <option value="price-desc" <?php echo $order_selector === 'price-desc' ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->sort_by_price_high_to_low;?>
                </option>

                <option value="price-asc" <?php echo $order_selector === 'price-asc' ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->sort_by_price_low_to_high;?>
                </option>

                <option value="title-asc" <?php echo $order_selector === 'title-asc' ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->sort_by_name_A_to_Z;?>
                </option>
                <option value="title-desc" <?php echo $order_selector === 'title-desc' ? 'selected' : ''; ?>>
                  <?php echo $translatedText->template_store->sort_by_name_Z_to_A;?>
                </option>
            </select>

            <form id="ds-filters-search-wrap" class="dsn:flex dsn:w-full dsn:lg:w-1/2" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" name="s" id="ds-filters-search" class="search__input dsn:w-full" placeholder="<?php echo $translatedText->template_store->search_placeholder;?>" value="<?php echo $search; ?>" />

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
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <?php
                  $product = wc_get_product(get_the_ID());
                  $product_price_html = $product->get_price_html();
                  $stock_status = $product->get_stock_status();
                ?>
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
                            <?php if (dsn_get_syndified_show_price()) : ?>
                              <div class='ds-product__price'>
                                <?php echo $product_price_html; ?>
                              </div>
                            <?php endif; ?>
                            
                            <?php if (dsn_get_syndified_show_action_btn()) : ?>
                                <?php if ($stock_status === ON_RESERVE_STOCK_STATUS && dsn_get_syndified_show_reserve_btn()) : ?>
                                  <a href="<?php echo esc_url(dsn_get_reserve_cta_url(get_the_ID())); ?>" class="ds-reserve-button dsn:primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:ml-2 dsn:w-8 dsn:h-8 dsn:p-0 dsn:text-white dsn:transition-colors dsn:duration-150 dsn:rounded" title="<?php echo esc_attr($translatedText->woocommerce_cart->reserve_button); ?>">
                                    <span class="dsn:flex dsn:items-center">
                                      <?php dsn_icon('reserve', 'dsn:w-4 dsn:h-4'); ?>
                                    </span>
                                  </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($product_price_html && dsn_get_syndified_show_add_to_cart()) : ?>
                              <button class="single_add_to_cart_button dsw-primary-site-background dsn:flex dsn:items-center dsn:justify-center dsn:gap-1 dsn:px-3 dsn:py-2" value="<?php echo get_the_ID(); ?>" title="<?php echo esc_attr($translatedText->woocommerce_cart->add_to_cart_btn); ?>">
                                    <span class='dsn:flex dsn:items-center'>
                                      <?php dsn_icon('plus', 'dsn:w-4 dsn:h-4'); ?>
                                    </span>
                                <span class="dsn:flex dsn:items-center dsn:hover:bg-gray-700 dsn:transition-colors dsn:duration-150">
                                      <?php dsn_icon('shopping-cart', 'dsn:w-5 dsn:h-5'); ?>
                                    </span>
                              </button>
                            <?php endif; ?>
                          </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class='dsn:flex ds-filters-footer-nav dsn:w-full dsn:col-span-1 dsn:sm:col-span-2 dsn:md:col-span-3'>
            <div class='dsn:hidden dsn:lg:block'>
              <span class="ds-filters-counter">
                <?php echo $post_query_count->found_posts; ?>
                <?php echo $translatedText->template_store->products_to_explore;?>
              </span>
            </div>
            <div id="dsPagination" class="js-pagination">
              <?php
              foundation_pagination($post_query_count) ?>
            </div>
            <div class="ds-filters-footer-nav-right">
              <?php if ($post_query_count->max_num_pages && $post_query_count->max_num_pages > 1) : ?>
                <div class="dsn:flex dsn:items-center dsn:gap-2">
                  <?php echo $translatedText->template_store->go_to_page;?>

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
                </div>
              <?php
              endif; ?>
              <a href="#" class="dsn-primary-site-link dsn:hidden dsn:lg:block" id="toTop">
                <?php echo $translatedText->template_store->back_to_top;?>
              </a>
            </div>
          </div>
        </div>
      <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <h2 class="dsn:text-center" style="width: 100%">
          <?php echo $translatedText->template_store->no_products_found;?>
        </h2>
      <?php endif; ?>
    </div>

