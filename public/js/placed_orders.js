$(document).ready(function(){
    
    // function to retrieve data from partial view orders
    function callOrders() {
        // passing CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name = csrf-token]').attr('content')
            }
        });
        
        // Ajax call
        $.ajax({
            type: 'GET',
            url: "placed_orders/pending_orders_partial",
            dataType: 'html',
            success: function (data) {
                $('#placed').html(data);
                 
            }});
    }

  // function to retrieve data from partial view payments
    function callPayments() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name = csrf-token]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: "placed_orders/pending_payment_partial",
            dataType: 'html',
            success: function (data) {
                $('#not_paid').html(data);
            }});
    }
 
    // calling functions on load
    callOrders();
    callPayments();
    
    // calling functions every one second for real time order update
    setInterval(callOrders, 1000);
    setInterval(callPayments, 1000);
    
  
    
    
    
});

