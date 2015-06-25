@extends('layouts.main')
@section('title', 'Payment')
@section('additionalstyles')


@stop
@section('content')
<div class="container-fluid">
    <div id="paid"
    <div class="panel ">
        <div class="panel-heading SR"><h2>Credit Card payment was successful</h2></div>
        <div class="panel-body"><p>Thank you {{$bill->customer_name}}. We have sent an receipt of your purchase at<strong> {{$email}} </strong></p>
    <p>Come back soon</p></div>
    </div>     
    </div>
</div>
@stop
@section('additionalscripts')



@stop
