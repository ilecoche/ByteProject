@extends('layouts.main')
@section('title', 'Payment')
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <!-- sucess page for payment -->
    <h1>Credit Card payment was successful</h1>
    
    <p>Thank you {{$bill->customer_name}} and come back soon to our restaurant!</p>
   
</div>
@stop
@section('additionalscripts')



@stop
