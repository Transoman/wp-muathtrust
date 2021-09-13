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
      
      btn.addClass('btn-loader');
      
      let amount = form.find('select[name="amount"]').val();
      
      if ( amount === 'custom' ) {
        amount = form.find('input[name="custom_amount"]').val();
      }

      let selectedAmount = form.find('select[name="amount"] option:selected').data('custom-properties');
      
      let type = form.find('select[name="type"]').val();

      let result = basket_add_item(amount, type, null, selectedAmount.title);

      if (result) {
        update_donation_summary(btn);
      } else alert('Some error');
    });
  };
  
  let donationForm = function() {
    let form = $('.donation-form');
    let btn = form.find('[type="submit"]');
    let removeBtn = $('.donation-form__other-amount-remove');
    let amountCustom = $('input[name="amount_custom"]');

    amountCustom.on('input', function() {
      if ( $(this).val() ) {
        removeBtn.show();
      } else {
        removeBtn.hide();
      }
    });

    removeBtn.click(function(e) {
      e.preventDefault();

      if (form[0].checkValidity() === false) {
        return true;
      }

      amountCustom.val('');
      amountCustom.trigger('input');
    });
    
    form.submit(function(e) {
      e.preventDefault();
      
      let type = form.find('input[name="type"]:checked').val();
      let appeal = form.find('input[name="donation"]:checked');
      let appeal_id = appeal.val();
      let amount = form.find('input[name="amount_custom"]').val();
      let title = appeal.data('name');
      
      if (!amount) {
        amount = appeal.data('amount');
      }

      btn.addClass('btn-loader');

      let result = basket_add_item(amount, type, appeal_id, title);

      if (result) {
        update_donation_summary(btn);
      } else alert('Some error');
    });
  };

  let checkoutForm = function() {
    if ($('.checkout-form-box--step-1').length) {
      let form = $('.checkout-form');
      let categoryField = $('select[name="category"]');
      let amountField = $('input[name="amount"]');
      let btn = form.find('[type="submit"]');

      let selectedCategory = categoryField.find('option:selected');

      if (amountField.val() === '') {
        amountField.val(selectedCategory.data('custom-properties').price);
      }

      categoryField.change(function () {
        selectedCategory = $(this).find('option:selected');
        amountField.val(selectedCategory.data('custom-properties').price);
      });

      btn.click(function(e) {
        e.preventDefault();

        btn.addClass('btn-loader');

        let result = basket_add_item(amountField.val(), 'once', categoryField.val(), selectedCategory.data('custom-properties').title);

        if (result) {
          form.submit();
        } else alert('Some error');
      });
    }
  };
  
  
  // Basket
  function basket_add_item(amount, type, item_id = null, title = null) {
    let item = {
      amount: amount,
      type: type,
      item_id: item_id,
      title: title,
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

  function update_donation_summary(btn = null) {
    $.ajax({
      url: window.wp_data.ajax_url,
      type: 'POST',
      dataType: 'html',
      data: {
        action: 'donation_summary',
      },
      success: function(data) {
        if (btn) {
          btn.removeClass('btn-loader');
        }

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
      window.location.href = '/donate';
    }


    // box_giftaid
    let plus_gift_aid = total_amount * 0.25 + total_amount;
    $('.gift-aid').find('.put_price_current').text(total_amount);
    $('.gift-aid').find('.put_price').text(plus_gift_aid);
  }
  
  let confirmDonation = function() {
    if ($('#card-element').length) {
      let stripe = Stripe('pk_test_51JXoKCG3CZkpXfTwJRAQvg3BVJxhyPRTePgRGms0tCrpFTVtEE8HAgRzqSJw3X8AvLdFO3tC2o5vGRrT5semutri00oA9Gj8fY');
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
      let errorBlock = $('.card-error');

      card.mount('#card-element');

      card.on('change', function(event) {
        if (event.error) {
          errorBlock.text(event.error.message);
        } else {
          errorBlock.text('');
        }        
      });
      
      let form = $('.confirm-form');
      let btn = form.find('[type="submit"]');
      
      form.submit(function(e) {
        e.preventDefault();

        btn.addClass('btn-loader');

        stripe.createToken(card).then(function(result) {

          if (result.error) {
            // Inform the user if there was an error.
            errorBlock.text(result.error.message);

            btn.removeClass('btn-loader');
          } else {

            // Send the token to your server.
            let data = {
              action: 'submit_donation',
              token : result.token.id,
              data : $(form).serialize(),
            };

            $.ajax({
              url: window.wp_data.ajax_url,
              type: 'POST',
              dataType: 'json',
              data: data,
            })
              .done(function(data) {
                btn.removeClass('btn-loader');

                if (data.res === true) {
                  basket_update([]);
                  location.href = '/thank-you';
                } else {
                  console.log(data);
                  errorBlock.text(data.message);
                }

              })
              .fail(function(data) {
                btn.removeClass('btn-loader');

                alert('Error');
                console.log("error");
              });


            return false;
          }

        });
      });
    }
  };

  quickDonate();
  donationForm();
  confirmDonation();
  checkoutForm();
});