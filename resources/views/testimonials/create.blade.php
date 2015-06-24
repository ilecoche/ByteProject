@extends('layouts.main')
@section('title', 'Write new testimonial')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Write new testimonial</div>

				<div class="panel-body">
                                    {!! Form::open(['url' => 'testimonials']) !!}
                                        <div class="form-group">
                                            {!! Form::label('author', 'Name: ') !!}
                                            {!! Form::text('author', null, ['class' => 'form-control', 'size' => '20']) !!}
                                        </div>
                                    
                                        <div class="form-group">
                                            {!! Form::label('body', 'Message: ') !!}
                                            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                                        </div>
                                    
                                        <div class="form-group">
                                            {!! Form::label('rating', 'Rating: ') !!} &nbsp;
                                            {!! Form::radio('rating', '1') !!} &nbsp;1 &nbsp;
                                            {!! Form::radio('rating', '2') !!} &nbsp;2 &nbsp;
                                            {!! Form::radio('rating', '3') !!} &nbsp;3 &nbsp; 
                                            {!! Form::radio('rating', '4') !!} &nbsp;4 &nbsp; 
                                            {!! Form::radio('rating', '5') !!} &nbsp;5 &nbsp; 
                                        </div>
                                    
                                        <div class="form-group">
                                            {!! Form::submit('Add Testimonial', ['class' => 'btn btn-primary form-control']) !!}
                                        </div>
                                    
                                    {!! Form::close() !!}
                                    
                                    @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div><!-- /panel-body -->
			</div><!-- /panel panel-default -->
		</div><!-- /col-md-10 col-md-offset-1 -->
	</div><!-- /row -->
</div><!-- /container -->
@stop