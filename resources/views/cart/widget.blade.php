             @if($subtotal > 0)

                                <ul>
                                    
                                    @foreach($cart as $row)
                                    <li class="row list-inline">
                                        <span class="qty">
                                            @if($row['qty'] > 1)
                                            <a href="#"  onclick="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] - 1 }} );" ontouchstart="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] - 1 }} );"><i class="glyphicon glyphicon-minus-sign btn-lg"></i></a>
                                            @else
                                            <i class="glyphicon glyphicon-minus-sign btn-lg inactve"></i>
                                            @endif
                                            {{ $row['qty'] }}
                                            
                                            <a href="#" onclick="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] + 1 }} );" ontouchstart="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] + 1 }} );"><i class="glyphicon glyphicon-plus-sign btn-lg"></i></a>
                                        </span>
                                        <span class="name">{{ $row['name'] }}</span>
                                        <span class="subtotal">{{ $row['subtotal'] }}</span>
                                        <span class="actions">
                                            <a href="#" onclick="deleteRow('{{ $row['rowid'] }}');" ontouchstart="deleteRow('{{ $row['rowid'] }}');"><i class="glyphicon glyphicon-remove-sign btn-lg"></i></a>
                                        </span>
                                    </li>
                                    @endforeach
                                     <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">SUBTOTAL</span>
                                        <span class="actions">${{ number_format($subtotal, 2) }}</span>
                                    </li>
                                    <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">HST</span>
                                        <span class="actions">${{ number_format($tax, 2) }}</span>
                                    </li>
                                    <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">TOTAL</span>
                                        <span class="actions">${{ number_format($total, 2) }}</span>
                                    </li>
                                    <li class="row list-inline footer">
                                        <a href="{{ url('orders/create') }}"><button value="Checkout">Checkout</button></a>
                                    </li>
                                   
                                </ul>  
                                
@else 
    <span class="placeholder"><h3>Drag and drop your dishes to this area</h3><span>
@endif