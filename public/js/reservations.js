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
        fname: {
        	required: true,
        	minlength: 2
        },
        lname: {
        	required: true,
        	minlength: 2
        },
        email: {
            required: true,
            email: true
        },
        phone: {
        	required: true,
        	"phoneUS": true
        }
    },
    
    // Validation error messages
    messages: {
        fname: {
        	required: "Please enter your first name",
        	minlength: "Invalid first name"
        },
        lname: {
        	required: "Please enter your last name",
        	minlength: "Invalid last name"
        },
        email: {
        	required: "Please enter your email address",
        	email: "Invalid email address",
        },
        phone: {
        	required: "Please enter your phone number"
        }
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