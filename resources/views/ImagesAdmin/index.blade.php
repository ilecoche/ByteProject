@extends('layouts.admin')
@section('title', 'Byte | Admin Panel | Edit menu')

@section('content')
{!! Form::open(['url' => 'image', 'files' => true, 'id' => 'mainForm']) !!}


{!! Form::label('image', 'Image: ') !!}
{!! Form::file('image', ['class' => 'form-control']) !!}
                                           
                                    
{!! Form::submit('Add Image') !!}                                    
{!! Form::close() !!}
@stop