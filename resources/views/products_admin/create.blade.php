@extends('layouts.main')
@section('title', 'Products')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Add Dish</div>

				<div class="panel-body">
                                    {!! Form::open(['url' => 'products_admin', 'files' => true]) !!}
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

                                    <div class="nutrition_codes">
                                        
                                    </div>

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
        <div class="col-md-4">
            <h2>Search Nutrition Info</h2>
            <a href="#" onclick="getNutritionInfo();"><i class="glyphicon glyphicon-search btn-lg"></i></a>
            <div id="nutrition-content">
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
    function getNutritionInfo() {
        /*var row_id = id;
        var new_qty = newqty;
        var geturl = 'product_admin/nutrition/'+row_id + '/' + new_qty;
        */
        //console.log(row_id);
        //console.log(geturl);
        geturl = 'product_admin/nutrition';
        $.get(geturl, function(data, status){
           $('#nutrition-content').html(data);
        });
    }
    });


</script>
@stop
@section('additionalstyles')
<link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
@stop