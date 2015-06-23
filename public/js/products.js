//products.js   

    $(function() {

    var loader = $("#ajax-loader");

    $.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
    }); // $.ajaxSetup({ ...
   
    
    $( "#catalog" ).accordion();

    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone",
      containment: "#container-fluid",
      zIndex: 100,
      //stack: "#cart",
      drag: function(event, ui){
      	
      }, 
      stop: function(event, ui){
      	
      }
    }); // $( "#catalog li" ).draggable({ ....

    $( "#cart" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
        //$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
        //var fd = new FormData();
        console.log( ui.draggable.find("span.dish-name").text() );
        var dishname = ui.draggable.find("span.dish-name").text();
        var dishid = ui.draggable.find("span.dish-id").text();
        var dishprice = ui.draggable.find("span.dish-price").text();

        var fd = { name: dishname, qty: 1, price: dishprice, id: dishid };
        
        console.log(fd);
        $.ajax({
                    type: 'post',
                    url: 'cart/add',
                    data: fd,
                    success: function(response){
                        $('#cart-content').html(response);
                        var autoHeight = $('#cart-content').css('height', 'auto').height() + 160;
                        if($('body').height() < autoHeight){
	        				$('body').animate({ "height": autoHeight }, 200);
	        			}
						if ($(window).width() < 926) {
             				expandCart(false);
        	 			}
                    },
                    error: function(e){
                        alert(e.message);
                    }
                }); //  $.ajax({
      } //  drop: function( event, ui ) { ....
    }); // $( "#cart" ).droppable({ .......
    
  $(document).on('click', '.details-links', function(event) {
      event.preventDefault();
      $("#myModalLabel").html('Loading details ...');
      $( ".modal-body" ).empty();

      loader.show();

      var dishid = $(this).parent().attr('id');
      console.log(dishid);
      var dishname = $(this).parent().find('.dish-name').html();
      console.log(dishname);
      geturl = 'products/' + dishid;
        $.get(geturl, function(data, status){

          loader.hide();

          var $header = $(data).filter('.details-header').contents();
          console.log($header);

          //$("#myModalLabel").html($header);
          $("#myModalLabel").html(dishname);
          $( ".modal-body" ).empty().append( data );
          var $sampletitle = $(document).find("#food-sample-title");
          console.log($sampletitle.html());
          $sampletitle.empty();
                    console.log($sampletitle.html());


      }); // $.get(geturl, function(data, status){ ...
            
  }); // $(document).on('click', '.details-links' ...


  $(document).on('submit',"#addToCartForm", function(event){
          event.preventDefault();
          var $form = $(document).find("form#addToCartForm"),
          fd = $form.serialize(),
          url = 'cart/add';   
          console.log($form.attr("id"));
       
          $.post(url,fd)
          .done(function(response){
             $('#cart-content').html(response);
             var autoHeight = $('#cart-content').css('height', 'auto').height() + 160;
			 if($('body').height() < autoHeight){
	        	$('body').animate({ "height": autoHeight }, 200);
	         }
             if ($(window).width() < 926) {
             	expandCart(false);
        	 }
          })
          .fail(function(e){
            alert(e.message);
          });
          $( "#myModal").modal('hide');
          $( ".modal-body" ).empty();


  }); // $(document).on('submit',"#addToCartForm",....
    

  $('#expand-cart').click(function(){
  	
  	expandCart(true);
  }); // $('#expand-cart').click(function(){

  }); // main function $(function()

   function deleteRow(id) {
        var row_id = id;
        var geturl = 'cart/remove/'+row_id;
        console.log(row_id);
        console.log(geturl);
        $.get(geturl, function(data, status){
           $('#cart-content').html(data);
        });

    return false;
    }
    
    function updateRow(id,newqty) {
        var row_id = id;
        var new_qty = newqty;
        var geturl = 'cart/update/'+row_id + '/' + new_qty;
        console.log(row_id);
        console.log(geturl);
        $.get(geturl, function(data, status){
           $('#cart-content').html(data);
        });

    return false;
    }

    function expandCart(te){
    	//console.log('called expandCart');
    	if($('#cart').hasClass("expanded")){
    	var toggleEnabled = te;
		if(toggleEnabled){
  		//console.log('alreday expanded ... collapsing');
	    $('#cart').animate({"height": "200px"}).removeClass("expanded");
	    $('#expand-cart').animate({  borderSpacing: 360 }, {
    step: function(now,fx) {
      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
      $(this).css('-moz-transform','rotate('+now+'deg)');
      $(this).css('transform','rotate('+now+'deg)');
    },
    duration:'slow'
},'linear');
	   } // if(toggleEnabled){
	   	else {
	   		var autoHeight = $('#cart-content').css('height', 'auto').height() + 130;
	    $('#cart').animate({ "height": autoHeight }, 200);
	   	}

	}  else {
		//console.log('expanding ...');
		 var autoHeight = $('#cart-content').css('height', 'auto').height() + 130;
	    $('#cart').animate({ "height": autoHeight }, 200).addClass("expanded");
	    $('body').animate({ "height": autoHeight }, 200);
	    $('#expand-cart').animate({  borderSpacing: 180 }, {
    step: function(now,fx) {
      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
      $(this).css('-moz-transform','rotate('+now+'deg)');
      $(this).css('transform','rotate('+now+'deg)');
    },
    duration:'slow'
},'linear');
	} // else
} //  function expandCart(){
