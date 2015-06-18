@extends('layouts.admin')
@section('title', 'Byte | Admin Panel | Edit menu')
@if($errors->any())
    @foreach($errors->all() as $e)
        <li>
            {{$e}}
        </li>
    @endforeach
@endif

@section('content')
<div class='container-fluid'>
{!! Form::model($map, ['id' => 'mainForm', 'method' => 'PATCH', 'url' => 'rest/update' ]) !!}

{!! Form::label('business_name', 'Hours of operation: ') !!}
{!! Form::text('business_name', null, ['class' => 'form-control']) !!}
<br />
{!! Form::label('business_hours', 'Business Number: ') !!}
{!! Form::text('business_hours', null, ['class' => 'form-control']) !!}
<br />
{!! Form::label('address', 'Address: ') !!}
{!! Form::text('address', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('City', 'City: ') !!}
{!! Form::text('city', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('postal_code', 'Postal Code: ') !!}
{!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
<br />
{!! Form::label('phone', 'Phone Number: ') !!}
{!! Form::text('phone', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('category', 'Type of Cuisine: ') !!}
{!! Form::text('category', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('price', 'Price Range: ') !!}
{!! Form::text('price', null, ['class' => 'form-control']) !!}
<br />


{!! Form::label('website', 'Website: ') !!}
{!! Form::text('website', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('number_of_tables', 'Number of tables: ') !!}
{!! Form::text('number_of_tables', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('owner_name', 'Owner Name: ') !!}
{!! Form::text('owner_name', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('price', 'Price Range: ') !!}
{!! Form::text('price', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('email', 'Email: ') !!}
{!! Form::text('email', null, ['class' => 'form-control']) !!}
<br />

{!! Form::label('business_number', 'Business Number: ') !!}
{!! Form::text('business_number', null, ['class' => 'form-control']) !!}
<br />
{!! Form::label('hst_reg_number', 'Hst: ') !!}
{!! Form::text('hst_reg_number', null, ['class' => 'form-control']) !!}
<br />



                                                                               
{!! Form::submit('Update Resturant') !!}                                    
{!! Form::close() !!}
</div>
@stop