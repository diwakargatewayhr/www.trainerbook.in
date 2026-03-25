/*
::
:: Theme Name: MedDoctors - Medical & Health HTML5 Template
:: Email: Nourramadan144@gmail.com
:: Author URI: https://themeforest.net/user/ar-coder
:: Author: ar-coder
:: Version: 1.0
:: 
*/

(function () {
    'use strict';
    
    // :: Loading
    $(window).on('load', function () {
        $('.loading').fadeOut();
    });
    
    // :: Scroll Smooth To Go Section
    $('.move-section').on('click', function (e) {
        e.preventDefault();
        var anchorLink = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchorLink.attr('href')).offset().top + 1
        }, 1000);
    });
    
    // :: Add Class Active For ('.nav-bar')
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > $('.all-navbar').height() + 30) {
            $('.nav-bar').addClass('active');
        } else {
            $('.nav-bar').removeClass('active');
        }
    });
    
    // :: Varables Navbar
    var headerBar = $('.nav-bar'),
        $navbarMenu = $('#open-nav-bar-menu'),
        $menuLink = $('.open-nav-bar'),
        $menuTriggerLink = $('.has-menu > a');
		

    // :: Add Class Active For $menuLink And $navbarMenu
    $menuLink.on('click', function (e) {
        e.preventDefault();
        $menuLink.toggleClass('active');
        $navbarMenu.toggleClass('active');
    });

    // :: Add Class Active For $menuTriggerLink
    $menuTriggerLink.on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.toggleClass('active').next('ul').toggleClass('active');
    });
	
	
	
	
	$('.menu_close_btn').on('click', function () {
		$(this).removeClass('active');
        $('.nav-bar .nav-bar-links').removeClass('active');
		$('.mobile_overlay').removeClass('show');
		$('body').css('overflow', 'auto');	
    });
	$('.open-nav-bar').on('click', function () {
        $('.menu_close_btn').addClass('active');
		 $('.mobile_overlay').addClass('show');
		 $('body').css('overflow', 'hidden');	
    });
	
    
    // :: Add Class Active To Search Box
    $('.search-icon.open').on('click', function () {
        $('.search-box').fadeIn();
    });
    $('.search-box, .search-box-icon.exit').on('click', function () {
        $('.search-box').fadeOut();
    });
    $('.search-box form').on('click', function (e) {
        e.stopPropagation();
    });
    
    // :: Open And Close Menu
    $('.menu-icon.open').on('click', function () {
        $('.menu-box').fadeIn().addClass('active');
    });
    $('.menu-box').on('click', function () {
        $(this).fadeOut().removeClass('active');
    });
    $('.menu-box-icon.exit').on('click', function () {
        $('.menu-box').fadeOut().removeClass('active');
    });
    $('.menu-box .inner-menu').on('click', function (e) {
        e.stopPropagation();
    });
    
    // :: Height Header Section
    $('.header, .header .table-cell').height( $(window).height() );
    
    // :: Animation OWL Header
    $('.header-carousel').on('translate.owl.carousel', function () {
        $('.header-carousel .banner').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .headline-top').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .handline').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .about-website').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .btn-1, .header .banner .header-video, .header-3 .features-box .item').removeClass('animated fadeInUp').css('opacity', '0');
    });
    $('.header-carousel').on('translated.owl.carousel', function () {
        $('.header-carousel .banner').removeClass('animated fadeIn').css('opacity', '1');
        $('.header .banner .headline-top').addClass('animated fadeInUp').css('opacity', '1');
        $('.header .banner .handline').addClass('animated fadeInUp').css('opacity', '1');
        $('.header .banner .about-website').addClass('animated fadeInUp').css('opacity', '1');
        $('.header .banner .btn-1, .header .banner .header-video, .header-3 .features-box .item').addClass('animated fadeInUp').css('opacity', '1');
    });
    
    // :: NiceSelect Plugin
    $('select').niceSelect();
    
    // :: DatePicker Plugin
    $('[data-toggle="datepicker"]').datepicker();
    
    // :: TimePicker Plugin
    $('#timeQuote').timepicker();
    
    // :: Magnific Popup Plugin
    $('.gallery-item .hover-box .gallery-icon li a.popup, .shop-item .hover-box .shop-icon li a.popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    
    // :: Counter Up Js
    $('.statistic-counter, .experience-counter').counterUp({
        delay: 20,
        time: 1000
    });
    
    // :: OWL Carousel Js Header Hero
    $('.header-carousel').owlCarousel({
        loop: true,
        nav: true,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ['<i class="flaticon-back"></i>', '<i class="flaticon-next"></i>'],
        dotsClass: ['container','owl-dots'],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });
	
	
	// :: OWL Carousel Js Header Hero
    $('.home_page_banner_carousel').owlCarousel({
        loop: true,
        nav: false,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ['<i class="flaticon-back"></i>', '<i class="flaticon-next"></i>'],
        dotsClass: ['container','owl-dots'],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });
	
	
    
    // :: OWL Carousel Js Departments Item
    $('.departments-carousel').owlCarousel({
        loop: true,
        margin: 30,
        smartSpeed: 1000,
        autoplay: 2000,
        nav: false,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });
    
    // :: OWL Carousel Js Testimonial
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
		autoHeight: true,	
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 15,
        center: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });
	
	
	
	
	// :: OWL Carousel Js Testimonial
    $('.home_customer_review_slider').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
		autoHeight: true,	
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 15,
        center: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });
	
	
	
	
	// :: OWL Carousel Js Home Heightlight Banner Slider
    $('.home_heightlight_banner_slider').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 0,
        center: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });
	
	
	
	
	
	
	
    
    // :: OWL Carousel Js Work
    $('.gallery-carousel').owlCarousel({
        loop: true,
        margin: 30,
        smartSpeed: 1000,
        autoplay: 2000,
        nav: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });
    
    // :: Skills Data Value
    $(window).on('scroll', function () {
        $('.skills .skill-box .skill-line .line').each(function () {
            var toQuestionsAndSkills =
                $(this).offset().top + $(this).outerHeight();
            var goToBottom =
                $(window).scrollTop() + $(window).height();
            var widthValue = $(this).attr('data-value');
            if (goToBottom > toQuestionsAndSkills) {
                $(this).css({
                    width: widthValue,
                    transition: 'all 2s ease'
                });
            }
        });
    });
    
    // :: Add Class Active To Gallery
    $('.gallery-list .list-name-gallery li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    
    // :: Add Class Active On Go To Header
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 400) {
            $('.scroll-up').addClass('active');
        } else {
            $('.scroll-up').removeClass('active');
        }
    });

}());

// :: Setup mouseenter On Department Item
$(document).ready(function () {
    $('.departments-2 .departments-item, .departments .departments-item .departments-item-img-box, .gallery-item, .shop-item').on('mouseenter', function (e) {
        x = e.pageX - $(this).offset().left,
            y = e.pageY - $(this).offset().top;
        $(this).find('span').css({
            top: y,
            left: x
        });
    });
    $('.departments-2 .departments-item, .departments .departments-item .departments-item-img-box, .gallery-item, .shop-item').on('mouseout', function (e) {
        x = e.pageX - $(this).offset().left,
            y = e.pageY - $(this).offset().top;
        $(this).find('span').css({
            top: y,
            left: x
        });
    });
});



// DASHBOARD MENU
	
	$(".dasboard_menu_btn").click(function(){
	  $(this).parent().toggleClass("open");
	});
	
	// Listing Side MENU
	$( ".listing_side_bar_menu_list li ul" ).find( "li" ) .closest("ul") .parent("li") .addClass( 'dropdown_menu' );

		$(".listing_side_bar_menu_list li").click(function(){
		  $(this).toggleClass("active");
		   $(".listing_side_bar_menu_list li").not(this).removeClass("active");
		});
		
	// Quantity	
	
		$('.add').click(function () {		
		  var th = $(this).closest('.wrap').find('.count');    	
		  th.val(+th.val() + 1);
		});
		$('.sub').click(function () {
		  var th = $(this).closest('.wrap').find('.count');    	
				if (th.val() > 0) th.val(+th.val() - 1);
		});	
		
		
		
  $(".nav-bar .nav-bar-links .level-2 .item-level-2").click(function(){
		  $(this).toggleClass("active");
		   $(".nav-bar .nav-bar-links .level-2 .item-level-2").not(this).removeClass("active");
});