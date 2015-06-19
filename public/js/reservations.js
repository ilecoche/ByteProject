$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

(function(){

$('form.confirm').submit(function(e){
	
	var form = $(this);
	var method = form.find('input[name="_method"]').val() || 'POST';
	var url = form.prop('action');
	e.preventDefault();

	// Setup form validation on the #register-form element
	form.validate({

	    // Specify the validation rules
	    rules: {
	        fname: "required",
	        lname: "required",
	        email: {
	            required: true,
	            email: true
	        },
	        phone: "required"
	    },
	    
	    // Specify the validation error messages
	    messages: {
	        fname: "Please enter your first name",
	        lname: "Please enter your last name",
	        email: "Please enter a valid email address",
	        phone: "Please accept our policy"
	    },
	    
	    submitHandler: function(form) {

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

			form.submit();

	    }
	});

});

})();


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


// $('form.confirm').submit(function(e){
// 	//alert('hi');
// 	var form = $(this);
// 	var method = form.find('input[name="_method"]').val() || 'POST';
// 	var url = form.prop('action');

// 	var first = $('#fname').val();
// 	var last = $('#lname').val();
// 	var email = $('#email').val();
// 	var phone = $('#phone').val();

// 	if(first && last && email && phone)
// 	{
// 		$.ajax({
// 			type: method,
// 			url: url,
// 			data: form.serialize(),
// 			beforeSend: function(){
// 				$('.reserve-container').hide();
// 				$('.reserve-loader').show().html('<i class="fa fa-cog fa-spin fa-3x"></i>');
// 			},
// 			complete: function(){
// 				$('.reserve-loader').hide();
// 				console.log(data); 
// 			},
// 			success: function(data){
// 				$('.reserve-container').html(data).fadeIn();
// 				console.log(data); 
// 	        },
// 			error: function(e){
// 		    	alert(e.message);
// 		  	}
// 		});

// 	}else{
// 		alert('Something is not right');
// 	}

// 	e.preventDefault();

// });

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