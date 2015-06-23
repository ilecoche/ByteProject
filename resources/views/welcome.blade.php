@extends('layouts.main') 
@section('content')
		<div class="my-container">
    
        
            <section id="title">
                <h1>Grab a Byte</h1>
                <input id="search" class="btn-block" type="search" value placeholder="Search for ..."/>
                <a href="{{url ('auth/login')}}" class="btn btn-primary btn-block SR">Sign In</a>
                <a href="#" class="btn btn-primary btn-block SR">Register</a>
            </section>
       
    </div>
@endsection