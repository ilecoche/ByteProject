@extends('layouts.main')
@section('title', 'Checkout')
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
				<h2>Order Details</h2>
                                {!! Form::open(['url' => 'orders']) !!}
                                    {!! Form::hidden('order_no', $order_no) !!}
                                    {!! Form::hidden('date', $now) !!}
                                    {!! Form::hidden('status', 'pending') !!}
                                    {!! Form::hidden('total', $total) !!}
                                    {!! Form::hidden('type', 'TO') !!}
                                    {!! Form::hidden('tax', $tax) !!}
                                           
                                    
                                    
                                <ul>
                                    <li>
                                        DATE: {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                                        ORDER # {{ $order_no }}
                                    </li>
                                    <li>
                                        CUSTOMER: {!! Form::text('customer_name', null) !!}
                                        TABLE #: {!! Form::text('table_id', null) !!}
                                    </li>
                                    
                                </ul>
                                <table>
                                    <thead>
                                        <th class="qty">QTY</th>
                                        <th class="name">NAME</th>
                                        <th class="subtotal">SUBTOTAL</th>
                                    </thead>
                                    @foreach($cart as $row)
<!--                                    {!! Form::input('hidden', 'menu_item[]',  $row['name']) !!}
                                    {!! Form::input('hidden', 'qty[]', $row['qty']) !!}
                                    {!! Form::input('hidden', 'price[]', $row['price']) !!}-->
<!--                                    <input name="menu_item[]" type="hidden" value="{!! $row['name'] !!}">
                                    <input name="qty[]" type="hidden" value="{!! $row['qty'] !!}">
                                    <input name="price[]" type="hidden" value="{!! $row['price'] !!}">-->

                                    <tr>
                                        <td class="qty">
                                            
                                            {{ $row['qty'] }}
                                            
                                        </td>
                                        <td class="name">{{ $row['name'] }}</td>
                                        <td class="subtotal">{{ $row['subtotal'] }}</td>
                                        
                                    </tr>
                                    @endforeach
                                    <tr>                                       
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="2">HST</td>
                                        <td>${{ number_format($tax, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="2">TOTAL</td>
                                        <td>${{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="2">TIP</td>
                                        <td>{!! Form::text('tip', null) !!}</td>
                                    </tr>
                                </table>  
                              {!! Form::submit('Place Order') !!} 
                              <button type="button" onclick="window.location='{{ url("products") }}'">Want to keep ordering</button>
                                    {!! Form::close() !!}
                        </div>
		</div>
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
@stop
