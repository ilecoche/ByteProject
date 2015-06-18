@extends('layouts.main')
@section('additionalstyles')
<link href="{{ asset('/css/layout.css')}}" rel="stylesheet">
@stop
@section('content')
        <div class="container-fluid">
                @foreach($map as $c) 
                    <h1>
                        <a href="{{ $c->website }}">{{ $c->business_name }}</a>
                    </h1>
                    
                

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="food.jpeg" alt="food">
        </div>

        <div class="item">
          <img src="food.jpeg" alt="food">
        </div>

        <div class="item">
          <img src="food.jpeg" alt="food">
        </div>

        <div class="item">
          <img src="food.jpeg" alt="food">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="row">
    <div class="col-sm-4"><a href="#" class="btn btn-primary center-block SR">Menu</a> </div>
    <div class="col-sm-4"><a href="#" class="btn btn-primary center-block SR">Reserve</a> </div>
    <div class="col-sm-4">
    <div class="panel ">
      <div class="panel-heading SR">Estimated wait time</div>
      <div class="panel-body">{{ $avg}}</div>
    </div>
        </div>
  </div>
  <div class ="row">
     <div class="col-sm-5" >
         <h3>Info pane</h3>
         <ul class="list-group">
            <li class="list-group-item"><span class="glyphicon glyphicon-earphone"></span> {{$c->phone}}</li>
             <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> {{$c->business_hours}}</li>
             <li class="list-group-item"><span class="glyphicon glyphicon-map-marker"></span> {{$c->address}}</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-cutlery"></span> {{$c->category}}</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-usd"></span> {{$c->price}}</li>
         </ul>
      </div>
      <div  class="col-sm-5">
          <iframe
			width=100%
			height=400
			frameborder="0" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD0rSvjg9kPCCIjiHV7HFJeLacxbjZ0-rE
			  &q={{ $c->address }}+ {{ $c->city }} +CA"/>
                </iframe>
      </div>
  </div>
    
</div>

                @endforeach
   @stop
