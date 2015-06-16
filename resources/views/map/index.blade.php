<!--@extends('layout.Officelayout')

@section('content')
 <h2>Map</h2>
@foreach($map as $c) 
    <h3>
        <a href="{{ url('/cd', $c->id) }}">{{ $c->business_name }}</a>
    </h3>
 @endforeach
    		  <iframe
			width="600"
			height="450"
			frameborder="0" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD0rSvjg9kPCCIjiHV7HFJeLacxbjZ0-rE
			  &q={{ $c->address }}+ {{ $c->city }} +CA"/>
                </iframe>
@stop-->

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
         <h2>Map</h2>
                @foreach($map as $c) 
                    <h3>
                        <a href="{{ url('/cd', $c->id) }}">{{ $c->business_name }}</a>
                    </h3>
                 @endforeach
    		  <iframe
			width="600"
			height="450"
			frameborder="0" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD0rSvjg9kPCCIjiHV7HFJeLacxbjZ0-rE
			  &q={{ $c->address }}+ {{ $c->city }} +CA"/>
                </iframe>
    </body>
</html>
