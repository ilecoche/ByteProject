				<div class="details-header">
                    {{ $product->dish }}
                    <em>in {{ $product->menu_category->name }}</em>
                </div>

				<div class="details-body">
                                    <p>Price: $ {{ $product->price }} </p>
                                    <p>SKU: {{ $product->sku }}</p>
                                    <p>
                                        Nutrition Info<br/>
                                        {!! $nutrition_info !!}
                                    </p>
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
			
