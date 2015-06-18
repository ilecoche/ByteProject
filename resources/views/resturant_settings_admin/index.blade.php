@extends('layouts.admin')
@section('title', 'Byte | Admin Panel | Edit menu')
@section('content')
 <h2>Resturant Information</h2>
@foreach($map as $m) 
    <h3>
        Name: {{ $m->business_name}}
    </h3>
    <p><strong> Address: </strong> {{$m->address}}</p>
    <p><strong> City: </strong> {{$m->city}}</p>
    <p><strong> Postal Code: </strong> {{$m->postal_code}}</p>
    <p><strong> Business Hours: </strong> {{$m->business_hours}}</p>
    <p><strong> Phone Number: </strong> {{$m->phone}}</p>
    <p><strong> Type of Cuisine: </strong> {{$m->category}}</p>
    <p><strong> Price Range: </strong> {{$m->price}}</p>
    <p><strong> website: </strong> {{$m->website}}</p>
    <p><strong> Number of Tables: </strong> {{$m->number_of_tables}}</p>
    <p><strong> Owner: </strong> {{$m->owner_name}}</p>
    <p><strong> Price Range: </strong> {{$m->price}}</p>
    <p><strong> Email: </strong> {{$m->email}}</p>
    <p><strong> Business Number: </strong> {{$m->business_number}}</p>
    <p><strong> Hst_reg_number: </strong> {{$m->hst_reg_number}}</p>
    
    
    <form>
        <a href="{{ url('rest/edit') }}">Click here to edit </a>
    </form>
@endforeach
@stop