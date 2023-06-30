import $ from 'jquery';
import "slick-carousel";
import AOS from 'aos';
//import ScrollMagic from 'scrollmagic';
import responsiveLazyload from 'responsive-lazyload';

responsiveLazyload();

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

  $("#company_slider").slick({
    dots: false,
    draggable: true,
    centerMode: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    arrows: true,
    responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          }
        }
      ]
  })
  
  /* Ajax calls */


});