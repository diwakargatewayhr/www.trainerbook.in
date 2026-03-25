
$(".navbar-toggler").click(function(){
  $(".navbar-collapse").toggleClass("menu-visible");
  $(".menu_overlay").toggleClass("menu-visible");
  $('body').css('overflow', 'hidden');	
});


 
$(".menu_close_btn").click(function(){
  $(".navbar-collapse").removeClass("menu-visible");
  $(".navbar-collapse").removeClass("show");
  $(".menu_overlay").removeClass("menu-visible");
  $('body').css('overflow', 'auto');
});



$(".menu_overlay").click(function(){
  $(".menu_overlay").removeClass("menu-visible");
  $(".navbar-collapse").removeClass("show");
  $(".navbar-collapse").removeClass("menu-visible");
  $('body').css('overflow', 'auto');
});


$('[data-fancybox="gallery"]').fancybox({
         	
           /*thumbs : {
             autoStart : true
           },
           
           buttons : [
             'zoom',
             'close'
           ]*/
           
         });



$('.trainerListtingSlider').owlCarousel({
    nav:false,
    margin:15,
	autoplay:true,
    loop:false,
    dots:true,
    smartSpeed:	500,
	navText: [
    "<span><i class='fa-light fa-arrow-left'></i></span>",
    "<span><i class='fa-light fa-arrow-right'></i></span>"
  ],
	
	/*animateOut: 'fadeOut',
       animateIn: 'fadeIn',*/
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2
      },
      767:{
        items:3
      },
      1000:{
        items:3
      },
      1560:{
        items:3
      },
      1920:{
        items:3
      }
    }
  });




$('.testimonialSlider').owlCarousel({
    nav:false,
    margin:15,
	autoplay:true,
    loop:false,
    dots:true,
    smartSpeed:	500,
	navText: [
    "<span><i class='fa-light fa-arrow-left'></i></span>",
    "<span><i class='fa-light fa-arrow-right'></i></span>"
  ],
	
	/*animateOut: 'fadeOut',
       animateIn: 'fadeIn',*/
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      767:{
        items:1
      },
      1000:{
        items:1
      },
      1560:{
        items:1
      },
      1920:{
        items:1
      }
    }
  });




$( ".header .navbar .navbar-nav li ul" ).find( "li" ) .closest("ul") .parent("li") .addClass( 'dropdown_menu' );
$(".header .navbar .navbar-nav li").click(function(){
  $(this).toggleClass("curent");
  $('.header .navbar .navbar-nav li').not($(this)).removeClass('curent');
});




$( ".modal" ).insertAfter( ".footer" );