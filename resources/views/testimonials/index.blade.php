@extends('layouts.main')
@section('title', 'Testimonials')
@section('additionalstyles')
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
                                    Testimonials
                                    <span class="addnew">
                                        <a href="{{ url('testimonials/create') }}"><i class="glyphicon glyphicon-plus"></i>Add new</a>
                                    </span>

                                </div>

				<div class="panel-body">
                                    {{-- */$count = count($testimonials)/* --}}
                                    @foreach($testimonials as $testimonial)
                                        <p>{{ $testimonial->body }} </p>
                                        <small>by {{ $testimonial->author }}</small>
                                        <br />
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                            <i class='glyphicon glyphicon-star'></i> 
                                            @else
                                            <i class='glyphicon glyphicon-star-empty'></i>                                        
                                            @endif
                                        @endfor                                    
                                        <small> Rating {{ $testimonial->rating }}</small>

                                        @if( Auth::check() )

                                        <a href="{{ url('testimonials/destroy',$testimonial->id) }}"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                                        
                                        @endif
                                        {{-- */$count--/* --}}
                                        @if($count >= 1)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
			</div>
		</div>
	</div>
</div>
@stop