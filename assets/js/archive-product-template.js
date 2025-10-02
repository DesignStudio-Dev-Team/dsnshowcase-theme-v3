/**
 * Archive Product Template
 * Handles product filtering, pagination, cart actions, and search
 */

jQuery(function($) {
  
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
      categories: dsnArchiveParams.currentCategory,
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

    const ajaxUrl = dsnArchiveParams.ajaxUrl;
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

  /**
   * Handle add to cart button click
   * Let WooCommerce handle the response and fragment updates
   */
  $(document).on('click', '.ds-add-to-cart-button', function(e) {
    e.preventDefault();
    var $button = $(this);
    var product_id = $button.data('product-id');
    
    // Show loading state
    $button.addClass('loading').prop('disabled', true);
    
    // Use WooCommerce's standard AJAX add to cart
    var data = {
      action: 'woocommerce_ajax_add_to_cart',
      product_id: product_id,
      quantity: 1,
    };

    // Trigger WooCommerce event
    $(document.body).trigger('adding_to_cart', [$button, data]);

    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: data,
      success: function(response) {
        if (response.error && response.product_url) {
          window.location = response.product_url;
          return;
        }
        
        // Let WooCommerce handle the fragment updates
        // This will automatically replace .ds-product-cart-wrapper via fragments
        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
      },
      error: function() {
        $button.removeClass('loading').prop('disabled', false);
      }
    });
  });

  /**
   * Handle quantity increase
   */
  $(document).on('click', '.ds-quantity-increase', function(e) {
    e.preventDefault();
    var product_id = $(this).data('product-id');
    var $wrapper = $(this).closest('.ds-product-cart-wrapper');
    var $quantity = $wrapper.find('.ds-product-quantity');
    var currentQty = parseInt($quantity.text()) || 0;
    
    updateCartQuantity(product_id, currentQty + 1, $wrapper);
  });

  /**
   * Handle quantity decrease
   */
  $(document).on('click', '.ds-quantity-decrease', function(e) {
    e.preventDefault();
    var product_id = $(this).data('product-id');
    var $wrapper = $(this).closest('.ds-product-cart-wrapper');
    var $quantity = $wrapper.find('.ds-product-quantity');
    var currentQty = parseInt($quantity.text()) || 0;
    var newQty = Math.max(0, currentQty - 1);
    
    updateCartQuantity(product_id, newQty, $wrapper);
  });

  /**
   * Update cart quantity via AJAX
   * Let WooCommerce fragments handle the DOM updates
   */
  function updateCartQuantity(product_id, quantity, $wrapper) {
    // Show loading state
    $wrapper.addClass('updating');
    
    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: 'dsn_update_cart_quantity',
        product_id: product_id,
        quantity: quantity,
        nonce: dsnArchiveParams.nonce
      },
      success: function(response) {
        if (response.fragments) {
          // Replace all fragments returned by the server
          $.each(response.fragments, function(key, value) {
            $(key).replaceWith(value);
          });
          
          // Trigger WooCommerce event for other plugins/scripts
          $(document.body).trigger('wc_fragments_refreshed');
        }
        
        // Remove loading state after fragments are updated
        setTimeout(function() {
          $('.ds-product-cart-wrapper').removeClass('updating');
        }, 100);
      },
      error: function(xhr, status, error) {
        $wrapper.removeClass('updating');
        console.error('Cart update error:', error);
        alert('Error updating cart. Please try again.');
      }
    });
  }

  // Handle single product add to cart (for backward compatibility)
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
});

