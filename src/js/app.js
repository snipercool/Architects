import "slick-carousel";
import AOS from 'aos';

const $ = jQuery;
$(document).ready(function () {
  AOS.init({
    offset: 0,
  });

  //menu
  $('.hamburger-menu').on("click", function(e) {
    e.preventDefault();
    toggleMenu();
  });

  function toggleMenu() {
    $('#primary-menu').toggleClass("hidden");
  }

  
  /* Modal */
  $('.button-modal').on("click", function(e) {
    e.preventDefault();
    openModal();
  });
  $('.contact-modal').on("click", function(e) {
    e.preventDefault();
    openContactModal();
  });
  $('.modal-close-btn').on("click", function(e) {
    closeModal();
  });
  $('.modal-overlay').on("click", function(e) {
    closeModal();
  });

  function openModal() {
    $('#modal').removeClass("hidden");
    $('body').addClass('no-scroll');
  }
  function openContactModal() {
    $('#contact-modal').removeClass("hidden");
    $('body').addClass('no-scroll');
  }
  function closeModal() {
    $('#modal').addClass("hidden");
    $('#contact-modal').addClass("hidden");
    $('body').removeClass('no-scroll');
  }

  /* Project gallery */
  const activeImage = $(".project-gallery .active");
  const productImages = $(".project-image-list img");
  
  function changeImage(e) {
    activeImage.fadeOut(300);
    activeImage.attr("src", e.target.src);
    activeImage.fadeIn(300);
  }
  
  productImages.each(function() {
    $(this).on("click", function(e) {
      changeImage(e);
    });
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

  $("#category_filter button").on("click", function(event) {
      event.preventDefault();
      var category = this.id;
      $("#category_filter button").each(function() {
        if (!$(this).hasClass("outlined")) {
          $(this).addClass("outlined");
        }
      });
      $(this).removeClass('outlined');

      var params = {};
    if (category) {
      params.category = category;
    }
    var queryString = $.param(params);
      
      $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
          data: {
            action: 'get_filtered_projects',
            category: category,
          },
        beforeSend: function(){
          $("#grid-projects").fadeOut(600);
        },
        success: function(data) {
          if (data) {
            // Update the cases container with the filtered cases
            document.getElementById('grid-projects').innerHTML = data;
                
            // Update the URL with the chosen industry and service
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            if (queryString) {
              newUrl += '?' + queryString;
            }
            window.history.pushState({path: newUrl}, '', newUrl);    
            $("#grid-projects").fadeIn(600);
          } else {
                document.getElementById('grid-projects').innerHTML = data;`<h1 style="text-align: center; color: black;">No cases found...</h1>`;
          }
              
        },
        error: function(xhr, status, error) {
              console.log(xhr.responseText);
                document.getElementById('grid-projects').innerHTML = data;`<h1 style="text-align: center; color: black;">Oops something went wrong...</h1>`;
        }
      });
  });

});