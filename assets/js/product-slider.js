jQuery(document).ready(function($) {
    // Check if elements exist
    if (!$('#single_product_image_slider').length || !$('#single_product_image_thumbnail_slider').length) {
        return;
    }

    // Add lightbox markup
    var lightboxHtml = '<div class="product-image-lightbox" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:999999;">' +
                      '<span class="close-lightbox" style="position:absolute;top:20px;right:20px;color:white;font-size:30px;cursor:pointer;">&times;</span>' +
                      '<img src="" alt="Product image" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);max-width:90%;max-height:90vh;object-fit:contain;" />' +
                      '</div>';
    $('body').append(lightboxHtml);

    // Initialize main slider
    $('#single_product_image_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        infinite: true,
        asNavFor: '#single_product_image_thumbnail_slider'
    });

    // Initialize thumbnail slider
    $('#single_product_image_thumbnail_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        vertical: true,
        verticalSwiping: true,
        arrows: false,
        dots: false,
        focusOnSelect: true,
        asNavFor: '#single_product_image_slider',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    slidesToShow: 4
                }
            }
        ]
    });

    // Handle click on main slider
    $('#single_product_image_slider').on('click', 'img', function() {
        var $img = $(this);
        var fullSizeUrl = $img.attr('data-large_image') || $img.attr('src');
        
        if (fullSizeUrl) {
            $('.product-image-lightbox img').attr('src', fullSizeUrl);
            $('.product-image-lightbox').fadeIn();
        }
    });

    // Close lightbox handlers
    $('.product-image-lightbox, .close-lightbox').on('click', function(e) {
        if (e.target === this || $(e.target).hasClass('close-lightbox')) {
            $('.product-image-lightbox').fadeOut();
        }
    });

    // Prevent lightbox from closing when clicking the image
    $('.product-image-lightbox img').on('click', function(e) {
        e.stopPropagation();
    });

    // Close on escape key
    $(document).on('keyup', function(e) {
        if (e.key === "Escape") {
            $('.product-image-lightbox').fadeOut();
        }
    });
});
