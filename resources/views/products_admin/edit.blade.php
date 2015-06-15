@extends('layouts.main')
@section('title', 'Products')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Dish Information: {!! $product->dish !!}</div>

				<div class="panel-body">
                                    <!-- removes escaping -->
                                    {!! Form::model($product, ['method' => 'PATCH', 'action' => ['ProductAdminController@update', $product->id]] ) !!}
                                    {!! Form::label('dish', 'Dish title: ') !!}
                                    {!! Form::text('dish', null, ['class' => 'form-control']) !!}
                                    {!! Form::label('description', 'Description: ') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                    {!! Form::label('menu_category_id', 'Menu Category: ') !!}
                                    {!! Form::text('menu_category_id', null, ['class' => 'form-control']) !!}
                                    {!! Form::label('price', 'Price: ') !!}
                                    {!! Form::text('price', null, ['class' => 'form-control', 'size' => '10']) !!}
                                    {!! Form::label('sku', 'SKU: ') !!}
                                    {!! Form::text('sku', null, ['class' => 'form-control']) !!}
                                           
                                       
                                    
                                    {!! Form::submit('Update Dish') !!}                                    
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
@stop
@section('additionalstyles')
<link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
@stop