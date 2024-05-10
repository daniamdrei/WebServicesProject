/**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

(function ($) {
  'use strict';

  /* ========================================================================= */
  /*	Page Preloader
  /* ========================================================================= */
  $(window).on('load', function () {
    $('#preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  });


  // navbarDropdown
	if ($(window).width() < 992) {
		$('#navigation .dropdown-toggle').on('click', function () {
			$(this).siblings('.dropdown-menu').animate({
				height: 'toggle'
			}, 300);
		});
  }

  //Hero Slider
  $('.hero-slider').slick({
    autoplay: true,
    infinite: true,
    arrows: true,
    prevArrow: '<button type=\'button\' class=\'prevArrow\'></button>',
    nextArrow: '<button type=\'button\' class=\'nextArrow\'></button>',
    dots: false,
    autoplaySpeed: 7000,
    pauseOnFocus: false,
    pauseOnHover: false
  });
  $('.hero-slider').slickAnimation();

  /* ========================================================================= */
  /*	Portfolio Filtering Hook
  /* =========================================================================  */
  // filter
  setTimeout(function(){
    var containerEl = document.querySelector('.filtr-container');
    var filterizd;
    if (containerEl) {
      filterizd = $('.filtr-container').filterizr({});
    }
  }, 500);

  /* ========================================================================= */
  /*	Testimonial Carousel
  /* =========================================================================  */
  //Init the slider
  $('.testimonial-slider').slick({
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000
  });


  /* ========================================================================= */
  /*	Clients Slider Carousel
  /* =========================================================================  */
  //Init the slider
  $('.clients-logo-slider').slick({
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false
      }
    }
    ]
  });

  /* ========================================================================= */
  /*	Company Slider Carousel
  /* =========================================================================  */
  $('.company-gallery').slick({
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 667,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false
      }
    }
    ]
  });

  /* ========================================================================= */
  /*	On scroll fade/bounce effect
  /* ========================================================================= */
  var scroll = new SmoothScroll('a[href*="#"]');

  // -----------------------------
  //  Count Up
  // -----------------------------
  function counter() {
    var oTop;
    if ($('.counter').length !== 0) {
      oTop = $('.counter').offset().top - window.innerHeight;
    }
    if ($(window).scrollTop() > oTop) {
      $('.counter').each(function () {
        var $this = $(this),
          countTo = $this.attr('data-count');
        $({
          countNum: $this.text()
        }).animate({
          countNum: countTo
        }, {
          duration: 1000,
          easing: 'swing',
          step: function () {
            $this.text(Math.floor(this.countNum));
          },
          complete: function () {
            $this.text(this.countNum);
          }
        });
      });
    }
  }
  // -----------------------------
  //  On Scroll
  // -----------------------------
  $(window).scroll(function () {
    counter();

    var scroll = $(window).scrollTop();
    if (scroll > 50) {
      $('.navigation').addClass('sticky-header');
    } else {
      $('.navigation').removeClass('sticky-header');
    }
  });

})(jQuery);

/* Scroll to top */
const toTop = document.querySelector(".to-top");
window.onscroll = () => {
    if( this.scrollY >= 100){
        toTop.classList.add("active")
    }
        else{
            toTop.classList.remove("active");
    }
}
toTop.onclick = function() {
    window.scrollTo({
        top:0,
        behavior:"smooth",
    });
}
/*Items Counter */
let DrinkType = document.querySelectorAll('.choosedrinktype li');
let Cold_Baverage = document.getElementById('Cold_Baverage');
let Hot_Baverage = document.getElementById('Hot_Baverage');
for(let i=0;i<DrinkType.length;i++) {
    DrinkType[i].addEventListener('click', ()=>{
        //remove all active
        for(let i=0;i<DrinkType.length;i++) { 
            DrinkType[i].classList.remove('active');
        }
        DrinkType[i].classList.add('active');
        if(DrinkType[i].getAttribute('data-val') === 'Hot')  {
            Cold_Baverage.style.display = 'none';
            Hot_Baverage.style.display = 'flex';
        }
        else if(DrinkType[i].getAttribute('data-val') === 'Cold')  {
            Hot_Baverage.style.display = 'none';
            Cold_Baverage.style.display = 'flex';
        }
    })
}

let elec = document.getElementById("elec");

elec.addEventListener('click',function(){
    
})
let ServiceType = document.querySelectorAll('.optionsOfServic li');
let Electrical = document.getElementById("Electrical");
let pluming = document.getElementById("pluming");
let painting = document.getElementById("painting");
let carpent = document.getElementById("carpent");

for(let i=0;i<ServiceType.length;i++) {
    ServiceType[i].addEventListener('click', ()=>{
        //remove all active
        for(let i=0;i<ServiceType.length;i++) { 
            ServiceType[i].classList.remove('activeClass');
        }
        ServiceType[i].classList.add('activeClass');
        if(ServiceType[i].getAttribute('data-val') === 'Electrical')  {
            Electrical.style.display = 'block';
            pluming.style.display = 'none';
            painting.style.display = 'none';
            carpent.style.display = 'none';
        }
        else if(ServiceType[i].getAttribute('data-val') === 'pluming')  {
            pluming.style.display = 'block';
            Electrical.style.display = 'none';
            painting.style.display = 'none';
            carpent.style.display = 'none';
        }
        else if(ServiceType[i].getAttribute('data-val') === 'painting')  {
            painting.style.display = 'block';
            pluming.style.display = 'none';
            Electrical.style.display = 'none';
            carpent.style.display = 'none';
        }
        else if(ServiceType[i].getAttribute('data-val') === 'carpent')  {
            carpent.style.display = 'block';
            pluming.style.display = 'none';
            painting.style.display = 'none';
            Electrical.style.display = 'none';
        }
    })
}
/*Multi tabs*/
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

// For image in profile edit pages:
var loadFile = function(event) {
  var image = document.getElementById('output');
  image.src = URL.createObjectURL(event.target.files[0]);
  image.onload = function() {
      URL.revokeObjectURL(image.src) // Free up memory
  }
};
