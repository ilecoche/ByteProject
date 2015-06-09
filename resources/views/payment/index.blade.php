@extends('layouts.main')
@section('title', 'Payment')
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <h1>Credit Card Payment</h1>
    
    <p>it works! order id {{$order_id}}</p>
    <!-- FORM -->
    {!! Form::open(['url' => 'payment/process', 'method' => 'post','id' => 'billing-form'])!!}

<!-- To use the stripe with Laravel no name attr so It does not go to our server -->
<ol id="insert_form">
    <li>
    {!! Form::hidden('order_id', $order_id) !!}    
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
    {!! Form::submit('Pay Now',['class' => 'btn btn-primary form-control', 'id' => 'payment'] )!!}
    <span class="payment-error" style="display: block; color: red;"><!-- Credit Card Payment Error --></span>
    </li>
</ol>
{!! Form::close()!!}
</div>
@stop
@section('additionalscripts')

<script src="{{ asset('/js/billing.js') }}" type="text/javascript"></script>

@stop

