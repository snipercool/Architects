import "slick-carousel";
import AOS from 'aos';

const $ = jQuery;
$(document).ready(function () {
  AOS.init({
    offset: 0,
  });
  //open hamburger menu
  $('.hamburger-menu .ham').on("click", function() {
    $(this).toggleClass('active');
    $('.header-menu-container').toggleClass('open');
    $('header').toggleClass('open-nav');
    if($('.header-menu-container').hasClass('open')){
      $('body').css('overflow', 'hidden');
    } else{
      $('body').css('overflow', 'auto');
    }
  })         

  //(on mobile) on menu click open sub menu
 
        $('.menu-item-has-children').on('click', function(){
          if ($('header').hasClass('open-nav')) {
            $(this).find('a').toggleClass('active');
            $('.sub-menu').toggleClass('open');
          }
        });

  /* Slick sliders */

  $("#home-slider").slick({
    dots: true,
    draggable: true,
    centerMode: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    autoplay: true,
    autospeed: 4000,
    fade: true,
  })
  
  /* Ajax calls */

  $("#Category_filter button").on("click", function(event) {
    console.log('search clicked');
      event.preventDefault();
      var category = this.id;
      console.log(category);
  });

});