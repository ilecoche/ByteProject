@extends('layouts.admin')
@section('title', 'Byte | Admin Panel | Edit menu')
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
                                    <p>Description: {{ $product->description }} </p>
                                    <p>Price: $ {{ $product->price }} </p>
                                    <p>SKU: {{ $product->sku }}</p>
                                    <span class='link-edit'>
                                        <a href="{{ action('ProductAdminController@edit',$product->id) }}"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                                    </span>
                                            |
                                            
                                {!! Form::open(['action' => ['ProductAdminController@destroy', $product->id], 'method' => 'DELETE', 'class' => 'form-inline one-button-form']) !!}
                                    <button type="submit" class="btn btn-link form-inline" >
                                        <i class="glyphicon glyphicon-remove"></i>Delete
                                    </button>
                                                                           {!! Form::close() !!}

                                </div>
			</div>
		</div>
	</div>
</div>
@stop