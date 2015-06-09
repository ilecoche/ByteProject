@extends('layouts.main')
@section('title', 'Products')
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
	<div class="row">
                                <div class="col-md-10 col-md-offset-1 message">

            @if(isset($message))
                        {{$message}}
                        @else
                        Product not added
                    @endif
                                        </div>

		<div class="col-md-10 col-md-offset-1">
                    
				<div>
                                    <span class="addnew">
                                        <a href="{{ url('products_admin/create') }}"><i class="glyphicon glyphicon-plus"></i>Add new</a>
                                    </span>
                                </div><!-- add new -->

				<div class="category">
                                    @foreach($products as $category => $productbycategory)
                    <h2>{{ $category }}</h2>
                    <div class="product-listing col-md-10 col-md-offset-1">
                        <ul style="list-style: none;">
                            @foreach($productbycategory as $product)
                            <li id="{{ $product->id }}" class="col-md-4 menu-item">
                                <a href="{{ url('products_admin',$product->id) }}" /><img src="images/{{ $product->image }}" alt="{{ $product->dish }}" style="width: 100%; max-width: 300px;"></a>
                                <span class="dish-name">{{ $product->dish }}</span><br/>
                                <span class="dish-price">{{ $product->price }}</span><br/>
                                <span class="dish-id" style="visibility: hidden;">{{ $product->id }}</span>

                                <span class='link-edit'>
                                    <a href="{{ action('ProductAdminController@edit',$product->id) }}"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                                </span>
                                            |
                                            
                                {!! Form::open(['action' => ['ProductAdminController@destroy', $product->id], 'method' => 'DELETE', 'class' => 'form-inline one-button-form']) !!}
                                    <button type="submit" class="btn btn-link form-inline" >
                                        <i class="glyphicon glyphicon-remove"></i>Delete
                                    </button>
                                                                           {!! Form::close() !!}

                            </li>
                            @endforeach
                        </ul>  
                    </div>
                    @endforeach
                                    
                                </div><!-- category -->
	
		</div>
	</div>
</div>
@stop