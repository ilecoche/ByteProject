@extends('layouts.main')
@section('title')
{{ $product->title }}
@stop
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
                                    {{ $product->dish }}
                                    <em>in {{ $product->menu_category->name }}</em>
                                </div>

				<div class="panel-body">
                                    <p>Price: $ {{ $product->price }} </p>
                                    <p>SKU: {{ $product->sku }}</p>
                                    {!! Form::open(['url' => 'cart/add']) !!}
                                            {!! Form::hidden('name', $product->dish) !!}
                                            {!! Form::hidden('qty', 1) !!}
                                            {!! Form::hidden('price', $product->price) !!}
                                            {!! Form::hidden('id', $product->id) !!}

                                    
                                        <div class="form-group">
                                            {!! Form::button('<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Add to cart', array('type' => 'submit', 'class' => 'btn btn-addtocart form-control')) !!}

                                        </div>
                                    
                                    {!! Form::close() !!}
                                </div>
			</div>
		</div>
	</div>
</div>
@stop