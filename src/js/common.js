'use strict';

// import datepicker from 'air-datepicker';
// global.jQuery = require('jquery');
global.Cookies = require('js-cookie');
let svg4everybody = require('svg4everybody'),
  popup = require('jquery-popup-overlay'),
  iMask = require('imask'),
  Swiper = require('swiper/swiper-bundle'),
  Choices = require('choices.js');

jQuery(document).ready(function($) {
  // Toggle nav menu
  let toggleNav = function () {
    let toggle = $('.nav-toggle');
    let mobileMenu = $('.mobile-menu');
    let body = $('body');

    toggle.on('click', function (e) {
      e.preventDefault();
      toggle.toggleClass('is-active');
      mobileMenu.toggleClass('open');
      body.toggleClass('menu-open');
    });

    $(".nav li.menu-item-has-children").mouseenter(function() {
      $('.header').addClass('nav-hover');
    });

    $(".nav li.menu-item-has-children").mouseleave(function() {
      $('.header').removeClass('nav-hover');
    });

    $( ".mobile-menu li.menu-item-has-children > a" ).one( "click", function( event ) {
      event.preventDefault();
      $(this).next().slideDown();
    });
  };

  // Modal
  let initModal = function() {
    $('.modal').popup({
      transition: 'all 0.3s',
      scrolllock: true,
      onclose: function() {
        $(this).find('label.error').remove();
        $(this).find('.wpcf7-response-output').hide();
      }
    });
  };

  // Input mask
  let inputMask = function() {
    let phoneInputs = $('input[type="tel"]');
    let maskOptions = {
      mask: '+{7} (000) 000-0000'
    };

    if (phoneInputs) {
      phoneInputs.each(function(i, el) {
        IMask(el, maskOptions);
      });
    }
  };
  
  let widgetCart = function() {
    let toggle = $('.widget-cart__toggle');
    let box = $('.widget-cart');
    let body = $('body');
    
    toggle.click(function (e) {
      e.preventDefault();

      if (box.hasClass('is-active')) {
        box.removeClass('is-active');
        body.removeClass('cart-open');
      } else {
        box.addClass('is-active');
        body.addClass('cart-open');
      }
    });

    box.on('click', '.widget-cart__close', function (e) {
      e.preventDefault();

      box.removeClass('is-active');
      body.removeClass('cart-open');
    });

    $(document).on('click', function(e) {
      if (! $(e.target).closest('.widget-cart').length && ! $(e.target).closest('.widget-cart-items__item').length) {
        box.removeClass('is-active');
        body.removeClass('cart-open');
      }
    });
  };
  
  let newsSlider = function () {
    new Swiper('.news-slider', {
      slidesPerView: 1,
      navigation: {
        nextEl: '.news-slider-section .swiper-button-next',
        prevEl: '.news-slider-section .swiper-button-prev',
      },
      breakpoints: {
        768: {
          slidesPerView: 2,    
        },
        1280: {
          slidesPerView: 3,    
        },
      }
    });
  };
  
  let gallerySlider = function () {
    new Swiper('.gallery-slider', {
      slidesPerView: 1,
      spaceBetween: 85,
      navigation: {
        nextEl: '.gallery-slider-wrap .swiper-button-next',
        prevEl: '.gallery-slider-wrap .swiper-button-prev',
      }
    });
  };

  let logosSlider = function () {
    new Swiper('.logos-list', {
      slidesPerView: 2,
      spaceBetween: 25,
      speed: 1000,
      watchOverflow: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        1280: {
          slidesPerView: 4,
          spaceBetween: 100,
        },
      }
    });
  };
  
  let customSelect = function() {
    $('select:not(.js-not-init)').each(function(index, el) {
      new Choices(el, {
        searchEnabled: false,
        shouldSort: false,
        itemSelectText: '',
      });
    });
  };
  
  let loadMore = function() {
    $('.load-more').click(function(e) {
      e.preventDefault();

      let button = $(this),
        oldBtnText = button.text(),
        data = {
          'action': 'load_more',
          'query': posts,
          'page' : current_page,
          'nonce': nonce
        };

      $.ajax({
        url : window.wp_data.ajax_url,
        data : data,
        type : 'POST',
        beforeSend : function ( xhr ) {
          button.text('Loading...');
        },
        success : function( data ){
          if( data ) {

            //reset button text
            button.text( oldBtnText );

            //append new data
            $('#response').append(data);

            current_page++;
            if ( current_page == max_page )
              $('.load-more-wrap').remove();

          } else {
            $('.load-more-wrap').remove();
          }
        }
      });
    });
  };
  
  let fpTabs = function() {
    $('.fees-and-payment-tabs__list a').click(function(e) {
      e.preventDefault();

      $('.fees-and-payment-tabs__list a').removeClass('is-active');
      $(this).addClass('is-active');
      
      let id = $(this).attr('href');

      $('.fees-and-payment-tabs__item').removeClass('is-active');
      $('.fees-and-payment-tabs__item' + id).addClass('is-active');

      let textActive = $('.fees-and-payment-tabs__list a.is-active').text();

      $('.fees-and-payment-tabs__list-select span').text(textActive);
    });
    
    $('.fees-and-payment-tabs__list-select').click(function() {
      $(this).toggleClass('is-open');
      $('.fees-and-payment-tabs__list').slideToggle();
    });
  };
  
  let widgetAcc = function() {
    let acc = $('.widget-acc');
    let toggle = acc.find('.widget-acc__head');
    let content = acc.find('.widget-acc__content');
    
    toggle.click(function() {
      let $this = $(this);
      if ($this.hasClass('is-active')) {
        $this.removeClass('is-active');
        $this.next().slideUp();
      }
      else {
        $this.addClass('is-active');
        content.not($this.next()).slideUp();
        toggle.not($this).removeClass('is-active');
        $this.next().slideToggle(function() {
          let offset = $('.header').height();
          
          $('html, body').animate({
            scrollTop: $this.offset().top - offset
          }, 500);
        });
        
      }
    });
  };

  $('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .not('.fees-and-payment-tabs__list a')
    .click(function(event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
        &&
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        let target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            let $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            }
          });
        }
      }
    });
  
  let hireForm = function() {
    let room = $('select[name="hire_accommodation"]');
    
    if (room.length) {
      let selectedPrice = room.find('option:selected').data('custom-properties');
      let priceBlock = $('.select-price span');

      priceBlock.text(selectedPrice.price);

      room.on('change', function () {
        selectedPrice = $(this).find('option:selected').data('custom-properties');
        priceBlock.text(selectedPrice.price)
      });
    }
    
    let form = $('.hire-form--step-6');
    
    if (form.length) {
      let checkTerm = form.find('input[name="hire_statemant"]');
      let btn = form.find('[type="submit"]');

      checkTerm.change(function() {
        if (checkTerm.is(':checked')) {
          btn.removeAttr('disabled');
        } else {
          btn.attr('disabled', true);
        }
      });

      form.submit(function(e) {
        e.preventDefault();

        $.ajax({
          url: window.wp_data.ajax_url,
          data: {
            action: 'booking_insert',
            nonce: window.wp_data.booking_nonce
          },
          type: 'POST',
          beforeSend: function (xhr) {
            btn.addClass('btn-loader');
          },
          success: function (data) {
            btn.removeClass('btn-loader');
            
            if ( data.success ) {
              // $('.alert-block').html(data.data).addClass('alert-block--success');
              form.trigger('reset');
              btn.attr('disabled', true);
              window.location.href = '/room-booking-thank-you/';
            } else {
              alert(data.data);
            }
          }
        });

      });
    }

  };

  $('.btn-to-top').click(function(e) {
    e.preventDefault();

    $('html, body').animate({
      scrollTop: 0
    }, 1000);
  });

  let fixedHeader = function() {
    let header = $('.header');
    let h = header.innerHeight();
    let offsetShow = document.documentElement.clientHeight / 1.5;

    if ($(window).scrollTop() > offsetShow) {
      $('body').css('padding-top', h);
      header.addClass('fixed');
    }
    else {
      $('body').css('padding-top', 0);
      header.removeClass('fixed');
    }
    
    $(window).scroll(function() {
      if ($(this).scrollTop() > offsetShow) {
        $('body').css('padding-top', h);
        header.addClass('fixed');
      }
      else {
        $('body').css('padding-top', 0);
        header.removeClass('fixed');
      }
    });
  };

  $(window).scroll(function() {
    if ($(this).scrollTop() > window.innerHeight) {
      $('.btn-to-top').addClass('active');
    } else {
      $('.btn-to-top').removeClass('active');
    }
  });
  
  let aboutBlock = function() {
    let listItems = $('.about-block__links-item');
    let id = null;

    listItems.mouseenter(function() {
      if (id !== $(this).data('hover-id')) {
        id = $(this).data('hover-id');
        $('.about-block__right img').hide();
      }
      $('.about-block__right img.'+id).fadeIn();      
    });

    listItems.mouseleave(function() {
      $('.about-block__right img:not(.'+id+')').hide();      
    });
  };
  
  let hireServiceForm = function() {
    let form = $('.hire-service-form');
    let btn = form.find('.btn[type="submit"]');
    let typeOneTime = form.find('.one-time');
    let typeBlockTime = form.find('.block-time');
    let type = form.find('input[name="hs_type"]');
    let addDate = form.find('.hire-service-form__add-date');
    let errorBlock = $('.card-error');
    let stripe = Stripe(stripe_keys.public);
    let settings = {
      minimumResultsForSearch: Infinity
    };
    
    $('.hire-service-form__datetime-time').select2(settings);
    
    type.change(function() {
      if (!$(this).is(':checked')) return;
      
      let value = $(this).val();
      let oneTimeBlock = $('.one-time');
      let blockTimeBlock = $('.block-time');

      if (value === 'one-time') {
        typeBlockTime.hide();
        typeOneTime.show();

        oneTimeBlock.find('.hire-service-form__datetime-date').attr('disabled', false);
        blockTimeBlock.find('.hire-service-form__datetime-date').attr('disabled', true);
        blockTimeBlock.find('.hire-service-form__datetime-time').prop('disabled', true);

        if ( oneTimeBlock.find('.hire-service-form__datetime-date').val() !== '' ) {
          oneTimeBlock.find('.hire-service-form__datetime-time').prop('disabled', false);
        }
        
      } else {
        typeOneTime.hide();
        typeBlockTime.show();

        blockTimeBlock.find('.hire-service-form__datetime-date').attr('disabled', false);
        oneTimeBlock.find('.hire-service-form__datetime-date').attr('disabled', true);
        oneTimeBlock.find('.hire-service-form__datetime-time').prop('disabled', true);
        
        blockTimeBlock.find('.hire-service-form__datetime-date').each(function() {
          if ( $(this).val() !== '' ) {
            $(this).parents('.hire-service-form__datetime').find('.hire-service-form__datetime-time').prop('disabled', false);
          }
        });
      }
    });

    type.trigger('change');

    addDate.click(function(e) {
      e.preventDefault();
      
      let clone = $('.block-time-clone').html();
      $(this).parent().before(clone);

      typeBlockTime.find('.hire-service-form__datetime-time').select2(settings);
    });
    
    $(document).on('change', '.hire-service-form__datetime-date', function() {
      let selectDate = $(this).val();
      let select = $(this).parents('.hire-service-form__datetime').find('.hire-service-form__datetime-time');

      $.ajax({
        url: window.wp_data.ajax_url,
        data: {
          action: 'get_service_days',
          selectDay: selectDate,
          nonce: window.wp_data.booking_nonce
        },
        type: 'POST',
        beforeSend: function (xhr) {
          select.prop("disabled", true);
        },
        success: function (data) {
          if ( data.success ) {
            if (data.data.length) {
              select.val(null);
              select.html('').select2({
                minimumResultsForSearch: Infinity,
                data: data.data
              });
              select.prop("disabled", false);
            }
          } else {
            alert(data.data);
          }
        }
      });
    });

    $(document).on('select2:select', '.hire-service-form__datetime-time', function (e) {
      $.ajax({
        url: window.wp_data.ajax_url,
        data: {
          action: 'get_service_data',
          data: form.serialize(),
          nonce: window.wp_data.booking_nonce
        },
        type: 'POST',
        beforeSend: function (xhr) {
        },
        success: function (data) {
          if ( data.success ) {
            $('.confirm__items').html(data.data.prices);
            $('.confirm__total span span').html(data.data.total);
          } else {
            alert(data.data);
          }
        }
      });
    });

    if ($('.hire-service-form #card-element').length) {
      let styles = {
        base: {
          iconColor: '#2C2C2C',
          color: '#2C2C2C',
          fontFamily: 'inherit',
          fontSize: '21px',
          fontSmoothing: 'antialiased',
          ':-webkit-autofill': {
            color: '#fce883',
          },
          '::placeholder': {
            color: '#C8CBCD',
          },
        },
        invalid: {
          iconColor: '#f00',
          color: '#f00',
        },
      };
      let elements = stripe.elements();
      let card = elements.create('card', {
        style: styles,
        hidePostalCode: true
      });

      card.mount('#card-element');

      card.on('change', function (event) {
        if (event.error) {
          errorBlock.text(event.error.message);
        } else {
          errorBlock.text('');
        }
      });

      form.submit(function(e) {
        e.preventDefault();

        btn.addClass('btn-loader');
        btn.attr('disabled', true);

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            errorBlock.text(result.error.message);

            btn.removeClass('btn-loader');
            btn.attr('disabled', false);
          } else {

            // Send the token to your server.
            let data = {
              action: 'booking_service',
              token : result.token.id,
              data: form.serialize()
            };

            $.ajax({
              url: window.wp_data.ajax_url,
              data: data,
              type: 'POST',
              dataType: 'json',
              success: function (data) {
                btn.removeClass('btn-loader');
                btn.removeAttr('disabled');

                if ( data.success ) {
                  location.href = '/sports-hall-hire-thank-you';
                } else {
                  errorBlock.text(data.data);
                }
              }
            });

            return false;
          }

        });
      });
    }
    
    // function updateTotal() {
    //   let sum = 0;
    //
    //   if (data.oneTime.length) {
    //     data.oneTime.forEach(element => {
    //       sum += parseInt(element.price, 10);
    //     });
    //   }
    //
    //   if (data.blockTime.length) {
    //     data.blockTime.forEach(element => {
    //       sum += parseInt(element.price, 10);
    //     });
    //   }
    //
    //   total = sum;
    //
    //   $('.confirm__items').html('');
    //   $('.confirm__total span span').text(total);
    //  
    //   if (data.oneTime.length) {
    //     $('.confirm__items').append($('<div class="confirm__items-item"></div>').append(data.oneTime[0].date + ' ' + data.oneTime[0].time + '<span>£' + data.oneTime[0].price + '</span>'));
    //   }
    //  
    //   if (data.blockTime.length) {
    //     data.blockTime.forEach(element => {
    //       $('.confirm__items').append($('<div class="confirm__items-item"></div>').append(element.date + ' ' + element.time + '<span>£' + element.price + '</span>'));
    //     });
    //   }
    //
    //   // $.ajax({
    //   //   url: window.wp_data.ajax_url,
    //   //   data: {
    //   //     action: 'update_booking_date',
    //   //     data: data
    //   //   },
    //   //   type: 'POST',
    //   //   dataType: 'json',
    //   //   success: function (data) {
    //   //   }
    //   // });
    // }
    //
    // function getTotal() {
    //   let sum = 0;
    //
    //   if (data.oneTime.length) {
    //     data.oneTime.forEach(element => {
    //       sum += parseInt(element.price, 10);
    //     });
    //   }
    //
    //   if (data.blockTime.length) {
    //     data.blockTime.forEach(element => {
    //       sum += parseInt(element.price, 10);
    //     });
    //   }
    //
    //   return sum;
    // }
  };

  toggleNav();
  initModal();
  // inputMask();
  widgetCart();
  newsSlider();
  gallerySlider();
  logosSlider();
  customSelect();
  loadMore();
  fpTabs();
  widgetAcc();
  hireForm();
  fixedHeader();
  aboutBlock();
  hireServiceForm();

  // SVG
  svg4everybody({});
});