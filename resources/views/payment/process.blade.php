@extends('layouts.main')
@section('title', 'Payment')
@section('additionalstyles')


@stop
@section('content')
<div class="container">
    <!-- sucess page for payment -->
    <h1>Credit Card payment was successful</h1>
    
    <!-- Retrieves the name and email of costumer -->
    <p>Thank you {{$bill->customer_name}}. We have sent an receipt of your purchase at {{$email}}</p>
    <p>Come back soon</p>
</div>
@stop
@section('additionalscripts')



@stop
