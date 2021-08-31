jQuery(document).ready(function($) {
  let quickDonate = function () {
    let form = $('.quick-donate-form');
    let btn = form.find('[type="submit"]');

    $('select[name="amount"]').on('change', function(event) {
      let selected = $('select[name="amount"] option:selected');

      if ( selected.val() === 'custom' ) {
        $('.quick-donate-form__custom-amount').slideDown();
        $('.quick-donate-form__custom-amount input').attr('required','required');
      } else {
        $('.quick-donate-form__custom-amount').slideUp();
        $('.quick-donate-form__custom-amount input').removeAttr('required');
      }
    });
    
    form.submit(function(e) {
      e.preventDefault();

      if (form[0].checkValidity() === false) {
        return true;
      }
      
      let amount = form.find('select[name="amount"]').val();
      
      if ( amount === 'custom' ) {
        amount = form.find('input[name="custom_amount"]').val();
      }
      
      let type = form.find('select[name="type"]').val();

      let result = basket_add_item(amount, type);

      if (result) {
        update_donation_summary();
      } else alert('Some error');
    });
  };
  
  
  // Basket
  function basket_add_item(amount, type) {
    let item = {
      amount : amount,
      type : type
    };

    // console.log(item);
    // return false;

    // Save
    let basket_items = basket_get_items();
    basket_items.push(item);
    basket_update(basket_items);

    return true;

  }

  // delete
  function basket_remove_item(index) {
    var items = basket_get_items();
    items.splice(index,1);
    basket_update(items);
    return true;
  }

  function basket_update(items) {
    Cookies.set('basket_items', JSON.stringify(items));
    return true;
  }

  // read
  function basket_get_items() {
    let items = Cookies.get('basket_items');

    if (items === undefined || items === null || items === '') {
      basket_update([]);
      return [];
    } else {
      items = JSON.parse(items);
      return items;
    }

  }
  // END Basket

  function update_donation_summary() {
    // loader.show();

    $.ajax({
      url: window.wp_data.ajax_url,
      type: 'POST',
      dataType: 'html',
      data: {
        action: 'donation_summary',
      },
      success: function(data) {
        $('.widget-cart__body').replaceWith(data);
        $('.widget-cart__toggle').trigger('click');

        let basket_items = basket_get_items();
        $('.widget-cart__cart-count').text(basket_items.length);
      }
    });
  }

  let donation_summary = $('.widget-cart');

  donation_summary.on('click', '.widget-cart-items__remove', function(e) {
    e.preventDefault();

    let index = $(this).parents('.widget-cart-items__item').index();
    // index+1 because 0 is main appeal, so additional appeals is starting from 1 in cookies
    basket_remove_item(index);

    // update totals
    update_total();

    // $('[data-toggle="tooltip"]').tooltip('hide');

    $(this).parents('.widget-cart-items__item').remove();
  });

  function update_total() {
    let box = donation_summary.find('.widget-cart__total');
    // var total_amount = parseInt(box.data('total-amount'))+parseInt(box.data('total-additional'));
    let basket_items = basket_get_items();
    let total_amount = 0;

    basket_items.forEach( function(item, index) {
      total_amount += parseInt(item.amount);
    });

    $('.widget-cart__cart-count').text(basket_items.length);
    box.find('span').text(total_amount);
    
    if (basket_items.length === 0) {
      $('.widget-cart__body-bottom').hide();
    }


    // box_giftaid
    // let plus_gift_aid = total_amount * 0.25 + total_amount;
    // $('.box_giftaid').find('.put_price_current').text(total_amount);
    // $('.box_giftaid').find('.put_price').text(plus_gift_aid);
  }
  
  let confirmDonation = function() {
    if ($('#card-element').length) {
      var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
      var styles = {
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
      var elements = stripe.elements();
      var card = elements.create('card', {
        style: styles,
        hidePostalCode: true
      });
      var errorBlock = $('.card-error');

      card.mount('#card-element');

      card.on('change', function(event) {
        if (event.error) {
          errorBlock.text(event.error.message);
        } else {
          errorBlock.text('');
        }        
      });
      
      var form = $('.confirm-form');
      
      form.submit(function(e) {
        e.preventDefault();
        
        location.href = '/thank-you';
      });
    }
  };

  quickDonate();
  confirmDonation();
});