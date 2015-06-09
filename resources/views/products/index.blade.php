@extends('layouts.main')
@section('title', 'Products')
@section('additionalstyles')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
  h1 { padding: .2em; margin: 0; }
  #cart { width: 200px; float: left; margin-top: 1em; }
  #catalog ul {list-style: none;}
  .catalog-row {position: relative;}
  .menu-item {text-align: center; width: 300px; padding: 0; height: 340px; outline: #555 solid 1px; list-style: none;}
  </style>
  
@stop
@section('content')

<div class="container-fluid">
    <div class="row catalog-row">
		<div id="catalog" class="col-md-8">
                    @foreach($products as $category => $productbycategory)
                    <h2>{{ $category }}</h2>
                    <div>
                        <ul style="list-style: none;">
                            @foreach($productbycategory as $product)
                            <li id="{{ $product->id }}" class="col-md-4 menu-item">
                                <a href="testimonials" /><img src="images/{{ $product->image }}" alt="{{ $product->dish }}" style="width: 100%; max-width: 300px;"></a>
                                <span class="dish-name">{{ $product->dish }}</span><br/>
                                <span class="dish-price">{{ $product->price }}</span><br/>
                                <span class="dish-id" style="visibility: hidden;">{{ $product->id }}</span>


                            </li>
                            @endforeach
                        </ul>  
                    </div>
                    @endforeach
                   
		</div><!-- / col-md-8 -->
                <div id="cart" class="col-md-4" style="position: absolute; top: 0; bottom: 0; right: 0; width: 450px; min-height: 400px; margin-top: -20px; padding-bottom: 20px; background: #7f0000 url(images/table_setting.jpg) 50% 50px no-repeat">
                    <h2 style="color: white;">Your Order</h2>
                    <div id="cart-content" style="padding-bottom: 20px; background-color: rgba(255, 255, 255, 0.95);">
                      
                      @include('cart.widget')
                    </div>
                </div>
	</div><!-- /row-->
</div><!-- /container -->
@stop
@section('additionalscripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>

    <script>
         
  $(function() {

      
      $.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
    });
   
    
    $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone",
      drag: function(event, ui){
      }
    });
    $( "#cart" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
        //$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
        //var fd = new FormData();
        console.log( ui.draggable.find("span.dish-name").text());
        var dishname = ui.draggable.find("span.dish-name").text();
        var dishid = ui.draggable.find("span.dish-id").text();
        var dishprice = ui.draggable.find("span.dish-price").text();

        var fd = { name: dishname, qty: 1, price: dishprice, id: dishid };
        //fd.append = ('qty', 1);
        //fd.append = ('price', 9.99);
        //fd.append = ('id', 2);
        console.log(fd);
        $.ajax({
                    type: 'post',
                    url: 'cart/add',
                    data: fd,
                    success: function(response){
                        $('#cart-content').html(response);
                    },
                    error: function(e){
                        alert(e.message);
                    }
                });
      }
    });
    
   
    
    
    
   
  });
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
  </script>
@stop