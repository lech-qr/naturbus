/*
| ----------------------------------------------------------------------------------
| TABLE OF CONTENT
| ----------------------------------------------------------------------------------
-SETTING
-Sticky Header
-Dropdown Menu Fade
-Animated Entrances
-Accordion
-Filter accordion
-Chars Start
-Сustomization select
-Zoom Images
-HOME SLIDER
-CAROUSEL PRODUCTS
-PRICE RANGE
-SLIDERS
-Animated WOW
*/


(function ($) {
$(document).ready(function() {

    "use strict";

    // Legenda by QR
//    for (var i = 1; i < 21; i++) {
//        var legenda = $('#pageContent section.first-schedule .single-przystanek:nth-of-type(1) .przystanek-content .col-md-2:nth-child(' + i + ') span.legenda').text();
//        $( "#pageContent section.first-schedule .single-przystanek" ).each(function() {
//            $( this ).find('.col-md-2:nth-of-type(' + i + ') .hour > span.godz').after('<span class="lower">' + legenda + '</span>'); 
//        });
//    }
//    for (var i = 1; i < 21; i++) {
//        var legenda = $('#pageContent section.second-schedule .single-przystanek:nth-of-type(1) .przystanek-content .col-md-2:nth-child(' + i + ') span.legenda').text();
//        $( "#pageContent section.second-schedule .single-przystanek" ).each(function() {
//            $( this ).find('.col-md-2:nth-of-type(' + i + ') .hour > span.godz').after('<span class="lower">' + legenda + '</span>'); 
//        });
//    }


 /////////////////////////////////////
    //  LOADER
    /////////////////////////////////////

    var $preloader = $('#page-preloader'),
    $spinner = $preloader.find('.spinner-loader');
    $spinner.fadeOut();
    $preloader.delay(50).fadeOut('slow');
    
    
    
    $('#wpadminbar').addClass('wpadmin-opacity');


    $( '.yamm li:has(ul)' ).doubleTapToGo();

/////////////////////////////////////////////////////////////////
// SETTING
/////////////////////////////////////////////////////////////////

    var windowHeight = $(window).height();
    var windowWidth = $(window).width();


    var tabletWidth = 767;
    var mobileWidth = 640;
    
    
    
		 /////////////////////////////////////
    //  iframe
    /////////////////////////////////////


		$('.wpb_map_wraper').click(function () {
			$('iframe').css("pointer-events", "auto");
		});




/////////////////////////////////////
//  Sticky Header
/////////////////////////////////////


    if (windowWidth > tabletWidth) {

        var headerSticky = $(".layout-theme").data("header");
        var headerTop = $(".layout-theme").data("header-top");

        if (headerSticky.length) {
            $(window).on('scroll', function() {
                var winH = $(window).scrollTop();
                var $pageHeader = $('.header');
                if (winH > headerTop) {

                    $('.header').addClass("animated");
                    $('header').addClass("animation-done");
                    $('.header').addClass("bounce");
                    $pageHeader.addClass('sticky');

                } else {

                    $('.header').removeClass("bounce");
                    $('.header').removeClass("animated");
                    $('.header').removeClass("animation-done");
                    $pageHeader.removeClass('sticky');
                }
            });
        }
    }
	
    
    
	
    ////////////////////////////////////////////  
    //  full-width
    ///////////////////////////////////////////  


    function fullWidthSection() {
		

        var windowWidth = $(window).width();
        var widthContainer = $('.container').width();
		var sectionFW =   $('.bg_inner');

        var fullWidth1 = windowWidth - widthContainer;
        var fullWidth2 = fullWidth1 / 2;
        
        
        if( $('html').attr('dir') == 'rtl' ){
    
    
                sectionFW.css("width", windowWidth);
                sectionFW.css("margin-right", -fullWidth2);
               
                $('[data-vc-full-width="true"]').css("right", -fullWidth2 + 15 ); 
              
       }
        
        
        
        else{
            
            sectionFW.css("width", windowWidth);
            sectionFW.css("margin-left", -fullWidth2); 
            
        }
 
        

    }

    fullWidthSection();
    $(window).resize(function() {
        fullWidthSection()
    });
    

/////////////////////////////////////////////////////////////////
//PRICE RANGE
/////////////////////////////////////////////////////////////////

    if ($('#slider-price').length > 0) {
		var slider = document.getElementById('slider-price');
		var min_price = document.getElementById('pix-min-price').value;
		var max_price = document.getElementById('pix-max-price').value;
		var max_slider_price = document.getElementById('pix-max-slider-price').value;
		//var symbol_price = document.getElementById('pix-currency-symbol').value;
		min_price = min_price == '' ? 0 : min_price;
		max_price = max_price == '' ? max_slider_price : max_price;

        noUiSlider.create(slider, {
                        start: [min_price, max_price],
                        step: 1000,
                        connect: true,
                        range: {
                            'min': 0,
                            'max': Number(max_slider_price)
                        },

                        format: {
                          to: function ( value ) {
                            return value;
                          },
                          from: function ( value ) {
                            return value;
                          }
                        }
            
                    });

		var pValues_price = [
			document.getElementById('slider-price_min'),
			document.getElementById('slider-price_max')
		];

		slider.noUiSlider.on('update', function( values, handle ) {
			pValues_price[handle].value = values[handle];
		});

		slider.noUiSlider.on('change', function( values, handle ) {
			$(pValues_price[handle]).trigger('change');
		});

    }

/////////////////////////////////////////////////////////////////
//YEAR RANGE
/////////////////////////////////////////////////////////////////

    if ($('#slider-year').length > 0) {
		var slider_year = document.getElementById('slider-year');
		var min_year = document.getElementById('pix-min-year').value;
		var max_year = document.getElementById('pix-max-year').value;
		var max_slider_year = document.getElementById('pix-max-slider-year').value;
		min_year = min_year == '' ? 1950 : min_year;
		max_year = max_year == '' ? max_slider_year : max_year;

        noUiSlider.create(slider_year, {
                        start: [min_year, max_year],
                        step: 1,
                        connect: true,
                        range: {
                            'min': 1950,
                            'max': Number(max_slider_year)
                        },

                        format: {
                          to: function ( value ) {
                            return value;
                          },
                          from: function ( value ) {
                            return value;
                          }
                        }
                        
                    });

		var pValues_year = [
			document.getElementById('slider-year_min'),
			document.getElementById('slider-year_max')
		];

		slider_year.noUiSlider.on('update', function( values, handle ) {
			pValues_year[handle].value = values[handle];
		});

		slider_year.noUiSlider.on('change', function( values, handle ) {
			$(pValues_year[handle]).trigger('change');
		});

    }
    
    
    
/////////////////////////////////////////////////////////////////
//   MILEAGE RANGE
/////////////////////////////////////////////////////////////////

    if ($('#slider-mileage').length > 0) {
		var slider_mileage = document.getElementById('slider-mileage');
		var min_mileage = document.getElementById('pix-min-mileage').value;
		var max_mileage = document.getElementById('pix-max-mileage').value;
		var max_slider_mileage = document.getElementById('pix-max-slider-mileage').value;
		min_mileage = min_mileage == '' ? 0 : min_mileage;
		max_mileage = max_mileage == '' ? max_slider_mileage : max_mileage;

        noUiSlider.create(slider_mileage, {
                        start: [min_mileage, max_mileage],
                        step: 10000,
                        connect: true,
                        range: {
                            'min': 0,
                            'max': Number(max_slider_mileage)
                        },

                        format: {
                          to: function ( value ) {
                            return value;
                          },
                          from: function ( value ) {
                            return value;
                          }
                        }
                        
                    });

		var pValues_mileage = [
			document.getElementById('slider-mileage_min'),
			document.getElementById('slider-mileage_max')
		];

		slider_mileage.noUiSlider.on('update', function( values, handle ) {
			pValues_mileage[handle].value = values[handle];
		});

		slider_mileage.noUiSlider.on('change', function( values, handle ) {
			$(pValues_mileage[handle]).trigger('change');
		});

    }
 
/////////////////////////////////////////////////////////////////
//   ENGINE RANGE
/////////////////////////////////////////////////////////////////

    if ($('#slider-engine').length > 0) {
		var slider_engine = document.getElementById('slider-engine');
		var min_engine = document.getElementById('pix-min-engine').value;
		var max_engine = document.getElementById('pix-max-engine').value;
		var max_slider_engine = document.getElementById('pix-max-slider-engine').value;
		min_engine = min_engine == '' ? 0 : min_engine;
		max_engine = max_engine == '' ? max_slider_engine : max_engine;

        noUiSlider.create(slider_engine, {
                        start: [min_engine, max_engine],
                        step: 0.1,
                        connect: true,
                        range: {
                            'min': 0,
                            'max': Number(max_slider_engine)
                        },

                        // Full number format support.
                        
                    });

		var pValues_engine = [
			document.getElementById('slider-engine_min'),
			document.getElementById('slider-engine_max')
		];

		slider_engine.noUiSlider.on('update', function( values, handle ) {
			pValues_engine[handle].value = values[handle];
		});

		slider_engine.noUiSlider.on('change', function( values, handle ) {
			$(pValues_engine[handle]).trigger('change');
		});

    }
    

/////////////////////////////////////
//  Disable Mobile Animated
/////////////////////////////////////

    if (windowWidth < mobileWidth) {

        $("body").removeClass("animated-css");

    }


        $('.animated-css .animated:not(.animation-done)').waypoint(function() {

                var animation = $(this).data('animation');

                $(this).addClass('animation-done').addClass(animation);

        }, {
                        triggerOnce: true,
                        offset: '90%'
        });




//////////////////////////////
// Animated Entrances
//////////////////////////////



    if (windowWidth > 1200) {

        $(window).scroll(function() {
                $('.animatedEntrance').each(function() {
                        var imagePos = $(this).offset().top;

                        var topOfWindow = $(window).scrollTop();
                        if (imagePos < topOfWindow + 400) {
                                        $(this).addClass("slideUp"); // slideUp, slideDown, slideLeft, slideRight, slideExpandUp, expandUp, fadeIn, expandOpen, bigEntrance, hatch
                        }
                });
        });

    }




/////////////////////////////////////////////////////////////////
// Accordion
/////////////////////////////////////////////////////////////////

    $(".btn-collapse").on('click', function () {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            }
            else {$(this).next().toggleClass('panel-passive');
        };
    });




/////////////////////////////////////
//  Chars Start
/////////////////////////////////////

    if ($('body').length) {
            $(window).on('scroll', function() {
                    var winH = $(window).scrollTop();

                    $('.list-progress').waypoint(function() {
                            $('.chart').each(function() {
                                    CharsStart();
                            });
                    }, {
                            offset: '80%'
                    });
            });
    }


        function CharsStart() {
            $('.chart').easyPieChart({
                    barColor: false,
                    trackColor: false,
                    scaleColor: false,
                    scaleLength: false,
                    lineCap: false,
                    lineWidth: false,
                    size: false,
                    animate: 7000,

                    onStep: function(from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                    }
            });

        }




/////////////////////////////////////////////////////////////////
// Сustomization select
/////////////////////////////////////////////////////////////////

    $('.jelect').jelect();



/////////////////////////////////////
//  Zoom Images
/////////////////////////////////////





  //$(".slider-product a, .slider-gallery__link , .zoom ").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000});


    //$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000});
    
    
    
    
	$( ' slider-gallery__link , .zoom , .swipebox , .widget-slider__item a , .slider-gallery__link , .car-details .flexslider a.prettyPhoto , .isotope-item a ' ).swipebox();
    
    
    $(".slides  img:last").on('load',function(){
        $( '.slides a.prettyPhoto ' ).swipebox();
    });



/////////////////////////////////////////////////////////////////
// Accordion
/////////////////////////////////////////////////////////////////

    $(".btn-collapse").on('click', function () {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            }
            else {$(this).next().toggleClass('panel-passive');
        };
    });




/////////////////////////////////////////////////////////////////
// Filter accordion
/////////////////////////////////////////////////////////////////


$('.js-filter').on('click', function() {
        $(this).prev('.wrap-filter').slideToggle('slow')});

$('.js-filter').on('click', function() {
        $(this).toggleClass('filter-up filter-down')});




////////////////////////////////////////////
// CAROUSEL PRODUCTS
///////////////////////////////////////////



    if ($('#slider-product').length > 0) {

        // The slider being synced must be initialized first
        $('#carousel-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
             smoothHeight:true,
            itemWidth: 120,
            itemMargin: 8,
            asNavFor: '#slider-product'
        });

        $('#slider-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            smoothHeight:true,
            sync: "#carousel-product"
        });
    }



    
    
/////////////////////////////////////
//  SCROLL TOP
/////////////////////////////////////
    
    
     $(document).on("click", ".footer__btn", function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 300);
    });



 




/////////////////////////////////////////////////////////////////
// Sliders
/////////////////////////////////////////////////////////////////

    var Core = {

        initialized: false,

        initialize: function() {

                if (this.initialized) return;
                this.initialized = true;

                this.build();

        },

        build: function() {

        // Owl Carousel

            this.initOwlCarousel();
        },
        initOwlCarousel: function(options) {

                        $(".enable-owl-carousel").each(function(i) {
                            var $owl = $(this);

                            var itemsData = $owl.data('items');
                            var navigationData = $owl.data('navigation');
                            var paginationData = $owl.data('pagination');
                            var singleItemData = $owl.data('single-item');
                            var autoPlayData = $owl.data('auto-play');
                            var transitionStyleData = $owl.data('transition-style');
                            var mainSliderData = $owl.data('main-text-animation');
                            var afterInitDelay = $owl.data('after-init-delay');
                            var stopOnHoverData = $owl.data('stop-on-hover');
                            var min480 = $owl.data('min480');
                            var min768 = $owl.data('min768');
                            var min992 = $owl.data('min992');
                            var min1200 = $owl.data('min1200');

                            $owl.owlCarousel({
                                autoHeight: true,
                                navigation : navigationData,
                                pagination: paginationData,
                                singleItem : singleItemData,
                                autoPlay : autoPlayData,
                                transitionStyle : transitionStyleData,
                                stopOnHover: stopOnHoverData,
                                navigationText : ["<i></i>","<i></i>"],
                                items: itemsData,
                                itemsCustom:[
                                                [0, 1],
                                                [465, min480],
                                                [750, min768],
                                                [975, min992],
                                                [1185, min1200]
                                ],
                                afterInit: function(elem){
                                            if(mainSliderData){
                                                    setTimeout(function(){
                                                            $('.main-slider_zoomIn').css('visibility','visible').removeClass('zoomIn').addClass('zoomIn');
                                                            $('.main-slider_fadeInLeft').css('visibility','visible').removeClass('fadeInLeft').addClass('fadeInLeft');
                                                            $('.main-slider_fadeInLeftBig').css('visibility','visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
                                                            $('.main-slider_fadeInRightBig').css('visibility','visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
                                                    }, afterInitDelay);
                                                }
                                },
                                beforeMove: function(elem){
                                    if(mainSliderData){
                                            $('.main-slider_zoomIn').css('visibility','hidden').removeClass('zoomIn');
                                            $('.main-slider_slideInUp').css('visibility','hidden').removeClass('slideInUp');
                                            $('.main-slider_fadeInLeft').css('visibility','hidden').removeClass('fadeInLeft');
                                            $('.main-slider_fadeInRight').css('visibility','hidden').removeClass('fadeInRight');
                                            $('.main-slider_fadeInLeftBig').css('visibility','hidden').removeClass('fadeInLeftBig');
                                            $('.main-slider_fadeInRightBig').css('visibility','hidden').removeClass('fadeInRightBig');
                                    }
                                },
                                afterMove: sliderContentAnimate,
                                afterUpdate: sliderContentAnimate,
                            });
                        });
            function sliderContentAnimate(elem){
                var $elem = elem;
                var afterMoveDelay = $elem.data('after-move-delay');
                var mainSliderData = $elem.data('main-text-animation');
                if(mainSliderData){
                                setTimeout(function(){
                                                $('.main-slider_zoomIn').css('visibility','visible').addClass('zoomIn');
                                                $('.main-slider_slideInUp').css('visibility','visible').addClass('slideInUp');
                                                $('.main-slider_fadeInLeft').css('visibility','visible').addClass('fadeInLeft');
                                                $('.main-slider_fadeInRight').css('visibility','visible').addClass('fadeInRight');
                                                $('.main-slider_fadeInLeftBig').css('visibility','visible').addClass('fadeInLeftBig');
                                                $('.main-slider_fadeInRightBig').css('visibility','visible').addClass('fadeInRightBig');
                                }, afterMoveDelay);
                }
            }
        },

    };

    Core.initialize();

    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $(".header").addClass("white-bg");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".header").removeClass("white-bg");
        }
    });
    $('.triangle-btn').click(function() {
        $('html, body').animate({
            scrollTop: $(".home-contact-row").offset().top
        }, 1500)
    })
    function rozkladAccordion(trigger, content, arrow) {
        for (let i=0; i < trigger.length; i++) {
            $(trigger[i]).on('click', function (e) {

                // trigger.removeClass('active-przystanek-name');
                content.stop().slideUp().removeClass('active-przystanek-content');
                arrow.removeClass('rotated');

                if (!$(this).hasClass('active-przystanek-name')) {
                    $(this).addClass('active-przystanek-name');

                    $(content[i]).stop().slideDown().addClass('active-przystanek-content');
                    $(arrow[i]).addClass('rotated');
                } else {
                    $(this).removeClass('active-przystanek-name');

                    $(content[i]).stop().slideUp().removeClass('active-przystanek-content');
                    $(arrow[i]).removeClass('rotated');
                }
            });

        }
    }
    rozkladAccordion($('.przystanek-name'), $('.przystanek-content'), $('.przystanek-name span i'));
    
//    Opole - Warszawa
        $("#pageContent .single-przystanek").each(function () {
//            $(this).find('.hour .lower:first').html("a, m, +, 5");
        });    
    
});

}(jQuery));






    
