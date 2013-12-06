 var initStriper = function(){

    jQuery(function($) {


    var $form = $('form.checkout,form#order_review');
    var stripeResponseHandler = function(status, response) {

    if (response.error) {

      // Show the errors on the form
      $form.find('.payment-errors').text(response.error.message);
      // Unblock the form to re-enter data
      $form.unblock();

    } else {
      // Append the Token
      $form.append($('<input type="hidden" name="stripeToken" />').val(response.id));

      //Re-Submit
      $form.submit();

    }
  };

    $('body').on('click', 'form#order_review input:submit', function(){
      // Make sure there's not an old token on the form
      Stripe.setPublishableKey($('#stripe_pub_key').data('publishablekey'));
      Stripe.createToken($form, stripeResponseHandler);
      return false;
    });


    $('body').on('click', 'form.checkout input:submit', function(){
      // Make sure there's not an old token on the form
      $('form.checkout').find('[name=stripeToken]').remove()
    })


    // Bind to the checkout_place_order event to add the token
    $('form.checkout').bind('checkout_place_order_Striper', function(e){
      if (window.striper) 
      {
        return;
      }

      window.striper = true;
      if($('input[name=payment_method]:checked').val() != 'Striper'){
          return true;
      }

      $form.find('.payment-errors').html('');
      $form.block({message: null,overlayCSS: {background: "#fff url(" + woocommerce_params.ajax_loader_url + ") no-repeat center",backgroundSize: "16px 16px",opacity: .6}});

      // Pass if we have a token
      if( $form.find('[name=stripeToken]').length)
        return true;

      Stripe.setPublishableKey($('#stripe_pub_key').data('publishablekey'));
      Stripe.createToken($form, stripeResponseHandler)
      // Prevent the form from submitting with the default action
      return false;
    });
  });
};

if(typeof jQuery=='undefined')
{
    var headTag = document.getElementsByTagName("head")[0];
    var jqTag = document.createElement('script');
    jqTag.type = 'text/javascript';
    jqTag.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js';
    jqTag.onload = initStriper;
    headTag.appendChild(jqTag);
} else {
   initStriper()
}
