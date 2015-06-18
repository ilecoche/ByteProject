$(document.ready(function(){
    function callOrders() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name = csrf_token]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: "./update",
            dataType: 'html',
            success: function (data) {
                $('#display').html(data);
            }});
    }

    function callPayments() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name = csrf_token]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: "./realupdatepayment",
            dataType: 'html',
            success: function (data) {
                $('#notpaid').html(data);
            }});
    }

    callOrders();
//    callPayments();
    setInterval(callOrders, 5000);
//    setInterval(callPayments, 5000);
    
    
    
}));

