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
                                        <th class="actions">ACTIONS</th>
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
                                            @if($row['qty'] > 1)
                                            <a href="{{ url('cart/update', [$row['rowid'],($row['qty'] - 1)] ) }}"><i class="glyphicon glyphicon-minus-sign btn-lg"></i></a>
                                            @else
                                            <i class="glyphicon glyphicon-minus-sign btn-lg inactve"></i>
                                            @endif
                                            {{ $row['qty'] }}
                                            
                                            <a href="{{ url('cart/update', [$row['rowid'],($row['qty'] + 1)] ) }}"><i class="glyphicon glyphicon-plus-sign btn-lg"></i></a>
                                        </td>
                                        <td class="name">{{ $row['name'] }}</td>
                                        <td class="subtotal">{{ $row['subtotal'] }}</td>
                                        <td class="actions">
                                            <a href="{{ url('cart/remove', $row['rowid']) }}"><i class="glyphicon glyphicon-remove-sign btn-lg"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>                                       
                                        <td colspan="3">SUBTOTAL</td>
                                        <td>${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="3">HST</td>
                                        <td>${{ number_format($tax, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="3">TOTAL</td>
                                        <td>${{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr>                                       
                                        <td colspan="3">TIP</td>
                                        <td>{!! Form::text('tip', null) !!}</td>
                                    </tr>
                                </table>  
                              {!! Form::submit('Pay now') !!}                                    
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
@section('additionalscripts')
<!---------function to submit delete form and process it through ajax call -------------->  
<script type="text/javascript" >  
    function deleteRow(id) {
        var row_id = id;
        var geturl = 'cart/remove/'+row_id;
        console.log(row_id);
        console.log(geturl);
        $.get(geturl, function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });

    return false;
    }
    
    function updateForm(thisForm){
         var formData = {
                name     : $('input[name=name]').val(),
                email    : $('input[name=email]').val(),
                homepage : $('input[name=homepage]').val(),
                message  : $('textarea[name=message]').val()
            }

            $.ajax({
                type     : "POST",
                // url      : $(this).attr('action') + '/store',
                url      : $(thisForm).attr('action'),
                data     : formData,
                cache    : false,

                success  : function(data) {
                    console.log(data);
                }
            })

            // console.log(formData);

            return false;

            // alert($(this).attr('action'));

            // alert('form is submited');
        }
</script>
@stop