jQuery(document).ready(function ($) {
    $('.custom-blocks-slideshow').slick({
        centerMode: true,       // Enables center mode
        centerPadding: '0px',   // Ensures no neighboring slides are visible
        slidesToShow: 1,        // Displays only one slide at a time
        slidesToScroll: 1,      // Scrolls one slide at a time
        infinite: true,         // Enables infinite looping
        arrows: true,           // Shows navigation arrows
        dots: true,             // Shows navigation dots
        autoplay: true,         // Enables automatic sliding
        autoplaySpeed: 5000,    // Time in milliseconds between slides
        pauseOnHover: true,     // Pauses autoplay on hover
        pauseOnFocus: true,     // Pauses autoplay on focus
    });
    $('.outdoor-kitchen-gallery').slick({
        centerMode: true,       // Enables center mode
        centerPadding: '0px',   // Ensures no neighboring slides are visible
        slidesToShow: 4,        // Displays only one slide at a time
        slidesToScroll: 1,      // Scrolls one slide at a time
        infinite: true,         // Enables infinite looping
        arrows: true,           // Shows navigation arrows
        dots: false,             // Shows navigation dots
        autoplay: false,         // Enables automatic sliding
        pauseOnHover: true,     // Pauses autoplay on hover
        pauseOnFocus: true,     // Pauses autoplay on focus
        responsive: [           //Responsive Breakpoint settings
            {
              breakpoint: 1024, 
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true, 
                infinite: true,
              }
            },
            {
              breakpoint: 600, 
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
              }
            },
            {
              breakpoint: 480, 
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
              }
            }]
    });
    $('.outdoor-kitchen-gallery').slickLightbox({ //Outdoor innerpage bottom gallery lightbox.
        itemSelector        : 'a',
        navigateByKeyboard  : true
    });
});

  