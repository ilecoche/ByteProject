             @if($subtotal > 0)

                                <table>
                                    <tbody>
                                        @foreach($cart as $row)
                                        <tr class="row list-inline">
                                            <td>
                                                <span class="qty">
                                                    @if($row['qty'] > 1)
                                                    <a href="#"  onclick="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] - 1 }} );" ontouchstart="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] - 1 }} );"><i class="glyphicon glyphicon-minus-sign btn-lg"></i></a>
                                                    @else
                                                    <i class="glyphicon glyphicon-minus-sign btn-lg inactve"></i>
                                                    @endif
                                                    {{ $row['qty'] }}
                                                    
                                                    <a href="#" onclick="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] + 1 }} );" ontouchstart="updateRow('{{ $row['rowid'] }}', {{ $row['qty'] + 1 }} );"><i class="glyphicon glyphicon-plus-sign btn-lg"></i></a>
                                                </span>
                                            </td>
                                            <td><span class="name">{{ $row['name'] }}</span></td>
                                            <td><span class="subtotal">{{ $row['subtotal'] }}</span></td>
                                            <td>
                                                <span class="actions">
                                                <a href="#" onclick="deleteRow('{{ $row['rowid'] }}');" ontouchstart="deleteRow('{{ $row['rowid'] }}');"><i class="glyphicon glyphicon-remove-sign btn-lg"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><span class="subtotal">SUBTOTAL</span></td>
                                            <td><span class="actions">${{ number_format($subtotal, 2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><span class="subtotal">HST</span></td>
                                            <td><span class="actions">${{ number_format($tax, 2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><span class="subtotal">TOTAL</span></td>
                                            <td><span class="actions">${{ number_format($total, 2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><a href="{{ url('orders/create') }}"><button class="btn btn-primary btn-checkout form-control" value="Checkout">Checkout</button></a></td>
                                        </tr>
                                    </tfoot>
                                </table>  
                                
@else 
    <span class="placeholder"><h3>Drag and drop your dishes to this area</h3><span>
@endif