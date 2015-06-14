@extends('layouts.main')
@section('title', 'Products')
@section('additionalstyles')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Add Dish</div>

				<div class="panel-body">
                                    {!! Form::open(['url' => 'products_admin', 'files' => true, 'id' => 'mainForm']) !!}
                                    
                                    {!! Form::label('dish', 'Dish Title: ') !!}
                                    {!! Form::text('dish', null, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::label('description', 'Description: ') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::label('menu_category_id', 'Menu Category: ') !!}
                                    {!! Form::select('menu_category_id', $menu_categories, null, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::label('price', 'Price: ') !!}
                                    {!! Form::text('price', null, ['class' => 'form-control', 'size' => '10']) !!}
                                   
                                    {!! Form::label('sku', 'SKU: ') !!}
                                    {!! Form::text('sku', null, ['class' => 'form-control']) !!}

                                    {!! Form::label('image', 'Image: ') !!}
                                    {!! Form::file('image', ['class' => 'form-control']) !!}
                                           
                                    
                                    {!! Form::submit('Add Dish') !!}                                    
                                    {!! Form::close() !!}
                                        
                                    @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
			</div>
		</div>
        <div class="col-md-4" style="position: relative;">
            <h2>Search Nutrition Info</h2>
            <form action="/" id="searchForm">
              <input type="text" name="s" placeholder="Search...">
              <button type="submit"><i class="glyphicon glyphicon-search btn-lg"></i></button>
            </form>
            
            <div id="food-samples">
                                      @include('products_admin.usdanumber')
            </div>
            <div id="nutrition-info">
            </div>
            <div id="ajax-loader" style=" position: absolute; top:0; bottom: 0; left: 0; right: 0; padding: 50%; min-height: 100px; z-index: 10; display:none; background-color: rgba(255, 255, 255, 0.7);">
                <img src="../images/ajax-loader.gif" >
            </div>
        </div>
	</div>
</div>
@stop
@section('additionalscripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.js"></script>


<script type="text/javascript">
    $(function() {
    $('#datetimepicker3').datepicker({
        format: 'yyyy-mm-dd'
        });
    
    });

</script>



<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var loader = $("#ajax-loader");

    function getNutritionInfo(ndbno) {
        loader.show();
        var ndbnom = ndbno;
        /*var new_qty = newqty;
        var geturl = 'product_admin/nutrition/'+row_id + '/' + new_qty;
        */
        //console.log(row_id);
        //console.log(geturl);
        geturl = 'nutrition/' + ndbnom;
        $.get(geturl, function(data, status){
            loader.hide();
           $( "#nutrition-info" ).empty().append( data );
           var $form = $( "#mainForm" ),
                sku = $form.find( "input[name='sku']" ).val(ndbnom);
        });
    }
    
    /*function usdaNumberInfo(){
        var searchparam = $('#dishkeywords').val();
        console.log(searchparam);
        geturl = 'usdanumber/' + searchparam;
        $.get(geturl, function(data, status){
           $('#nutrition-content').html(data);
        });
    }*/

    $( "#searchForm" ).submit(function( event ) {
     
      // Stop form from submitting normally
      event.preventDefault();
      loader.show();
     
      // Get some values from elements on the page:
      var $form = $( this ),
          searchparam = $form.find( "input[name='s']" ).val(),
          url = 'usdanumber';
      console.log(searchparam);
      // Send the data using post
      var posting = $.post( url, { s: searchparam } );
     
      // Put the results in a div
      posting.done(function( data ) {
        //var content = $( data ).find( "#content" );
        loader.hide();
        $( "#food-samples" ).empty().append( data );
        $( "#nutrition-info" ).empty();
         var $form = $( "#mainForm" ),
                sku = $form.find( "input[name='sku']" ).val('');
      });

    });

    $(document).on('click', '.samples', function(event) {
            console.log($(this).attr('id'));
            getNutritionInfo($(this).attr('id'));
            
        });

    

</script>
@stop
@section('additionalstyles')
<link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
@stop