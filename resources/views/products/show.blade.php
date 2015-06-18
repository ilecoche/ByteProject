				

				<div class="details-body">
                                    @if( $product->description )
                                        <p>Description: {{ $product->description }} </p>
                                    @endif
                                    <p>Price: $ {{ $product->price }} </p>
                                    @if( $product->sku )
                                        <p>SKU: {{ $product->sku }}</p>
                                    @endif
                                    @if( $nutrition_info )
                                    <h4>Nutrition Info</h4>
                                    <p>
                                        {!! $nutrition_info !!}
                                    </p>
                                    @endif
                                    {!! Form::open(['action' => 'CartController@add', 'method' => 'POST', 'id' => 'addToCartForm']) !!}
                                            {!! Form::hidden('name', $product->dish) !!}
                                            {!! Form::hidden('qty', 1) !!}
                                            {!! Form::hidden('price', $product->price) !!}
                                            {!! Form::hidden('id', $product->id) !!}

                                    
                                        <div class="form-group">
                                            {!! Form::button('<i class="glyphicon glyphicon-shopping-cart"></i> Add to cart', array( 'type' => 'submit', 'class' => 'btn btn-addtocart btn-primary form-control')) !!}

                                        </div>
                                    
                                    {!! Form::close() !!}
                </div>
			
