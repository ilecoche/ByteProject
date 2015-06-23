@extends('layouts.main')
@section('title', 'Products')
@section('additionalstyles')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="{{ asset('/css/products.css') }}" rel="stylesheet">
@stop
@section('content')

<div class="container-fluid">
    <div id="cart" class="col-md-4">
        <h2>Your Order <i id="expand-cart" class="glyphicon glyphicon-chevron-down"></i></h2>
        <div id="cart-content">
                      
        @include('cart.widget')
        </div> <!-- /cart-content -->
    </div><!-- /cart -->
		<div id="catalog" class="col-md-8">
                    @foreach($products as $category => $productbycategory)
                    <h2>{{ $category }}</h2>
                    <div>
                        <ul class="product-listing">
                            @foreach($productbycategory as $product)
                            <li id="{{ $product->id }}" class="col-sm-4 menu-item">
                                <a href="#" data-toggle="modal" data-target="#myModal" class="details-links">
                                  <img src="images/{{ $product->image }}" alt="{{ $product->dish }}" class="product-image">
                                </a>
                                <span class="dish-name">{{ $product->dish }}</span><br/>
                                <span class="dish-price">{{ $product->price }}</span><br/>
                                <span class="dish-id">{{ $product->id }}</span>


                            </li>
                            @endforeach
                        </ul>  
                    </div>
                    @endforeach
                   
		</div><!-- / col-md-8 -->
                
</div><!-- /container -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Loading details ...</h4>
      </div>
      <div id="ajax-loader">
                <img src="../public/images/ajax-loader.gif" >
            </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@stop
@section('additionalscripts')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/products.js"></script>

@stop