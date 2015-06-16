(function () {
    var StripeBilling = {
        init: function () {
            this.form = $('#billing-form');
            this.submitButton = $('#payment');
            var stripeKey = $('meta[name = "publishable-key"]').attr('content');

            Stripe.setPublishableKey(stripeKey);

            this.bindEvents();
        },
        bindEvents: function () {
            this.form.on('submit', $.proxy(this.sendToken, this));
        },
        
        sendToken: function (event) {
            this.submitButton.val("One Moment").prop('disabled', true);
            
            Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
            event.preventDefault();
        },
        
        stripeResponseHandler: function(status, response){
             this.submitButton.val("Pay Bill");

            
            if(response.error){
               $('.payment-error').html(response.error.message + ' Please try again');
                return this.submitButton.val("Pay Bill").prop('disabled', false);
            }
            
           
            $('<input>',{
                
             type: 'hidden',
             name: 'stripeToken',
             value: response.id
             
            }).appendTo(this.form);
            
            this.form[0].submit();
            
        }
        


    };

    StripeBilling.init();

})();

