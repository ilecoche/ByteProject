@extends('layouts.admin')
@section('title', 'Place Orders')
@section('additionalstyles')
<!-- This css is to format the table that shows the bill's details. Jordan can delete this if he wants to apply his own style -->
<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container-fluid">
    <h1>Placed Orders Tool</h1>
    
    <div id='placed'><!-- Placeholder for Ajax Call --></div>
    <div id='not_paid'><!-- Placeholder for Ajax Call --></div>
</div>
@stop
@section('additionalscripts')
 <!-- this is the script that makes the Ajaxs calls to the database -->
<script src="{{ asset('/js/placed_orders.js') }}" type="text/javascript"></script>

@stop

