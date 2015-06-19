(function () {
    var StripeBilling = {
        init: function () {
            
            // fetch the form
            this.form = $('#billing-form');
            //fetcj submit button
            this.submitButton = $('#payment');
            // get token from stripe
            var stripeKey = $('meta[name = "publishable-key"]').attr('content');
            // get stripe key
            Stripe.setPublishableKey(stripeKey);
            
            this.bindEvents();
        },
        bindEvents: function () {
            //send token
            this.form.on('submit', $.proxy(this.sendToken, this));
        },
        
        sendToken: function (event) {
            // disable button avoid doble clicking
            this.submitButton.val("One Moment").prop('disabled', true);
            
            //create credit card token
            Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
            
            //stop form from posting
            event.preventDefault();
        },
        
        stripeResponseHandler: function(status, response){

            
            if(response.error){
               // if error enabled the submit button again and display error message 
               $('.payment-error').html(response.error.message + ' Please try again');
                return this.submitButton.val("Pay Bill").prop('disabled', false);
            }
            
           // if no error create hidden inout field and pass the credit card token as a value
            $('<input>',{
                
             type: 'hidden',
             name: 'stripeToken',
             value: response.id
             
            }).appendTo(this.form);
            
            // submit the form.
            this.form[0].submit();
            
        }
        


    };

    StripeBilling.init();

})();

