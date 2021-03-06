@extends('layouts.main')
@section('title', 'Payment')
@section('additionalstyles')
<!-- This css is to format the table that shows the bill's details. Jordan can delete this if he wants to apply his own style -->
<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <!-- If statement to handle Card processing Errors -->
    @if(Session::has('flash_message'))
    <h1>Credit Card Payment for table {{Session::get('bill')->table_id}} (Client: {{Session::get('bill')->customer_name}})</h1>
    @else
    <h1>Credit Card Payment for table {{$bill->table_id}} (Client: {{$bill->customer_name}})</h1>
    @endif
    
     <!-- If statement to display the error message if card is declined for several reasons -->
    @if(Session::has('flash_message'))

    <p class="flash_message">
        {{Session::get('flash_message')}}
    </p>
    @endif
    
     <!-- Table that shows the billing details. I made it small so responsiveness is easier -->
     <!-- It has an if and else statement in case a credit card error triggered -->
    <table id="cust_order">
        <tr>
            <th>Number of items</th>
            <th>Item and price</th>
            <th>price per item</th>
        </tr>
        @if(Session::has('flash_message')) <!-- This means the card was rejected -->
        @foreach(Session::get('order') as $items)
        <tr>
            <td>{{$items->qty}}</td>
            <td>{{$items->menu_item}} ({{$items->price}})</td>
            <td>{{$items->price * $items->qty }}</td>
        </tr>
        @endforeach
        @else <!-- Payment went trough -->
        @foreach($order as $items)
        <tr>
            <td>{{$items->qty}}</td>
            <td>{{$items->menu_item}} ({{$items->price}})</td>
            <td>{{$items->price * $items->qty }}</td>
        </tr>
        @endforeach
        @endif
        <tr>
            <th colspan='2'>Tax</th>
            <th>
                @if(Session::has('flash_message'))
                    {{Session::get('bill')->tax}}
                @else
                {{$bill->tax}}
               @endif
            </th>
            <th></th>
        </tr>
        <tr>
            <th colspan='2'>Tip</th>
            <th>
                <!-- Error Messages was triggered -->
                 @if(Session::has('flash_message'))
                    {{Session::get('bill')->tip}}
                @else
                {{$bill->tip}}
               @endif
            </th>
            <th></th>
        </tr>
        <tr>
            <th colspan='2'>Total payment</th>
            <th>
                <!-- Error Messages was triggered -->
                @if(Session::has('flash_message'))
                    {{Session::get('bill')->total}}
                @else
                {{$bill->total}}
               @endif
            </th>
            <th></th>
        </tr>
    </table>



    <!-- FORM -->
    {!! Form::open(['url' => 'payment/process', 'method' => 'post','id' => 'billing-form'])!!}

    <!-- To use the stripe with Laravel no name attr so It does not go to our server. DO NOT ADD NAME ATTRIBUTES. ONLY EMAIL HAS ONE -->
    <ol id="insert_form">
        <li>
            @if(Session::has('flash_message'))
            {!! Form::hidden('order_id', Session::get('order_id')) !!} 
            @else
            {!! Form::hidden('order_id', $order_id) !!}
            @endif
            {!! Form::label('cardNum', 'Credit Card Number: ') !!}
            {!! Form::text(null, null,['class' => 'form-control', 'data-stripe' => 'number'] ) !!}
        </li>
        <li>
            {!! Form::label('cvc', 'CVC: ') !!}
            {!! Form::text(null, null,['class' => 'form-control', 'data-stripe' => 'cvc'] ) !!}
        </li>
        <li>
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::text(null, null,['class' => 'form-control', 'name' => 'email'] ) !!}
        </li>
        <li>
            {!! Form::label('exp-date', 'Expiration Date: ') !!}
            {!! Form::selectMonth(null, null,['class' => 'form-control', 'data-stripe' => 'exp-month'] ) !!}
            {!! Form::selectYear(null, date('Y'), date('Y') + 10,null,['class' => 'form-control', 'data-stripe' => 'exp-year'] ) !!}
        </li>

        <li>
            {!! Form::submit('Pay Now',['class' => 'btn btn-success form-control', 'id' => 'payment'] )!!}
            <span class="payment-error" style="display: block; color: red;"><!-- Credit Card Payment Error --></span>
        </li>
    </ol>
    {!! Form::close()!!}
</div>
@stop
@section('additionalscripts')
 <!-- this is the script I need to send the payment to the Stripe Server -->
<script src="{{ asset('/js/billing.js') }}" type="text/javascript"></script>

@stop

