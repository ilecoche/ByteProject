// --- reservations --- //
$(document).ready(function(){

    function getReservations() {
        //alert('hi');
        $.ajax({
            type: 'GET',
            url: "reservation/reservation_partial",
            dataType: 'html',
            success: function (data) {
                $('#today').html(data);
            }});
    }
 
    getReservations();

    setInterval(getReservations, 1000); 
        
});