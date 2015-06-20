$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

// --- Step 1 - Pick reservation date --- //

$('form.reserve').submit(function(e){

	var form = $(this);
	var method = form.find('input[name="_method"]').val() || 'POST';
	var url = form.prop('action');

	var date = $('#date').val();
	var time = $('#time').val();
	var capacity = $('#capacity').val();

	if(date || time || capacity)
	{
		$.ajax({
			type: method,
			url: url,
			data: form.serialize(),
			beforeSend: function(){
				$('.reserve-container').hide();
				$('.reserve-loader').show().html('<i class="fa fa-cog fa-spin fa-3x"></i>');
			},
			complete: function(){
				$('.reserve-loader').hide();
			},
			success: function(data){
				//console.log(data);
				$('.reserve-container').html(data).fadeIn(); 
	        },
			error: function(e){
		    	alert(e.message);
		  	}
		});

	}else{
		alert('Something is not right');
	}

	e.preventDefault();

});

// --- Step 2 - Personal information --- //

$('form.confirm').validate({

    // Validation rules
    rules: {
        fname: "required",
        lname: "required",
        email: {
            required: true,
            email: true
        },
        phone: "required"
    },
    
    // Validation error messages
    messages: {
        fname: "Please enter your first name",
        lname: "Please enter your last name",
        email: "Please enter a valid email address",
        phone: "Please enter your phone number"
    },
    
    submitHandler: function(form) {

		var method = $(form).find('input[name="_method"]').val() || 'POST';
		var url = $(form).prop('action');

    	$.ajax({
			type: method,
			url: url,
			data: $(form).serialize(),
			beforeSend: function(){
				$('.reserve-container').hide();
				$('.reserve-loader').show().html('<i class="fa fa-cog fa-spin fa-3x"></i>');
			},
			complete: function(){
				$('.reserve-loader').hide();
			},
			success: function(data){
				$('.reserve-container').html(data).fadeIn(); 
	        },
			error: function(e){
		    	alert(e.message);
		  	}
		});
		return false;
    }
});


// $('form.back').submit(function(e){

// 	var form = $(this);
// 	var method = form.find('input[name="_method"]').val() || 'POST';
// 	var url = form.prop('action');

// 	$.ajax({
// 		type: method,
// 		url: url,
// 		data: form.serialize(),
// 		beforeSend: function(){
// 			$('.reserve-container').hide();
// 			$('.reserve-loader').show().html('<i class="fa fa-cog fa-spin fa-3x"></i>');
// 		},
// 		complete: function(){
// 			$('.reserve-loader').hide();
// 		},
// 		success: function(data){
// 			console.log(data);
// 			$('.reserve-container').html(data).fadeIn(); 
//         },
// 		error: function(e){
// 	    	alert(e.message);
// 	  	}
// 	});

// 	e.preventDefault();

// });