	$('.carousel').carousel({
	  interval: 20000,
   	  pause: "false"
	});
	$(document).ready(function(){
$('.navbar-toggler').click(function(){
$('.navbar-toggler').toggleClass('showtoggle');
});	

$(".hamburger").click(function(){
  $(".overlay_menu").toggleClass("show");
});

$(".closed").click(function(){
  $(".overlay_menu").removeClass("show");
});  

});	
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 30) {
        $(".header_sec").addClass("fixed");
    } else {
        $(".header_sec").removeClass("fixed");
    }
});


$(document).ready(function() {
  var owl = $('.serve_sec .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplayTimeout: 5000,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,

      },
	  575: {
	    items: 2,

	  },
      600: {
        items: 3,
  
      },
      768: {
        items: 3,
  
      },
      992: {
        items: 4,

      },
      1200: {
        items: 6
      },
      1400: {items: 7
      }
    }
  });
});

$(document).ready(function() {
  var owl = $('.testimonial_sec .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,
      }
    }
  });
});

$(document).ready(function() {
  var owl = $('.meet_team_sec .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,
  
      },
	  575: {
	    items: 2,
       
	  },
      600: {
        items: 2,

      },
      768: {
        items: 2,

      },
      992: {
        items: 3,

      },
      1200: {
        items: 4
      }
    }
  });
});

$(document).ready(function() {
  var owl = $('.blog_sec .owl-carousel');
  owl.owlCarousel({
    margin: 0,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,

      },
	  575: {
	    items: 1,
   
	  },
      600: {
        items: 2,
   
      },
      768: {
        items: 2,
   
      },
      992: {
        items: 3,
  
      },
      1200: {
        items: 3
      }
    }
  });
});


$(document).ready(function() {
  var owl = $('.benefit_sec .owl-carousel');
  owl.owlCarousel({
    margin: 15,
    nav: false,
    loop: false,
    dotsEach: false,
    autoplay: false,
    responsive: {
      0:{
      	items: 1,
  
      },
	  575: {
	    items: 2,
       
	  },
      600: {
        items: 2,

      },
      768: {
        items: 3,

      },
      992: {
        items: 4,
        loop: true,

      },
      1200: {
        items: 5
      }
    }
  });
});



$(document).ready(function() {
  var owl = $('.clienc_testimonials .owl-carousel');
  owl.owlCarousel({
    margin: 0,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,

      },
	 
      1200: {
        items: 1,
      }
    }
  });
});


$(document).ready(function() {
  var owl = $('.truckland_mob .owl-carousel');
  owl.owlCarousel({
    margin: 15,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplay: false,
    responsive: {
      0:{
      	items: 2,

      },
	  575: {
	    items: 2,
   
	  },
      600: {
        items: 3,
   
      },
      767: {
        items: 4,
   
      },
      992: {
        items: 3,
  
      },
      1200: {
        items: 3
      }
    }
  });
});



$(document).ready(function() {
  var owl = $('.resources_sec .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dotsEach: false,
    autoplayTimeout: 9000,
	autoplaySpeed: 900,
	autoplayHoverPause: true,
    autoplay: true,
    mouseDrag: true, 
    responsive: {
      0:{
      	items: 1,

      },
	  575: {
	    items: 1,

	  },
      600: {
        items: 1,
  
      },
      768: {
        items: 1,
  
      },
      992: {
        items: 1,

      },
      1200: {
        items: 1
      },
      1400: {
		items: 1
      },
	  1600: {
		items: 1
      },
	  1800: {
		items: 1
      },
	  1900: { 
		items: 1
      },
	  2100: { 
		items: 1
      }
    }
  });
});