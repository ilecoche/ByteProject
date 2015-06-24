$(document).ready(function () {

	var today = new Date();
	
    $('input.reserve-date').datepicker({
        orientation: "top auto",
        todayHighlight: true,
        format: "MM d, yyyy",
        startDate: today,
        "autoclose": true
    });
    
});