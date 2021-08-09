'use strict';

global.jQuery = require('jquery');
let svg4everybody = require('svg4everybody'),
  popup = require('jquery-popup-overlay'),
  iMask = require('imask');

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
    let closeBtn = $('.widget-cart__close');
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

    closeBtn.click(function (e) {
      e.preventDefault();

      box.removeClass('is-active');
      body.removeClass('cart-open');
    });
  };


  toggleNav();
  initModal();
  // inputMask();
  widgetCart();

  // SVG
  svg4everybody({});
});