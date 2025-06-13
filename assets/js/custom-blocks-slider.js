jQuery(document).ready(function ($) {
  //check if the class is present
  if ($('.custom-blocks-slideshow').length > 0) {   
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
  }

  //outdoor internal page bottom slider
  if ($('.outdoor-kitchen-gallery').length > 0) {
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
  }
  if ($('.outdoor-kitchen-gallery').length > 0) {
    $('.outdoor-kitchen-gallery').slickLightbox({ //Outdoor innerpage bottom gallery lightbox.
        itemSelector        : 'a',
        navigateByKeyboard  : true
    });
  }

  //Custom block logo slider
  if ($('.dsn-logo-slider').length > 0) {   
    $('.dsn-logo-slider').slick({
        rows: 2,
        slidesToShow: 3,        // Displays only one slide at a time
        slidesToScroll: 1,      // Scrolls one slide at a time
        infinite: true,         // Enables infinite looping
        arrows: true,           // Shows navigation arrows
        dots: false,             // Shows navigation dots
        autoplay: true,         // Enables automatic sliding
        autoplaySpeed: 5000,    // Time in milliseconds between slides
        pauseOnHover: true,     // Pauses autoplay on hover
        pauseOnFocus: true,     // Pauses autoplay on focus
        responsive: [           //Responsive Breakpoint settings
            {
              breakpoint: 1024, 
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true, 
                infinite: true,
              }
            },
            {
              breakpoint: 600, 
              settings: {
                rows: 1,
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: true, 
              }
            },
            {
              breakpoint: 480, 
              settings: {
                rows: 1,
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: true,
                
              }
            }]
    });
  }





//Product Showcase Tab Slider 
 if ($('.product-slider-for').length > 0) {   
  var $carousel = $('.product-slider-for').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   draggable: false,
    swipe: false,
    touchMove: false,
    swipeToSlide: false,
   initialSlide: 0,
   responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          arrows: false,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          arrows: false,
        }
      }
    ]
 });
}
 $cat_val = $('.product-slider-nav').slick({
   slidesToShow: 8,
   slidesToScroll: 1,
   asNavFor: '.product-slider-for',
   dots: false,
   arrows: false,
   initialSlide: 0,
   focusOnSelect: true,
   centerMode: false,
   responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        }
      }
    ]
 });
 var select = $("#category");
  $("#category").change( function() { 
  
   
    //get the selected value
if (select.prop('selectedIndex')) {
    goTo = select.prop('selectedIndex');
     if (slick.slideCount <= 4) {
      $('.progress').addClass('dsn:hidden');
    }
} else {
	goTo = 0;
}
    $carousel.slick( "goTo", goTo-1 );
    $cat_val.slick( "goTo", goTo-1 );
  });
 
 

//Tab Slider
$('.all-products').on('init', function(event, slick){
        $(this).append('<div class="slider-count dsn:w-max dsn:mx-auto dsn:mt-10"><p><span id="dsn-current">1</span> / <span id="dsn-total">'+slick.slideCount+'</span></p></div>');
    });
  var $slider = $('.all-products');
  var $progressBar = $('.progress');
  var $progressBarLabel = $( '.slider__label' );
  $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {   
    var calc = ( (nextSlide) / (slick.slideCount-1) ) * 100;
    $progressBar
      .css('background-size', calc + '% 100%')
      .attr('aria-valuenow', calc );
    $progressBarLabel.text( calc + '% completed' );
  });

  $slider.slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    speed: 400,
    infinite: true,
    arrows: true,
    prevArrow:"<button type='button' class='pull-left'></button>",
    nextArrow:"<button type='button' class='pull-right'></button>",
    responsive: [    
       //Responsive Breakpoint settings
       {
              breakpoint: 1500, 
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true, 
              }
            },      
            {
              breakpoint: 1024, 
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 600, 
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 480, 
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              }
            }]
  });  
  


  $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {   
    var totalSlides = Math.ceil(slick.slideCount / slick.options.slidesToShow);
    var calc = ( (nextSlide + 1) / totalSlides ) * 100;
    //unless it resets can't be more then the total slides
    if (calc > 100) {
      calc = 100;
    }
    
    //upddate the total slides count remeber this might be 5 at a time 
    $(this).find('#dsn-total').text( totalSlides );
    //update the current slide count
    $(this).find('#dsn-current').text( Math.ceil((nextSlide + 1) / slick.options.slidesToShow) );
    //update the progress bar
    
    $progressBar
      .css('background-size', calc + '% 100%')
      .attr('aria-valuenow', calc );
    
    $progressBarLabel.text( calc + '% completed' );
  });
 

   $cat_val.on('afterChange', function(event, slick, currentSlide) {
 
    var $progressBar = $('.progress');
    $progressBar.css('background-size', '0% 100%');
    $progressBar.attr('aria-valuenow', 0);
    $progressBarLabel.text( '0% completed' );
  //  console.log('category changed');
   //all carousels reset to the first slide
    $slider.slick('slickGoTo', 0); 
    //also reset  $(this).append('<div class="slider-count dsn:w-max dsn:mx-auto dsn:mt-10"><p><span id="current">1</span> / <span id="total">'+totalSlides+'</span></p></div>');

  });


});

